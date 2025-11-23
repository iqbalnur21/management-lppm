<?= $this->extend('layout/edit') ?>

<?= $this->section('title') ?>
Edit Data Pengabdian: <?= esc($data['judul_pengabdian']) ?>
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Edit Pengabdian Masyarakat</h4>
<hr>

<form action="<?= site_url('pengabdian/' . $data['id_pengabdian']) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT"> <!-- Method Spoofing untuk proses UPDATE -->

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nomor_surat">Nomor Surat Tugas</label>
                <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">
                <input type="text" name="nomor_surat" id="nomor_surat" class="form-control <?= isset(session('errors')['nomor_surat']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_surat', $data['nomor_surat']) ?>" autofocus>
                <div class="invalid-feedback">
                    <?= session('errors.nomor_surat') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="judul_pengabdian">Judul Pengabdian</label>
                <input type="text" name="judul_pengabdian" id="judul_pengabdian" class="form-control <?= isset(session('errors')['judul_pengabdian']) ? 'is-invalid' : '' ?>" value="<?= old('judul_pengabdian', $data['judul_pengabdian']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.judul_pengabdian') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="lokasi_pengabdian">Lokasi Pengabdian</label>
        <textarea name="lokasi_pengabdian" id="lokasi_pengabdian" class="form-control <?= isset(session('errors')['lokasi_pengabdian']) ? 'is-invalid' : '' ?>" rows="3"><?= old('lokasi_pengabdian', $data['lokasi_pengabdian']) ?></textarea>
        <div class="invalid-feedback">
            <?= session('errors.lokasi_pengabdian') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="sumber_dana">Sumber Dana</label>
                <input type="text" name="sumber_dana" id="sumber_dana" class="form-control <?= isset(session('errors')['sumber_dana']) ? 'is-invalid' : '' ?>" value="<?= old('sumber_dana', $data['sumber_dana']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.sumber_dana') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="jumlah_dana">Jumlah Dana</label>
                <input type="number" name="jumlah_dana" id="jumlah_dana" class="form-control <?= isset(session('errors')['jumlah_dana']) ? 'is-invalid' : '' ?>" value="<?= currencyNumberFormat(old('jumlah_dana', $data['jumlah_dana'])) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.jumlah_dana') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tanggal_pelaksanaan">Tahun Pelaksanaan</label>
                <input type="number" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan" class="form-control <?= isset(session('errors')['tanggal_pelaksanaan']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_pelaksanaan', $data['tanggal_pelaksanaan']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_pelaksanaan') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control <?= isset(session('errors')['tanggal_mulai']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_mulai', $data['tanggal_mulai']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_mulai') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control <?= isset(session('errors')['tanggal_selesai']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_selesai', $data['tanggal_selesai']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_selesai') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="file_surat_tugas">Upload File Surat Tugas Baru (PDF, DOCX)</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input <?= isset(session('errors')['file_surat_tugas']) ? 'is-invalid' : '' ?>" id="file_surat_tugas" name="file_surat_tugas" onchange="$('#customFileLabel').text(this.files[0].name)">
            <label class="custom-file-label" id="customFileLabel" for="file_surat_tugas">Pilih file (jika ingin mengganti)</label>
            <?php if (!empty($data['file_surat_tugas'])) : ?>
                <p class="mt-1">
                    <small>File saat ini: <a href="<?= base_url('upload/pengabdian/' . $data['file_surat_tugas']) ?>" target="_blank"><?= $data['file_surat_tugas'] ?></a></small>
                </p>
            <?php endif; ?>
            <div class="invalid-feedback">
                <?= session('errors.file_surat_tugas') ?>
            </div>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-paper-plane"></i> Simpan Perubahan</button>
        <a href="<?= site_url('pengabdian') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>