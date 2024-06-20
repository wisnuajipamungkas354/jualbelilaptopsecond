<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.data-user', [
            'title' => 'Data User',
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.user-tambah', [
            'title' => 'Tambah Data User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required',
            'nm_user' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required',
            'verify_password' => 'required'
        ], [
            'role.required' => 'Role Wajib Diisi!',
            'nm_user.required' => 'Nama User Wajib Diisi!',
            'no_hp.required' => 'Nomor HP Wajib Diisi!',
            'alamat.required' => 'Alamat Wajib Diisi!',
            'email.required' => 'Email Wajib Diisi!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password Wajib Diisi!',
            'verify_password' => 'Verifikasi Password Wajib Diisi!'
        ]);


        unset($validatedData['verify_password']);
        $validatedData['password'] = bcrypt($request->password);
        $validatedData['id_user'] = $this->getUserId($validatedData['role']);
        User::create($validatedData);
        return redirect('/data-user')->with('success', 'Data User Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pegawai.user-detail', [
            'title' => 'Detail Data User',
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pegawai.user-edit', [
            'title' => 'Edit Data User',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role' => 'required',
            'nm_user' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
            'verify_password' => 'required'
        ], [
            'role.required' => 'Role Wajib Diisi!',
            'nm_user.required' => 'Nama User Wajib Diisi!',
            'no_hp.required' => 'Nomor HP Wajib Diisi!',
            'alamat.required' => 'Alamat Wajib Diisi!',
            'email.required' => 'Email Wajib Diisi!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password Wajib Diisi!',
            'verify_password' => 'Verifikasi Password Wajib Diisi!'
        ]);

        unset($validatedData['verify_password']);
        $validatedData['password'] = bcrypt($request->password);
        if ($validatedData['email'] == $user->email) {
            unset($validatedData['email']);
        }

        User::query()->where('id_user', $user->id_user)->update($validatedData);
        return redirect('/data-user')->with('success', 'Data User Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::query()->where('id_user', '=', $user->id_user)->delete();
        return redirect('/data-user')->with('success', 'Data User Berhasil Dihapus!');
    }

    public function getUserId($role)
    {
        // Mengambil Data Id Terakhir dari database
        $query = DB::table('users')->where('role', '=', $role)->orderByDesc('id_user')->first('id_user');

        // Mengambil 2 Huruf dari depan
        if ($role == 'Owner') {
            $role = 'OWN';
        } elseif ($role == 'Driver') {
            $role = 'DRV';
        } elseif ($role == 'Admin') {
            $role = 'ADM';
        }

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
