<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\DataLaptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data Laptop berdasarkan keranjang user
        $data_cart = DB::table('carts')
            ->join('data_laptops', 'carts.laptop_id', '=', 'data_laptops.id_laptop')
            ->where('carts.user_id', '=', auth()->user()->id_user)
            ->get();

        $isEmpty = $data_cart->isEmpty();
        $images = [];
        foreach ($data_cart as $id) {
            $images[$id->id_laptop] = DB::table('laptop_images')->where('id_laptop', '=', $id->laptop_id)->get('path')->first();
        }

        return view('katalog.keranjang', [
            'title' => 'Keranjang',
            'data_cart' => $data_cart,
            'is_empty' => $isEmpty,
            'images' => $images
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataLaptop $dataLaptop)
    {
        $addToCart = [
            'user_id' => auth()->user()->id_user,
            'laptop_id' => $dataLaptop->id_laptop,
            'jml_barang' => 1
        ];

        Cart::create($addToCart);

        return redirect('/keranjang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataLaptop $dataLaptop)
    {
        Cart::query()->where('user_id', '=', auth()->user()->id_user)->where('laptop_id', '=', $dataLaptop->id_laptop)->delete();
        return redirect('/keranjang');
    }
}
