<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/search', 'Home::search');

$routes->group('auth', function ($routes) {
    $routes->get('login', 'Auth\LoginController::index');
    $routes->post('login/getLogin', 'Auth\LoginController::getLogin');
    $routes->get('logout', 'Auth\LoginController::logout');
});


// routes admin
$routes->group('admin', function ($routes) {

    $routes->get('dashboard', 'Admin\Dashboard::index');
    // ukpd
    $routes->get('ukpd', 'Admin\Ukpd::index');
    $routes->post('ukpd/insert', 'Admin\Ukpd::insert');
    $routes->get('ukpd/edit', 'Admin\Ukpd::edit');
    $routes->post('ukpd/hapus', 'Admin\Ukpd::hapus');
    $routes->post('ukpd/update', 'Admin\Ukpd::update');

    // jenis penindakan
    $routes->get('jenis_penindakan', 'Admin\JenisPenindakan::index');
    $routes->post('jenis_penindakan/insert', 'Admin\JenisPenindakan::insert');
    $routes->get('jenis_penindakan/edit', 'Admin\JenisPenindakan::edit');
    $routes->post('jenis_penindakan/hapus', 'Admin\JenisPenindakan::hapus');
    $routes->post('jenis_penindakan/update', 'Admin\JenisPenindakan::update');

    // jenis kendaraan
    $routes->get('jenis_kendaraan', 'Admin\JenisKendaraan::index');
    $routes->post('jenis_kendaraan/insert', 'Admin\JenisKendaraan::insert');
    $routes->get('jenis_kendaraan/edit', 'Admin\JenisKendaraan::edit');
    $routes->post('jenis_kendaraan/hapus', 'Admin\JenisKendaraan::hapus');
    $routes->post('jenis_kendaraan/update', 'Admin\JenisKendaraan::update');

    // klasifikasi kendaraan
    $routes->get('klasifikasi', 'Admin\KlasifikasiKendaraan::index');
    $routes->post('klasifikasi/insert', 'Admin\KlasifikasiKendaraan::insert');
    $routes->get('klasifikasi/edit', 'Admin\KlasifikasiKendaraan::edit');
    $routes->post('klasifikasi/hapus', 'Admin\KlasifikasiKendaraan::hapus');
    $routes->post('klasifikasi/update', 'Admin\KlasifikasiKendaraan::update');

    // Type kendaraan
    $routes->get('type_kendaraan', 'Admin\TypeKendaraan::index');
    $routes->post('type_kendaraan/insert', 'Admin\TypeKendaraan::insert');
    $routes->get('type_kendaraan/edit', 'Admin\TypeKendaraan::edit');
    $routes->post('type_kendaraan/hapus', 'Admin\TypeKendaraan::hapus');
    $routes->post('type_kendaraan/update', 'Admin\TypeKendaraan::update');

    // Terminal
    $routes->get('tempat_penyimpanan', 'Admin\TempatPenyimpanan::index');
    $routes->post('tempat_penyimpanan/insert', 'Admin\TempatPenyimpanan::insert');
    $routes->get('tempat_penyimpanan/edit', 'Admin\TempatPenyimpanan::edit');
    $routes->post('tempat_penyimpanan/hapus', 'Admin\TempatPenyimpanan::hapus');
    $routes->post('tempat_penyimpanan/update', 'Admin\TempatPenyimpanan::update');

    // Pelanggaran
    $routes->get('jenis_pelanggaran', 'Admin\JenisPelanggaran::index');
    $routes->post('jenis_pelanggaran/insert', 'Admin\JenisPelanggaran::insert');
    $routes->get('jenis_pelanggaran/edit', 'Admin\JenisPelanggaran::edit');
    $routes->post('jenis_pelanggaran/hapus', 'Admin\JenisPelanggaran::hapus');
    $routes->post('jenis_pelanggaran/update', 'Admin\JenisPelanggaran::update');

    // ppns
    $routes->get('ppns', 'Admin\PPNS::index');
    $routes->post('ppns/insert', 'Admin\PPNS::insert');
    $routes->get('ppns/edit', 'Admin\PPNS::edit');
    $routes->post('ppns/hapus', 'Admin\PPNS::hapus');
    $routes->post('ppns/update', 'Admin\PPNS::update');

    // tanda_tangan
    $routes->get('tanda_tangan_ppns', 'Admin\TandaTanganPPNS::index');
    $routes->post('tanda_tangan/insert', 'Admin\TandaTanganPPNS::insert');
    $routes->get('tanda_tangan/edit', 'Admin\TandaTanganPPNS::edit');
    $routes->post('tanda_tangan/hapus', 'Admin\TandaTanganPPNS::hapus');
    $routes->post('ppns/update', 'Admin\PPNS::update');

    // Unit Penindak
    $routes->get('unit_penindak', 'Admin\UnitPenindak::index');
    $routes->post('unit_penindak/insert', 'Admin\UnitPenindak::insert');
    $routes->get('unit_penindak/edit', 'Admin\UnitPenindak::edit');
    $routes->post('unit_penindak/hapus', 'Admin\UnitPenindak::hapus');
    $routes->post('unit_penindak/update', 'Admin\UnitPenindak::update');

    // petugas
    $routes->get('petugas', 'Admin\Petugas::index');
    $routes->post('petugas/insert', 'Admin\Petugas::insert');
    $routes->get('petugas/edit', 'Admin\Petugas::edit');
    $routes->post('petugas/hapus', 'Admin\Petugas::hapus');
    $routes->post('petugas/update', 'Admin\Petugas::update');

    // petugas_tanda_tangan
    $routes->get('tanda_tangan_petugas', 'Admin\TandaTanganPetugas::index');
    $routes->post('tanda_tangan_petugas/insert', 'Admin\TandaTanganPetugas::insert');
    $routes->get('tanda_tangan_petugas/edit', 'Admin\TandaTanganPetugas::edit');
    $routes->post('tanda_tangan_petugas/hapus', 'Admin\TandaTanganPetugas::hapus');

    // saksi_penderekan
    $routes->get('saksi_penderekan', 'Admin\SaksiPenderekan::index');
    $routes->post('saksi_penderekan/insert', 'Admin\SaksiPenderekan::insert');
    $routes->get('saksi_penderekan/edit', 'Admin\SaksiPenderekan::edit');
    $routes->post('saksi_penderekan/hapus', 'Admin\SaksiPenderekan::hapus');
    $routes->post('saksi_penderekan/update', 'Admin\SaksiPenderekan::update');

    // tanda_tangan_saksi
    $routes->get('tanda_tangan_saksi', 'Admin\TandaTanganSaksi::index');
    $routes->post('tanda_tangan_saksi/insert', 'Admin\TandaTanganSaksi::insert');
    $routes->get('tanda_tangan_saksi/edit', 'Admin\TandaTanganSaksi::edit');
    $routes->post('tanda_tangan_saksi/hapus', 'Admin\TandaTanganSaksi::hapus');

    // Status BAP
    $routes->get('status_bap', 'Admin\StatusBap::index');
    $routes->post('status_bap/insert', 'Admin\StatusBap::insert');
    $routes->get('status_bap/edit', 'Admin\StatusBap::edit');
    $routes->post('status_bap/hapus', 'Admin\StatusBap::hapus');
    $routes->post('status_bap/update', 'Admin\StatusBap::update');

    // BAP
    $routes->get('bap', 'Admin\Bap::index');
    $routes->get('bap/getUnit', 'Admin\Bap::getUnit');
    $routes->post('bap/insert', 'Admin\Bap::insert');
    $routes->get('bap/edit', 'Admin\Bap::edit');
    $routes->post('bap/hapus', 'Admin\Bap::hapus');
    $routes->post('bap/update', 'Admin\Bap::update');

    // Role Management
    $routes->get('role_management', 'Admin\RoleManagement::index');
    $routes->post('role_management/insert', 'Admin\RoleManagement::insert');
    $routes->get('role_management/edit', 'Admin\RoleManagement::edit');
    $routes->post('role_management/hapus', 'Admin\RoleManagement::hapus');
    $routes->post('role_management/update', 'Admin\RoleManagement::update');

    // User Management
    $routes->get('user_management', 'Admin\UserManagement::index');
    $routes->post('user_management/insert', 'Admin\UserManagement::insert');
    $routes->get('user_management/edit', 'Admin\UserManagement::edit');
    $routes->post('user_management/hapus', 'Admin\UserManagement::hapus');
    $routes->post('user_management/update', 'Admin\UserManagement::update');

    // Jabatan
    $routes->get('jabatan', 'Admin\Jabatan::index');
    $routes->post('jabatan/insert', 'Admin\Jabatan::insert');
    $routes->get('jabatan/edit', 'Admin\Jabatan::edit');
    $routes->post('jabatan/hapus', 'Admin\Jabatan::hapus');
    $routes->post('jabatan/update', 'Admin\Jabatan::update');

    // Nomor Surat Tugas
    $routes->get('nomor_spt', 'Admin\NomorSuratTugas::index');
    $routes->post('nomor_spt/insert', 'Admin\NomorSuratTugas::insert');
    $routes->get('nomor_spt/edit', 'Admin\NomorSuratTugas::edit');
    $routes->post('nomor_spt/hapus', 'Admin\NomorSuratTugas::hapus');
    $routes->post('nomor_spt/update', 'Admin\NomorSuratTugas::update');

    // Penderekan
    $routes->get('penderekan', 'Admin\Penderekan::index');
    $routes->get('penderekan/view/(:any)', 'Petugas\DataPenderekan::view_kendaraan/$1');
    $routes->get('penderekan/form_penderekan', 'Admin\Penderekan::form_penderekan');
    $routes->get('penderekan/getNoBap', 'Admin\Penderekan::getNoBap');
    $routes->post('penderekan/insert', 'Admin\Penderekan::insert');
    $routes->get('penderekan/edit_data/(:num)', 'Admin\Penderekan::edit_data/$1');
    $routes->get('penderekan/getKlasifikasi', 'Admin\Penderekan::getKlasifikasi');
    $routes->get('penderekan/getTypeKendaraan', 'Admin\Penderekan::getTypeKendaraan');
    $routes->get('penderekan/getKota', 'Admin\Penderekan::getKota');
    $routes->get('penderekan/getKecamatan', 'Admin\Penderekan::getKecamatan');
    $routes->get('penderekan/getKelurahan', 'Admin\Penderekan::getKelurahan');
    $routes->get('penderekan/edit', 'Admin\Penderekan::edit');
    $routes->post('penderekan/hapus', 'Admin\Penderekan::hapus');
    $routes->post('penderekan/update', 'Admin\Penderekan::update');
});

