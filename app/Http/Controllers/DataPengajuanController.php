<?php

namespace App\Http\Controllers;

use App\Models\DataPembelian;
use App\Models\DataPengajuan;
use App\Models\Notification;
use App\Models\PengajuanImages;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DataPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.data-pengajuan', [
            'title' => 'Data Pengajuan',
            'pengajuan' => DataPengajuan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.pengajuan-tambah', [
            'title' => 'Tambah Data Pengajuan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nm_penjual' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'images' => 'required',
            'platform' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'processor' => 'required',
            'memory' => 'required',
            'storage' => 'required',
            'uk_layar' => 'required',
            'info_tambahan' => 'required',
            'kelengkapan' => 'required',
            'harga' => 'required',
            'jml_barang' => 'required',
            'status_pengajuan' => 'required'
        ], [
            'nm_penjual.required' => 'Nama Penjual Wajib Diisi!',
            'no_hp.required' => 'Nomor HP Penjual Wajib Diisi!',
            'alamat.required' => 'Alamat Penjual Wajib Diisi!',
            'platform.required' => 'Platform Wajib Diisi!',
            'merk.required' => 'Merk Wajib Diisi!',
            'tipe.required' => 'Tipe Wajib Diisi!',
            'processor.required' => 'Processor Wajib Diisi!',
            'memory.required' => 'Memory Wajib Diisi!',
            'storage.required' => 'Storage Wajib Diisi!',
            'uk_layar.required' => 'Ukuran Layar Wajib Diisi!',
            'info_tambahan.required' => 'Info Tambahan Wajib Diisi!',
            'kelengkapan.required' => 'Kelengkapan Wajib Diisi!',
            'harga.required' => 'Harga Wajib Diisi!',
            'jml_barang.required' => 'Jumlah Barang Wajib Diisi!',
            'status_pengajuan.required' => 'Status Pengajuan Wajib Diisi!'
        ]);

        // Mendapatkan Id Pengajuan
        $id_pengajuan = ['id_pengajuan' => $this->getPengajuanId()];
        $validatedData = array_merge($id_pengajuan, $validatedData);

        // Menampung data Minus
        if ($request->exists('minus')) {
            $minuses = [];
            foreach ($request->minus as $minus) {
                array_push($minuses, $minus);
            }
            $validatedData['minus'] = Arr::join($minuses, '|');
            $len = count($minuses);
            if ($len <= 2) {
                $validatedData['grade'] = 'B';
            } elseif ($len <= 3) {
                $validatedData['grade'] = 'C';
            } elseif ($len >= 4) {
                $validatedData['grade'] = 'D';
            }
        } else {
            $validatedData['minus'] = 'No Minus';
            $validatedData['grade'] = 'A';
        }

        // Memasukkan Semua Data kedalam database DataLaptop dan LaptopImages
        if (!empty($validatedData['images'])) {
            unset($validatedData['images']);
            DataPengajuan::create($validatedData);
            foreach ($request->images as $image) {
                $filename = $image->store('laptop-images');
                $laptopImages = [
                    'id_pengajuan' => $validatedData['id_pengajuan'],
                    'path' => $filename
                ];
                PengajuanImages::create($laptopImages);
            }
            return redirect('/data-pengajuan')->with('success', 'Tambah Data Pengajuan Berhasil!');
        } else {
            return back()->with('error', 'Wajib Upload Foto Produk');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DataPengajuan $dataPengajuan)
    {
        $dataPengajuan->minus = explode('|', $dataPengajuan->minus);
        $fotoProduk = DB::table('pengajuan_images')->where('id_pengajuan', '=', $dataPengajuan->id_pengajuan)->get('path');

        return view('pegawai.pengajuan-detail', [
            'title' => 'Detail Pengajuan',
            'pengajuan' => $dataPengajuan,
            'foto_produk' => $fotoProduk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPengajuan $dataPengajuan)
    {
        $dataPengajuan->minus = explode('|', $dataPengajuan->minus);
        $fotoProduk = DB::table('pengajuan_images')->where('id_pengajuan', '=', $dataPengajuan->id_pengajuan)->get('path');
        return view('pegawai.pengajuan-edit', [
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
            'nm_penjual' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'status_pengajuan' => 'required',
        ], [
            'nm_penjual.required' => 'Nama Penjual Wajib Diisi!',
            'no_hp.required' => 'Nomor HP Wajib Diisi!',
            'alamat.required' => 'Alamat Penjual Wajib Diisi!',
            'status_pengajuan.required' => 'Masukkan Status Pengajuan!'
        ]);

        $id_user = DB::table('users')
            ->where('nm_user', '=', $validatedData['nm_penjual'])
            ->where('no_hp', '=', $validatedData['no_hp'])
            ->get('id_user')->first();

        $dataTransaksi = [];
        if ($id_user == null) {
            if ($validatedData['status_pengajuan'] == 'Pengajuan Selesai') {
                $dataTransaksi['status_trx'] = 'Selesai';
                Transaksi::create([
                    'id' => 'TRX' . $dataPengajuan->id_pengajuan,
                    'id_trx' => $dataPengajuan->id_pengajuan,
                    'jenis_trx' => 'Pengajuan',
                    'total_trx' => $dataPengajuan->harga,
                    'status_trx' => 'Selesai'
                ]);
            }
        } else {
            $dataNotifikasi = [
                'id_user' => $id_user->id_user,
                'id_trx' => $dataPengajuan->id_pengajuan,
                'jenis_trx' => 'Pengajuan ' . $dataPengajuan->platform,
                'is_read' => 'Belum'
            ];

            if ($validatedData['status_pengajuan'] == 'Pengajuan Diterima') {
                $dataNotifikasi['pesan'] = 'Selamat! Pengajuanmu Diterima, Sebentar lagi Driver akan mengambil barang ke alamatmu! Pantau terus perkembangannya yaa!';
            } elseif ($validatedData['status_pengajuan'] == 'Pengajuan Ditolak') {
                $dataNotifikasi['pesan'] = 'Mohon maaf, Pengajuanmu belum bisa kami proses! Jangan bersedih hati yaa, silahkan dicoba dilain waktu!';
            } elseif ($validatedData['status_pengajuan'] == 'Driver Menuju Lokasi') {
                $dataNotifikasi['pesan'] = 'Driver sedang menuju alamatmu untuk mengambil barang! Jangan kemana-mana yaaa!';
            } elseif ($validatedData['status_pengajuan'] == 'Pengajuan Selesai') {
                $dataNotifikasi['pesan'] = 'Terimakasih sudah menggunakan layanan kami untuk menjual laptopmu, nanti kalo punya laptop lagi, jual ke kami yaa!';
                $dataTransaksi['status_trx'] = 'Selesai';
                Transaksi::create([
                    'id' => 'TRX' . $dataPengajuan->id_pengajuan,
                    'id_trx' => $dataPengajuan->id_pengajuan,
                    'jenis_trx' => 'Pengajuan',
                    'total_trx' => $dataPengajuan->harga,
                    'status_trx' => 'Selesai'
                ]);
            }
            Notification::create($dataNotifikasi);
        }

        DataPengajuan::query()->where('id_pengajuan', '=', $dataPengajuan->id_pengajuan)->update([
            'nm_penjual' => $validatedData['nm_penjual'],
            'no_hp' => $validatedData['no_hp'],
            'alamat' => $validatedData['alamat'],
            'status_pengajuan' => $validatedData['status_pengajuan']
        ]);


        return redirect('/data-pengajuan')->with('success', 'Update Data Pengajuan Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPengajuan $dataPengajuan)
    {
        $IdfotoDelete = DB::table('pengajuan_images')->select('path')->where('id_pengajuan', '=', $dataPengajuan->id_pengajuan)->get();
        foreach ($IdfotoDelete as $d) {
            Storage::delete([$d->path]);
        }
        PengajuanImages::query()->where('id_pengajuan', '=', $dataPengajuan->id_pengajuan)->delete();
        DataPengajuan::destroy($dataPengajuan->id_pengajuan);
        return redirect('/data-pengajuan')->with('success', 'Data Pengajuan Berhasil Dihapus!');
    }

    public function getPengajuanId()
    {
        $dateStr = Carbon::now('Asia/Jakarta')->toDateString();
        $thn = Str::of($dateStr)->substr(2, 2);
        $bln = Str::of($dateStr)->substr(5, 2);
        $tgl = Str::of($dateStr)->substr(8, 2);
        $newDate = $thn . $bln . $tgl;
        // Mengambil Data Id Terakhir dari database
        $query = DB::table('data_pengajuans')->where('id_pengajuan', 'LIKE', 'PJL' . $newDate . '%')->orderByDesc('id_pengajuan')->first('id_pengajuan');

        if ($query == null) {
            $id = 1;
        } else {
            $id = $query->id_pengajuan;
            $id = Str::of($id)->substr(9, 3);
            $id = intval($id->value()) + 1;
        }

        $kodePengajuan = Str::padLeft($id, 3, "0");
        $kodePengajuan = 'PJL' . $newDate . $kodePengajuan;

        return $kodePengajuan;
    }
}
