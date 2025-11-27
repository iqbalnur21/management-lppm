<?= $this->extend('layout/edit') ?>

<?= $this->section('title') ?>
Edit User: <?= esc($data['name']) ?>
<?= $this->endSection() ?>

<?= $this->section('form') ?>
<h4>Formulir Edit User</h4>
<hr>

<form action="<?= site_url('user/' . $data['id']) ?>" method="post" autocomplete="off">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div class="form-group">
        <label for="name">Nama Lengkap (Name)</label>
        <input type="text" name="name" id="name" class="form-control <?= isset(session('errors')['name']) ? 'is-invalid' : '' ?>" value="<?= old('name', $data['name']) ?>">
        <div class="invalid-feedback">
            <?= session('errors.name') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control <?= isset(session('errors')['username']) ? 'is-invalid' : '' ?>" value="<?= old('username', $data['username']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.username') ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control <?= isset(session('errors')['password']) ? 'is-invalid' : '' ?>" placeholder="(Kosongkan jika tidak ingin mengubah)">
                <small class="form-text text-muted">Biarkan kosong jika ingin menggunakan password lama.</small>
                <div class="invalid-feedback">
                    <?= session('errors.password') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="role_id">Role (Peran)</label>
        <select name="role_id" id="role_id" class="form-control <?= isset(session('errors')['role_id']) ? 'is-invalid' : '' ?>">
            <option value="">-- Pilih Role --</option>
            <?php if (isset($roles)) : ?>
                <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role['id_role'] ?>" <?= old('role_id', $data['role_id']) == $role['id_role'] ? 'selected' : '' ?>>
                        <?= $role['role_name'] ?>
                    </option>
                <?php endforeach; ?>
            <?php else : ?>
                <option value="1" <?= old('role_id', $data['role_id']) == 1 ? 'selected' : '' ?>>Dosen</option>
                <option value="2" <?= old('role_id', $data['role_id']) == 2 ? 'selected' : '' ?>>Staff LPPM</option>
                <option value="3" <?= old('role_id', $data['role_id']) == 3 ? 'selected' : '' ?>>Kepala LPPM</option>
                <option value="4" <?= old('role_id', $data['role_id']) == 3 ? 'selected' : '' ?>>Admin</option>
            <?php endif; ?>
        </select>
        <div class="invalid-feedback">
            <?= session('errors.role_id') ?>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Data</button>
        <a href="<?= site_url('user') ?>" class="btn btn-secondary float-right mr-2"><i class="fas fa-arrow-left"></i> Batal</a>
    </div>
</form>
<?= $this->endSection() ?>