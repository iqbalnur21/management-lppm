<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLppmTables extends Migration
{
    public function up()
    {
        // 1. Tabel Roles
        $this->forge->addField([
            'id_role'    => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nama_role'  => ['type' => 'VARCHAR', 'constraint' => 50, 'comment' => 'Contoh: dosen, staf_lppm, kepala_lppm, mahasiswa'],
        ]);
        $this->forge->addKey('id_role', true);
        $this->forge->createTable('roles', true);

        // 2. Tabel Users
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'role_id'    => ['type' => 'INT', 'unsigned' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'          => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);

        // --- TABEL BARU: DOSEN ---
        $this->forge->addField([
            'id_dosen'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'                 => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nidn'          => ['type' => 'INT', 'constraint' => 20, 'unique' => true], // Sesuai request: INT
            'nama_lengkap'  => ['type' => 'VARCHAR', 'constraint' => 150],
            'prodi'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'email'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'          => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_dosen', true);
        $this->forge->createTable('dosen', true);

        // --- TABEL BARU: MAHASISWA ---
        $this->forge->addField([
            'id_mahasiswa'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'                 => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nim'           => ['type' => 'VARCHAR', 'constraint' => 20, 'unique' => true], // Sesuai request: VARCHAR
            'nama_lengkap'  => ['type' => 'VARCHAR', 'constraint' => 150],
            'prodi'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'angkatan'      => ['type' => 'YEAR', 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'          => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_mahasiswa', true);
        $this->forge->createTable('mahasiswa', true);

        // 3. Tabel Pengabdian
        $this->forge->addField([
            'id_pengabdian'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'comment' => 'User ID penginput'],
            'id_dosen'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'comment' => 'Ketua Pengabdi'],
            'id_mahasiswa'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'comment' => 'Perwakilan Mahasiswa'],
            'tema'                => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'durasi'              => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'comment' => 'Contoh: 6 Bulan'],
            'tujuan'              => ['type' => 'TEXT', 'null' => true],
            'nomor_surat'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'judul_pengabdian'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'lokasi_pengabdian'   => ['type' => 'TEXT'],
            'sumber_dana'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'jumlah_dana'         => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'tanggal_pelaksanaan' => ['type' => 'DATE', 'null' => true],
            'tanggal_mulai'       => ['type' => 'DATE'],
            'tanggal_selesai'     => ['type' => 'DATE'],
            'status'              => ['type' => 'ENUM("menunggu", "revisi", "diverifikasi", "selesai")', 'default' => 'menunggu'],
            'catatan_verifikator' => ['type' => 'TEXT', 'null' => true],
            'file_surat_tugas'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'dibaca' => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'created_at'          => ['type' => 'DATETIME', 'null' => true],
            'updated_at'          => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'          => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_pengabdian', true);
        $this->forge->createTable('pengabdian', true);

        // 3.1. Tabel Anggota Pengabdian
        $this->forge->addField([
            'id_anggota'                  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pengabdian'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_id'                     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nama_mahasiswa_atau_eksternal' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'peran'                       => ['type' => 'ENUM("Ketua", "Anggota")', 'default' => 'Anggota'],
        ]);
        $this->forge->addKey('id_anggota', true);
        $this->forge->createTable('pengabdian_anggota', true);

        // 4. Tabel Penelitian
        $this->forge->addField([
            'id_penelitian'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_dosen'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'comment' => 'Ketua Peneliti'],
            'id_mahasiswa'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'tujuan'              => ['type' => 'TEXT', 'null' => true],
            'nomor_surat'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'judul_penelitian'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'skema_penelitian'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'tanggal_penelitian'  => ['type' => 'DATE', 'null' => true],
            'sumber_dana'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'jumlah_dana'         => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'file_surat_tugas'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_proposal'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_laporan_akhir'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'              => ['type' => 'ENUM("menunggu", "revisi", "diverifikasi", "selesai")', 'default' => 'menunggu'],
            'catatan_verifikator' => ['type' => 'TEXT', 'null' => true],
            'dibaca' => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'created_at'          => ['type' => 'DATETIME', 'null' => true],
            'updated_at'          => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'          => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_penelitian', true);
        $this->forge->createTable('penelitian', true);

        // 4.1. Tabel Anggota Penelitian
        $this->forge->addField([
            'id_anggota'                  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_penelitian'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_id'                     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nama_mahasiswa_atau_eksternal' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'peran'                       => ['type' => 'ENUM("Ketua", "Anggota", "Mahasiswa")', 'default' => 'Anggota'],
        ]);
        $this->forge->addKey('id_anggota', true);
        $this->forge->createTable('penelitian_anggota', true);

        // 5. Tabel Publikasi
        $this->forge->addField([
            'id_publikasi'                      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'                           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_penelitian_terkait'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'judul_artikel'                     => ['type' => 'VARCHAR', 'constraint' => 255],
            'jenis_pengabdian_atau_penelitian'  => ['type' => 'INT', 'constraint' => 11, 'comment' => '1=Penelitian, 2=Pengabdian'],
            'jenis_publikasi'                   => ['type' => 'VARCHAR', 'constraint' => 255],
            'nama_publikasi'                    => ['type' => 'VARCHAR', 'constraint' => 255],
            'tanggal_terbit'          => ['type' => 'DATE', 'null' => true],
            'status_akreditasi_jurnal' => ['type' => 'INT', 'constraint' => 2, 'null' => true, 'comment' => '1=Terakreditasi, 0=Tidak'],
            'sinta'                   => ['type' => 'ENUM("C1","C2","C3","C4","C5","C6")', 'null' => true],
            'quartile'                => ['type' => 'ENUM("Q1","Q2","Q3","Q4")', 'null' => true],
            'volume'                  => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'nomor'                   => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'halaman'                 => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'link_publikasi'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_artikel'            => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'                  => ['type' => 'ENUM("menunggu", "revisi", "diverifikasi", "selesai")', 'default' => 'menunggu'],
            'catatan_verifikator'     => ['type' => 'TEXT', 'null' => true],
            'created_at'              => ['type' => 'DATETIME', 'null' => true],
            'updated_at'              => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'              => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_publikasi', true);
        $this->forge->createTable('publikasi', true);

        // 6. Tabel HKI
        $this->forge->addField([
            'id_hki'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_penelitian_terkait' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'judul_ciptaan'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'jenis_hki'             => ['type' => 'VARCHAR', 'constraint' => 255],

            // Atribut Baru
            'pemilik_hak'           => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'comment' => 'Pemegang Hak Cipta'],

            'nomor_pendaftaran'     => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'nomor_sertifikat'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'tanggal_penerimaan'    => ['type' => 'DATE', 'null' => true],
            'file_sertifikat'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'                => ['type' => 'ENUM("menunggu", "revisi", "diverifikasi", "selesai")', 'default' => 'menunggu'],
            'catatan_verifikator'   => ['type' => 'TEXT', 'null' => true],
            'created_at'            => ['type' => 'DATETIME', 'null' => true],
            'updated_at'            => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'            => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_hki', true);
        $this->forge->createTable('hki', true);

        // 7. Tabel Prototype
        $this->forge->addField([
            'id_prototype'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_penelitian_terkait' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nama_prototype'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'deskripsi'             => ['type' => 'TEXT', 'null' => true],
            'tahun_pembuatan'       => ['type' => 'YEAR'],
            'link_video_demo'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_dokumentasi'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'                => ['type' => 'ENUM("menunggu", "revisi", "diverifikasi", "selesai")', 'default' => 'menunggu'],
            'catatan_verifikator'   => ['type' => 'TEXT', 'null' => true],
            'created_at'            => ['type' => 'DATETIME', 'null' => true],
            'updated_at'            => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'            => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_prototype', true);
        $this->forge->createTable('prototype', true);

        // 8. Tabel Notifikasi
        $this->forge->addField([
            'id_notifikasi'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_penelitian'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_pengabdian'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'status_notifikasi'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'comment' => '0 = Belum Dibaca, 1 = Sudah Dibaca'],
            'status_surat'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'comment' => '0 = Diverifikasi, 1 = Selesai, 2 = Revisi, 3 = Menunggu'],
            'jenis_notifikasi'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'comment' => '1=Penelitian, 2=Pengabdian'],
            'tampil_di'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'comment' => '1=dosen, 2=staf_lppm, 3=kepala_lppm, 4=admin'],
            'created_at'                => ['type' => 'DATETIME', 'null' => true],
            'updated_at'                => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'                => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_notifikasi', true);
        $this->forge->createTable('notifikasi', true);
    }

    public function down()
    {
        // Drop tabel dalam urutan terbalik
        $this->forge->dropTable('prototype', true);
        $this->forge->dropTable('hki', true);
        $this->forge->dropTable('publikasi', true);
        $this->forge->dropTable('penelitian_anggota', true);
        $this->forge->dropTable('penelitian', true);
        $this->forge->dropTable('pengabdian_anggota', true);
        $this->forge->dropTable('pengabdian', true);
        // Hapus tabel baru
        $this->forge->dropTable('mahasiswa', true);
        $this->forge->dropTable('dosen', true);
        $this->forge->dropTable('notifikasi', true);

        $this->forge->dropTable('users', true);
        $this->forge->dropTable('roles', true);
    }
}
