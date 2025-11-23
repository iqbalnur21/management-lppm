<?= $this->extend('layout/index') ?>

<?= $this->section('title') ?>
Daftar Pengguna
<?= $this->endSection() ?>

<?= $this->section('table'); ?>
<thead>
    <tr>
        <th style="width: 5%">#</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Role</th>
        <th class="action-column text-center" style="width: 20%">Aksi</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($data as $key => $value) : ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= esc($value['name']) ?></td>
            <td><?= esc($value['username']) ?></td>
            <td>
                <?php
                $roleName = 'User';
                if ($value['role_id'] == 1) $roleName = 'Dosen';
                elseif ($value['role_id'] == 2) $roleName = 'Staff LPPM';
                elseif ($value['role_id'] == 3) $roleName = 'Kepala LPPM';
                elseif ($value['role_id'] == 4) $roleName = 'Admin';
                ?>
                <span class="badge badge-info"><?= $roleName ?></span>
            </td>
            <td class="text-center">

                <form action="<?= site_url('user/reset/' . $value['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mereset password user ini menjadi 123456?')">
                    <?= csrf_field() ?>
                    <button class="btn btn-info btn-sm" title="Reset Password ke 123456">
                        <i class="fas fa-key"></i>
                    </button>
                </form>

                <a href="<?= site_url('user/' . $value['id'] . '/edit') ?>" class="btn btn-warning btn-sm" title="Edit Data">
                    <i class="fas fa-pencil-alt"></i>
                </a>

                <?php if (session('user_id') != $value['id']) : ?>
                    <form action="<?= site_url('user/' . $value['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-sm" title="Hapus Data">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach ?>
</tbody>
<?= $this->endSection() ?>