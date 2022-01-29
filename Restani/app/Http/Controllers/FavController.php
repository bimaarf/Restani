<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavController extends Controller
{
    public function index()
    {
        $category   = Category::all();
        $product    = Product::orderBy('id', 'DESC')->get();
        $favorites    = Favorite::where('user_id', Auth::id())->get();
        return view('shop.favorite', compact('category', 'favorites', 'product'));
    }
    public function showFav($id)
    {
        $num = 0;
        $product    = Product::find($id);
        $favo       = Favorite::where('product_id', $product->id)->get();
        if (count($favo) > 0) {
            $num = 1;
        }else {
            $num = 0;
        }
        return view('shop.elements.favorite', compact('product', 'favo', 'num'));
    }
    public function addFav($id)
    {
        $fav                = new Favorite();
        $fav->product_id    = $id;
        $fav->user_id       = Auth::id();
        $fav->save();
        return back();
    }
    public function delFav($id)
    {
        $fav                = Favorite::where('product_id', $id)->first();
        $fav->delete();
    }
    public function sum()
    {
        $favo       = Favorite::where('user_id', Auth::id())->count();
        return view('shop.elements.countFav', compact('favo'));
    }
 
}
