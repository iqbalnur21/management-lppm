<?= $this->extend('layout/new') ?>

<?= $this->section('title') ?>
Formulir Tambah Data HKI
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Tambah Data HKI</h4>
<hr>

<form action="<?= site_url('hki') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="judul_ciptaan">Judul Ciptaan</label>
        <input type="text" name="judul_ciptaan" id="judul_ciptaan" class="form-control <?= isset(session('errors')['judul_ciptaan']) ? 'is-invalid' : '' ?>" value="<?= old('judul_ciptaan') ?>" autofocus>
        <div class="invalid-feedback">
            <?= session('errors.judul_ciptaan') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
             <div class="form-group">
                <label for="jenis_hki">Jenis HKI</label>
                <select name="jenis_hki" id="jenis_hki" class="form-control <?= isset(session('errors')['jenis_hki']) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Hak Cipta" <?= old('jenis_hki') == 'Hak Cipta' ? 'selected' : '' ?>>Hak Cipta</option>
                    <option value="Paten" <?= old('jenis_hki') == 'Paten' ? 'selected' : '' ?>>Paten</option>
                    <option value="Paten Sederhana" <?= old('jenis_hki') == 'Paten Sederhana' ? 'selected' : '' ?>>Paten Sederhana</option>
                    <option value="Merek Dagang" <?= old('jenis_hki') == 'Merek Dagang' ? 'selected' : '' ?>>Merek Dagang</option>
                    <option value="Desain Industri" <?= old('jenis_hki') == 'Desain Industri' ? 'selected' : '' ?>>Desain Industri</option>
                    <option value="Lainnya" <?= old('jenis_hki') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                </select>
                <div class="invalid-feedback">
                    <?= session('errors.jenis_hki') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="id_penelitian_terkait">Penelitian Terkait (Opsional)</label>
                <select name="id_penelitian_terkait" id="id_penelitian_terkait" class="form-control <?= isset(session('errors')['id_penelitian_terkait']) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Penelitian --</option>
                    <?php foreach ($penelitian_list as $penelitian) : ?>
                        <option value="<?= $penelitian['id_penelitian'] ?>" <?= old('id_penelitian_terkait') == $penelitian['id_penelitian'] ? 'selected' : '' ?>>
                            <?= esc($penelitian['judul_penelitian']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= session('errors.id_penelitian_terkait') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="nomor_pendaftaran">Nomor Pendaftaran</label>
                <input type="text" name="nomor_pendaftaran" id="nomor_pendaftaran" class="form-control <?= isset(session('errors')['nomor_pendaftaran']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_pendaftaran') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nomor_pendaftaran') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="nomor_sertifikat">Nomor Sertifikat</label>
                <input type="text" name="nomor_sertifikat" id="nomor_sertifikat" class="form-control <?= isset(session('errors')['nomor_sertifikat']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_sertifikat') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nomor_sertifikat') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tanggal_penerimaan">Tanggal Penerimaan</label>
                <input type="date" name="tanggal_penerimaan" id="tanggal_penerimaan" class="form-control <?= isset(session('errors')['tanggal_penerimaan']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_penerimaan') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_penerimaan') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="file_sertifikat">Upload File Sertifikat (PDF)</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input <?= isset(session('errors')['file_sertifikat']) ? 'is-invalid' : '' ?>" id="file_sertifikat" name="file_sertifikat" onchange="$('#customFileLabel').text(this.files[0].name)">
            <label class="custom-file-label" id="customFileLabel" for="file_sertifikat">Pilih File</label>
            <div class="invalid-feedback">
                <?= session('errors.file_sertifikat') ?>
            </div>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-paper-plane"></i> Simpan Data</button>
        <a href="<?= site_url('hki') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>
