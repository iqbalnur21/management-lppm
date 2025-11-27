<?= $this->extend('layout/index') ?>

<?= $this->section('title') ?>
Daftar Kontrak <?= url(3) == 1 ? 'Penelitian' : 'Pengabdian' ?>
<?= $this->endSection() ?>

<?= $this->section('table'); ?>
<thead>
    <tr>
        <th style="width: 5%">#</th>
        <th>Nomor Kontrak</th>
        <th style="width: 30%">Judul Kegiatan</th>
        <th>Dana Disetujui</th>
        <th>Tanggal TTD</th>
        <?php if (session('role_id') == 3) : ?>
            <th>File</th>
        <?php endif; ?>
        <!-- Aksi hanya untuk Staf LPPM (2) -->
        <?php if (session('role_id') == 2) : ?>
            <th class="action-column text-center">Aksi</th>
        <?php endif; ?>
    </tr>
</thead>
<tbody>
    <?php foreach ($data as $key => $value) : ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td>
                <span class="font-weight-bold"><?= esc($value['nomor_kontrak']) ?></span>
            </td>
            <td>
                <!-- Menampilkan Judul (Penelitian/Pengabdian) -->
                <?= esc($value['judul_artikel']) ?>
                <br>
                <small class="text-muted">
                    TA: <?= esc($value['tahun_anggaran']) ?> |
                    Luaran: <?= esc($value['target_luaran']) ?>
                </small>
            </td>
            <td class="text-nowrap">
                Rp <?= number_format($value['jumlah_dana_disetujui'], 0, ',', '.') ?>
            </td>
            <td><?= date('d-m-Y', strtotime($value['tanggal_tanda_tangan'])) ?></td>

            <?php if (session('role_id') == 3): ?>
                <td>
                    <?php if (!empty($value['file_kontrak'])) : ?>
                        <!-- Asumsi route untuk download/view file -->
                        <a href="<?= base_url('uploads/kontrak/' . $value['file_kontrak']) ?>" target="_blank" class="btn btn-xs btn-info" title="Lihat Dokumen">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    <?php else : ?>
                        <span class="text-muted small">Tidak ada file</span>
                    <?php endif; ?>
                </td>
            <?php endif ?>

            <!-- Aksi Edit/Hapus khusus Staf LPPM -->
            <?php if (session('role_id') == 2) : ?>
                <td class="text-center">
                    <a href="<?= site_url('kontrak/' . $value['id_kontrak'] . '/edit') ?>" class="btn btn-warning btn-sm" title="Edit Kontrak">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="<?= site_url('kontrak/' . $value['id_kontrak']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kontrak ini? Data keuangan terkait mungkin akan terpengaruh.')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-sm" title="Hapus Kontrak">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach ?>
</tbody>
<?= $this->endSection() ?>