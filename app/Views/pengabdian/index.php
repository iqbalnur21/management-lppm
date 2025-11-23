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
        <th>Lokasi Pengabdian</th>
        <th>Sumber Dana</th>
        <th>Jumlah Dana</th>
        <th>Tahun Pelaksanaan</th>
        <!-- <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>File Surat Tugas</th> -->
        <th class="text-center" style="min-width: 150px;">Status</th>
        <?php if (session('role_id') == 1) : ?>
            <th class="action-column text-center" style="min-width: 150px;">Aksi</th>
        <?php elseif (session('role_id') == 3) : ?>
            <th class="action-column text-center" style="min-width: 150px;">Cetak Surat</th>
        <?php endif; ?>
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
            <td><?= $value['tanggal_pelaksanaan'] ?></td>
            <!-- <td><? //= dateFormat($value['tanggal_mulai']) 
                        ?></td>
            <td><? //= dateFormat($value['tanggal_selesai']) 
                ?></td>
            <td><a href="<? //= base_url('upload/pengabdian/' . $value['file_surat_tugas']) 
                            ?>"
                    target="_blank">
                    <? //= $value['file_surat_tugas'] 
                    ?>
                </a></td> -->
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
            <?php else : ?>
                <td class="text-center">
                    <?php
                    $options = [
                        1 => 'Terverifikasi',
                        0 => 'Belum Terverifikasi',
                    ];
                    ?>
                    <select name="status" data-type="pengabdian" data-id="<?= $value['id_pengabdian'] ?>" data-url="/pengabdian/updateStatus/<?= $value['id_pengabdian'] ?>" class="form-control confirm-btn">
                        <?php foreach ($options as $option_value => $option_text) : ?>
                            <option value="<?= $option_value ?>" <?= $option_value == $value['status'] ? 'selected' : '' ?>>
                                <?= esc($option_text) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <?php if (session('role_id') == 1) : ?>
                <td class="text-center">
                    <a href="<?= site_url('pengabdian/' . $value['id_pengabdian'] . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                    <form action="<?= site_url('pengabdian/' . $value['id_pengabdian']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
        </tr>
    <?php endforeach ?>
</tbody>
<?= $this->endSection() ?>