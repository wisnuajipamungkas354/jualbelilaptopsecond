<?php

namespace App\Http\Controllers;

use App\Models\DataPembelian;
use App\Models\DataPengajuan;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = DB::table('notifications')
            ->where('id_user', '=', auth()->user()->id_user)
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();

        $statusPembelian = DB::table('data_pembelians')
            ->where('nm_pembeli', '=', auth()->user()->nm_user)
            ->where('no_hp', '=', auth()->user()->no_hp)
            ->count();
        $statusPengajuan = DB::table('data_pengajuans')
            ->where('nm_penjual', '=', auth()->user()->nm_user)
            ->where('no_hp', '=', auth()->user()->no_hp)
            ->count();

        return view('katalog.notifikasi', [
            'title' => 'Notifikasi',
            'notifikasi' => $notifikasi,
            'status_pengajuan' => $statusPengajuan,
            'status_pembelian' => $statusPembelian,
        ]);
    }

    public function statusPembelian()
    {
        $dataPembelian = DataPembelian::query()->where('nm_pembeli', '=', auth()->user()->nm_user)
            ->where('no_hp', '=', auth()->user()->no_hp)
            ->get();
        $fotoBarang = [];
        $laptop = [];
        $date = [];
        foreach ($dataPembelian as $pembelian) {
            $fotoBarang[$pembelian->id_laptop] = DB::table('laptop_images')->where('id_laptop', '=', $pembelian->id_laptop)->get('path')->first();
            $laptop[$pembelian->id_laptop] = DB::table('data_laptops')->where('id_laptop', '=', $pembelian->id_laptop)->get()->first();
            $date[$pembelian->id_laptop] = $pembelian->created_at->format('d M Y');
        }

        return view('katalog.status-pembelian', [
            'title' => 'Status Pembelian',
            'data_pembelian' => $dataPembelian,
            'foto_barang' => $fotoBarang,
            'laptop' => $laptop,
            'date' => $date
        ]);
    }

    public function statusPengajuan()
    {
        $dataPengajuan = DataPengajuan::query()->where('nm_penjual', '=', auth()->user()->nm_user)
            ->where('no_hp', '=', auth()->user()->no_hp)
            ->get();
        $fotoBarang = [];
        $date = [];
        foreach ($dataPengajuan as $pengajuan) {
            $fotoBarang[$pengajuan->id_pengajuan] = DB::table('pengajuan_images')->where('id_pengajuan', '=', $pengajuan->id_pengajuan)->get('path')->first();
            $date[$pengajuan->id_pengajuan] = $pengajuan->created_at->format('d M Y');
        }

        return view('katalog.status-pengajuan', [
            'title' => 'Status Pengajuan',
            'data_pengajuan' => $dataPengajuan,
            'foto_barang' => $fotoBarang,
            'date' => $date
        ]);
    }

    public function progresTransaksi(Notification $notification)
    {
        Notification::query()
            ->where('id_user', auth()->user()->id_user)
            ->where('id_trx', '=', $notification->id_trx)->update(['is_read' => 'Sudah']);

        $jenis_transaksi = Str::of($notification->id_trx)->substr(0, 3);

        if ($jenis_transaksi == 'PBL') {
            $data_trx = DataPembelian::query()->where('id_pembelian', '=', $notification->id_trx)->get()->first();
            $jenis = 'Pembelian';
        } elseif ($jenis_transaksi == 'PJL') {
            $data_trx = DataPengajuan::query()->where('id_pengajuan', '=', $notification->id_trx)->get()->first();
            $jenis = 'Pengajuan';
        }

        return view('katalog.progres-trx', [
            'title' => 'Progres ' . $jenis,
            'data_trx' => $data_trx,
            'jenis_transaksi' => $jenis,
        ]);
    }
}
