<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'notifikasi';
    protected $primaryKey       = 'id_notifikasi';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_penelitian_pengabdian",
        "status_notifikasi",
        "status_surat",
        "jenis_notifikasi",
        "tampil_di",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getNotifications()
    {
        // Ambil penelitian
        $penelitian = $this->db->table('penelitian')
            ->select('
            id_penelitian as id,
            judul_penelitian AS judul,
            status,
            dibaca,
            updated_at
        ')
            ->get()
            ->getResultArray();

        // Tambahkan jenis_notifikasi = 1
        foreach ($penelitian as &$p) {
            $p['jenis_notifikasi'] = 1;
        }

        // Ambil pengabdian
        $pengabdian = $this->db->table('pengabdian')
            ->select('
            id_pengabdian as id,
            judul_pengabdian AS judul,
            status,
            dibaca,
            updated_at
        ')
            ->get()
            ->getResultArray();

        // Tambahkan jenis_notifikasi = 2
        foreach ($pengabdian as &$g) {
            $g['jenis_notifikasi'] = 2;
        }

        // Gabungkan
        $combined = array_merge($penelitian, $pengabdian);

        // Urutkan berdasarkan updated_at DESC
        usort($combined, function ($a, $b) {
            return strtotime($b['updated_at']) - strtotime($a['updated_at']);
        });

        // var_dump($combined);
        // die;
        
        return $combined;
    }
}
