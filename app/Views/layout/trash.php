<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="<?= site_url(url(1) . '/' . $variable) ?>" class="btn btn-secondary mr-4"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $this->renderSection('title') ?></h1>
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
                <div class="card-header-action">
                    <a href="<?= site_url(url(1) . '/' . $variable.'/restore') ?>" class="header-button btn btn-info"><i class="fa fa-download"></i> Restore Semua Data</a>
                    <form action="<?= site_url(url(1) . '/' . $variable.'/delete') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data ?')">
                        <?= csrf_field() ?>
                        <button class="header-button btn btn-danger"><i class="fas fa-trash"></i> Hapus Permanen Semua</button>
                    </form>
                </div>
            </div>
            <div class=" card-cody table-responsive">
                <table class="table table-striped table-md">
                    <tbody>
                        <?= $this->renderSection('table') ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>