$routes->group('petugas', function ($routes) {
    $routes->get('dashboard', 'Petugas\Dashboard::index');
    // BAP
    $routes->get('bap', 'Petugas\Bap::index');
    //Penderekan
    $routes->get('penderekan/noBap/(:num)', 'Petugas\Penderekan::index/$1');
    $routes->get('penderekan/noBap/getKlasifikasi', 'Petugas\Penderekan::getKlasifikasi');
    $routes->get('penderekan/noBap/getTypeKendaraan', 'Petugas\Penderekan::getTypeKendaraan');
    $routes->get('penderekan/noBap/getKota', 'Petugas\Penderekan::getKota');
    $routes->get('penderekan/noBap/getKecamatan', 'Petugas\Penderekan::getKecamatan');
    $routes->get('penderekan/noBap/getKelurahan', 'Petugas\Penderekan::getKelurahan');
    $routes->post('penderekan/insert', 'Petugas\Penderekan::insert');
    $routes->post('penderekan/update', 'Petugas\Penderekan::update');

    $routes->get('data_penderekan', 'Petugas\DataPenderekan::index');
    $routes->get('data_penderekan/view/(:any)', 'Petugas\DataPenderekan::view_kendaraan/$1');
    $routes->get('data_penderekan/edit', 'Petugas\DataPenderekan::edit');
    $routes->get('data_penderekan/edit_data/(:any)', 'Petugas\DataPenderekan::edit_data/$1');
    $routes->post('data_penderekan/hapus', 'Petugas\DataPenderekan::hapus');

    $routes->get('profile', 'Petugas\Profile::index');
});

$routes->group('pdf', function ($routes) {
    $routes->get('bap_digital/(:num)', 'Pdf\PdfController::index/$1');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
