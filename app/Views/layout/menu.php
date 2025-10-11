<?php $uri = service('uri'); ?>
<!-- Sidebar -->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= site_url('dashboard') ?>">LPPM Sistem</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= site_url('dashboard') ?>">LPPM</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Umum</li>
            <li class="<?= $uri->getSegment(1) == 'dashboard' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('dashboard'); ?>"><i class="fas fa-fire"></i> <span>Beranda</span></a>
            </li>

            <!-- ================== MENU DOSEN ================== -->
            <?php if (session('role_id') == 1) : // Asumsi role Dosen adalah 1 
            ?>
                <li class="menu-header">Kegiatan Dosen</li>
                <li class="nav-item dropdown <?= in_array($uri->getSegment(1), ['penelitian', 'publikasi', 'hki', 'prototype']) ? 'active' : '' ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-flask"></i><span>Penelitian</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= $uri->getSegment(1) == 'penelitian' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('penelitian') ?>">Daftar Penelitian</a></li>
                        <li class="<?= $uri->getSegment(1) == 'publikasi' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('publikasi') ?>">Publikasi</a></li>
                        <li class="<?= $uri->getSegment(1) == 'hki' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('hki') ?>">HKI</a></li>
                        <li class="<?= $uri->getSegment(1) == 'prototype' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('prototype') ?>">Prototype</a></li>
                    </ul>
                </li>
                <li class="<?= $uri->getSegment(1) == 'pengabdian' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('pengabdian') ?>"><i class="fas fa-hands-helping"></i> <span>Pengabdian</span></a>
                </li>
            <?php endif; ?>

            <!-- ================== MENU STAF LPPM ================== -->
            <?php if (session('role_id') == 2) : // Asumsi role Staf LPPM adalah 2 
            ?>
                <li class="menu-header">Manajemen LPPM</li>
                <li class="<?= $uri->getSegment(1) == 'verifikasi' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('verifikasi') ?>"><i class="fas fa-check-double"></i> <span>Verifikasi Data</span></a>
                </li>
                <li class="<?= $uri->getSegment(1) == 'laporan' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('laporan') ?>"><i class="fas fa-chart-bar"></i> <span>Laporan Kegiatan</span></a>
                </li>
            <?php endif; ?>

            <!-- ================== MENU KEPALA LPPM ================== -->
            <?php if (session('role_id') == 3) : // Asumsi role Kepala LPPM adalah 3 
            ?>
                <li class="menu-header">Laporan</li>
                <li class="<?= $uri->getSegment(1) == 'laporan' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('laporan') ?>"><i class="fas fa-chart-pie"></i> <span>Rekap Laporan</span></a>
                </li>
            <?php endif; ?>
        </ul>
    </aside>
</div>