<?= $this->extend('layout/index') ?>

<?= $this->section('title') ?>
Daftar Pengabdian Masyarakat
<?= $this->endSection() ?>

<?= $this->section('table'); ?>
<thead>
    <tr>
        <th>#</th>
        <th>Nomor Surat</th>
        <th>Judul Pengabdian</th>
        <th>Ketua Pelaksana</th>
        <th>Tanggal Pelaksanaan</th>
        <th class="text-center">Status</th>
        <th class="action-column text-center">Aksi</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($data as $key => $value) : ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= esc($value['nomor_surat'] ?? 'N/A') ?></td>
            <td><?= esc($value['judul_pengabdian']) ?></td>
            <td><?= esc($value['nama_lengkap']) // Asumsi ada JOIN ke tabel users 
                ?></td>
            <td><?= dateFormat($value['tanggal_mulai']) ?> s/d <?= dateFormat($value['tanggal_selesai']) ?></td>
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
                <span class="badge <?= $status_class ?>"><?= ucfirst(esc($value['status'])) ?></span>
            </td>
            <td class="text-center" style="width: 200px;">
                <a href="<?= site_url('pengabdian/detail/' . $value['id_pengabdian']) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>

                <?php if ($value['status'] == 'menunggu' || $value['status'] == 'revisi') : ?>
                    <a href="<?= site_url('pengabdian/edit/' . $value['id_pengabdian']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>

                    <form action="<?= site_url('pengabdian/delete/' . $value['id_pengabdian']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach ?>
</tbody>
<?= $this->endSection() ?>