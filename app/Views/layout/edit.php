<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<!-- Aplikasi -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="<?= site_url($variable) ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Update <?= $this->renderSection('title') ?></h1>
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
            <!-- <div class="card-header">
                <h4>Data <? //= $this->renderSection('title') 
                            ?></h4>
            </div> -->
            <div class="card-body">
                <?= $this->renderSection('form') ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>