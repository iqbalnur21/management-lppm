<?= $this->extend('layout/edit') ?>

<?= $this->section('title') ?>
Edit Data Penelitian: <?= esc($data['judul_penelitian']) ?>
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Edit Data Penelitian</h4>
<hr>

<form action="<?= site_url('penelitian/' . $data['id_penelitian']) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div class="form-group">
        <label for="judul_penelitian">Judul Penelitian</label>
        <input type="hidden" name="status" id="status" class="form-control" value="<?= $data['status'] ?>" >
        <input type="hidden" name="user_id" id="user_id" class="form-control <?= isset(session('errors')['user_id']) ? 'is-invalid' : '' ?>" value="<?= session('user_id') ?>" autofocus>
        <input type="text" name="judul_penelitian" id="judul_penelitian" class="form-control <?= isset(session('errors')['judul_penelitian']) ? 'is-invalid' : '' ?>" value="<?= old('judul_penelitian', $data['judul_penelitian']) ?>" autofocus>
        <div class="invalid-feedback">
            <?= session('errors.judul_penelitian') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="id_dosen">Ketua Peneliti (Dosen)</label>
                <select name="id_dosen" id="id_dosen" class="form-control <?= isset(session('errors')['id_dosen']) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Dosen --</option>
                    <?php if (isset($list_dosen)) : ?>
                        <?php foreach ($list_dosen as $dosen) : ?>
                            <option value="<?= $dosen['id_dosen'] ?>" <?= old('id_dosen', $data['id_dosen']) == $dosen['id_dosen'] ? 'selected' : '' ?>>
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
                            <option value="<?= $mhs['id_mahasiswa'] ?>" <?= old('id_mahasiswa', $data['id_mahasiswa']) == $mhs['id_mahasiswa'] ? 'selected' : '' ?>>
                                <?= $mhs['nama_lengkap'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <div class="invalid-feedback"><?= session('errors.id_mahasiswa') ?></div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="tujuan">Tujuan Penelitian</label>
        <input type="text" name="tujuan" id="tujuan" class="form-control <?= isset(session('errors')['tujuan']) ? 'is-invalid' : '' ?>" value="<?= old('tujuan', $data['tujuan']) ?>">
        <div class="invalid-feedback">
            <?= session('errors.tujuan') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="catatan_verifikator">Catatan Verifikator</label>
        <textarea name="catatan_verifikator" id="catatan_verifikator" rows="4" class="form-control <?= isset(session('errors')['catatan_verifikator']) ? 'is-invalid' : '' ?>"><?= old('catatan_verifikator', $data['catatan_verifikator']) ?></textarea>
        <div class="invalid-feedback">
            <?= session('errors.catatan_verifikator') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="skema_penelitian">Skema Penelitian</label>
                <input type="text" name="skema_penelitian" id="skema_penelitian" class="form-control <?= isset(session('errors')['skema_penelitian']) ? 'is-invalid' : '' ?>" value="<?= old('skema_penelitian', $data['skema_penelitian']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.skema_penelitian') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nomor_surat">Nomor Surat Tugas</label>
                <input type="text" name="nomor_surat" id="nomor_surat" class="form-control <?= isset(session('errors')['nomor_surat']) ? 'is-invalid' : '' ?>" value="<?= old('nomor_surat', $data['nomor_surat']) ?>">
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
                <input type="text" name="sumber_dana" id="sumber_dana" class="form-control <?= isset(session('errors')['sumber_dana']) ? 'is-invalid' : '' ?>" value="<?= old('sumber_dana', $data['sumber_dana']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.sumber_dana') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="jumlah_dana">Jumlah Dana</label>
                <input type="number" step="0.01" name="jumlah_dana" id="jumlah_dana" class="form-control <?= isset(session('errors')['jumlah_dana']) ? 'is-invalid' : '' ?>" value="<?= currencyNumberFormat(old('jumlah_dana', $data['jumlah_dana'])) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.jumlah_dana') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tanggal_penelitian">Tanggal Penelitian</label>
                <input type="date" name="tanggal_penelitian" id="tanggal_penelitian" class="form-control <?= isset(session('errors')['tanggal_penelitian']) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_penelitian', $data['tanggal_penelitian']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_penelitian') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="file_surat_tugas">File Surat Tugas</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= isset(session('errors')['file_surat_tugas']) ? 'is-invalid' : '' ?>" id="file_surat_tugas" name="file_surat_tugas" onchange="$(this).next('.custom-file-label').text(this.files[0].name)">
                    <label class="custom-file-label" for="file_surat_tugas">Pilih file...</label>
                    <div class="invalid-feedback"><?= session('errors.file_surat_tugas') ?></div>
                </div>
                <?php if (!empty($data['file_surat_tugas'])) : ?>
                    <p class="mt-1 mb-1"><small>File Sekarang: <a href="<?= base_url('upload/penelitian/surat_tugas/' . $data['file_surat_tugas']) ?>" target="_blank">Lihat File</a></small></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="file_proposal">File Proposal</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= isset(session('errors')['file_proposal']) ? 'is-invalid' : '' ?>" id="file_proposal" name="file_proposal" onchange="$(this).next('.custom-file-label').text(this.files[0].name)">
                    <label class="custom-file-label" for="file_proposal">Pilih file...</label>
                    <div class="invalid-feedback"><?= session('errors.file_proposal') ?></div>
                </div>
                <?php if (!empty($data['file_proposal'])) : ?>
                    <p class="mt-1 mb-1"><small>File Sekarang: <a href="<?= base_url('upload/penelitian/proposal/' . $data['file_proposal']) ?>" target="_blank">Lihat File</a></small></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="file_laporan_akhir">File Laporan Akhir</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= isset(session('errors')['file_laporan_akhir']) ? 'is-invalid' : '' ?>" id="file_laporan_akhir" name="file_laporan_akhir" onchange="$(this).next('.custom-file-label').text(this.files[0].name)">
                    <label class="custom-file-label" for="file_laporan_akhir">Pilih file...</label>
                    <div class="invalid-feedback"><?= session('errors.file_laporan_akhir') ?></div>
                </div>
                <?php if (!empty($data['file_laporan_akhir'])) : ?>
                    <p class="mt-1 mb-1"><small>File Sekarang: <a href="<?= base_url('upload/penelitian/laporan/' . $data['file_laporan_akhir']) ?>" target="_blank">Lihat File</a></small></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-paper-plane"></i> Simpan Data</button>
        <a href="<?= site_url('penelitian') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>