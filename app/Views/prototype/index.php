<?= $this->extend('layout/index') ?>

<?= $this->section('title') ?>
Daftar Prototype
<?= $this->endSection() ?>

<?= $this->section('table'); ?>
<thead>
    <tr>
        <th>No</th>
        <th>Nama Prototype</th>
        <th>Tahun Pembuatan</th>
        <th>Deskripsi</th>
        <th>Link Video Demo</th>
        <?php if (session('role_id') == 1) : ?>
            <th class="action-column text-center">Aksi</th>
        <?php endif; ?>
    </tr>
</thead>
<tbody>
    <?php foreach ($data as $key => $value) : ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= esc($value['nama_prototype']) ?></td>
            <td><?= esc($value['tahun_pembuatan']) ?></td>
            <td><?= esc($value['deskripsi']) ?></td>
            <td><?= esc($value['link_video_demo']) ?></td>
            <?php if ($value['status'] == 'menunggu' || $value['status'] == 'revisi') : ?>
                <td class="text-center" style="width: 150px;">
                    <?php if (session('role_id') == 1) : ?>
                        <a href="<?= site_url('prototype/' . $value['id_prototype'] . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        <form action="<?= site_url('prototype/' . $value['id_prototype']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    <?php else : ?>
                        <span class="badge badge-warning text-dark">Sedang di Verifikasi</span>
                    <?php endif; ?>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach ?>
</tbody>
<?= $this->endSection() ?>