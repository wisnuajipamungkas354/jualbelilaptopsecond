<?php

namespace App\Http\Controllers;

use App\Models\DataLaptop;
use App\Models\DataPembelian;
use App\Models\Notification;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class KatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fotoProduk = [];
        if (request('search') == null) {
            $dataLaptop = DataLaptop::query()->where('stok', '>', 0)->get();
            foreach ($dataLaptop as $id) {
                $fotoProduk[$id->id_laptop] = DB::table('laptop_images')->where('id_laptop', '=', $id->id_laptop)->first();
            }
        } else {
            $dataLaptop = DataLaptop::query()->where('stok', '>', 0)
                ->where('merk', 'like', '%' . request('search') . '%')
                ->orWhere('tipe', 'like', '%' . request('search') . '%')
                ->orWhere('processor', 'like', '%' . request('search') . '%')
                ->orWhere('memory', 'like', '%' . request('search') . '%')
                ->orWhere('storage', 'like', '%' . request('search') . '%')
                ->get();

            foreach ($dataLaptop as $id) {
                $fotoProduk[$id->id_laptop] = DB::table('laptop_images')->where('id_laptop', '=', $id->id_laptop)->first();
            }
        }

        return view('katalog.index', [
            'title' => 'Dashboard',
            'data_laptop' => $dataLaptop,
            'foto_produk' => $fotoProduk,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPayment(DataLaptop $dataLaptop, Request $request)
    {
        if ($request->exists('totalbarang')) {
            $totalharga = $dataLaptop->harga * $request->totalbarang;
            $jmlpembelian = $request->totalbarang;
        } else {
            $jmlpembelian = 1;
            $totalharga = $dataLaptop->harga * $jmlpembelian;
        }

        $fotoProduk = DB::table('laptop_images')->where('id_laptop', '=', $dataLaptop->id_laptop)->get('path')->first();

        return view('katalog.pembayaran', [
            'title' => 'Pembayaran',
            'laptop' => $dataLaptop,
            'jml_pembelian' => $jmlpembelian,
            'total_harga' => $totalharga,
            'foto_produk' => $fotoProduk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataLaptop $dataLaptop, Request $request)
    {
        if ($request->alamat == null) {
            return back()->with('error', 'Masukkan Alamat Pengiriman!');
        }

        if ($request->metodePembayaran == null) {
            return back()->with('error', 'Pilih Metode Pembayaran!');
        }

        $idPembelian = $this->getPembelianId();
        $idTransaksiPembelian = $this->getTransaksiId();

        $dataPembelian = [
            'id_pembelian' => $idPembelian,
            'nm_pembeli' => auth()->user()->nm_user,
            'no_hp' => auth()->user()->no_hp,
            'alamat' => $request->alamat,
            'mtd_pembayaran' => $request->metodePembayaran,
            'id_laptop' => $dataLaptop->id_laptop,
            'jml_barang' => $request->jmlBarang,
            'total_pembayaran' => $request->totalHarga,
            'status_pembelian' => 'Menunggu Konfirmasi'
        ];

        $dataTransaksi = [
            'id' => $idTransaksiPembelian,
            'id_trx' => $idPembelian,
            'jenis_trx' => 'Pembelian',
            'total_trx' => $request->totalHarga,
            'status_trx' => 'Pending'
        ];

        $dataNotifikasi = [
            'id_user' => auth()->user()->id_user,
            'id_trx' => $idPembelian,
            'jenis_trx' => 'Pembelian ' . $dataLaptop->platform,
            'pesan' => 'Pembayaran Berhasil! Sebentar lagi pesananmu dikonfirmasi oleh Admin, Pantau terus perkembangannya yaa!',
            'is_read' => 'Belum'
        ];

        DataPembelian::create($dataPembelian);
        Transaksi::create($dataTransaksi);
        Notification::create($dataNotifikasi);

        $stok = $dataLaptop->stok - $request->jmlBarang;
        DataLaptop::query()->where('id_laptop', '=', $dataLaptop->id_laptop)->update(['stok' => $stok]);

        $time = Carbon::now('Asia/Jakarta')->format('H:i');
        $date = Carbon::now('Asia/Jakarta')->format('d M Y');

        return view('katalog.statusPayment', [
            'title' => 'Status Pembayaran',
            'data_pembelian' => $dataPembelian,
            'jam' => $time,
            'tgl' => $date
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DataLaptop $dataLaptop)
    {
        $dataLaptop->minus = explode('|', $dataLaptop->minus);
        $fotoProduk = DB::table('laptop_images')->where('id_laptop', '=', $dataLaptop->id_laptop)->get('path');

        return view('katalog.detail', [
            'title' => 'Detail Produk',
            'laptop' => $dataLaptop,
            'foto_produk' => $fotoProduk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editProfile()
    {
        $data_Akun = [
            'nm_user' => auth()->user()->nm_user,
            'no_hp' => auth()->user()->no_hp,
            'alamat' => auth()->user()->alamat,
            'email' => auth()->user()->email,
        ];

        return view('katalog.detail-akun', [
            'title' => 'Edit Data Akun',
            'data' => $data_Akun
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(Request $request)
    {
        $validation = $request->validate([
            'nm_user' => 'required|min:3',
            'no_hp' => 'required|min:3',
            'alamat' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
            'verify_password' => 'required'
        ]);

        if ($validation['password'] !== $validation['verify_password']) {
            return back()->with('wrongpassword', 'Verifikasi Password tidak sama dengan Password!');
        } else {
            unset($validation['verify_password']);
            $validation['role'] = 'Pelanggan';
            $validation['password'] = Hash::make($validation['password']);

            auth()->user()->update($validation);
            return redirect('/')->with('loginSuccess', 'Edit Akun Berhasil!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
