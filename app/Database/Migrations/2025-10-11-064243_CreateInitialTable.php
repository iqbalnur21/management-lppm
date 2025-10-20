<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLppmTables extends Migration
{
    public function up()
    {
        // 1. Tabel Roles
        // Tabel ini mendefinisikan peran pengguna dalam sistem.
        $this->forge->addField([
            'id_role'        => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nama_role'      => ['type' => 'VARCHAR', 'constraint' => 50, 'comment' => 'Contoh: dosen, staf_lppm, kepala_lppm'],
        ]);
        $this->forge->addKey('id_role', true);
        $this->forge->createTable('roles', true);

        // 2. Tabel Users
        // Tabel ini menyimpan data semua pengguna sistem.
        $this->forge->addField([
            'id'          => ['type' => 'INT','unsigned' => true,'auto_increment' => true],
            'role_id'     => ['type' => 'INT','unsigned' => true],
            'name'        => ['type' => 'VARCHAR','constraint' => 100],
            'username'       => ['type' => 'VARCHAR','constraint' => 100,'unique' => true],
            'password'    => ['type' => 'VARCHAR','constraint' => 255],
            'created_at'  => ['type' => 'DATETIME','null' => true],
            'updated_at'  => ['type' => 'DATETIME','null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);

        // 3. Tabel Pengabdian (Mencakup data Surat Tugas Pengabdian)
        $this->forge->addField([
            'id_pengabdian'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'comment' => 'ID Dosen yang mengajukan (Ketua)'],
            'nomor_surat'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'judul_pengabdian'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'lokasi_pengabdian'  => ['type' => 'TEXT'],
            'sumber_dana'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'jumlah_dana'        => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'tahun_pelaksanaan' => ['type' => 'INT', 'constraint' => 4, 'unsigned' => true],
            'tanggal_mulai'      => ['type' => 'DATE'],
            'tanggal_selesai'    => ['type' => 'DATE'],
            'file_surat_tugas'   => ['type' => 'VARCHAR', 'constraint' => 255, 'comment' => 'Path ke file yang diupload'],
            'status'             => ['type' => 'ENUM("menunggu", "revisi", "diverifikasi", "selesai")', 'default' => 'menunggu'],
            'catatan_verifikator' => ['type' => 'TEXT', 'null' => true, 'comment' => 'Catatan dari Staf LPPM saat verifikasi/revisi'],
            'created_at'         => ['type' => 'DATETIME', 'null' => true],
            'updated_at'         => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'         => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_pengabdian', true);
        $this->forge->createTable('pengabdian', true);

        // 3.1. Tabel Anggota Pengabdian
        $this->forge->addField([
            'id_anggota'                  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pengabdian'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_id'                     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'comment' => 'Jika anggota adalah dosen/user terdaftar'],
            'nama_mahasiswa_atau_eksternal' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true, 'comment' => 'Nama mahasiswa atau anggota dari luar'],
            'peran'                       => ['type' => 'ENUM("Ketua", "Anggota")', 'default' => 'Anggota'],
        ]);
        $this->forge->addKey('id_anggota', true);
        $this->forge->createTable('pengabdian_anggota', true);

        // 4. Tabel Penelitian (Mencakup data Surat Tugas Penelitian)
        $this->forge->addField([
            'id_penelitian'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'comment' => 'ID Dosen yang mengajukan (Ketua)'],
            'nomor_surat'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'comment' => 'Nomor surat tugas penelitian'],
            'judul_penelitian'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'skema_penelitian'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'tahun_penelitian'   => ['type' => 'YEAR'],
            'sumber_dana'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'jumlah_dana'        => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'file_surat_tugas'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'comment' => 'Path ke file surat tugas'],
            'file_proposal'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_laporan_akhir' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'             => ['type' => 'ENUM("menunggu", "revisi", "diverifikasi", "selesai")', 'default' => 'menunggu'],
            'catatan_verifikator' => ['type' => 'TEXT', 'null' => true],
            'created_at'         => ['type' => 'DATETIME', 'null' => true],
            'updated_at'         => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'         => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_penelitian', true);
        $this->forge->createTable('penelitian', true);

        // 4.1. Tabel Anggota Penelitian (Untuk Penelitian Bersama Dosen & Mahasiswa)
        $this->forge->addField([
            'id_anggota'                  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_penelitian'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_id'                     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'comment' => 'Jika anggota adalah dosen/user terdaftar'],
            'nama_mahasiswa_atau_eksternal' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true, 'comment' => 'Nama mahasiswa atau anggota dari luar'],
            'peran'                       => ['type' => 'ENUM("Ketua", "Anggota", "Mahasiswa")', 'default' => 'Anggota'],
        ]);
        $this->forge->addKey('id_anggota', true);
        $this->forge->createTable('penelitian_anggota', true);
        
        // 5. Tabel Publikasi
        $this->forge->addField([
            'id_publikasi'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_penelitian_terkait' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'judul_artikel'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'jenis_publikasi'    => ['type' => 'ENUM("jurnal", "prosiding", "buku")', 'default' => 'jurnal'],
            'nama_publikasi'     => ['type' => 'VARCHAR', 'constraint' => 255, 'comment' => 'Nama Jurnal/Konferensi'],
            'tahun'              => ['type' => 'YEAR'],
            'volume'             => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'nomor'              => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'halaman'            => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'link_publikasi'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_artikel'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'             => ['type' => 'ENUM("menunggu", "revisi", "diverifikasi", "selesai")', 'default' => 'menunggu'],
            'catatan_verifikator' => ['type' => 'TEXT', 'null' => true],
            'created_at'         => ['type' => 'DATETIME', 'null' => true],
            'updated_at'         => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'         => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_publikasi', true);
        $this->forge->createTable('publikasi', true);

        // 6. Tabel HKI (Hak Kekayaan Intelektual)
        $this->forge->addField([
            'id_hki'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_penelitian_terkait' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'judul_ciptaan'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'jenis_hki'          => ['type' => 'ENUM("Hak Cipta", "Paten", "Merek Dagang")', 'default' => 'Hak Cipta'],
            'nomor_pendaftaran'  => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'nomor_sertifikat'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'tanggal_penerimaan' => ['type' => 'DATE', 'null' => true],
            'file_sertifikat'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'             => ['type' => 'ENUM("menunggu", "revisi", "diverifikasi", "selesai")', 'default' => 'menunggu'],
            'catatan_verifikator' => ['type' => 'TEXT', 'null' => true],
            'created_at'         => ['type' => 'DATETIME', 'null' => true],
            'updated_at'         => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'         => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_hki', true);
        $this->forge->createTable('hki', true);

        // 7. Tabel Prototype
        $this->forge->addField([
            'id_prototype'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_penelitian_terkait' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nama_prototype'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'deskripsi'          => ['type' => 'TEXT', 'null' => true],
            'tahun_pembuatan'    => ['type' => 'YEAR'],
            'link_video_demo'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_dokumentasi'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'             => ['type' => 'ENUM("menunggu", "revisi", "diverifikasi", "selesai")', 'default' => 'menunggu'],
            'catatan_verifikator' => ['type' => 'TEXT', 'null' => true],
            'created_at'         => ['type' => 'DATETIME', 'null' => true],
            'updated_at'         => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'         => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_prototype', true);
        $this->forge->createTable('prototype', true);
    }

    public function down()
    {
        // Drop tabel dalam urutan terbalik untuk menghindari error foreign key
        $this->forge->dropTable('prototype', true);
        $this->forge->dropTable('hki', true);
        $this->forge->dropTable('publikasi', true);
        $this->forge->dropTable('penelitian_anggota', true);
        $this->forge->dropTable('penelitian', true);
        $this->forge->dropTable('pengabdian_anggota', true);
        $this->forge->dropTable('pengabdian', true);
        $this->forge->dropTable('users', true);
        $this->forge->dropTable('roles', true);
    }
}
