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
            ['nama_role' => 'dosen'],        // ID: 1
            ['nama_role' => 'staf_lppm'],    // ID: 2
            ['nama_role' => 'kepala_lppm'],  // ID: 3
            ['nama_role' => 'mahasiswa'],    // ID: 4 (Baru)
        ];
        $this->db->table('roles')->insertBatch($roles);

        // ----------------------------------------
        // 2. Tabel Users (Dosen, Staf, Mahasiswa)
        // ----------------------------------------
        $users = [
            // --- DOSEN ---
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
            
            // --- STAF ---
            [
                'role_id'  => 2, // staf_lppm
                'name'     => 'Staf LPPM',
                'username' => 'staf-lppm',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'created_at' => $time->now(),
                'updated_at' => $time->now(),
            ], // ID: 4
            [
                'role_id'  => 3, // kepala_lppm
                'name'     => 'Kepala LPPM',
                'username' => 'kepala-lppm',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'created_at' => $time->now(),
                'updated_at' => $time->now(),
            ], // ID: 5
            [
                'role_id'  => 4, 
                'name'     => 'Admin',
                'username' => 'admin',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'created_at' => $time->now(),
                'updated_at' => $time->now(),
            ], // ID: 6

        ];
        $this->db->table('users')->insertBatch($users);

        // ----------------------------------------
        // 2.1 Tabel Dosen (Detail Data Dosen)
        // ----------------------------------------
        $dosen = [
            [
                'user_id'      => 1, // Budi
                'nidn'         => 12345678,
                'nama_lengkap' => 'Dr. Budi Santoso',
                'prodi'        => 'Informatika',
                'email'        => 'budi@univ.ac.id',
                'created_at'   => $time->now(),
                'updated_at'   => $time->now(),
            ], // id_dosen: 1
            [
                'user_id'      => 2, // Indah
                'nidn'         => 87654321,
                'nama_lengkap' => 'Prof. Indah Cahyani',
                'prodi'        => 'Sistem Informasi',
                'email'        => 'indah@univ.ac.id',
                'created_at'   => $time->now(),
                'updated_at'   => $time->now(),
            ], // id_dosen: 2
            [
                'user_id'      => 3, // Ahmad
                'nidn'         => 11223344,
                'nama_lengkap' => 'Ahmad Zulkifli, M.Kom.',
                'prodi'        => 'Teknik Komputer',
                'email'        => 'ahmad@univ.ac.id',
                'created_at'   => $time->now(),
                'updated_at'   => $time->now(),
            ], // id_dosen: 3
        ];
        $this->db->table('dosen')->insertBatch($dosen);

        // ----------------------------------------
        // 2.2 Tabel Mahasiswa (Detail Data Mahasiswa)
        // ----------------------------------------
        $mahasiswa = [
            [
                'user_id'      => 7, // Kevin
                'nim'          => '20230001',
                'nama_lengkap' => 'Kevin Sanjaya',
                'prodi'        => 'Informatika',
                'angkatan'     => '2023',
                'created_at'   => $time->now(),
                'updated_at'   => $time->now(),
            ], // id_mahasiswa: 1
        ];
        $this->db->table('mahasiswa')->insertBatch($mahasiswa);

        // ----------------------------------------
        // 3. Tabel Penelitian
        // ----------------------------------------
        $penelitian = [
            [
                'user_id'           => 1, // Budi
                'id_dosen'          => 1,
                'id_mahasiswa'      => null,
                'judul_penelitian'  => 'Sistem Cerdas untuk Deteksi Penyakit Tanaman Padi',
                'skema_penelitian'  => 'Penelitian Dasar',
                'tanggal_penelitian'=> '2025-01-15',
                'tujuan'            => 'Mengembangkan algoritma AI untuk petani lokal.',
                'sumber_dana'       => 'Internal',
                'jumlah_dana'       => 50000000,
                'status'            => 'menunggu',
                'catatan_verifikator' => null,
                'created_at'        => $time->createFromDate(2025, 10, 1),
                'updated_at'        => $time->createFromDate(2025, 10, 1),
            ],
            [
                'user_id'           => 2, // Indah
                'id_dosen'          => 2,
                'id_mahasiswa'      => 1,
                'judul_penelitian'  => 'Analisis Big Data untuk Model Transportasi Urban Cerdas',
                'skema_penelitian'  => 'Penelitian Terapan',
                'tanggal_penelitian'=> '2025-02-10',
                'tujuan'            => 'Membuat model prediksi kemacetan berbasis data historis.',
                'sumber_dana'       => 'Dikti',
                'jumlah_dana'       => 150000000,
                'status'            => 'revisi',
                'catatan_verifikator' => 'Mohon perbaiki RAB dan metodologi.',
                'created_at'        => $time->createFromDate(2025, 9, 15),
                'updated_at'        => $time->createFromDate(2025, 9, 20),
            ],
            [
                'user_id'           => 1, // Budi
                'id_dosen'          => 1, 
                'id_mahasiswa'      => null,
                'judul_penelitian'  => 'Pengembangan Framework IoT untuk Smart Home Hemat Energi',
                'skema_penelitian'  => 'Penelitian Unggulan',
                'tanggal_penelitian'=> '2025-03-01',
                'tujuan'            => 'Menciptakan purwarupa smart home yang efisien.',
                'sumber_dana'       => 'Internal',
                'jumlah_dana'       => 75000000,
                'status'            => 'diverifikasi',
                'catatan_verifikator' => null,
                'created_at'        => $time->createFromDate(2025, 8, 5),
                'updated_at'        => $time->createFromDate(2025, 8, 10),
            ],
            [
                'user_id'           => 3, // Ahmad
                'id_dosen'          => 3,
                'id_mahasiswa'      => null,
                'judul_penelitian'  => 'Kajian Keamanan Data pada Aplikasi Mobile Banking',
                'skema_penelitian'  => 'Penelitian Dasar',
                'tanggal_penelitian'=> '2025-01-20',
                'tujuan'            => 'Menganalisis celah keamanan pada aplikasi fintech populer.',
                'sumber_dana'       => 'Internal',
                'jumlah_dana'       => 40000000,
                'status'            => 'selesai',
                'catatan_verifikator' => null,
                'created_at'        => $time->createFromDate(2025, 7, 10),
                'updated_at'        => $time->createFromDate(2025, 7, 15),
            ],
            [
                'user_id'           => 1, // Budi
                'id_dosen'          => 1,
                'id_mahasiswa'      => 1,
                'judul_penelitian'  => 'Model Prediksi Kinerja Mahasiswa Menggunakan Machine Learning',
                'skema_penelitian'  => 'Penelitian Dosen Pemula',
                'tanggal_penelitian'=> '2025-04-15',
                'tujuan'            => 'Membantu akademik memprediksi mahasiswa yang butuh bimbingan.',
                'sumber_dana'       => 'Internal',
                'jumlah_dana'       => 25000000,
                'status'            => 'menunggu',
                'catatan_verifikator' => null,
                'created_at'        => $time->createFromDate(2025, 10, 5),
                'updated_at'        => $time->createFromDate(2025, 10, 5),
            ],
        ];
        $this->db->table('penelitian')->insertBatch($penelitian);

        // ----------------------------------------
        // 4. Tabel Pengabdian
        // ----------------------------------------
        $pengabdian = [
            [
                'user_id'           => 2, // Indah
                'id_dosen'          => 2,
                'id_mahasiswa'      => 1,
                'judul_pengabdian'  => 'Pelatihan Digital Marketing untuk UMKM Desa Sukamaju',
                'tema'              => 'Pemberdayaan Ekonomi Masyarakat',
                'tujuan'            => 'Meningkatkan omzet UMKM lokal melalui pasar digital.',
                'durasi'            => '3 Bulan',
                'lokasi_pengabdian' => 'Desa Sukamaju, Kab. A',
                'sumber_dana'       => 'Internal',
                'jumlah_dana'       => 30000000,
                'tanggal_pelaksanaan' => '2025-09-01',
                'tanggal_mulai'     => '2025-09-01',
                'tanggal_selesai'   => '2025-11-01',
                'status'            => 'menunggu',
                'created_at'        => $time->createFromDate(2025, 8, 20),
                'updated_at'        => $time->createFromDate(2025, 8, 20),
            ],
            [
                'user_id'           => 3, // Ahmad
                'id_dosen'          => 3,
                'id_mahasiswa'      => null,
                'judul_pengabdian'  => 'Workshop Keamanan Siber untuk Siswa SMA',
                'tema'              => 'Literasi Digital',
                'tujuan'            => 'Memberikan awareness tentang bahaya cyber crime sejak dini.',
                'durasi'            => '2 Hari',
                'lokasi_pengabdian' => 'SMA Negeri 1 Kota B',
                'sumber_dana'       => 'Mandiri',
                'jumlah_dana'       => 15000000,
                'tanggal_pelaksanaan' => '2025-10-01',
                'tanggal_mulai'     => '2025-10-01',
                'tanggal_selesai'   => '2025-10-02',
                'status'            => 'diverifikasi',
                'created_at'        => $time->createFromDate(2025, 9, 10),
                'updated_at'        => $time->createFromDate(2025, 9, 11),
            ],
            [
                'user_id'           => 1, // Budi
                'id_dosen'          => 1,
                'id_mahasiswa'      => null,
                'judul_pengabdian'  => 'Sosialisasi Pemanfaatan Aplikasi IoT untuk Irigasi',
                'tema'              => 'Teknologi Tepat Guna',
                'tujuan'            => 'Efisiensi penggunaan air sawah.',
                'durasi'            => '1 Bulan',
                'lokasi_pengabdian' => 'Kelurahan Tani Makmur',
                'sumber_dana'       => 'Internal',
                'jumlah_dana'       => 20000000,
                'tanggal_pelaksanaan' => '2025-11-01',
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
                'user_id'               => 1,
                'id_penelitian_terkait' => 2,
                'jenis_pengabdian_atau_penelitian' => 1,
                'judul_artikel'         => 'A Novel Architecture for Energy-Efficient Smart Home IoT',
                'jenis_publikasi'       => 'Jurnal Internasional',
                'nama_publikasi'        => 'IEEE Internet of Things Journal',
                'tanggal_terbit'        => '2025-06-15',
                'status_akreditasi_jurnal' => 1,
                'sinta'                 => 'C1',
                'quartile'              => 'Q1',
                'volume'                => '12',
                'nomor'                 => '4',
                'halaman'               => '110-120',
                'link_publikasi'        => 'https://doi.org/10.1109/JIOT.2025.12345',
                'file_artikel'          => null,
                'status'                => 'diverifikasi',
                'catatan_verifikator'   => null,
                'created_at'            => $time->now(),
                'updated_at'            => $time->now(),
            ],
            [
                'user_id'               => 2,
                'id_penelitian_terkait' => 2,
                'jenis_pengabdian_atau_penelitian' => 2,
                'judul_artikel'         => 'Urban Traffic Congestion Modeling using Big Data Analytics',
                'jenis_publikasi'       => 'Konferensi Internasional',
                'nama_publikasi'        => 'International Conference on Data Science (ICDS)',
                'tanggal_terbit'        => '2025-08-20',
                'status_akreditasi_jurnal' => 0,
                'sinta'                 => null,
                'quartile'              => null,
                'volume'                => null,
                'nomor'                 => null,
                'halaman'               => '50-56',
                'link_publikasi'        => null,
                'file_artikel'          => null,
                'status'                => 'menunggu',
                'catatan_verifikator'   => null,
                'created_at'            => $time->now(),
                'updated_at'            => $time->now(),
            ],
        ];
        $this->db->table('publikasi')->insertBatch($publikasi);

        $hki = [
            [
                'user_id'               => 1,
                'id_penelitian_terkait' => 1,
                'judul_ciptaan'         => 'Software Deteksi Penyakit Tanaman Padi v1.0',
                'jenis_hki'             => 'Hak Cipta',
                'pemilik_hak'           => 'Universitas & Dr. Budi Santoso',
                'nomor_pendaftaran'     => 'EC00202512345',
                'nomor_sertifikat'      => null,
                'tanggal_penerimaan'    => null,
                'file_sertifikat'       => null,
                'status'                => 'diverifikasi',
                'catatan_verifikator'   => null,
                'created_at'            => $time->now(),
                'updated_at'            => $time->now(),
            ],
        ];
        $this->db->table('hki')->insertBatch($hki);

        // ----------------------------------------
        // 6. Tabel Anggota
        // ----------------------------------------
        $penelitian_anggota = [
            [
                'id_penelitian' => 2,
                'user_id'       => 1, // Anggota adalah dosen (Budi)
                'nama_mahasiswa_atau_eksternal' => null,
                'peran'         => 'Anggota'
            ],
            [
                'id_penelitian' => 2,
                'user_id'       => 7, // Anggota adalah mahasiswa (Kevin)
                'nama_mahasiswa_atau_eksternal' => 'Kevin Sanjaya', 
                'peran'         => 'Mahasiswa'
            ],
            [
                'id_penelitian' => 3,
                'user_id'       => 3, // Anggota adalah dosen (Ahmad)
                'nama_mahasiswa_atau_eksternal' => null,
                'peran'         => 'Anggota'
            ],
        ];
        $this->db->table('penelitian_anggota')->insertBatch($penelitian_anggota);

        $pengabdian_anggota = [
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

        // ----------------------------------------
        // 7. Tabel Notifikasi (BARU)
        // ----------------------------------------
        $notifikasi = [
            // Notif untuk Penelitian Budi (ID 1) yang 'Menunggu' - Ditujukan ke Staf LPPM
            [
                'id_penelitian_pengabdian' => 1,
                'status_notifikasi'        => 0, // Belum Dibaca
                'status_surat'             => 3, // Menunggu
                'jenis_notifikasi'         => 'Penelitian',
                'tampil_di'                => 'Staff LPPM', // Notif untuk verifikator
                'created_at'               => $time->now(),
                'updated_at'               => $time->now(),
            ],
            // Notif untuk Penelitian Indah (ID 2) yang 'Revisi' - Ditujukan ke Dosen
            [
                'id_penelitian_pengabdian' => 2,
                'status_notifikasi'        => 0, // Belum Dibaca
                'status_surat'             => 2, // Revisi
                'jenis_notifikasi'         => 'Penelitian',
                'tampil_di'                => 'Dosen', // Notif balikan ke dosen
                'created_at'               => $time->now(),
                'updated_at'               => $time->now(),
            ],
            // Notif untuk Pengabdian Ahmad (ID 2) yang 'Diverifikasi' - Ditujukan ke Dosen
            [
                'id_penelitian_pengabdian' => 2,
                'status_notifikasi'        => 1, // Sudah Dibaca
                'status_surat'             => 0, // Diverifikasi
                'jenis_notifikasi'         => 'Pengabdian',
                'tampil_di'                => 'Dosen', 
                'created_at'               => $time->now(),
                'updated_at'               => $time->now(),
            ],
            // Notif untuk Penelitian Ahmad (ID 4) yang 'Selesai' - Ditujukan ke Dosen
            [
                'id_penelitian_pengabdian' => 4,
                'status_notifikasi'        => 1, // Sudah Dibaca
                'status_surat'             => 1, // Selesai
                'jenis_notifikasi'         => 'Penelitian',
                'tampil_di'                => 'Dosen',
                'created_at'               => $time->now(),
                'updated_at'               => $time->now(),
            ],
        ];
        $this->db->table('notifikasi')->insertBatch($notifikasi);

        echo "Seeding LPPM data finished successfully.\n";
    }
}