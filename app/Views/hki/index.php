<?= $this->extend('layout/index') ?>

<?= $this->section('title') ?>
Daftar Hak Kekayaan Intelektual (HKI)
<?= $this->endSection() ?>

<?= $this->section('table'); ?>
<thead>
    <tr>
        <th>#</th>
        <th>Judul Ciptaan</th>
        <!-- <th>Pemegang Hak Cipta</th> -->
        <th>Jenis HKI</th>
        <th>Nomor Pendaftaran</th>
        <th class="text-center">Status</th>
        <?php if (session('role_id') == 1) : ?>
            <th class="action-column text-center">Aksi</th>
        <?php endif; ?>
    </tr>
</thead>
<tbody>
    <?php foreach ($data as $key => $value) : ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= esc($value['judul_ciptaan']) ?></td>
            <!-- <td><? //= esc($value['nama_lengkap']) 
                        ?></td> -->
            <td><?= esc($value['jenis_hki']) ?></td>
            <td><?= esc($value['nomor_pendaftaran']) ?></td>
            <?php if (session('role_id') != 2) : ?>
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
            <?php else : ?>
                <td class="text-center">
                    <?php
                    $options = [
                        'diverifikasi' => 'Diverifikasi',
                        'selesai' => 'Selesai',
                        'revisi' => 'Revisi',
                        'menunggu' => 'Menunggu'
                    ];
                    ?>
                    <select name="status" data-type="hki" data-id="<?= $value['id_hki'] ?>" data-url="/hki/updateStatus/<?= $value['id_hki'] ?>" class="form-control confirm-btn">
                        <?php foreach ($options as $option_value => $option_text) : ?>
                            <option value="<?= $option_value ?>" <?= $option_value == $value['status'] ? 'selected' : '' ?>>
                                <?= esc($option_text) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <?php if (session('role_id') == 1) : ?>
                <td class="text-center" style="width: 200px;">
                    <?php if ($value['status'] == 'menunggu' || $value['status'] == 'revisi') : ?>
                        <a href="<?= site_url('hki/' . $value['id_hki'] . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        <form action="<?= site_url('hki/' . $value['id_hki']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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