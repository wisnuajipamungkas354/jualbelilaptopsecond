<?php

namespace App\Http\Controllers;

use App\Models\DataLaptop;
use App\Models\DataPembelian;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Transaksi;

class DataPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.data-pembelian', [
            'title' => 'Data Pembelian',
            'data_pembelian' => DataPembelian::query()->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = DB::table('data_laptops')->get(['stok', 'harga'])->first();

        return  view('pegawai.pembelian-tambah', [
            'title' => 'Tambah Data Pembelian',
            'laptop' => DataLaptop::query()->where('stok', '>', 0)->get('id_laptop'),
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nm_pembeli' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'mtd_pembayaran' => 'required',
            'id_laptop' => 'required',
            'jml_barang' => 'required',
            'total_pembayaran' => 'required',
            'status_pembelian' => 'required',
        ], [
            'nm_pembeli.required' => 'Nama Pembeli Wajib Diisi!',
            'no_hp.required' => 'Nomor HP Wajib Diisi!',
            'alamat.required' => 'Alamat Pembeli Wajib Diisi!',
            'mtd_pembayaran.required' => 'Pilih Metode Pembayaran!',
            'id_laptop.required' => 'Pilih ID Laptop!',
            'jml_barang.required' => 'Masukkan Jumlah Barang!',
            'total_pembayaran.required' => 'Masukkan Total Pembayaran!',
            'status_pembelian.required' => 'Masukkan Status Pembelian!'
        ]);

        $idPembelian = $this->getPembelianId();
        $idTransaksiPembelian = $this->getTransaksiId();

        $validatedData['id_pembelian'] = $idPembelian;

        $dataTransaksi = [
            'id' => $idTransaksiPembelian,
            'id_trx' => $idPembelian,
            'jenis_trx' => 'Pembelian',
            'total_trx' => $request->total_pembayaran,
            'status_trx' => 'Selesai'
        ];

        DataPembelian::create($validatedData);
        Transaksi::create($dataTransaksi);
        $stok = DB::table('data_laptops')->where('id_laptop', '=', $request->id_laptop)->get('stok')->first();
        $totalStok = $stok->stok - $request->jml_barang;
        DataLaptop::query()->where('id_laptop', '=', $validatedData['id_laptop'])->update(['stok' => $totalStok]);

        return redirect('/data-pembelian')->with('success', 'Tambah Data Pembelian Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataPembelian $dataPembelian)
    {
        return view('pegawai.pembelian-detail', [
            'title' => 'Detail Data Pembeli',
            'data_pembelian' => $dataPembelian,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPembelian $dataPembelian)
    {
        $dataLaptop = DB::table('data_laptops')->where('id_laptop', '=', $dataPembelian->id_laptop)->get()->first();

        return view('pegawai.pembelian-edit', [
            'title' => 'Update Data Pembeli',
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
            'nm_pembeli' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'status_pembelian' => 'required',
        ], [
            'nm_pembeli.required' => 'Nama Pembeli Wajib Diisi!',
            'no_hp.required' => 'Nomor HP Wajib Diisi!',
            'alamat.required' => 'Alamat Pembeli Wajib Diisi!',
            'status_pembelian.required' => 'Masukkan Status Pembelian!'
        ]);

        $laptop = DB::table('data_laptops')->where('id_laptop', '=', $dataPembelian->id_laptop)->get('platform')->first();
        $id_user = DB::table('users')
            ->where('nm_user', '=', $validatedData['nm_pembeli'])
            ->where('no_hp', '=', $validatedData['no_hp'])
            ->get('id_user')->first();

        $dataNotifikasi = [
            'id_user' => $id_user->id_user,
            'id_trx' => $dataPembelian->id_pembelian,
            'jenis_trx' => 'Pembelian ' . $laptop->platform,
            'is_read' => 'Belum'
        ];

        $dataTransaksi = [];

        if ($validatedData['status_pembelian'] == 'Diproses Admin') {
            $dataTransaksi['status_trx'] = 'Pending';
            $dataNotifikasi['pesan'] = 'Pesananmu sedang diproses oleh Admin lho! Sebentar lagi akan dikirim ke alamatmu! Pantau terus perkembangannya yaa!';
        } elseif ($validatedData['status_pembelian'] == 'Dalam Pengiriman') {
            $dataTransaksi['status_trx'] = 'Pending';
            $dataNotifikasi['pesan'] = 'Pesananmu sedang diantar oleh Driver! Jangan kemana-mana yaaa!';
        } elseif ($validatedData['status_pembelian'] == 'Menunggu Konfirmasi') {
            return back()->with('error', 'Status Pembelian harus dikonfirmasi!');
        }

        DataPembelian::query()->where('id_pembelian', '=', $dataPembelian->id_pembelian)->update([
            'nm_pembeli' => $validatedData['nm_pembeli'],
            'no_hp' => $validatedData['no_hp'],
            'alamat' => $validatedData['alamat'],
            'status_pembelian' => $validatedData['status_pembelian']
        ]);
        Transaksi::query()->where('id', '=', 'TRX' . $dataPembelian->id_pembelian)->update([
            'status_trx' => $dataTransaksi['status_trx']
        ]);
        Notification::create($dataNotifikasi);

        // Mengambil jumlah stok yang ada di data laptop
        $stok = DB::table('data_laptops')->where('id_laptop', '=', $dataPembelian->id_laptop)->get('stok')->first();
        if ($validatedData['status_pembelian'] == 'Dibatalkan Pembeli') {
            $totalStok = $stok->stok + $dataPembelian->jml_barang;
            DataLaptop::query()->where('id_laptop', '=', $dataPembelian->id_laptop)->update(['stok' => $totalStok]);
        }

        return redirect('/data-pembelian')->with('success', 'Edit Data Pembelian Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPembelian $dataPembelian)
    {
        DataPembelian::destroy($dataPembelian->id_pembelian);
        return redirect('/data-pembelian')->with('success', 'Data Pembelian Berhasil Dihapus!');
    }

    public function getDataLaptop(DataLaptop $dataLaptop)
    {
        $data = DB::table('data_laptops')->where('id_laptop', '=', $dataLaptop->id_laptop)->get(['harga', 'stok']);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data Laptop Ditemukan!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data Laptop tidak ditemukan!'
            ], 404);
        }
    }

    public function getPembelianId()
    {
        $dateStr = Carbon::now('Asia/Jakarta')->toDateString();
        $thn = Str::of($dateStr)->substr(2, 2);
        $bln = Str::of($dateStr)->substr(5, 2);
        $tgl = Str::of($dateStr)->substr(8, 2);
        $newDate = $thn . $bln . $tgl;
        // Mengambil Data Id Terakhir dari database
        $query = DB::table('data_pembelians')->where('id_pembelian', 'LIKE', 'PBL' . $newDate . '%')->orderByDesc('id_pembelian')->first('id_pembelian');

        if ($query == null) {
            $id = 1;
        } else {
            $id = $query->id_pembelian;
            $id = Str::of($id)->substr(9, 3);
            $id = intval($id->value()) + 1;
        }

        $kodePembelian = Str::padLeft($id, 3, "0");
        $kodePembelian = 'PBL' . $newDate . $kodePembelian;

        return $kodePembelian;
    }

    public function getTransaksiId()
    {
        $dateStr = Carbon::now('Asia/Jakarta')->toDateString();
        $thn = Str::of($dateStr)->substr(2, 2);
        $bln = Str::of($dateStr)->substr(5, 2);
        $tgl = Str::of($dateStr)->substr(8, 2);
        $newDate = $thn . $bln . $tgl;
        // Mengambil Data Id Terakhir dari database
        $query = DB::table('transaksis')->where('id', 'LIKE', 'TRXPBL' . $newDate . '%')->orderByDesc('id')->first('id');

        if ($query == null) {
            $id = 1;
        } else {
            $id = $query->id;
            $id = Str::of($id)->substr(12, 3);
            $id = intval($id->value()) + 1;
        }

        $kodeTransaksiPembelian = Str::padLeft($id, 3, "0");
        $kodeTransaksiPembelian = 'TRXPBL' . $newDate . $kodeTransaksiPembelian;

        return $kodeTransaksiPembelian;
    }
}
