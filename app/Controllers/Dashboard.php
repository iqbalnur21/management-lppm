<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// Pastikan Anda memanggil semua Model yang akan digunakan
use App\Models\PenelitianModel;
use App\Models\PengabdianModel;
use App\Models\PublikasiModel;
use App\Models\HkiModel;
use App\Models\PrototypeModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Inisialisasi model
        $penelitianModel = new PenelitianModel();
        $pengabdianModel = new PengabdianModel();
        $publikasiModel  = new PublikasiModel();
        $hkiModel        = new HkiModel();
        $db              = \Config\Database::connect();

        $data = [];

        // 1. Data untuk Kartu Statistik (Widget Atas)
        // ... (Tidak ada perubahan di bagian ini) ...
        $countPenelitian = $penelitianModel->select('status, COUNT(*) as total')
            ->groupBy('status')
            ->findAll();
        $countPengabdian = $pengabdianModel->select('status, COUNT(*) as total')
            ->groupBy('status')
            ->findAll();
        $statusCounts = ['menunggu' => 0, 'revisi' => 0, 'diverifikasi' => 0, 'selesai' => 0];
        foreach ($countPenelitian as $row) {
            if (isset($statusCounts[$row['status']])) {
                $statusCounts[$row['status']] += $row['total'];
            }
        }
        foreach ($countPengabdian as $row) {
            if (isset($statusCounts[$row['status']])) {
                $statusCounts[$row['status']] += $row['total'];
            }
        }
        $data['total_usulan']       = array_sum($statusCounts);
        $data['total_menunggu']     = $statusCounts['menunggu'];
        $data['total_revisi']       = $statusCounts['revisi'];
        $data['total_diverifikasi'] = $statusCounts['diverifikasi'];
        $total_dana_penelitian = $penelitianModel->selectSum('jumlah_dana')->get()->getRow()->jumlah_dana ?? 0;
        $total_dana_pengabdian = $pengabdianModel->selectSum('jumlah_dana')->get()->getRow()->jumlah_dana ?? 0;
        $data['total_dana_all'] = $total_dana_penelitian + $total_dana_pengabdian;
        $data['total_publikasi'] = $publikasiModel->countAllResults();
        $data['total_hki']       = $hkiModel->countAllResults();


        // 2. Data untuk Grafik Utama (Usulan per Bulan)
        // ... (Tidak ada perubahan di bagian ini) ...
        $chart_labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $chart_penelitian = array_fill(0, 12, 0);
        $chart_pengabdian = array_fill(0, 12, 0);
        $currentYear = date('Y');
        $penelitianPerBulan = $penelitianModel->select("COUNT(*) as total, MONTH(created_at) as bulan")
            ->where('YEAR(created_at)', $currentYear)
            ->groupBy('MONTH(created_at)')
            ->findAll();
        foreach ($penelitianPerBulan as $row) {
            $chart_penelitian[$row['bulan'] - 1] = (int)$row['total'];
        }
        $pengabdianPerBulan = $pengabdianModel->select("COUNT(*) as total, MONTH(created_at) as bulan")
            ->where('YEAR(created_at)', $currentYear)
            ->groupBy('MONTH(created_at)')
            ->findAll();
        foreach ($pengabdianPerBulan as $row) {
            $chart_pengabdian[$row['bulan'] - 1] = (int)$row['total'];
        }
        $data['chart_labels'] = json_encode($chart_labels);
        $data['chart_penelitian'] = json_encode($chart_penelitian);
        $data['chart_pengabdian'] = json_encode($chart_pengabdian);

        // 3. Data untuk "Peneliti Teraktif" (Top 5)
        // ... (Tidak ada perubahan di bagian ini) ...
        $queryPeneliti = $db->query("
            SELECT user_id, users.name, COUNT(*) as total_usulan 
            FROM (
                SELECT user_id FROM penelitian WHERE deleted_at IS NULL
                UNION ALL
                SELECT user_id FROM pengabdian WHERE deleted_at IS NULL
            ) as usulan
            JOIN users ON users.id = usulan.user_id
            WHERE usulan.user_id IS NOT NULL
            GROUP BY user_id, users.name
            ORDER BY total_usulan DESC
            LIMIT 5
        ");
        $data['peneliti_teraktif'] = $queryPeneliti->getResultArray();

        // 4. Data untuk Tabel "Usulan Menunggu Verifikasi"
        // ... (Tidak ada perubahan di bagian ini) ...
        $builderPenelitian = $penelitianModel->builder()
            ->select('id_penelitian as id, judul_penelitian as judul, penelitian.created_at as tgl_dibuat, penelitian.status, "Penelitian" as tipe, "penelitian" as variable, users.name as nama_pengaju')
            ->join('users', 'users.id = penelitian.user_id')
            ->where('penelitian.status', 'menunggu');
        $builderPengabdian = $pengabdianModel->builder()
            ->select('id_pengabdian as id, judul_pengabdian as judul, pengabdian.created_at as tgl_dibuat, pengabdian.status, "Pengabdian" as tipe, "pengabdian" as variable, users.name as nama_pengaju')
            ->join('users', 'users.id = pengabdian.user_id')
            ->where('pengabdian.status', 'menunggu');
        $unionQuery = $builderPenelitian->getCompiledSelect() . ' UNION ' . $builderPengabdian->getCompiledSelect();
        $data['usulan_menunggu'] = $db->query($unionQuery . " ORDER BY tgl_dibuat DESC LIMIT 5")->getResultArray();

        // 5. Data untuk "Usulan Perlu Revisi" (Tickets)
        // ... (Tidak ada perubahan di bagian ini) ...
        $builderPenelitianRevisi = $penelitianModel->builder()
            ->select('id_penelitian as id, judul_penelitian as judul, "Penelitian" as tipe, "penelitian" as variable, users.name as nama_pengaju, penelitian.updated_at as tgl_diupdate')
            ->join('users', 'users.id = penelitian.user_id')
            ->where('penelitian.status', 'revisi');
        $builderPengabdianRevisi = $pengabdianModel->builder()
            ->select('id_pengabdian as id, judul_pengabdian as judul, "Pengabdian" as tipe, "pengabdian" as variable, users.name as nama_pengaju, pengabdian.updated_at as tgl_diupdate')
            ->join('users', 'users.id = pengabdian.user_id')
            ->where('pengabdian.status', 'revisi');
        $unionRevisiQuery = $builderPenelitianRevisi->getCompiledSelect() . ' UNION ' . $builderPengabdianRevisi->getCompiledSelect();
        $data['usulan_revisi'] = $db->query($unionRevisiQuery . " ORDER BY tgl_diupdate DESC LIMIT 3")->getResultArray();


        // ---------------------------------------------------------------
        // 6. Data untuk Grafik Widget (BARU)
        // ---------------------------------------------------------------

        // --- DATA WIDGET DANA (BALANCE-CHART) ---
        $dana_labels = [];
        $dana_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $month = date('m', strtotime("-$i month"));
            $year = date('Y', strtotime("-$i month"));
            $dana_labels[] = date('M', strtotime("-$i month"));

            $q_dana_penelitian = $penelitianModel->selectSum('jumlah_dana', 'total')
                ->where('MONTH(created_at)', $month)
                ->where('YEAR(created_at)', $year)
                ->get()->getRow()->total ?? 0;

            $q_dana_pengabdian = $pengabdianModel->selectSum('jumlah_dana', 'total')
                ->where('MONTH(created_at)', $month)
                ->where('YEAR(created_at)', $year)
                ->get()->getRow()->total ?? 0;

            $dana_data[] = ($q_dana_penelitian + $q_dana_pengabdian) / 1000000; // Dalam jutaan
        }
        $data['chart_dana_labels'] = json_encode($dana_labels);
        $data['chart_dana_data'] = json_encode($dana_data);

        // --- DATA WIDGET LUARAN (SALES-CHART) ---
        $luaran_labels = [];
        $luaran_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $month = date('m', strtotime("-$i month"));
            $year = date('Y', strtotime("-$i month"));
            $luaran_labels[] = date('M', strtotime("-$i month"));

            $q_luaran_publikasi = $publikasiModel->where('MONTH(created_at)', $month)
                ->where('YEAR(created_at)', $year)
                ->countAllResults();

            $q_luaran_hki = $hkiModel->where('MONTH(created_at)', $month)
                ->where('YEAR(created_at)', $year)
                ->countAllResults();

            $luaran_data[] = $q_luaran_publikasi + $q_luaran_hki;
        }
        $data['chart_luaran_labels'] = json_encode($luaran_labels);
        $data['chart_luaran_data'] = json_encode($luaran_data);

        // Kirim semua data ke view
        return view('dashboard', $data);
    }
}
