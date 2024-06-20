<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardPegawaiController;
use App\Http\Controllers\DataAmbilController;
use App\Http\Controllers\DataAntarController;
use App\Http\Controllers\DataLaporanController;
use App\Http\Controllers\DataLaptopController;
use App\Http\Controllers\DataPembelianController;
use App\Http\Controllers\DataPengajuanController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TransaksiController;
use App\Models\DataLaporan;
use Illuminate\Support\Facades\Route;



// Routes Login & Registration
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/registration', [RegistrationController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/registration', [RegistrationController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Routes Pelanggan
// ----------------- Katalog -----------------------
Route::get('/', [KatalogController::class, 'index'])->middleware('isUser');
// ----------------- Edit Profile ------------------
Route::get('/edit-akun', [KatalogController::class, 'editProfile'])->middleware('isPelanggan');
Route::post('/edit-akun', [KatalogController::class, 'updateProfile'])->middleware('isPelanggan');
// ----------------- Detail Katalog ----------------
Route::get('/detail/{data_laptop:id_laptop}', [KatalogController::class, 'show'])->middleware('isPelanggan');
// ----------------- Pembayaran Laptop -------------
Route::get('/pembayaran/{data_laptop:id_laptop}', [KatalogController::class, 'createPayment'])->middleware('isPelanggan');
Route::post('/pembayaran/{data_laptop:id_laptop}/bayar', [KatalogController::class, 'store'])->middleware('isPelanggan');
// ----------------- Keranjang ---------------------
Route::get('/keranjang', [CartController::class, 'index'])->middleware('isPelanggan');
Route::get('/keranjang/{data_laptop:id_laptop}/add', [CartController::class, 'store'])->middleware('isPelanggan');
Route::delete('/keranjang/{data_laptop:id_laptop}/hapus', [CartController::class, 'destroy'])->middleware('isPelanggan');
// ----------------- Notifikasi --------------------
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->middleware('isPelanggan');
Route::get('/status-pembelian', [NotifikasiController::class, 'statusPembelian'])->middleware('isPelanggan');
Route::get('/status-pengajuan', [NotifikasiController::class, 'statusPengajuan'])->middleware('isPelanggan');
Route::get('/progres-transaksi/{notification:id_trx}', [NotifikasiController::class, 'progresTransaksi'])->middleware('isPelanggan');
// ----------------- Pengajuan ----------------------
Route::get('/jual-laptop', [PengajuanController::class, 'index'])->middleware('isPelanggan');
Route::post('/jual-laptop', [PengajuanController::class, 'store'])->middleware('isPelanggan');

// Route Pegawai

Route::get('/dashboard', [DashboardPegawaiController::class, 'index'])->middleware('isPegawai');

// ----- CRUD Data Laptop -------
Route::get('/data-laptop', [DataLaptopController::class, 'index'])->middleware('isPegawai');
Route::get('/data-laptop/laptop-tambah', [DataLaptopController::class, 'create'])->middleware('isPegawai');
Route::post('/data-laptop/laptop-tambah', [DataLaptopController::class, 'store'])->middleware('isPegawai');
Route::get('/data-laptop/laptop-detail/{data_laptop:id_laptop}', [DataLaptopController::class, 'show'])->middleware('isPegawai');
Route::get('/data-laptop/laptop-edit/{data_laptop:id_laptop}', [DataLaptopController::class, 'edit']);
Route::post('/data-laptop/laptop-edit/{data_laptop:id_laptop}', [DataLaptopController::class, 'update']);
Route::delete('/data-laptop/hapus/{data_laptop:id_laptop}', [DataLaptopController::class, 'destroy']);

// ------ CRUD Riwayat Transaksi -------------
Route::get('/riwayat-transaksi', [TransaksiController::class, 'index']);
Route::delete('/riwayat-transaksi/hapus/{transaksi:id}', [TransaksiController::class, 'destroy']);

// ------- CRUD Data Pembelian ---------------
Route::get('/data-pembelian', [DataPembelianController::class, 'index']);
Route::get('/data-pembelian/pembelian-tambah', [DataPembelianController::class, 'create']);
Route::get('/data-pembelian/get-data-laptop/{data_laptop:id_laptop}', [DataPembelianController::class, 'getDataLaptop']);
Route::post('/data-pembelian/pembelian-tambah', [DataPembelianController::class, 'store']);
Route::get('/data-pembelian/pembelian-detail/{data_pembelian:id_pembelian}', [DataPembelianController::class, 'show']);
Route::get('/data-pembelian/pembelian-edit/{data_pembelian:id_pembelian}', [DataPembelianController::class, 'edit']);
Route::post('/data-pembelian/pembelian-edit/{data_pembelian:id_pembelian}/edit', [DataPembelianController::class, 'update']);
Route::delete('/data-pembelian/{data_pembelian:id_pembelian}/hapus', [DataPembelianController::class, 'destroy']);

// ------- CRUD Data Pengajuan ---------------
Route::get('/data-pengajuan', [DataPengajuanController::class, 'index']);
Route::get('/data-pengajuan/pengajuan-tambah', [DataPengajuanController::class, 'create']);
Route::post('/data-pengajuan/pengajuan-tambah', [DataPengajuanController::class, 'store']);
Route::get('/data-pengajuan/pengajuan-edit/{data_pengajuan:id_pengajuan}', [DataPengajuanController::class, 'edit']);
Route::post('/data-pengajuan/pengajuan-edit/{data_pengajuan:id_pengajuan}/edit', [DataPengajuanController::class, 'update']);
Route::get('/data-pengajuan/pengajuan-detail/{data_pengajuan:id_pengajuan}', [DataPengajuanController::class, 'show']);
Route::delete('/data-pengajuan/{data_pengajuan:id_pengajuan}/hapus', [DataPengajuanController::class, 'destroy']);

// -------- CRUD Data Laporan --------------
Route::get('/data-laporan', [DataLaporanController::class, 'index']);
Route::get('/data-laporan/laporan-tambah', [DataLaporanController::class, 'create']);
Route::post('/data-laporan/laporan-tambah', [DataLaporanController::class, 'store']);
Route::get('/data-laporan/laporan-detail/{data_laporan:id}', [DataLaporanController::class, 'show']);
Route::get('/data-laporan/laporan-detail/{data_laporan:id}/cetak-pdf', [DataLaporanController::class, 'cetakPdf']);

// -------- CRUD Data User -----------------
Route::get('/data-user', [DataUserController::class, 'index']);
Route::get('/data-user/user-tambah', [DataUserController::class, 'create']);
Route::post('/data-user/user-tambah', [DataUserController::class, 'store']);
Route::get('/data-user/user-detail/{user:id_user}', [DataUserController::class, 'show']);
Route::get('/data-user/user-edit/{user:id_user}', [DataUserController::class, 'edit']);
Route::post('/data-user/user-edit/{user:id_user}/edit', [DataUserController::class, 'update']);
Route::delete('/data-user/{user:id_user}/hapus', [DataUserController::class, 'destroy']);

// --------- CRUD Data Ambil ---------------
Route::get('/data-ambil', [DataAmbilController::class, 'index']);
Route::get('/data-ambil/ambil-edit/{data_pengajuan:id_pengajuan}', [DataAmbilController::class, 'edit']);
Route::post('/data-ambil/ambil-edit/{data_pengajuan:id_pengajuan}/edit', [DataAmbilController::class, 'update']);

// --------- CRUD Data Anter ---------------
Route::get('/data-antar', [DataAntarController::class, 'index']);
Route::get('/data-antar/antar-edit/{data_pembelian:id_pembelian}', [DataAntarController::class, 'edit']);
Route::post('/data-antar/antar-edit/{data_pembelian:id_pembelian}/edit', [DataAntarController::class, 'update']);
