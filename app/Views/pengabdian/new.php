<?= $this->extend('layout/new') ?>

<?= $this->section('title') ?>
Formulir Tambah Pengabdian Masyarakat
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Tambah Pengabdian Masyarakat</h4>
<hr>

<form action="<?= site_url('pengabdian') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">
    <input type="hidden" name="status" value="0">

    <div class="form-group">
        <label for="judul_pengabdian">Judul Pengabdian</label>
        <input type="text" name="judul_pengabdian" id="judul_pengabdian" class="form-control <?= isset(session('errors')['judul_pengabdian']) ? 'is-invalid' : '' ?>" value="<?= old('judul_pengabdian') ?>" autofocus>
        <div class="invalid-feedback">
            <?= session('errors.judul_pengabdian') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="id_dosen">Ketua Pengabdi (Dosen)</label>
                <select name="id_dosen" id="id_dosen" class="form-control <?= isset(session('errors')['id_dosen']) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Dosen --</option>
                    <?php if (isset($list_dosen)) : ?>
                        <?php foreach ($list_dosen as $dosen) : ?>
                            <option value="<?= $dosen['id_dosen'] ?>" <?= old('id_dosen') == $dosen['id_dosen'] ? 'selected' : '' ?>>
                                <?= $dosen['nama_lengkap'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <div class="invalid-feedback"><?= session('errors.id_dosen') ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="id_mahasiswa">Anggota (Mahasiswa)</label>
                <select name="id_mahasiswa" id="id_mahasiswa" class="form-control <?= isset(session('errors')['id_mahasiswa']) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Mahasiswa (Opsional) --</option>
                    <?php if (isset($list_mahasiswa)) : ?>
                        <?php foreach ($list_mahasiswa as $mhs) : ?>
                            <option value="<?= $mhs['id_mahasiswa'] ?>" <?= old('id_mahasiswa') == $mhs['id_mahasiswa'] ? 'selected' : '' ?>>
                                <?= $mhs['nama_lengkap'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <div class="invalid-feedback"><?= session('errors.id_mahasiswa') ?></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tema">Tema</label>
                <input type="text" name="tema" id="tema" class="form-control <?= isset(session('errors')['tema']) ? 'is-invalid' : '' ?>" value="<?= old('tema') ?>">
                <div class="invalid-feedback"><?= session('errors.tema') ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="durasi">Durasi (Bulan/Minggu)</label>
                <input type="text" name="durasi" id="durasi" class="form-control <?= isset(session('errors')['durasi']) ? 'is-invalid' : '' ?>" value="<?= old('durasi') ?>">
                <div class="invalid-feedback"><?= session('errors.durasi') ?></div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="tujuan">Tujuan</label>
        <input type="text" name="tujuan" id="tujuan" class="form-control <?= isset(session('errors')['tujuan']) ? 'is-invalid' : '' ?>" value="<?= old('tujuan') ?>">
        <div class="invalid-feedback"><?= session('errors.tujuan') ?></div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="lokasi_pengabdian">Lokasi Pengabdian</label>
                <textarea name="lokasi_pengabdian" id="lokasi_pengabdian" class="form-control <?= isset(session('errors')['lokasi_pengabdian']) ? 'is-invalid' : '' ?>" rows="3"><?= old('lokasi_pengabdian') ?></textarea>
                <div class="invalid-feedback">
                    <?= session('errors.lokasi_pengabdian') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="catatan_verifikator">Catatan Verifikator</label>
                <textarea name="catatan_verifikator" id="catatan_verifikator" rows="3" class="form-control <?= isset(session('errors')['catatan_verifikator']) ? 'is-invalid' : '' ?>"></textarea>
                <div class="invalid-feedback"><?= session('errors.catatan_verifikator') ?></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="nomor_surat">Nomor Surat Tugas</label>
                <input type="text" name="nomor_surat" id="nomor_surat" class="form-control <?= isset(session('errors')['nomor_surat']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_surat') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.nomor_surat') ?>
                </div>
            </div>
        </div>
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
                <input type="number" step="0.01" name="jumlah_dana" id="jumlah_dana" class="form-control <?= isset(session('errors')['jumlah_dana']) ? 'is-invalid' : '' ?>" value="<?= old('jumlah_dana') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.jumlah_dana') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan" class="form-control <?= isset(session('errors')['tanggal_pelaksanaan']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_pelaksanaan') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_pelaksanaan') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control <?= isset(session('errors')['tanggal_mulai']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_mulai') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_mulai') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
        <label for="file_surat_tugas">Upload File Surat Tugas (PDF, DOCX)</label>
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
        <a href="<?= site_url('pengabdian') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>