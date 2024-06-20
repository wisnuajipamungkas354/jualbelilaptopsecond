<?php

namespace App\Http\Controllers;

use App\Models\DataPengajuan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataAmbilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.data-ambil', [
            'title' => 'Data Ambil Barang',
            'pengajuan' => DataPengajuan::query()->where('status_pengajuan', 'LIKE', 'Driver%')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPengajuan $dataPengajuan)
    {
        $dataPengajuan->minus = explode('|', $dataPengajuan->minus);
        $fotoProduk = DB::table('pengajuan_images')->where('id_pengajuan', '=', $dataPengajuan->id_pengajuan)->get('path');

        return view('pegawai.ambil-edit', [
            'title' => 'Update Data Pengajuan',
            'pengajuan' => $dataPengajuan,
            'foto_produk' => $fotoProduk
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataPengajuan $dataPengajuan)
    {
        $validatedData = $request->validate([
            'status_pengajuan' => 'required'
        ], [
            'status_pengajuan.required' => 'Status Pengajuan Wajib Diisi!'
        ]);

        DataPengajuan::query()->where('id_pengajuan', '=', $dataPengajuan->id_pengajuan)
            ->update([
                'status_pengajuan' => $validatedData['status_pengajuan']
            ]);

        $id_user = DB::table('users')
            ->where('nm_user', '=', $dataPengajuan->nm_penjual)
            ->where('no_hp', '=', $dataPengajuan->no_hp)
            ->get('id_user')->first();

        $dataNotifikasi = [
            'id_user' => $id_user->id_user,
            'id_trx' => $dataPengajuan->id_pengajuan,
            'jenis_trx' => 'Pengajuan ' . $dataPengajuan->platform,
            'is_read' => 'Belum'
        ];

        if ($request->status_pengajuan == 'Pengajuan Selesai') {
            Transaksi::create([
                'id' => 'TRX' . $dataPengajuan->id_pengajuan,
                'id_trx' => $dataPengajuan->id_pengajuan,
                'jenis_trx' => 'Pengajuan',
                'total_trx' => $dataPengajuan->harga,
                'status_trx' => 'Selesai',
            ]);
            $dataNotifikasi['pesan'] = 'Pesananmu Sudah Kami Terima! Terimakasih sudah menjual barangmu ke platform kami!';
        }

        return redirect('/data-ambil')->with('success', 'Data Pengajuan Berhasil Diupdate!');
    }
}
