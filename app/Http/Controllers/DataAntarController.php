<?php

namespace App\Http\Controllers;

use App\Models\DataPembelian;
use App\Models\Notification;
use App\Models\Transaksi;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mime\Part\DataPart;

class DataAntarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.data-antar', [
            'title' => 'Data Antar Barang',
            'pembelian' => DataPembelian::query()->where('status_pembelian', 'LIKE', 'Dalam%')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPembelian $dataPembelian)
    {
        $dataPembelian->minus = explode('|', $dataPembelian->minus);
        $dataLaptop = DB::table('data_laptops')->where('id_laptop', '=', $dataPembelian->id_laptop)->get()->first();

        return view('pegawai.antar-edit', [
            'title' => 'Update Data Pengajuan',
            'data_pembelian' => $dataPembelian,
            'data_laptop' => $dataLaptop
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataPembelian $dataPembelian)
    {
        $validatedData = $request->validate([
            'status_pembelian' => 'required'
        ], [
            'status_pembelian.required' => 'Status Pembelian Wajib Diisi!'
        ]);

        $laptop = DB::table('data_laptops')->where('id_laptop', '=', $dataPembelian->id_laptop)->get('platform')->first();
        $id_user = DB::table('users')
            ->where('nm_user', '=', $dataPembelian->nm_pembeli)
            ->where('no_hp', '=', $dataPembelian->no_hp)
            ->get('id_user')->first();

        $dataNotifikasi = [
            'id_user' => $id_user->id_user,
            'id_trx' => $dataPembelian->id_pembelian,
            'jenis_trx' => 'Pembelian ' . $laptop->platform,
            'is_read' => 'Belum'
        ];

        DataPembelian::query()->where('id_pembelian', '=', $dataPembelian->id_pembelian)
            ->update([
                'status_pembelian' => $validatedData['status_pembelian']
            ]);

        if ($validatedData['status_pembelian'] == 'Diterima Pembeli') {
            Transaksi::query()->where('id', '=', 'TRX' . $dataPembelian->id)->update([
                'id' => 'TRX' . $dataPembelian->id_pembelian,
                'id_trx' => $dataPembelian->id_pembelian,
                'jenis_trx' => 'Pembelian',
                'total_trx' => $dataPembelian->total_pembayaran,
                'status_trx' => 'Selesai',
            ]);
            $dataNotifikasi['pesan'] = 'Pesananmu Sudah Sampai! Semoga barangnya awet yaa!';
        } elseif ($validatedData['status_pembelian'] == 'Dibatalkan Pembeli') {
            Transaksi::query()->where('id', '=', 'TRX' . $dataPembelian->id)->update([
                'id' => 'TRX' . $dataPembelian->id_pembelian,
                'id_trx' => $dataPembelian->id_pembelian,
                'jenis_trx' => 'Pembelian',
                'total_trx' => $dataPembelian->total_pembayaran,
                'status_trx' => 'Refund Dana',
            ]);
            $dataTransaksi['status_trx'] = 'Refund Dana';
            $dataNotifikasi['pesan'] = 'Yah Pesananmu dibatalin! Gapapa deh, semoga nanti ada laptop yang cocok untuk kamu yaa!';
        }
        // Menambahkan Notifikasi
        Notification::create($dataNotifikasi);

        return redirect('/data-antar')->with('success', 'Data Antar Berhasil Diupdate!');
    }
}
