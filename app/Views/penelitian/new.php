<?= $this->extend('layout/new') ?>

<?= $this->section('title') ?>
Formulir Tambah Data Penelitian
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Tambah Data Penelitian</h4>
<hr>

<form action="<?= site_url('penelitian') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="judul_penelitian">Judul Penelitian</label>
        <input type="text" name="judul_penelitian" id="judul_penelitian" class="form-control <?= isset(session('errors')['judul_penelitian']) ? 'is-invalid' : '' ?>" value="<?= old('judul_penelitian') ?>" autofocus>
        <div class="invalid-feedback">
            <?= session('errors.judul_penelitian') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="skema_penelitian">Skema Penelitian</label>
                <input type="text" name="skema_penelitian" id="skema_penelitian" class="form-control <?= isset(session('errors')['skema_penelitian']) ? 'is-invalid' : '' ?>" value="<?= old('skema_penelitian') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.skema_penelitian') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nomor_surat">Nomor Surat Tugas</label>
                <input type="text" name="nomor_surat" id="nomor_surat" class="form-control <?= isset(session('errors')['nomor_surat']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_surat') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nomor_surat') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="sumber_dana">Sumber Dana</label>
                <input type="text" name="sumber_dana" id="sumber_dana" class="form-control <?= isset(session('errors')['sumber_dana']) ? 'is-invalid' : '' ?>" value="<?= old('sumber_dana') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.sumber_dana') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="jumlah_dana">Jumlah Dana</label>
                <input type="number" name="jumlah_dana" id="jumlah_dana" class="form-control <?= isset(session('errors')['jumlah_dana']) ? 'is-invalid' : '' ?>" value="<?= old('jumlah_dana') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.jumlah_dana') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tanggal_penelitian">Tahun Penelitian</label>
                <input type="number" name="tanggal_penelitian" id="tanggal_penelitian" class="form-control <?= isset(session('errors')['tanggal_penelitian']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_penelitian', date('Y')) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_penelitian') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="file_surat_tugas">Upload File Surat Tugas (PDF, DOCX)</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= isset(session('errors')['file_surat_tugas']) ? 'is-invalid' : '' ?>" id="file_surat_tugas" name="file_surat_tugas" onchange="$('#suratTugasLabel').text(this.files[0].name)">
                    <label class="custom-file-label" id="suratTugasLabel" for="file_surat_tugas">Pilih File</label>
                    <div class="invalid-feedback">
                        <?= session('errors.file_surat_tugas') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="file_proposal">Upload File Proposal (PDF, DOCX)</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= isset(session('errors')['file_proposal']) ? 'is-invalid' : '' ?>" id="file_proposal" name="file_proposal" onchange="$('#proposalLabel').text(this.files[0].name)">
                    <label class="custom-file-label" id="proposalLabel" for="file_proposal">Pilih File</label>
                    <div class="invalid-feedback">
                        <?= session('errors.file_proposal') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-paper-plane"></i> Simpan Data</button>
        <a href="<?= site_url('penelitian') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>
