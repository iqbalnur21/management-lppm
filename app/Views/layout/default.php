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
    <style>
        .dropdown-list .dropdown-list-content:not(.is-end):after {
            bottom: unset;
        }
    </style>
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
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep" aria-expanded="false"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifikasi
                                <div class="float-right">
                                    <a href="#">Tandai Semua Telah Dibaca</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons" tabindex="3" style="overflow: hidden; outline: none;">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Template update is available now!
                                        <div class="time text-primary">2 Min Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Low disk space. Let's clean it!
                                        <div class="time">17 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Welcome to Stisla template!
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div id="ascrail2002" class="nicescroll-rails nicescroll-rails-vr" style="width: 9px; z-index: 1000; cursor: default; position: absolute; top: 58px; left: 341px; height: 350px; opacity: 0.3; display: block;">
                                <div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 7px; height: 306px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;"></div>
                            </div>
                            <div id="ascrail2002-hr" class="nicescroll-rails nicescroll-rails-hr" style="height: 9px; z-index: 1000; top: 399px; left: 0px; position: absolute; cursor: default; display: none; width: 341px; opacity: 0.3;">
                                <div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 7px; width: 350px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px; left: 0px;"></div>
                            </div>
                        </div>
                    </li>
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