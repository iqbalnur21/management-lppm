<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<section class="section">
    <?php if (session('role_id') == 1) : ?>
        <div class="section-header">
            <h1><?= $this->renderSection('title') ?></h1>
            <div class="section-header-button">
                
            <?php if ($variable == 'publikasi'): ?>
                <a href="<?= site_url($variable . '/custom_new/'. url(3)) ?>" class="btn btn-primary">Tambah</a>
            <?php else: ?>
                <a href="<?= site_url($variable . '/new') ?>" class="btn btn-primary">Tambah</a>
            <?php endif ?>
            </div>
        </div>
    <?php endif; ?>
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
                <h4>Data <?= $title ?></h4>
            </div>
            <div class=" card-body table-responsive">
                <table class="table table-striped table-md" id="datatables">
                    <?= $this->renderSection('table') ?>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>