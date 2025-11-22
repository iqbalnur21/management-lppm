<?= $this->extend('layout/new') ?>

<?= $this->section('title') ?>
Formulir Tambah Data Mahasiswa
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Tambah Data Mahasiswa</h4>
<hr>

<form action="<?= site_url('mahasiswa') ?>" method="post" autocomplete="off">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="nim">NIM</label>
        <input type="text" name="nim" id="nim" class="form-control <?= isset(session('errors')['nim']) ? 'is-invalid' : '' ?>" value="<?= old('nim') ?>" placeholder="Masukkan NIM" autofocus>
        <div class="invalid-feedback">
            <?= session('errors.nim') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control <?= isset(session('errors')['nama_lengkap']) ? 'is-invalid' : '' ?>" value="<?= old('nama_lengkap') ?>" placeholder="Masukkan Nama Lengkap">
        <div class="invalid-feedback">
            <?= session('errors.nama_lengkap') ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
             <div class="form-group">
                <label for="prodi">Program Studi</label>
                <select name="prodi" id="prodi" class="form-control <?= isset(session('errors')['prodi']) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Prodi --</option>
                    <option value="Teknik Informatika" <?= old('prodi') == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                    <option value="Sistem Informasi" <?= old('prodi') == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                    <option value="Teknik Komputer" <?= old('prodi') == 'Teknik Komputer' ? 'selected' : '' ?>>Teknik Komputer</option>
                    <option value="Manajemen Informatika" <?= old('prodi') == 'Manajemen Informatika' ? 'selected' : '' ?>>Manajemen Informatika</option>
                </select>
                <div class="invalid-feedback">
                    <?= session('errors.prodi') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <input type="number" name="angkatan" id="angkatan" class="form-control <?= isset(session('errors')['angkatan']) ? 'is-invalid' : '' ?>" value="<?= old('angkatan', date('Y')) ?>" placeholder="Contoh: 2023" min="2000" max="<?= date('Y') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.angkatan') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Data</button>
        <a href="<?= site_url('mahasiswa') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>