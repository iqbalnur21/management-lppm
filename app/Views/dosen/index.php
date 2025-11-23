<?= $this->extend('layout/index') ?>

<?= $this->section('title') ?>
Daftar Dosen
<?= $this->endSection() ?>

<?= $this->section('table'); ?>
<thead>
    <tr>
        <th style="width: 5%">#</th>
        <th>NIDN</th>
        <th>Nama Lengkap</th>
        <th>Prodi</th>
        <th>Email</th>
        <?php if (session('role_id') == 1) : ?>
            <th class="action-column text-center" style="width: 15%">Aksi</th>
        <?php endif; ?>
    </tr>
</thead>
<tbody>
    <?php foreach ($data as $key => $value) : ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= esc($value['nidn']) ?></td>
            <td><?= esc($value['nama_lengkap']) ?></td>
            <td><?= esc($value['prodi']) ?></td>
            <td><?= esc($value['email']) ?></td>

            <?php if (session('role_id') == 1) : ?>
                <td class="text-center">
                    <a href="<?= site_url('dosen/' . $value['id_dosen'] . '/edit') ?>" class="btn btn-warning btn-sm" title="Edit Data">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                    <form action="<?= site_url('dosen/' . $value['id_dosen']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dosen ini? Data yang dihapus tidak dapat dikembalikan.')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-sm" title="Hapus Data">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach ?>
</tbody>
<?= $this->endSection() ?>