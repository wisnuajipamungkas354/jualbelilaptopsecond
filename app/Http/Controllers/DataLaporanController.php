<?php

namespace App\Http\Controllers;

use App\Models\DataLaporan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class DataLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.data-laporan', [
            'title' => 'Data Laporan',
            'laporan' => DataLaporan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.laporan-tambah', [
            'title' => 'Tambah Data Laporan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'tahun' => 'required',
                'bulan' => 'required',
            ],
            [
                'tahun.required' => 'Pilih Tahun!',
                'bulan.required' => 'Pilih Bulan!'
            ]
        );

        if (DB::table('data_laporans')
            ->where('id', 'LIKE', 'L' . $validatedData['tahun'] . $validatedData['bulan'] . '%')
            ->exists()
        ) {
            dd('Truee');
            return back()->with('error', 'Laporan Sudah Pernah Dibuat!');
        }
        $validatedData['tahun'] = Str::of($validatedData['tahun'])->substr(2, 2);


        $kodeLaporan  = $this->getLaporanId($validatedData['tahun'], $validatedData['bulan']);
        $terjual = DB::table('data_pembelians')
            ->where('id_pembelian', 'LIKE', '%' . $validatedData['tahun'] . $validatedData['bulan'] . '%')
            ->where('status_pembelian', '=', 'Diterima Pembeli')
            ->sum('jml_barang');
        $dibeli = DB::table('data_pengajuans')
            ->where('id_pengajuan', 'LIKE', '%' . $validatedData['tahun'] . $validatedData['bulan'] . '%')
            ->where('status_pengajuan', '=', 'Pengajuan Selesai')
            ->sum('jml_barang');
        $pemasukan = DB::table('transaksis')
            ->where('id', 'LIKE', '%' . $validatedData['tahun'] . $validatedData['bulan'] . '%')
            ->where('jenis_trx', '=', 'Pembelian')
            ->where('status_trx', '=', 'Selesai')
            ->sum('total_trx');
        $pengeluaran = DB::table('transaksis')->where('id', 'LIKE', '%' . $validatedData['tahun'] . $validatedData['bulan'] . '%')
            ->where('jenis_trx', '=', 'Pengajuan')
            ->where('status_trx', '=', 'Selesai')
            ->sum('total_trx');
        $jml_trx = DB::table('transaksis')->where('id', 'LIKE', '%' . $validatedData['tahun'] . $validatedData['bulan'] . '%')->count();

        DataLaporan::create([
            'id' => $kodeLaporan,
            'tahun' => $validatedData['tahun'],
            'bulan' => $validatedData['bulan'],
            'terjual' => $terjual,
            'dibeli' => $dibeli,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'jml_trx' => $jml_trx
        ]);

        return redirect('/data-laporan')->with('success', 'Tambah Data Laporan Berhasil!');
    }

    public function cetakPdf(DataLaporan $dataLaporan)
    {
        $bulan = Str::of($dataLaporan->id)->substr(1, 4);
        $pembelian = DB::table('data_pembelians')
            ->where('id_pembelian', 'LIKE', 'PBL' . $bulan . "%")
            ->where('status_pembelian', '=', 'Diterima Pembeli')
            ->join('data_laptops', 'data_pembelians.id_laptop', '=', 'data_laptops.id_laptop')
            ->select('data_pembelians.id_pembelian', 'data_laptops.merk', 'data_laptops.tipe', 'data_pembelians.jml_barang', 'data_pembelians.total_pembayaran')
            ->get();
        $pengajuan = DB::table('data_pengajuans')
            ->where('id_pengajuan', 'LIKE', 'PJL' . $bulan . '%')
            ->where('status_pengajuan', '=', 'Pengajuan Selesai')
            ->get();
        $date = [];
        $tanggal = null;
        $bulan = null;
        $tahun = null;
        foreach ($pembelian as $p) {
            $tahun = Str::of($p->id_pembelian)->substr(3, 2);
            $bulan = Str::of($p->id_pembelian)->substr(5, 2);
            $tanggal = Str::of($p->id_pembelian)->substr(7, 2);

            $date[$p->id_pembelian] = Carbon::parse($tahun . '-' . $bulan . '-' . $tanggal);
        }
        foreach ($pengajuan as $p) {
            $tahun = Str::of($p->id_pengajuan)->substr(3, 2);
            $bulan = Str::of($p->id_pengajuan)->substr(5, 2);
            $tanggal = Str::of($p->id_pengajuan)->substr(7, 2);

            $date[$p->id_pengajuan] = Carbon::parse($tahun . '-' . $bulan . '-' . $tanggal);
        }

        $pdf = PDF::loadView('pegawai/laporan-detail', [
            'title' => 'Laporan Bulanan',
            'pembelian' => $pembelian,
            'pengajuan' => $pengajuan,
            'laporan' => $dataLaporan,
            'date' => $date,
        ]);

        return $pdf->stream('pdfcoba.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataLaporan $dataLaporan)
    {
        //
    }

    public function getLaporanId($tahun, $bulan)
    {
        $tanggal = Carbon::now()->format('d');

        $kodeLaporan = 'L' . $tahun . $bulan . $tanggal;
        return $kodeLaporan;
    }
}
