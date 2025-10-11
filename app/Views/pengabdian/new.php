<?= $this->extend('layout/new') ?>

<?= $this->section('form') ?>
<h4>Formulir Tambah <?= $title ?></h4>
<hr>

<form action="<?= site_url($variable . '/create') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nomor_surat">Nomor Surat Tugas</label>
                <input type="text" name="nomor_surat" id="nomor_surat" class="form-control <?= isset(session('errors')['nomor_surat']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_surat') ?>" autofocus>
                <div class="invalid-feedback">
                    <?= session('errors.nomor_surat') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="judul_pengabdian">Judul Pengabdian</label>
                <input type="text" name="judul_pengabdian" id="judul_pengabdian" class="form-control <?= isset(session('errors')['judul_pengabdian']) ? 'is-invalid' : '' ?>" value="<?= old('judul_pengabdian') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.judul_pengabdian') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="lokasi_pengabdian">Lokasi Pengabdian</label>
        <textarea name="lokasi_pengabdian" id="lokasi_pengabdian" class="form-control <?= isset(session('errors')['lokasi_pengabdian']) ? 'is-invalid' : '' ?>" rows="3"><?= old('lokasi_pengabdian') ?></textarea>
        <div class="invalid-feedback">
            <?= session('errors.lokasi_pengabdian') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control <?= isset(session('errors')['tanggal_mulai']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_mulai') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_mulai') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control <?= isset(session('errors')['tanggal_selesai']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_selesai') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_selesai') ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label for="file_surat_tugas">Upload File Surat Tugas (PDF/DOCX)</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input <?= isset(session('errors')['file_surat_tugas']) ? 'is-invalid' : '' ?>" id="file_surat_tugas" name="file_surat_tugas" onchange="$('#customFileLabel').text(this.files[0].name)">
            <label class="custom-file-label" id="customFileLabel" for="file_surat_tugas">Pilih File</label>
            <div class="invalid-feedback">
                <?= session('errors.file_surat_tugas') ?>
            </div>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-paper-plane"></i> Simpan Data</button>
        <a href="<?= site_url('Pengabdian/SuratTugas') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>