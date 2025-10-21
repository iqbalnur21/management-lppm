<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('Auth/loginProcess', 'Auth::loginProcess');

$routes->group('', ['filter' => 'isLoggedIn'], static function ($routes) {

    // --- Rute Utama Setelah Login ---
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('logout', 'Auth::logout');

    // --- Rute untuk Peran: DOSEN ---
    // Menggunakan 'resource' untuk membuat rute CRUD lengkap secara otomatis
    // untuk setiap modul kegiatan dosen.
    $routes->resource('pengabdian', ['controller' => 'Pengabdian']);
    $routes->resource('penelitian', ['controller' => 'Penelitian']);
    $routes->resource('publikasi', ['controller' => 'Publikasi']);
    $routes->resource('hki', ['controller' => 'Hki']);
    $routes->resource('prototype', ['controller' => 'Prototype']);

    // --- Rute untuk Peran: STAF LPPM ---
    // Rute untuk halaman verifikasi dan laporan
    $routes->get('verifikasi', 'Verifikasi::index');
    $routes->post('verifikasi/update/(:num)', 'Verifikasi::update/$1'); // Contoh rute untuk proses verifikasi
    $routes->get('laporan', 'Laporan::index');
    $routes->get('laporan/generate', 'Laporan::generate'); // Contoh rute untuk membuat laporan

    // --- Rute untuk Peran: KEPALA LPPM ---
    // Kepala LPPM bisa menggunakan rute Laporan yang sama dengan Staf,
    // namun controllernya bisa menampilkan data yang berbeda.
    // $routes->get('laporan', 'Laporan::rekapitulasi');

    $routes->post('hki/updateStatus/(:num)', 'Hki::updateStatus/$1');
    $routes->post('penelitian/updateStatus/(:num)', 'Penelitian::updateStatus/$1');
});
