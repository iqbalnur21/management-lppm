<?= $this->extend('layout/index') ?>

<?= $this->section('title') ?>
Daftar Penelitian
<?= $this->endSection() ?>

<?= $this->section('table'); ?>
<thead>
    <tr>
        <th>#</th>
        <th>Judul Penelitian</th>
        <!-- <th>Ketua Peneliti</th> -->
        <th>Skema</th>
        <th>Tahun</th>
        <th class="text-center">Status</th>
        <?php if (session('role_id') == 1) : ?>
            <th class="action-column text-center">Aksi</th>
        <?php elseif (session('role_id') == 3) : ?>
            <th class="action-column text-center" style="min-width: 150px;">Cetak Surat</th>
        <?php endif; ?>
    </tr>
</thead>
<tbody>
    <?php foreach ($data as $key => $value) : ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= esc($value['judul_penelitian']) ?></td>
            <!-- <td><? //= esc($value['nama_lengkap']) 
                        ?></td> -->
            <td><?= esc($value['skema_penelitian']) ?></td>
            <td><?= esc($value['tanggal_penelitian']) ?></td>
            <?php if (session('role_id') == 1 || session('role_id') == 4) : ?>
                <td class="text-center">
                    <?php
                    $status_class = '';
                    switch ($value['status']) {
                        case 1:
                            $status_class = 'badge-primary';
                            break;
                        default:
                            $status_class = 'badge-secondary';
                            break;
                    }
                    ?>
                    <span class="badge <?= $status_class ?>"><?= ucfirst($value['status'] == 1 ? 'Terverifikasi' : 'Belum Terverifikasi') ?></span>
                </td>
                <?php if (session('role_id') == 1) : ?>
                    <td class="text-center" style="width: 200px;">
                        <a href="<?= site_url('penelitian/' . $value['id_penelitian'] . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        <form action="<?= site_url('penelitian/' . $value['id_penelitian']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                <?php elseif (session('role_id') == 3) : ?>
                    <td class="text-center">
                        <?php if (!empty($value['file_surat_tugas'])): ?>
                            <a href="<?= base_url('upload/pengabdian/' . $value['file_surat_tugas']) ?>" class="btn btn-info btn-sm" title="Download File" download><i class="fas fa-download"></i> Cetak Surat</a>
                        <?php else: ?>
                            <span class="badge badge-secondary">File Tidak Tersedia</span>
                        <?php endif ?>
                    </td>
                <?php endif; ?>
            <?php else : ?>
                <td class="text-center">
                    <?php
                    $options = [
                        1 => 'Terverifikasi',
                        0 => 'Belum Terverifikasi',
                    ];
                    ?>
                    <select name="status" data-type="penelitian" data-id="<?= $value['id_penelitian'] ?>" data-url="/penelitian/updateStatus/<?= $value['id_penelitian'] ?>" class="form-control confirm-btn">
                        <?php foreach ($options as $option_value => $option_text) : ?>
                            <option value="<?= $option_value ?>" <?= $option_value == $value['status'] ? 'selected' : '' ?>>
                                <?= esc($option_text) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
        </tr>
    <?php endforeach ?>
</tbody>
<?= $this->endSection() ?>