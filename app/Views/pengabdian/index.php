<?= $this->extend('layout/index') ?>

<?= $this->section('title') ?>
Daftar Pengabdian Masyarakat
<?= $this->endSection() ?>

<?= $this->section('table'); ?>
<thead>
    <tr>
        <th>#</th>
        <th class="action-column text-center" style="min-width: 150px;">Aksi</th>
        <th>Nomor Surat</th>
        <th>Judul Pengabdian</th>
        <th>Lokasi Pengabdian</th>
        <th>Sumber Dana</th>
        <th>Jumlah Dana</th>
        <th>Tahun Pelaksanaan</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>File Surat Tugas</th>
        <th class="text-center">Status</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($data as $key => $value) : ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $value['nomor_surat'] ?></td>
            <td><?= $value['judul_pengabdian'] ?></td>
            <td><?= $value['lokasi_pengabdian'] ?></td>
            <td><?= $value['sumber_dana'] ?></td>
            <td><?= currencyFormat($value['jumlah_dana']) ?></td>
            <td><?= $value['tahun_pelaksanaan'] ?></td>
            <td><?= dateFormat($value['tanggal_mulai']) ?></td>
            <td><?= dateFormat($value['tanggal_selesai']) ?></td>
            <td><a href="<?= base_url('upload/pengabdian/' . $value['file_surat_tugas']) ?>"
                    target="_blank">
                    <?= $value['file_surat_tugas'] ?>
                </a></td>
            <td class="text-center">
                <?php
                $status_class = '';
                switch ($value['status']) {
                    case 'diverifikasi':
                        $status_class = 'badge-primary';
                        break;
                    case 'selesai':
                        $status_class = 'badge-success';
                        break;
                    case 'revisi':
                        $status_class = 'badge-warning';
                        break;
                    default: // menunggu
                        $status_class = 'badge-secondary';
                        break;
                }
                ?>
                <span class="badge <?= $status_class ?>"><?= ucfirst($value['status']) ?></span>
            </td>
            <td class="text-center">
                <?php if ($value['status'] == 'menunggu' || $value['status'] == 'revisi') : ?>
                    <?php if (session('role_id') == 1) : ?>
                        <a href="<?= site_url('pengabdian/' . $value['id_pengabdian'] . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                    <?php endif; ?>
                    <form action="<?= site_url('pengabdian/delete/' . $value['id_pengabdian']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach ?>
</tbody>
<?= $this->endSection() ?>