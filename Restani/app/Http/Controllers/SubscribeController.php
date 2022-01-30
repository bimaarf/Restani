<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SubscribeController extends Controller
{
    public function sub()
    {
        return view('shop.subscribe');
    }
    function subElement()
    {
        $subscribe = Subscribe::where('user_id', Auth::id())
        ->orderBy('id', 'DESC')->get();
        $i = 1;
        $title = array();
        $isi = [];
        $users = User::all();
        $product = Product::all();

        $total = 0;
        foreach ($subscribe as $sub) {
            $isi = array(
                "mitra_id"      => $sub->product->user_id,
                "title"         => $sub->product->title,
                "jumlah"        => $sub->jumlah,
                // "subtotal"   => $cart->total
            );
            array_push($title, $isi);
        }
        
        return view('shop.elements.subscribe', compact('subscribe', 'total', 'i', 'isi', 'users', 'product', 'title'));
    }
    public function addSub(Request $request, $id)
    {
        
        $filters         = Subscribe::where('product_id', $id)
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
            $sub               = Subscribe::where('product_id', $id)->first();
            $sub->jumlah       = $sum + $request->jumlah;
            $sub->total        = $product->harga * ($sum + $request->jumlah);
            $sub->product_id   = $id;
            $sub->user_id      = Auth::id();
            $sub->update();
        }else {
            $product            = Product::find($id);
            $sub               = new Subscribe();
            $sub->jumlah       = $request->jumlah;
            $sub->total        = $product->harga * $sub->jumlah;
            $sub->product_id   = $id;
            $sub->user_id      = Auth::id();
            $sub->save();
        }
    }
    public function updateSub(Request $request, $id)
    {
        $sub           = Subscribe::find($id);
        $sub->jumlah   = $request->jumlah;
        $sub->total    = $sub->product->harga * $request->jumlah;
        $sub->update();
    }
    public function deleteSub($id)
    {
        $sub    = Subscribe::find($id);
        $sub->delete();
    }
}
