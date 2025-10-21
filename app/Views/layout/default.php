<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="<?= site_url() ?>/template_stisla/assets/img/accounting.png" type="image/png">
    <title>Manajemen LPPM</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/node_modules/@fontawesome/fontawesome-free/css/all.min.css">

    <!-- CSS Libraries -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/node_modules/jqvmap/dist/jqvmap.min.css"> -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/node_modules/weathericons/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/node_modules/weathericons/css/weather-icons-wind.min.css"> -->
    <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/node_modules/summernote/dist/summernote-bs4.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/assets/css/custom.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/assets/css/components.css">

    <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">

    <!-- <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/custom_package/datatables.css"> -->
    <link rel="stylesheet" href="https://themewagon.github.io/stisla-1/assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="https://themewagon.github.io/stisla-1/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://themewagon.github.io/stisla-1/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>/template_stisla/node_modules/izitoast/dist/css/iziToast.min.css">

    <!-- Start GA -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script> -->
    <!-- /END GA -->

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url() ?>/template_stisla/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= session('username') ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= site_url('logout') ?>" class="dropdown-item has-icon text-danger" data-confirm="Keluar ?|Yakin Ingin Keluar ?" data-confirm-yes="Logout()" id="Logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="<?= site_url('dashboard') ?>">Manajemen LPPM</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="<?= site_url('dashboard') ?>">Manajemen LPPM</a>
                    </div>
                    <ul class="sidebar-menu">
                        <?= $this->include('layout/menu') ?>
                    </ul>

                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>/template_stisla/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/template_stisla/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <!-- <script src="<?= base_url() ?>/template_stisla/node_modules/tooltip.js/dist/tooltip.js"></script> -->
    <script src="<?= base_url() ?>/template_stisla/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template_stisla/node_modules/nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/template_stisla/node_modules/moment/moment.js"></script>
    <script src="<?= base_url() ?>/template_stisla/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <!-- <script src="<?= base_url() ?>/template_stisla/node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
    <script src="<?= base_url() ?>/template_stisla/node_modules/chart.js/dist/chart.min.js"></script>
    <script src="<?= base_url() ?>/template_stisla/node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="<?= base_url() ?>/template_stisla/node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script> -->
    <script src="<?= base_url() ?>/template_stisla/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="<?= base_url() ?>/template_stisla/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script src="<?= base_url() ?>/template_stisla/node_modules/jquery-ui-dist/jquery-ui.min.js"></script>

    <!-- Page Specific JS File -->
    <!-- <script src="<?= base_url() ?>/template_stisla/assets/js/page/index-0.js"></script> -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/template_stisla/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/template_stisla/assets/js/custom.js"></script>
    <script src="<?= base_url() ?>/template_stisla/assets/js/gemini-ai.js"></script>

    <script src="<?= base_url() ?>/template_stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url() ?>/template_stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

    <script src="https://themewagon.github.io/stisla-1/assets/modules/datatables/datatables.min.js"></script>
    <script src="https://themewagon.github.io/stisla-1/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://themewagon.github.io/stisla-1/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <!-- <script src="<?= base_url() ?>/template_stisla/custom_package/datatables.js"></script> -->

    <script src="<?= base_url("/template_stisla/node_modules/cleave.js/dist/cleave.min.js") ?>"></script>
    <script src="<?= base_url("/template_stisla/node_modules/cleave.js/dist/addons/cleave-phone.us.js") ?>"></script>
    <script src="<?= base_url("/template_stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js") ?>"></script>
    <script src="<?= base_url() ?>/template_stisla/node_modules/izitoast/dist/js/iziToast.min.js"></script>

    <script src="<?= base_url() ?>/template_stisla/assets/js/page/forms-advanced-forms.js"></script>

    <!-- ============================================================= -->
    <!--  JAVASCRIPT UNTUK BALANCE-CHART & SALES-CHART -->
    <!-- ============================================================= -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php if (!empty($toasts)): ?>
        <script>
            <?php foreach ($toasts as $toast): ?>
                iziToast.<?= $toast['type'] ?>({
                    title: "<?= $toast['title'] ?>",
                    message: "<?= $toast['message'] ?>",
                    position: "topRight",
                    timeout: 0,
                    close: true
                });
            <?php endforeach; ?>
        </script>
    <?php endif; ?>

</body>

</html>