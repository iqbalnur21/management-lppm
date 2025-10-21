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
            <?php if (session('role_id') == 1 || session('role_id') == 2) : ?>
                <li class="menu-header">Menu</li>
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
        </ul>
    </aside>
</div>