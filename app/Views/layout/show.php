<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<!-- Aplikasi -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="<?= site_url(url(1) . '/' . $variable) ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Detail <?= $this->renderSection('title') ?></h1>
        <?php
        if (url(1) == 'Financial') {
            $url_variable = site_url(url(1) . "/financial_payment/new/" . $variable . '/' . $data[$variable . '_id']);
        } elseif (url(1) . '/' . url(2) == 'Lot/lot') {
            $url_variable = site_url(url(1) . "/payment/new/" . $data[$variable . '_id']);
        }
        if (url(1) == 'Financial' || url(1) . '/' . url(2) == 'Lot/lot') { ?>
            <a href="<?= $url_variable . '/false' ?>" class="btn btn-primary ml-3">Tambah</a>
            <?php if (url(1) == 'Financial') { ?>
                <!-- true is for with ai -->
                <a href="<?= $url_variable . '/true' ?>" class="btn btn-info ml-3">Tambah Menggunakan AI</a>
        <?php
            }
        } ?>
    </div>
    <?php if (session()->getFlashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismissible="alert">x</button>
                <b>Success !</b>
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    <?php } else if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismissible="alert">x</button>
                <b>Error !</b>
                <?= session()->getFlashdata('error') ?>
            </div>
        </div>
    <?php } ?>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Data <?= $this->renderSection('title') ?></h4>
                <?php if (session()->get('role') == 1 && url(1) == 'Financial') { ?>
                    <form class="card-header-action row align-items-center mr-2" method="post" autocomplete="off" action="<?= site_url('Financial/financial_payment/reassign') ?>">
                        <?= csrf_field() ?>
                        <div class="mr-2">
                            <input type="hidden" name="financial_id" value="<?= $data[$variable . '_id'] ?>">
                            <input type="hidden" name="type" value="<?= $variable ?>">
                            <select name="user_id" class="form-control <?= isset(session('errors')['user_id']) ? 'is-invalid' : null ?>" value="<?= old('user_id') ?>" autofocus>
                                <?php foreach ($user_data as $value) : ?>
                                    <option value="<?= $value['user_id'] ?>"><?= $value['username'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-sm">Pindah</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
            <div class="card-body">
                <?= $this->renderSection('form') ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>