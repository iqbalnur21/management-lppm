<?= $this->extend('layout/edit') ?>

<?= $this->section('title') ?>
Edit Data Publikasi: <?= esc($data['judul_artikel']) ?>
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Formulir Edit Data Publikasi</h4>
    <?php 
        $statusColor = [
            'belum_terverifikasi' => 'secondary',
            'terverifikasi' => 'success',
        ]; 
    ?>
    <span class="badge badge-<?= $statusColor[$data['status']] ?? 'secondary' ?>">
        Status: <?= ucfirst($data['status']) ?>
    </span>
</div>

<?php if (!empty($data['catatan_verifikator'])) : ?>
    <div class="alert alert-warning">
        <strong><i class="fas fa-exclamation-circle"></i> Catatan Verifikator:</strong><br>
        <?= esc($data['catatan_verifikator']) ?>
    </div>
<?php endif; ?>

<hr>

<form action="<?= site_url('publikasi/' . $data['id_publikasi']) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT"> <!-- Method Spoofing untuk proses UPDATE -->
    <input type="hidden" name="jenis_pengabdian_atau_penelitian" value="<?= $data['jenis_pengabdian_atau_penelitian'] ?>">
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
                <label for="jenis_publikasi">Jenis Publikasi <span class="text-danger">*</span></label>
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
                <label for="nama_publikasi">Nama Jurnal / Seminar <span class="text-danger">*</span></label>
                <input type="text" name="nama_publikasi" id="nama_publikasi" class="form-control <?= isset(session('errors')['nama_publikasi']) ? 'is-invalid' : '' ?>" value="<?= old('nama_publikasi', $data['nama_publikasi']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nama_publikasi') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-light mb-3">
        <div class="card-body py-3">
            <h6 class="card-subtitle mb-2 text-muted">Status & Indeksasi Jurnal</h6>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label for="status_akreditasi_jurnal">Status Akreditasi</label>
                        <select name="status_akreditasi_jurnal" id="status_akreditasi_jurnal" class="form-control <?= isset(session('errors')['status_akreditasi_jurnal']) ? 'is-invalid' : '' ?>">
                            <option value="0" <?= old('status_akreditasi_jurnal', $data['status_akreditasi_jurnal']) == '0' ? 'selected' : '' ?>>Tidak Terakreditasi</option>
                            <option value="1" <?= old('status_akreditasi_jurnal', $data['status_akreditasi_jurnal']) == '1' ? 'selected' : '' ?>>Terakreditasi</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label for="sinta">Peringkat SINTA (Opsional)</label>
                        <select name="sinta" id="sinta" class="form-control <?= isset(session('errors')['sinta']) ? 'is-invalid' : '' ?>">
                            <option value="">-- Tidak Ada --</option>
                            <?php foreach(['C1','C2','C3','C4','C5','C6'] as $s): ?>
                                <option value="<?= $s ?>" <?= old('sinta', $data['sinta']) == $s ? 'selected' : '' ?>>Sinta <?= $s ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label for="quartile">Quartile (Scopus/WoS) (Opsional)</label>
                        <select name="quartile" id="quartile" class="form-control <?= isset(session('errors')['quartile']) ? 'is-invalid' : '' ?>">
                            <option value="">-- Tidak Ada --</option>
                            <?php foreach(['Q1','Q2','Q3','Q4'] as $q): ?>
                                <option value="<?= $q ?>" <?= old('quartile', $data['quartile']) == $q ? 'selected' : '' ?>><?= $q ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="tanggal_terbit">Tanggal Terbit</label>
                <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control <?= isset(session('errors')['tanggal_terbit']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_terbit', $data['tanggal_terbit']) ?>">
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
            <input type="file" class="custom-file-input <?= isset(session('errors')['file_artikel']) ? 'is-invalid' : '' ?>" id="file_artikel" name="file_artikel" accept=".pdf" onchange="$('#customFileLabel').text(this.files[0].name)">
            <label class="custom-file-label" id="customFileLabel" for="file_artikel">Pilih file (jika ingin mengganti)</label>
            <div class="invalid-feedback">
                <?= session('errors.file_artikel') ?>
            </div>
        </div>
        <?php if (!empty($data['file_artikel'])) : ?>
            <div class="alert alert-info mt-2 p-2">
                <i class="fas fa-file-pdf"></i> File saat ini: 
                <a href="<?= base_url('upload/publikasi/' . $data['file_artikel']) ?>" target="_blank" class="font-weight-bold"><?= esc($data['file_artikel']) ?></a>
            </div>
        <?php endif; ?>
    </div>

    <div>
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Perubahan</button>
        <a href="<?= site_url('publikasi') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>