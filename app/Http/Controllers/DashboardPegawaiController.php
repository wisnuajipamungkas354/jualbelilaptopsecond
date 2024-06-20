<?php

namespace App\Http\Controllers;

use App\Models\DataLaptop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPegawaiController extends Controller
{
    public function index()
    {
        $totalLaptop = DB::table('data_laptops')->count();
        $totalPelanggan = DB::table('users')
            ->where('role', '=', 'Pelanggan')
            ->count();

        $totalPegawai = DB::table('users')
            ->where('role', '=', 'Owner')
            ->orWhere('role', '=', 'Admin')
            ->orWhere('role', '=', 'Driver')
            ->count();

        return view('pegawai.index', [
            'title' => 'Dashboard',
            'total_laptop' => $totalLaptop,
            'total_pegawai' => $totalPegawai,
            'total_pelanggan' => $totalPelanggan
        ]);
    }
}
