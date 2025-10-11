<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        // ------------------------
        // 2️⃣ USERS
        // ------------------------
        $users = [
            [
                'role_id' => 1,
                'name' => 'Dr. Ahmad',
                'username' => 'ahmad',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
            ],
            [
                'role_id' => 1,
                'name' => 'Dr. Siti',
                'username' => 'siti',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
            ],
            [
                'role_id' => 2,
                'name' => 'Admin LPPM',
                'username' => 'staf',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
            ],
            [
                'role_id' => 3,
                'name' => 'Prof. Budi',
                'username' => 'kepala',
                'password' => password_hash('kepala123', PASSWORD_DEFAULT),
            ],
        ];
        $this->db->table('users')->insertBatch($users);
    }
}
