<?php

namespace App\Http\Controllers;

use App\Models\Checkouts;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class CartController extends Controller
{
    public function cart()
    {
  
        return view('shop.cart');
    }

    public function cartElements(Request $request)
    {
        $users = User::all();
        $product = Product::all();
        $carts   = Checkouts::where('user_id', Auth::id())
                                ->orderBy('id', 'DESC')->get();
       
        $i = 1;
        $title = array();
        $isi = [];
        $total = 0;
        foreach ($carts as $cart) {
            // $total += $cart->total;

            $isi = array(
                "mitra_id" => $cart->product->user_id,
                "title" => $cart->product->title,
                "jumlah" => $cart->jumlah,
                // "subtotal" => $cart->total
            );
            array_push($title, $isi);
        }
        return view('shop.elements.cart', compact( 'carts', 'total', 'title', 'i', 'isi', 'users', 'product'));
    }
    
    public function cartDelete($id)
    {
        $carts   = Checkouts::find($id);
        $carts->delete();
        return back();
    }
    
    public function addCart(Request $request, $id)
    {
        
        $filters         = Checkouts::where('product_id', $id)
                                ->where('user_id', Auth::id())
                                ->get();
        $sum = 0;
        $sumJumlah = array();
        $product            = Product::find($id);
        
        if (count($filters) > 0) {
            foreach ($filters as $filter) {
              
                $sum += $filter->jumlah;
                array_push($sumJumlah, $sum);
            }
            $cart               = Checkouts::where('product_id', $id)->first();
            $cart->jumlah       = $sum + $request->jumlah;
            $cart->total        = $product->harga * ($sum + $request->jumlah);
            $cart->product_id   = $id;
            $cart->user_id      = Auth::id();
            $cart->update();
        }else {
            $product            = Product::find($id);
            $cart               = new Checkouts();
            $cart->jumlah       = $request->jumlah;
            $cart->total        = $product->harga * $cart->jumlah;
            $cart->product_id   = $id;
            $cart->user_id      = Auth::id();
            $cart->save();
        }
    }
    public function updateCart(Request $request, $id)
    {
        $cart   = Checkouts::find($id);
        $cart->jumlah   = $request->jumlah;
        $cart->total    = $cart->product->harga * $request->jumlah;
        $cart->update();
    }
    public function sum()
    {
        $sum = Checkouts::where('user_id', Auth::id())->count();
        return view('shop.elements.countCart', compact('sum'));
    }
}
