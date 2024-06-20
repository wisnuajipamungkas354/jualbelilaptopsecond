<?php

namespace Database\Seeders;

use App\Models\DataLaptop;
use App\Models\DataPembelian;
use App\Models\DataPengajuan;
use App\Models\LaptopImages;
use App\Models\PengajuanImages;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'id_user' => 'USPLG00001',
            'role' => 'Pelanggan',
            'nm_user' => 'Khoerul Fadil',
            'email' => 'fadil@gmail.com',
            'password' => bcrypt('fadil123'),
            'alamat' => 'Dusun Krajan 2, Pamanukan, Kab Subang',
            'no_hp' => '085812345678'
        ]);

        User::create([
            'id_user' => 'USPLG00002',
            'role' => 'Pelanggan',
            'nm_user' => 'Jodi Ramadhan',
            'email' => 'jodi@gmail.com',
            'password' => bcrypt('jodi123'),
            'alamat' => 'Dusun Kudus, Cikarang Selatan, Kab Cikarang',
            'no_hp' => '085812345679'
        ]);

        User::create([
            'id_user' => 'USADM00001',
            'role' => 'Admin',
            'nm_user' => 'Hilmi',
            'email' => 'hilmi@gmail.com',
            'password' => bcrypt('hilmi123'),
            'alamat' => 'Bekasi Barat',
            'no_hp' => '085812345610'
        ]);

        User::create([
            'id_user' => 'USOWN00001',
            'role' => 'Owner',
            'nm_user' => 'Wisnu Aji',
            'email' => 'wisnu@gmail.com',
            'password' => bcrypt('wisnu123'),
            'alamat' => 'Dusun Cirejag 1 RT/RW 002/003 Kel. Cibalongsari Kec. Klari Kab. Karawang 41371',
            'no_hp' => '085889634432'
        ]);

        User::create([
            'id_user' => 'USDRV00001',
            'role' => 'Driver',
            'nm_user' => 'Ahmad Budi',
            'email' => 'ahmad@gmail.com',
            'password' => bcrypt('ahmad123'),
            'alamat' => 'Dusun Cirejag 1 RT/RW 002/003 Kel. Cibalongsari Kec. Klari Kab. Karawang 41371',
            'no_hp' => '085812345611'
        ]);

        DataLaptop::create([
            'id_laptop' => 'LALE0001',
            'platform' => 'Laptop',
            'merk' => 'Lenovo',
            'tipe' => 'S145',
            'processor' => 'Intel Core i5-1002U @2.5Ghz',
            'memory' => '8GB',
            'storage' => '512GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'Lecet Pemakaian',
            'harga' => '4000000',
            'grade' => 'A',
            'stok' => '3',
        ]);

        DataLaptop::create([
            'id_laptop' => 'LALE0002',
            'platform' => 'Laptop',
            'merk' => 'Lenovo',
            'tipe' => 'IdeaPad Slim 3',
            'processor' => 'Intel Core i3 Gen 12',
            'memory' => '8GB',
            'storage' => '512GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger + Dus',
            'minus' => 'No Minus',
            'harga' => '5000000',
            'grade' => 'A',
            'stok' => '6',
        ]);

        DataLaptop::create([
            'id_laptop' => 'LADE0001',
            'platform' => 'Laptop',
            'merk' => 'Dell',
            'tipe' => 'Inspiron 7447',
            'processor' => 'Intel Core i7 Gen 4',
            'memory' => '8GB',
            'storage' => '128GB SSD + HDD 1TB',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'Lecet Pemakaian',
            'harga' => '3500000',
            'grade' => 'A',
            'stok' => '10',
        ]);

        DataLaptop::create([
            'id_laptop' => 'LATO0001',
            'platform' => 'Laptop',
            'merk' => 'Toshiba',
            'tipe' => 'Dynabook L410',
            'processor' => 'Intel Core i5 Gen 6',
            'memory' => '8GB',
            'storage' => '256GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'Lecet Pemakaian',
            'harga' => '2500000',
            'grade' => 'A',
            'stok' => '4',
        ]);

        DataLaptop::create([
            'id_laptop' => 'LAAS0001',
            'platform' => 'Laptop',
            'merk' => 'Asus',
            'tipe' => 'Vivobook A416K',
            'processor' => 'Intel Core i3 Gen 11',
            'memory' => '8GB',
            'storage' => '256GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger + Dus',
            'minus' => 'No Minus',
            'harga' => '3000000',
            'grade' => 'A',
            'stok' => '12',
        ]);

        DataLaptop::create([
            'id_laptop' => 'CHDE0001',
            'platform' => 'Chromebook',
            'merk' => 'Dell',
            'tipe' => 'Chromebook 11',
            'processor' => 'Intel N2840',
            'memory' => '4GB',
            'storage' => '64GB  + 128GB SSD',
            'uk_layar' => '11.6',
            'is_touchscreen' => 'Ya',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'No Minus',
            'harga' => '1000000',
            'grade' => 'A',
            'stok' => '2',
        ]);

        DataLaptop::create([
            'id_laptop' => 'LALE0003',
            'platform' => 'Laptop',
            'merk' => 'Lenovo',
            'tipe' => 'E40-80',
            'processor' => 'Intel Core i5 Gen 5',
            'memory' => '4GB',
            'storage' => '128GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Ya',
            'info_tambahan' => 'Grafis AMD Radeon 2GB',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'Lecet Pemakaian',
            'harga' => '1000000',
            'grade' => 'A',
            'stok' => '5',
        ]);

        DataLaptop::create([
            'id_laptop' => 'LADE0002',
            'platform' => 'Laptop',
            'merk' => 'Dell',
            'tipe' => 'Vostro 3405',
            'processor' => 'AMD Ryzen 3 3250',
            'memory' => '8GB',
            'storage' => '128GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger + Dus',
            'minus' => 'No Minus',
            'harga' => '3500000',
            'grade' => 'A',
            'stok' => '2',
        ]);

        DataLaptop::create([
            'id_laptop' => 'LAAS0002',
            'platform' => 'Laptop',
            'merk' => 'Asus',
            'tipe' => 'Vivobook X441BA',
            'processor' => 'AMD A4 9125',
            'memory' => '4GB',
            'storage' => '128GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'Lecet Pemakaian',
            'harga' => '1800000',
            'grade' => 'A',
            'stok' => '3',
        ]);

        DataLaptop::create([
            'id_laptop' => 'LALE0004',
            'platform' => 'Laptop',
            'merk' => 'Lenovo',
            'tipe' => 'IdeaPad 1 11-ADA',
            'processor' => 'AMD Athlon Silver 3050e',
            'memory' => '4GB',
            'storage' => '256GB SSD',
            'uk_layar' => '11.6',
            'is_touchscreen' => 'Ya',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'Lecet Pemakaian',
            'harga' => '2000000',
            'grade' => 'A',
            'stok' => '2',
        ]);

        LaptopImages::create([
            'id_laptop' => 'LALE0001',
            'path' => 'laptop-images/Laptop1.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'LALE0001',
            'path' => 'laptop-images/Laptop1-2.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'LALE0002',
            'path' => 'laptop-images/Laptop2.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'LALE0002',
            'path' => 'laptop-images/Laptop2-1.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'LADE0001',
            'path' => 'laptop-images/Laptop3.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'LADE0001',
            'path' => 'laptop-images/Laptop3-1.jpg'
        ]);
        LaptopImages::create([
            'id_laptop' => 'LATO0001',
            'path' => 'laptop-images/Laptop4.jpg'
        ]);
        LaptopImages::create([
            'id_laptop' => 'LATO0001',
            'path' => 'laptop-images/Laptop4-1.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'LAAS0001',
            'path' => 'laptop-images/Laptop5.jpg'
        ]);
        LaptopImages::create([
            'id_laptop' => 'LAAS0001',
            'path' => 'laptop-images/Laptop5-1.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'CHDE0001',
            'path' => 'laptop-images/Laptop6.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'CHDE0001',
            'path' => 'laptop-images/Laptop6-1.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'LALE0003',
            'path' => 'laptop-images/Laptop7.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'LADE0002',
            'path' => 'laptop-images/Laptop8.jpg'
        ]);
        LaptopImages::create([
            'id_laptop' => 'LADE0002',
            'path' => 'laptop-images/Laptop8-1.jpg'
        ]);
        LaptopImages::create([
            'id_laptop' => 'LAAS0002',
            'path' => 'laptop-images/Laptop9.jpg'
        ]);
        LaptopImages::create([
            'id_laptop' => 'LAAS0002',
            'path' => 'laptop-images/Laptop9-1.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'LALE0004',
            'path' => 'laptop-images/Laptop10.jpg'
        ]);

        LaptopImages::create([
            'id_laptop' => 'LALE0004',
            'path' => 'laptop-images/Laptop10-1.jpg'
        ]);

        DataPembelian::create([
            'id_pembelian' => 'PBL240101001',
            'nm_pembeli' => 'Otong Surotong',
            'no_hp' => '085712345678',
            'alamat' => 'Bekasi Timur',
            'mtd_pembayaran' => 'QRIS',
            'id_laptop' => 'LALE0001',
            'jml_barang' => '1',
            'total_pembayaran' => '2500000',
            'status_pembelian' => 'Diterima Pembeli'
        ]);

        DataPembelian::create([
            'id_pembelian' => 'PBL240104001',
            'nm_pembeli' => 'Sutong Surotong',
            'no_hp' => '085712345678',
            'alamat' => 'Bekasi Timur',
            'mtd_pembayaran' => 'QRIS',
            'id_laptop' => 'LALE0001',
            'jml_barang' => '1',
            'total_pembayaran' => '5500000',
            'status_pembelian' => 'Diterima Pembeli'
        ]);

        DataPembelian::create([
            'id_pembelian' => 'PBL240107001',
            'nm_pembeli' => 'Sutong Surotong',
            'no_hp' => '085712345678',
            'alamat' => 'Bekasi Timur',
            'mtd_pembayaran' => 'QRIS',
            'id_laptop' => 'LALE0002',
            'jml_barang' => '1',
            'total_pembayaran' => '3500000',
            'status_pembelian' => 'Diterima Pembeli'
        ]);

        DataPembelian::create([
            'id_pembelian' => 'PBL240110001',
            'nm_pembeli' => 'Sutong',
            'no_hp' => '085712345678',
            'alamat' => 'Bekasi Barat',
            'mtd_pembayaran' => 'QRIS',
            'id_laptop' => 'LADE0001',
            'jml_barang' => '1',
            'total_pembayaran' => '3000000',
            'status_pembelian' => 'Diterima Pembeli'
        ]);

        DataPembelian::create([
            'id_pembelian' => 'PBL240113001',
            'nm_pembeli' => 'Sutong',
            'no_hp' => '085712345678',
            'alamat' => 'Bekasi Barat',
            'mtd_pembayaran' => 'QRIS',
            'id_laptop' => 'LADE0001',
            'jml_barang' => '1',
            'total_pembayaran' => '1800000',
            'status_pembelian' => 'Diterima Pembeli'
        ]);

        DataPembelian::create([
            'id_pembelian' => 'PBL240120001',
            'nm_pembeli' => 'Sutong',
            'no_hp' => '085712345678',
            'alamat' => 'Karawang Barat',
            'mtd_pembayaran' => 'QRIS',
            'id_laptop' => 'LAAS0001',
            'jml_barang' => '1',
            'total_pembayaran' => '2800000',
            'status_pembelian' => 'Diterima Pembeli'
        ]);

        DataPengajuan::create([
            'id_pengajuan' => 'PJL240121001',
            'nm_penjual' => 'Otong Surotong',
            'no_hp' => '085712345678',
            'alamat' => 'Bekasi Timur',
            'platform' => 'Laptop',
            'merk' => 'Lenovo',
            'tipe' => 'S145',
            'processor' => 'Intel Core i5-1002U @2.5Ghz',
            'memory' => '8GB',
            'storage' => '512GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'Lecet Pemakaian',
            'harga' => '1800000',
            'grade' => 'A',
            'jml_barang' => '1',
            'status_pengajuan' => 'Pengajuan Selesai'
        ]);

        DataPengajuan::create([
            'id_pengajuan' => 'PJL240125001',
            'nm_penjual' => 'Otong Surotong',
            'no_hp' => '085712345678',
            'alamat' => 'Bekasi Timur',
            'platform' => 'Laptop',
            'merk' => 'Lenovo',
            'tipe' => 'S145',
            'processor' => 'Intel Core i5-1002U @2.5Ghz',
            'memory' => '8GB',
            'storage' => '512GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'Lecet Pemakaian',
            'harga' => '1500000',
            'grade' => 'A',
            'jml_barang' => '1',
            'status_pengajuan' => 'Pengajuan Selesai'
        ]);

        DataPengajuan::create([
            'id_pengajuan' => 'PJL240125002',
            'nm_penjual' => 'Otong Surotong',
            'no_hp' => '085712345678',
            'alamat' => 'Bekasi Timur',
            'platform' => 'Laptop',
            'merk' => 'Lenovo',
            'tipe' => 'S145',
            'processor' => 'Intel Core i5-1002U @2.5Ghz',
            'memory' => '8GB',
            'storage' => '512GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'Lecet Pemakaian',
            'harga' => '1600000',
            'grade' => 'A',
            'jml_barang' => '1',
            'status_pengajuan' => 'Pengajuan Selesai'
        ]);

        DataPengajuan::create([
            'id_pengajuan' => 'PJL240126001',
            'nm_penjual' => 'Otong Surotong',
            'no_hp' => '085712345678',
            'alamat' => 'Bekasi Timur',
            'platform' => 'Laptop',
            'merk' => 'Lenovo',
            'tipe' => 'S145',
            'processor' => 'Intel Core i5-1002U @2.5Ghz',
            'memory' => '8GB',
            'storage' => '512GB SSD',
            'uk_layar' => '14',
            'is_touchscreen' => 'Tidak',
            'info_tambahan' => 'Semua Fungsi Normal',
            'kelengkapan' => 'Unit + Charger',
            'minus' => 'Lecet Pemakaian',
            'harga' => '2000000',
            'grade' => 'A',
            'jml_barang' => '1',
            'status_pengajuan' => 'Pengajuan Selesai'
        ]);

        PengajuanImages::create([
            'id_pengajuan' => 'PJL240121001',
            'path' => 'laptop-images/Laptop10.jpg'
        ]);

        PengajuanImages::create([
            'id_pengajuan' => 'PJL240121001',
            'path' => 'laptop-images/Laptop10-1.jpg'
        ]);

        PengajuanImages::create([
            'id_pengajuan' => 'PJL240125001',
            'path' => 'laptop-images/Laptop10.jpg'
        ]);

        PengajuanImages::create([
            'id_pengajuan' => 'PJL240125001',
            'path' => 'laptop-images/Laptop10-1.jpg'
        ]);

        PengajuanImages::create([
            'id_pengajuan' => 'PJL240125002',
            'path' => 'laptop-images/Laptop10.jpg'
        ]);

        PengajuanImages::create([
            'id_pengajuan' => 'PJL240125002',
            'path' => 'laptop-images/Laptop10-1.jpg'
        ]);

        PengajuanImages::create([
            'id_pengajuan' => 'PJL240126001',
            'path' => 'laptop-images/Laptop10.jpg'
        ]);

        PengajuanImages::create([
            'id_pengajuan' => 'PJL240126001',
            'path' => 'laptop-images/Laptop10-1.jpg'
        ]);
    }
}
