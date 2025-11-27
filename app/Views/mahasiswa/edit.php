<?= $this->extend('layout/edit') ?>

<?= $this->section('title') ?>
Edit Data Mahasiswa: <?= esc($data['nama_lengkap']) ?>
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Edit Data Mahasiswa</h4>
<hr>

<form action="<?= site_url('mahasiswa/' . $data['id_mahasiswa']) ?>" method="post" autocomplete="off">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <input type="hidden" name="user_id" value="<?= session('user_id') ?>">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" id="nim" class="form-control <?= isset(session('errors')['nim']) ? 'is-invalid' : '' ?>" value="<?= old('nim', $data['nim']) ?>" autofocus>
                <div class="invalid-feedback">
                    <?= session('errors.nim') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control <?= isset(session('errors')['nama_lengkap']) ? 'is-invalid' : '' ?>" value="<?= old('nama_lengkap', $data['nama_lengkap']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nama_lengkap') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="prodi">Program Studi</label>
                <input type="text" name="prodi" id="prodi" class="form-control <?= isset(session('errors')['prodi']) ? 'is-invalid' : '' ?>" value="<?= old('prodi', $data['prodi']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.prodi') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <input type="number" name="angkatan" id="angkatan" class="form-control <?= isset(session('errors')['angkatan']) ? 'is-invalid' : '' ?>" value="<?= old('angkatan', $data['angkatan']) ?>" placeholder="Contoh: 2023">
                <div class="invalid-feedback">
                    <?= session('errors.angkatan') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Data</button>
        <a href="<?= site_url('mahasiswa') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>