<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Data extends Seeder
{
    public function run()
    {
        // Gunakan helper Time untuk timestamp
        $time = new Time('now', 'Asia/Jakarta', 'id_ID');

        // ----------------------------------------
        // 1. Tabel Roles
        // ----------------------------------------
        $roles = [
            ['nama_role' => 'dosen'],         // ID: 1
            ['nama_role' => 'staf_lppm'],     // ID: 2
            ['nama_role' => 'kepala_lppm'],   // ID: 3
        ];
        $this->db->table('roles')->insertBatch($roles);

        // ----------------------------------------
        // 2. Tabel Users (Dosen & Staf)
        // ----------------------------------------
        $users = [
            [
                'role_id'  => 1, // dosen
                'name'     => 'Dr. Budi Santoso',
                'username' => 'budi',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'created_at' => $time->now(),
                'updated_at' => $time->now(),
            ], // ID: 1
            [
                'role_id'  => 1, // dosen
                'name'     => 'Prof. Indah Cahyani',
                'username' => 'indah',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'created_at' => $time->now(),
                'updated_at' => $time->now(),
            ], // ID: 2
            [
                'role_id'  => 1, // dosen
                'name'     => 'Ahmad Zulkifli, M.Kom.',
                'username' => 'ahmad',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'created_at' => $time->now(),
                'updated_at' => $time->now(),
            ], // ID: 3
            [
                'role_id'  => 2, // staf_lppm
                'name'     => 'Admin LPPM',
                'username' => 'staf',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'created_at' => $time->now(),
                'updated_at' => $time->now(),
            ], // ID: 4
            [
                'role_id'  => 3, // staf_lppm
                'name'     => 'Kepala LPPM',
                'username' => 'admin',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'created_at' => $time->now(),
                'updated_at' => $time->now(),
            ], // ID: 4
        ];
        $this->db->table('users')->insertBatch($users);

        // ----------------------------------------
        // 3. Tabel Penelitian
        // ----------------------------------------
        $penelitian = [
            [
                'user_id'          => 1, // Budi
                'judul_penelitian' => 'Sistem Cerdas untuk Deteksi Penyakit Tanaman Padi',
                'skema_penelitian' => 'Penelitian Dasar',
                'tahun_penelitian' => '2025',
                'sumber_dana'      => 'Internal',
                'jumlah_dana'      => 50000000,
                'status'           => 'menunggu',
                'catatan_verifikator' => null,
                'created_at'       => $time->createFromDate(2025, 10, 1),
                'updated_at'       => $time->createFromDate(2025, 10, 1),
            ],
            [
                'user_id'          => 2, // Indah
                'judul_penelitian' => 'Analisis Big Data untuk Model Transportasi Urban Cerdas',
                'skema_penelitian' => 'Penelitian Terapan',
                'tahun_penelitian' => '2025',
                'sumber_dana'      => 'Dikti',
                'jumlah_dana'      => 150000000,
                'status'           => 'revisi',
                'catatan_verifikator' => 'Mohon perbaiki RAB dan metodologi.',
                'created_at'       => $time->createFromDate(2025, 9, 15),
                'updated_at'       => $time->createFromDate(2025, 9, 20),
            ],
            [
                'user_id'          => 1, // Budi
                'judul_penelitian' => 'Pengembangan Framework IoT untuk Smart Home Hemat Energi',
                'skema_penelitian' => 'Penelitian Unggulan',
                'tahun_penelitian' => '2025',
                'sumber_dana'      => 'Internal',
                'jumlah_dana'      => 75000000,
                'status'           => 'diverifikasi',
                'catatan_verifikator' => null,
                'created_at'       => $time->createFromDate(2025, 8, 5),
                'updated_at'       => $time->createFromDate(2025, 8, 10),
            ],
            [
                'user_id'          => 3, // Ahmad
                'judul_penelitian' => 'Kajian Keamanan Data pada Aplikasi Mobile Banking',
                'skema_penelitian' => 'Penelitian Dasar',
                'tahun_penelitian' => '2025',
                'sumber_dana'      => 'Internal',
                'jumlah_dana'      => 40000000,
                'status'           => 'selesai',
                'catatan_verifikator' => null,
                'created_at'       => $time->createFromDate(2025, 7, 10),
                'updated_at'       => $time->createFromDate(2025, 7, 15),
            ],
            [
                'user_id'          => 1, // Budi
                'judul_penelitian' => 'Model Prediksi Kinerja Mahasiswa Menggunakan Machine Learning',
                'skema_penelitian' => 'Penelitian Dosen Pemula',
                'tahun_penelitian' => '2025',
                'sumber_dana'      => 'Internal',
                'jumlah_dana'      => 25000000,
                'status'           => 'menunggu',
                'catatan_verifikator' => null,
                'created_at'       => $time->createFromDate(2025, 10, 5),
                'updated_at'       => $time->createFromDate(2025, 10, 5),
            ],
        ];
        $this->db->table('penelitian')->insertBatch($penelitian);

        // ----------------------------------------
        // 4. Tabel Pengabdian
        // ----------------------------------------
        $pengabdian = [
            [
                'user_id'           => 2, // Indah
                'judul_pengabdian'  => 'Pelatihan Digital Marketing untuk UMKM Desa Sukamaju',
                'lokasi_pengabdian' => 'Desa Sukamaju, Kab. A',
                'sumber_dana'       => 'Internal',
                'jumlah_dana'       => 30000000,
                'tahun_pelaksanaan' => 2025,
                'tanggal_mulai'     => '2025-09-01',
                'tanggal_selesai'   => '2025-11-01',
                'status'            => 'menunggu',
                'created_at'        => $time->createFromDate(2025, 8, 20),
                'updated_at'        => $time->createFromDate(2025, 8, 20),
            ],
            [
                'user_id'           => 3, // Ahmad
                'judul_pengabdian'  => 'Workshop Keamanan Siber untuk Siswa SMA',
                'lokasi_pengabdian' => 'SMA Negeri 1 Kota B',
                'sumber_dana'       => 'Mandiri',
                'jumlah_dana'       => 15000000,
                'tahun_pelaksanaan' => 2025,
                'tanggal_mulai'     => '2025-10-01',
                'tanggal_selesai'   => '2025-10-02',
                'status'            => 'diverifikasi',
                'created_at'        => $time->createFromDate(2025, 9, 10),
                'updated_at'        => $time->createFromDate(2025, 9, 11),
            ],
            [
                'user_id'           => 1, // Budi
                'judul_pengabdian'  => 'Sosialisasi Pemanfaatan Aplikasi IoT untuk Irigasi',
                'lokasi_pengabdian' => 'Kelurahan Tani Makmur',
                'sumber_dana'       => 'Internal',
                'jumlah_dana'       => 20000000,
                'tahun_pelaksanaan' => 2025,
                'tanggal_mulai'     => '2025-11-01',
                'tanggal_selesai'   => '2025-11-30',
                'status'            => 'revisi',
                'created_at'        => $time->createFromDate(2025, 10, 2),
                'updated_at'        => $time->createFromDate(2025, 10, 3),
            ],
        ];
        $this->db->table('pengabdian')->insertBatch($pengabdian);

        // ----------------------------------------
        // 5. Tabel Luaran (Publikasi & HKI)
        // ----------------------------------------
        $publikasi = [
            [
                'user_id'             => 1,
                'id_penelitian_terkait' => 3,
                'judul_artikel'       => 'A Novel Architecture for Energy-Efficient Smart Home IoT',
                'jenis_publikasi'     => 'Jurnal Internasional',
                'nama_publikasi'      => 'IEEE Internet of Things Journal',
                'tahun'               => '2025',
                'volume'              => '12',
                'nomor'               => '4',
                'halaman'             => '110-120',
                'link_publikasi'      => 'https://doi.org/10.1109/JIOT.2025.12345',
                'file_artikel'        => null,
                'status'              => 'diverifikasi',
                'catatan_verifikator' => null,
                'created_at'          => $time->now(),
                'updated_at'          => $time->now(),
            ],
            [
                'user_id'             => 2,
                'id_penelitian_terkait' => 2,
                'judul_artikel'       => 'Urban Traffic Congestion Modeling using Big Data Analytics',
                'jenis_publikasi'     => 'Konferensi Internasional',
                'nama_publikasi'      => 'International Conference on Data Science (ICDS)',
                'tahun'               => '2025',
                'volume'              => null,
                'nomor'               => null,
                'halaman'             => '50-56',
                'link_publikasi'      => null,
                'file_artikel'        => null,
                'status'              => 'menunggu',
                'catatan_verifikator' => null,
                'created_at'          => $time->now(),
                'updated_at'          => $time->now(),
            ],
        ];
        $this->db->table('publikasi')->insertBatch($publikasi);

        $hki = [
            [
                'user_id'             => 1,
                'id_penelitian_terkait' => 1,
                'judul_ciptaan'       => 'Software Deteksi Penyakit Tanaman Padi v1.0',
                'jenis_hki'           => 'Hak Cipta',
                'nomor_pendaftaran'   => 'EC00202512345',
                'nomor_sertifikat'    => null,
                'tanggal_penerimaan'  => null,
                'file_sertifikat'     => null,
                'status'              => 'diverifikasi',
                'catatan_verifikator' => null,
                'created_at'          => $time->now(),
                'updated_at'          => $time->now(),
            ],
        ];
        $this->db->table('hki')->insertBatch($hki);

        // ----------------------------------------
        // 6. Tabel Anggota
        // ----------------------------------------
        // FIX: Semua array dibuat memiliki keys yang sama (user_id dan nama_mahasiswa_atau_eksternal)
        $penelitian_anggota = [
            // Anggota untuk Penelitian ID 2 (Indah)
            [
                'id_penelitian' => 2,
                'user_id'       => 1, // Anggota adalah dosen (Budi)
                'nama_mahasiswa_atau_eksternal' => null,
                'peran'         => 'Anggota'
            ],
            [
                'id_penelitian' => 2,
                'user_id'       => null,
                'nama_mahasiswa_atau_eksternal' => 'Mahasiswa A', // Anggota adalah mahasiswa
                'peran'         => 'Mahasiswa'
            ],
            // Anggota untuk Penelitian ID 3 (Budi)
            [
                'id_penelitian' => 3,
                'user_id'       => 3, // Anggota adalah dosen (Ahmad)
                'nama_mahasiswa_atau_eksternal' => null,
                'peran'         => 'Anggota'
            ],
        ];
        $this->db->table('penelitian_anggota')->insertBatch($penelitian_anggota);

        // FIX: Semua array dibuat memiliki keys yang sama
        $pengabdian_anggota = [
            // Anggota untuk Pengabdian ID 1 (Indah)
            [
                'id_pengabdian' => 1,
                'user_id'       => null,
                'nama_mahasiswa_atau_eksternal' => 'Mahasiswa B (Ketua Tim)',
                'peran'         => 'Anggota'
            ],
            [
                'id_pengabdian' => 1,
                'user_id'       => null,
                'nama_mahasiswa_atau_eksternal' => 'Mahasiswa C',
                'peran'         => 'Anggota'
            ],
        ];
        $this->db->table('pengabdian_anggota')->insertBatch($pengabdian_anggota);

        echo "Seeding LPPM data finished successfully.\n";
    }
}
