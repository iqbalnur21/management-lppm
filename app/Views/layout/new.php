<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<section class="section">
        <div class="section-header">
            <div class="section-header-button">
                <a href="<?= site_url(url(1) . '/' . $variable) ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah <?= $title ?></h1>
        </div>
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