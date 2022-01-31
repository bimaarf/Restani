<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Ratting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RattingController extends Controller
{
    public function stars($id)
    {
        $product   = Product::find($id);
        $mean = 0;
        $ratting       = Ratting::where('product_id', $product->id)
                                ->orderBy('id', 'DESC')
                                ->get();
        $mean = 0;
        foreach ($ratting as $rats) {
            $mean += $rats->stars;
        }
        return view('shop.elements.stars', compact('ratting', 'product', 'mean'));
    }

    public function showRat($id)
    {
        $num = 0;
        $product    = Product::find($id);
        $rat       = Ratting::where('product_id', $product->id)
                                ->where('user_id', Auth::id())
                                ->get();
        $ratting       = Ratting::where('product_id', $product->id)
                                ->orderBy('id', 'DESC')
                                ->get();
        $mean = 0;
        foreach ($ratting as $rats) {
            $mean += $rats->stars;
        }
        if (count($rat) > 0) {
            $num = 1;
        }else {
            $num = 0;
        }
        return view('shop.elements.ratting', compact('product', 'rat', 'num', 'ratting', 'mean'));
    }
    public function addRat(Request $request, $id)
    {
        $rat                = new Ratting();
        $rat->stars         = $request->stars;
        $rat->product_id    = $id;
        $rat->user_id       = Auth::id();
        $rat->save();
    }
    public function updRat(Request $request, $id)
    {
        $rat                = Ratting::where('product_id', $id)
                                        ->where('user_id', Auth::id())
                                        ->first();
        $rat->stars         = $request->stars;
        $rat->update();
    }
}
