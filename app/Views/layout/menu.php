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

            <!-- SECTION 1: UMUM -->
            <li class="menu-header">Umum</li>
            <li class="<?= $uri->getSegment(1) == 'dashboard' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('dashboard'); ?>">
                    <i class="fas fa-fire"></i> <span>Beranda</span>
                </a>
            </li>

            <!-- SECTION 2: PENELITIAN -->
            <li class="menu-header">Penelitian</li>

            <li class="nav-item dropdown <?= in_array($uri->getSegment(1), ['penelitian', 'hki', 'prototype']) || ($uri->getSegment(1) == 'publikasi' && $uri->getSegment(2) == '') ? 'active' : '' ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-flask"></i><span>Penelitian</span></a>
                <ul class="dropdown-menu">
                    <!-- Sesuai Gambar: Daftar Surat Tugas Penelitian -->
                    <li class="<?= $uri->getSegment(1) == 'penelitian' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('penelitian') ?>">Daftar Surat Tugas Penelitian</a>
                    </li>
                    <!-- Sesuai Gambar: Publikasi Penelitian -->
                    <li class="<?= $uri->getSegment(1) == 'publikasi' && $uri->getSegment(2) == '' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('publikasi') ?>">Publikasi Penelitian</a>
                    </li>
                    <!-- HKI & Prototype tetap di sini sesuai struktur gambar -->
                    <li class="<?= $uri->getSegment(1) == 'hki' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('hki') ?>">HKI</a>
                    </li>
                    <li class="<?= $uri->getSegment(1) == 'prototype' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('prototype') ?>">Prototype</a>
                    </li>
                    <li class="<?= ($uri->getSegment(1) == 'publikasi' && $uri->getSegment(2) == 'dosen') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('publikasi/dosen') ?>">
                            <span>Publikasi Dosen</span>
                        </a>
                    </li>
                    <li class="<?= ($uri->getSegment(1) == 'publikasi' && $uri->getSegment(2) == 'mahasiswa') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('publikasi/mahasiswa') ?>">
                            <span>Publikasi Mahasiswa</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown <?= $uri->getSegment(1) == 'pengabdian' ? 'active' : '' ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hands-helping"></i><span>Pengabdian</span></a>
                <ul class="dropdown-menu">
                    <!-- Sesuai Gambar: Daftar Surat Tugas Pengabdian -->
                    <li class="<?= $uri->getSegment(1) == 'pengabdian' && $uri->getSegment(2) == '' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('pengabdian') ?>">Daftar Surat Tugas Pengabdian</a>
                    </li>
                    <!-- Sesuai Gambar: Publikasi Pengabdian -->
                    <li class="<?= $uri->getSegment(1) == 'pengabdian' && $uri->getSegment(2) == 'publikasi' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= site_url('pengabdian/publikasi') ?>">Publikasi Pengabdian</a>
                    </li>
                </ul>
            </li>
            <?php if (session()->get('role') == 'admin'): ?>
                <li class="nav-item dropdown <?= $uri->getSegment(1) == 'user' ? 'active' : '' ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-friends"></i><span>Manajemen Data</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= $uri->getSegment(1) == 'user' && $uri->getSegment(2) == '' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('user') ?>">Data User</a>
                        </li>
                    </ul>
                </li>
            <?php endif ?>

        </ul>
    </aside>
</div>