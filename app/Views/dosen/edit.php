<?= $this->extend('layout/edit') ?>

<?= $this->section('title') ?>
Edit Data Dosen: <?= esc($data['nama_lengkap']) ?>
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Edit Data Dosen</h4>
<hr>

<form action="<?= site_url('dosen/' . $data['id_dosen']) ?>" method="post" autocomplete="off">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <input type="hidden" name="user_id" value="<?= session('user_id') ?>">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" name="nidn" id="nidn" class="form-control <?= isset(session('errors')['nidn']) ? 'is-invalid' : '' ?>" value="<?= old('nidn', $data['nidn']) ?>" autofocus>
                <div class="invalid-feedback">
                    <?= session('errors.nidn') ?>
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
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control <?= isset(session('errors')['email']) ? 'is-invalid' : '' ?>" value="<?= old('email', $data['email']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.email') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="prodi">Program Studi (Prodi)</label>
                <input type="text" name="prodi" id="prodi" class="form-control <?= isset(session('errors')['prodi']) ? 'is-invalid' : '' ?>" value="<?= old('prodi', $data['prodi']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.prodi') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Data</button>
        <a href="<?= site_url('dosen') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>