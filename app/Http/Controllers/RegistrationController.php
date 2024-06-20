<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('katalog.registration', [
            'title' => 'Daftar Akun'
        ]);
    }

    public function register(Request $request)
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

            User::create($validation);
            return redirect('/login')->with('registerSuccess', 'Daftar Akun Berhasil!');
        }
    }

    public function getUserId()
    {
        $role = 'Driver';

        // Mengambil Data Id Terakhir dari database
        $query = DB::table('users')->where('role', '=', $role)->orderByDesc('id_user')->first('id_user');

        // Mengambil 2 Huruf dari depan
        $role = Str::of($role)->substr(0, 3)->upper();

        if ($query == null) {
            $id = 1;
        } else {
            $id = $query->id;
            $id = Str::of($id)->substr(4, 4);
            $id = intval($id->value()) + 1;
        }

        $kodeUser = Str::padLeft($id, 5, "0");
        $kodeUser = 'US' . $role . $kodeUser;

        return $kodeUser;
    }
}
