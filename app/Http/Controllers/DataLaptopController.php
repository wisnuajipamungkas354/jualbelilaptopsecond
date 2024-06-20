<?php

namespace App\Http\Controllers;

use App\Models\DataLaptop;
use App\Models\LaptopImages;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DataLaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.data-laptop', [
            'title' => 'Data Laptop',
            'database' => DataLaptop::query()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.laptop-tambah', ['title' => 'Tambah Data Laptop']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
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
            'stok' => 'required'
        ], [
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
            'stok.required' => 'Stok Wajib Diisi!',
        ]);

        // Mendapatkan Id Laptop
        $id_laptop = ['id_laptop' => $this->getLaptopId($validatedData['platform'], $validatedData['merk'])];
        $validatedData = array_merge($id_laptop, $validatedData);

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
            DataLaptop::create($validatedData);
            foreach ($request->images as $image) {
                $filename = $image->store('laptop-images');
                $laptopImages = [
                    'id_laptop' => $validatedData['id_laptop'],
                    'path' => $filename
                ];
                LaptopImages::create($laptopImages);
            }
            return redirect('data-laptop')->with('success', 'Data Laptop Berhasil Ditambahkan!');
        } else {
            return back()->with('error', 'Wajib Upload Foto Produk');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DataLaptop $dataLaptop)
    {
        $dataLaptop->minus = explode('|', $dataLaptop->minus);
        $fotoProduk = DB::table('laptop_images')->where('id_laptop', '=', $dataLaptop->id_laptop)->get('path');

        return view('pegawai.laptop-detail', [
            'title' => 'Detail Laptop',
            'data_laptop' => $dataLaptop,
            'foto_produk' => $fotoProduk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataLaptop $dataLaptop)
    {
        $dataLaptop->minus = explode('|', $dataLaptop->minus);
        $fotoProduk = DB::table('laptop_images')->where('id_laptop', '=', $dataLaptop->id_laptop)->get('path');

        return view('pegawai.laptop-edit', [
            'title' => 'Edit Data Laptop',
            'data_laptop' => $dataLaptop,
            'foto_produk' => $fotoProduk
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataLaptop $dataLaptop)
    {
        $validatedData = $request->validate([
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
            'stok' => 'required'
        ], [
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
            'stok.required' => 'Stok Wajib Diisi!',
        ]);

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
        if ($request->exists('images')) {
            DataLaptop::query()->where('id_laptop', $dataLaptop->id_laptop)->update($validatedData);
            DB::table('laptop_images')->where('id_laptop', '=', $dataLaptop->id_laptop)->delete();

            // Menghapus foto dari storage
            $IdfotoDelete = DB::table('laptop_images')->select('path')->where('id_laptop', '=', $dataLaptop->id_laptop)->get();
            foreach ($IdfotoDelete as $d) {
                Storage::delete([$d->path]);
            }

            // Menambah foto ke storage
            foreach ($request->images as $image) {
                $filename = $image->store('laptop-images');
                $laptopImages = [
                    'id_laptop' => $dataLaptop->id_laptop,
                    'path' => $filename
                ];
                LaptopImages::create($laptopImages);
            }
            return redirect('data-laptop')->with('success', 'Data Laptop Berhasil Diedit!');
        } else {
            DataLaptop::query()->where('id_laptop', $dataLaptop->id_laptop)->update($validatedData);
            return redirect('data-laptop')->with('success', 'Data Laptop Berhasil Diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataLaptop $dataLaptop)
    {
        $IdfotoDelete = DB::table('laptop_images')->select('path')->where('id_laptop', '=', $dataLaptop->id_laptop)->get();
        foreach ($IdfotoDelete as $d) {
            Storage::delete([$d->path]);
        }
        LaptopImages::query()->where('id_laptop', '=', $dataLaptop->id_laptop)->delete();
        DataLaptop::destroy($dataLaptop->id_laptop);

        return redirect('/data-laptop')->with('success', 'Data Berhasil Dihapus!');
    }

    public function getLaptopId($platform, $merk)
    {
        // Mengambil Data Id Terakhir dari database
        $query = DB::table('data_laptops')->where('platform', '=', $platform)->where('merk', '=', $merk)->orderByDesc('id_laptop')->first('id_laptop');

        // Mengambil 2 Huruf dari depan
        $platform = Str::of($platform)->substr(0, 2)->upper();
        $merk = Str::of($merk)->substr(0, 2)->upper();

        if ($query == null) {
            $id = 1;
        } else {
            $id = $query->id_laptop;
            $id = Str::of($id)->substr(4, 4);
            $id = intval($id->value()) + 1;
        }

        $kodeLaptop = Str::padLeft($id, 4, "0");
        $kodeLaptop = $platform . $merk . $kodeLaptop;

        return $kodeLaptop;
    }
}
