<?= $this->extend('layout/edit') ?>

<?= $this->section('title') ?>
Edit Data Kontrak: <?= esc($data['nomor_kontrak']) ?>
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Formulir Edit Data Kontrak</h4>
</div>

<?php if (!empty($data['catatan_verifikator'])) : ?>
    <div class="alert alert-warning">
        <strong><i class="fas fa-exclamation-circle"></i> Catatan Verifikator:</strong><br>
        <?= esc($data['catatan_verifikator']) ?>
    </div>
<?php endif; ?>

<hr>

<form action="<?= site_url('kontrak/' . $data['id_kontrak']) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT"> <!-- Method Spoofing untuk proses UPDATE -->
    <input type="hidden" name="jenis_kontrak" id="jenis_kontrak" value="<?= $data['jenis_kontrak']?>">

    <div class="form-group">
        <label for="judul_artikel">Judul Artikel <span class="text-danger">*</span></label>
        <input type="text" name="judul_artikel" id="judul_artikel" class="form-control <?= isset(session('errors')['judul_artikel']) ? 'is-invalid' : '' ?>" value="<?= old('judul_artikel', $data['judul_artikel']) ?>" autofocus>
        <div class="invalid-feedback">
            <?= session('errors.judul_artikel') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nomor_kontrak">Nomor Kontrak <span class="text-danger">*</span></label>
                <input type="text" name="nomor_kontrak" id="nomor_kontrak" class="form-control <?= isset(session('errors')['nomor_kontrak']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_kontrak', $data['nomor_kontrak']) ?>" placeholder="No: 001/LPPM/...">
                <div class="invalid-feedback">
                    <?= session('errors.nomor_kontrak') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggal_tanda_tangan">Tanggal Tanda Tangan <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_tanda_tangan" id="tanggal_tanda_tangan" class="form-control <?= isset(session('errors')['tanggal_tanda_tangan']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_tanda_tangan', $data['tanggal_tanda_tangan']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_tanda_tangan') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="jumlah_dana_disetujui">Jumlah Dana Disetujui (Rp) <span class="text-danger">*</span></label>
                <input type="number" name="jumlah_dana_disetujui" id="jumlah_dana_disetujui" class="form-control <?= isset(session('errors')['jumlah_dana_disetujui']) ? 'is-invalid' : '' ?>" value="<?= number_format(old('jumlah_dana_disetujui', $data['jumlah_dana_disetujui']), 0, '', '') ?>" placeholder="Contoh: 50000000">
                <small class="text-muted">Masukkan angka tanpa titik atau koma.</small>
                <div class="invalid-feedback">
                    <?= session('errors.jumlah_dana_disetujui') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tahun_anggaran">Tahun Anggaran <span class="text-danger">*</span></label>
                <input type="number" name="tahun_anggaran" id="tahun_anggaran" class="form-control <?= isset(session('errors')['tahun_anggaran']) ? 'is-invalid' : '' ?>" value="<?= old('tahun_anggaran', $data['tahun_anggaran']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tahun_anggaran') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="target_luaran">Target Luaran Wajib <span class="text-danger">*</span></label>
        <input type="text" name="target_luaran" id="target_luaran" class="form-control <?= isset(session('errors')['target_luaran']) ? 'is-invalid' : '' ?>" value="<?= old('target_luaran', $data['target_luaran']) ?>" placeholder="Contoh: Jurnal Sinta 2, HKI, Buku Ajar">
        <div class="invalid-feedback">
            <?= session('errors.target_luaran') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="file_kontrak">Upload File Kontrak (PDF)</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input <?= isset(session('errors')['file_kontrak']) ? 'is-invalid' : '' ?>" id="file_kontrak" name="file_kontrak" accept=".pdf" onchange="$('#customFileLabel').text(this.files[0].name)">
            <label class="custom-file-label" id="customFileLabel" for="file_kontrak">Pilih file (jika ingin mengganti)</label>
            <div class="invalid-feedback">
                <?= session('errors.file_kontrak') ?>
            </div>
        </div>

        <?php if (!empty($data['file_kontrak'])) : ?>
            <p class="mt-1 mb-1"><small>File Sekarang: <a href="<?= base_url('upload/kontrak/' . $data['file_kontrak']) ?>" target="_blank">Lihat File</a></small></p>
        <?php endif; ?>
    </div>

    <div>
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Data</button>
        <a href="<?= site_url($variable . '/kategori/' . $data['jenis_kontrak']) ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>

<?= $this->endSection() ?>