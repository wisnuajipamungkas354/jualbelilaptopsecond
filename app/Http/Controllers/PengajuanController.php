<?php

namespace App\Http\Controllers;

use App\Models\DataPengajuan;
use App\Models\Notification;
use App\Models\PengajuanImages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('katalog.pengajuan', [
            'title' => 'Pengajuan Jual Laptop'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
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
            'jml_barang' => 'required'
        ], [
            'alamat.required' => 'Alamat Wajib Diisi!',
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
        ]);

        $validatedData['nm_penjual'] = auth()->user()->nm_user;
        $validatedData['no_hp'] = auth()->user()->no_hp;
        $validatedData['status_pengajuan'] = 'Menunggu Konfirmasi';

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
                Notification::create([
                    'id_user' => auth()->user()->id_user,
                    'id_trx' => $id_pengajuan['id_pengajuan'],
                    'jenis_trx' => 'Pengajuan Jual ' . $validatedData['platform'],
                    'pesan' => 'Pengajuan Berhasil! Sebentar lagi pengajuanmu dikonfirmasi oleh Owner, Pantau terus perkembangannya yaa!'
                ]);
            }
            return redirect('/status-pengajuan')->with('success', 'Pengajuan Jual Laptop Berhasil!');
        } else {
            return back()->with('error', 'Wajib Upload Foto Produk');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
