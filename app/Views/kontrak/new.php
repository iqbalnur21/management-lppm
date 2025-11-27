<?= $this->extend('layout/new') ?>

<?= $this->section('title') ?>
Formulir Input Data Kontrak
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<div class="d-flex justify-content-between align-items-center">
    <h4>Formulir Input Data Kontrak</h4>
</div>
<hr>

<form action="<?= site_url('kontrak') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="jenis_kontrak" id="jenis_kontrak" value="<?= url(3) ?>">
    
    <div class="form-group">
        <label for="judul_artikel">Judul Artikel <span class="text-danger">*</span></label>
        <input type="text" name="judul_artikel" id="judul_artikel" class="form-control <?= isset(session('errors')['judul_artikel']) ? 'is-invalid' : '' ?>" value="<?= old('judul_artikel') ?>" autofocus>
        <div class="invalid-feedback">
            <?= session('errors.judul_artikel') ?>
        </div>
    </div>

    <div class="form-group d-none" id="group-pengabdian">
        <label for="id_pengabdian">Judul Pengabdian (Yang Lolos) <span class="text-danger">*</span></label>
        <select name="id_pengabdian" id="id_pengabdian" class="form-control select2 <?= isset(session('errors')['id_pengabdian']) ? 'is-invalid' : '' ?>">
            <option value="">-- Pilih Judul Pengabdian --</option>
            <?php if(isset($list_pengabdian)): ?>
                <?php foreach($list_pengabdian as $p): ?>
                    <option value="<?= $p['id_pengabdian'] ?>" <?= old('id_pengabdian') == $p['id_pengabdian'] ? 'selected' : '' ?>>
                        <?= esc($p['judul_pengabdian']) ?> - <?= esc($p['nama_ketua']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <div class="invalid-feedback"><?= session('errors.id_pengabdian') ?></div>
    </div>

    <div class="row">
        <!-- 3. Nomor & Tanggal -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="nomor_kontrak">Nomor Kontrak <span class="text-danger">*</span></label>
                <input type="text" name="nomor_kontrak" id="nomor_kontrak" class="form-control <?= isset(session('errors')['nomor_kontrak']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_kontrak') ?>" placeholder="No: 001/LPPM/..." >
                <div class="invalid-feedback">
                    <?= session('errors.nomor_kontrak') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggal_tanda_tangan">Tanggal <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_tanda_tangan" id="tanggal_tanda_tangan" class="form-control <?= isset(session('errors')['tanggal_tanda_tangan']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_tanda_tangan') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_tanda_tangan') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- 4. Dana & Tahun -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="jumlah_dana_disetujui">Jumlah Dana Disetujui (Rp) <span class="text-danger">*</span></label>
                <input type="number" name="jumlah_dana_disetujui" id="jumlah_dana_disetujui" class="form-control <?= isset(session('errors')['jumlah_dana_disetujui']) ? 'is-invalid' : '' ?>" value="<?= old('jumlah_dana_disetujui') ?>" placeholder="Contoh: 50000000">
                <small class="text-muted">Masukkan angka tanpa titik atau koma.</small>
                <div class="invalid-feedback">
                    <?= session('errors.jumlah_dana_disetujui') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tahun_anggaran">Tahun Anggaran <span class="text-danger">*</span></label>
                <input type="number"name="tahun_anggaran" id="tahun_anggaran" class="form-control <?= isset(session('errors')['tahun_anggaran']) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tahun_anggaran') ?>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. Target Luaran -->
    <div class="form-group">
        <label for="target_luaran">Target Luaran Wajib <span class="text-danger">*</span></label>
        <input type="text" name="target_luaran" id="target_luaran" class="form-control <?= isset(session('errors')['target_luaran']) ? 'is-invalid' : '' ?>" value="<?= old('target_luaran') ?>" placeholder="Contoh: Jurnal Sinta 2, HKI, Buku Ajar">
        <div class="invalid-feedback">
            <?= session('errors.target_luaran') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="file_kontrak">Upload File</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input <?= isset(session('errors')['file_kontrak']) ? 'is-invalid' : '' ?>" id="file_kontrak" name="file_kontrak" accept=".pdf" onchange="$('#customFileLabel').text(this.files[0].name)">
            <label class="custom-file-label" id="customFileLabel" for="file_kontrak">Pilih File</label>
            <div class="invalid-feedback">
                <?= session('errors.file_kontrak') ?>
            </div>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Data</button>
        <a href="<?= site_url($variable . '/kategori/' . url(3)) ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>