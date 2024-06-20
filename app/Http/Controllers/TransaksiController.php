<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.riwayat-trx', [
            'title' => 'Riwayat Transaksi',
            'transaksi' => Transaksi::latest()->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        Transaksi::query()->where('id', '=', $transaksi->id)->delete();
        return redirect('/riwayat-transaksi')->with('success', 'Data Transaksi Berhasil Dihapus!');
    }
}
