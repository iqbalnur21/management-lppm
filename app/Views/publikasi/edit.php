<?= $this->extend('layout/edit') ?>

<?= $this->section('title') ?>
Edit Data Publikasi: <?= esc($data['judul_artikel']) ?>
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Edit Data Publikasi</h4>
<hr>

<form action="<?= site_url('publikasi/' . $data['id_publikasi']) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div class="form-group">
        <label for="judul_artikel">Judul Artikel</label>
        <input type="hidden" name="jenis_pengabdian_atau_penelitian" id="jenis_pengabdian_atau_penelitian" value="<?= $data['jenis_pengabdian_atau_penelitian'] ?>">
        <input type="text" name="judul_artikel" id="judul_artikel" class="form-control <?= isset(session('errors')['judul_artikel']) ? 'is-invalid' : '' ?>" value="<?= old('judul_artikel', $data['judul_artikel']) ?>" autofocus>
        <div class="invalid-feedback">
            <?= session('errors.judul_artikel') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="jenis_publikasi">Jenis Publikasi</label>
                <select name="jenis_publikasi" id="jenis_publikasi" class="form-control <?= isset(session('errors')['jenis_publikasi']) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Jurnal Nasional Terakreditasi" <?= old('jenis_publikasi', $data['jenis_publikasi']) == 'Jurnal Nasional Terakreditasi' ? 'selected' : '' ?>>Jurnal Nasional Terakreditasi</option>
                    <option value="Jurnal Internasional Bereputasi" <?= old('jenis_publikasi', $data['jenis_publikasi']) == 'Jurnal Internasional Bereputasi' ? 'selected' : '' ?>>Jurnal Internasional Bereputasi</option>
                    <option value="Prosiding Seminar Nasional" <?= old('jenis_publikasi', $data['jenis_publikasi']) == 'Prosiding Seminar Nasional' ? 'selected' : '' ?>>Prosiding Seminar Nasional</option>
                    <option value="Prosiding Seminar Internasional" <?= old('jenis_publikasi', $data['jenis_publikasi']) == 'Prosiding Seminar Internasional' ? 'selected' : '' ?>>Prosiding Seminar Internasional</option>
                    <option value="Lainnya" <?= old('jenis_publikasi', $data['jenis_publikasi']) == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                </select>
                <div class="invalid-feedback">
                    <?= session('errors.jenis_publikasi') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama_publikasi">Nama Jurnal / Seminar</label>
                <input type="text" name="nama_publikasi" id="nama_publikasi" class="form-control <?= isset(session('errors')['nama_publikasi']) ? 'is-invalid' : '' ?>" value="<?= old('nama_publikasi', $data['nama_publikasi']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nama_publikasi') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="tanggal_terbit">Tanggal Terbit</label>
                <input type="number" name="tanggal_terbit" id="tanggal_terbit" class="form-control <?= isset(session('errors')['tanggal_terbit']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_terbit', $data['tanggal_terbit']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_terbit') ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="volume">Volume</label>
                <input type="text" name="volume" id="volume" class="form-control <?= isset(session('errors')['volume']) ? 'is-invalid' : '' ?>" value="<?= old('volume', $data['volume']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.volume') ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="nomor">Nomor</label>
                <input type="text" name="nomor" id="nomor" class="form-control <?= isset(session('errors')['nomor']) ? 'is-invalid' : '' ?>" value="<?= old('nomor', $data['nomor']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nomor') ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="halaman">Halaman</label>
                <input type="text" name="halaman" id="halaman" class="form-control <?= isset(session('errors')['halaman']) ? 'is-invalid' : '' ?>" value="<?= old('halaman', $data['halaman']) ?>" placeholder="Contoh: 1-10">
                <div class="invalid-feedback">
                    <?= session('errors.halaman') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="link_publikasi">Link Publikasi (URL)</label>
        <input type="url" name="link_publikasi" id="link_publikasi" class="form-control <?= isset(session('errors')['link_publikasi']) ? 'is-invalid' : '' ?>" value="<?= old('link_publikasi', $data['link_publikasi']) ?>" placeholder="https://...">
        <div class="invalid-feedback">
            <?= session('errors.link_publikasi') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="file_artikel">Upload File Artikel Baru (PDF)</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input <?= isset(session('errors')['file_artikel']) ? 'is-invalid' : '' ?>" id="file_artikel" name="file_artikel" onchange="$('#customFileLabel').text(this.files[0].name)">
            <label class="custom-file-label" id="customFileLabel" for="file_artikel">Pilih file (jika ingin mengganti)</label>
            <div class="invalid-feedback">
                <?= session('errors.file_artikel') ?>
            </div>
            <?php if (!empty($data['file_artikel'])) : ?>
                <p class="mt-1">
                    <small>File saat ini: <a href="<?= base_url('upload/publikasi/' . $data['file_artikel']) ?>" target="_blank"><?= esc($data['file_artikel']) ?></a></small>
                </p>
            <?php endif; ?>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-paper-plane"></i> Simpan Perubahan</button>
        <a href="<?= site_url('publikasi') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>