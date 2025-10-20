<?= $this->extend('layout/new') ?>

<?= $this->section('title') ?>
Formulir Tambah Data Prototype
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Tambah Data Prototype</h4>
<hr>

<form action="<?= site_url('prototype') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="id_penelitian_terkait">Penelitian Terkait</label>
        <select name="id_penelitian_terkait" id="id_penelitian_terkait" class="form-control <?= isset(session('errors')['id_penelitian_terkait']) ? 'is-invalid' : '' ?>">
            <option value="">-- Pilih Penelitian --</option>
            <?php foreach ($penelitian_list as $item) : ?>
                <option value="<?= $item['id_penelitian'] ?>" <?= old('id_penelitian_terkait') == $item['id_penelitian'] ? 'selected' : '' ?>>
                    <?= esc($item['judul_penelitian']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
            <?= session('errors.id_penelitian_terkait') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="nama_prototype">Nama Prototype</label>
                <input type="text" name="nama_prototype" id="nama_prototype" class="form-control <?= isset(session('errors')['nama_prototype']) ? 'is-invalid' : '' ?>" value="<?= old('nama_prototype') ?>" autofocus>
                <div class="invalid-feedback">
                    <?= session('errors.nama_prototype') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tahun_pembuatan">Tahun Pembuatan</label>
                <input type="number" name="tahun_pembuatan" id="tahun_pembuatan" class="form-control <?= isset(session('errors')['tahun_pembuatan']) ? 'is-invalid' : '' ?>" value="<?= old('tahun_pembuatan', date('Y')) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tahun_pembuatan') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="deskripsi">Deskripsi Singkat</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control <?= isset(session('errors')['deskripsi']) ? 'is-invalid' : '' ?>" rows="4"><?= old('deskripsi') ?></textarea>
        <div class="invalid-feedback">
            <?= session('errors.deskripsi') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="link_video_demo">Link Video Demo (YouTube, Google Drive, dll.)</label>
        <input type="url" name="link_video_demo" id="link_video_demo" class="form-control <?= isset(session('errors')['link_video_demo']) ? 'is-invalid' : '' ?>" value="<?= old('link_video_demo') ?>" placeholder="https://...">
        <div class="invalid-feedback">
            <?= session('errors.link_video_demo') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="file_dokumentasi">Upload File Dokumentasi (PDF, DOCX)</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input <?= isset(session('errors')['file_dokumentasi']) ? 'is-invalid' : '' ?>" id="file_dokumentasi" name="file_dokumentasi" onchange="$('#customFileLabel').text(this.files[0].name)">
            <label class="custom-file-label" id="customFileLabel" for="file_dokumentasi">Pilih File</label>
            <div class="invalid-feedback">
                <?= session('errors.file_dokumentasi') ?>
            </div>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-paper-plane"></i> Simpan Data</button>
        <a href="<?= site_url('prototype') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>
