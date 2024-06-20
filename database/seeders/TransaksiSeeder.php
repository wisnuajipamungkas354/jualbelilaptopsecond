<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaksi::create([
            'id' => 'TRXPBL240101001',
            'id_trx' => 'PBL240101001',
            'jenis_trx' => 'Pembelian',
            'total_trx' => '2500000',
            'status_trx' => 'Selesai',
        ]);

        Transaksi::create([
            'id' => 'TRXPBL240104001',
            'id_trx' => 'PBL240104001',
            'jenis_trx' => 'Pembelian',
            'total_trx' => '5500000',
            'status_trx' => 'Selesai',
        ]);

        Transaksi::create([
            'id' => 'TRXPBL240107001',
            'id_trx' => 'PBL240107001',
            'jenis_trx' => 'Pembelian',
            'total_trx' => '3500000',
            'status_trx' => 'Selesai',
        ]);

        Transaksi::create([
            'id' => 'TRXPBL240110001',
            'id_trx' => 'PBL240110001',
            'jenis_trx' => 'Pembelian',
            'total_trx' => '3000000',
            'status_trx' => 'Selesai',
        ]);

        Transaksi::create([
            'id' => 'TRXPBL240113001',
            'id_trx' => 'PBL240113001',
            'jenis_trx' => 'Pembelian',
            'total_trx' => '1800000',
            'status_trx' => 'Selesai',
        ]);

        Transaksi::create([
            'id' => 'TRXPBL240120001',
            'id_trx' => 'PBL240120001',
            'jenis_trx' => 'Pembelian',
            'total_trx' => '2800000',
            'status_trx' => 'Selesai',
        ]);

        Transaksi::create([
            'id' => 'TRXPJL240121001',
            'id_trx' => 'PJL240121001',
            'jenis_trx' => 'Pengajuan',
            'total_trx' => '1800000',
            'status_trx' => 'Selesai',
        ]);

        Transaksi::create([
            'id' => 'TRXPJL240125001',
            'id_trx' => 'PJL240125001',
            'jenis_trx' => 'Pengajuan',
            'total_trx' => '1500000',
            'status_trx' => 'Selesai',
        ]);

        Transaksi::create([
            'id' => 'TRXPJL240125002',
            'id_trx' => 'PJL240125002',
            'jenis_trx' => 'Pengajuan',
            'total_trx' => '1600000',
            'status_trx' => 'Selesai',
        ]);

        Transaksi::create([
            'id' => 'TRXPJL240126001',
            'id_trx' => 'PJL240126001',
            'jenis_trx' => 'Pengajuan',
            'total_trx' => '2000000',
            'status_trx' => 'Selesai',
        ]);
    }
}
