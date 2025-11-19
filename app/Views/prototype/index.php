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
        <!-- <th>Link Video Demo</th> -->
        <th class="text-center" style="min-width: 150px;">Status</th>
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
            <!-- <td><? //= esc($value['link_video_demo']) 
                        ?></td> -->
            <?php if (session('role_id') == 1 || session('role_id') == 3) : ?>
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
                    <select name="status" data-type="prototype" data-id="<?= $value['id_prototype'] ?>" data-url="/prototype/updateStatus/<?= $value['id_prototype'] ?>" class="form-control confirm-btn">
                        <?php foreach ($options as $option_value => $option_text) : ?>
                            <option value="<?= $option_value ?>" <?= $option_value == $value['status'] ? 'selected' : '' ?>>
                                <?= esc($option_text) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <?php if (session('role_id') == 1) : ?>
                <td class="text-center" style="width: 150px;">
                    <?php if ($value['status'] == 'menunggu' || $value['status'] == 'revisi') : ?>
                        <a href="<?= site_url('prototype/' . $value['id_prototype'] . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        <form action="<?= site_url('prototype/' . $value['id_prototype']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    <?php endif; ?>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach ?>
</tbody>
<?= $this->endSection() ?>