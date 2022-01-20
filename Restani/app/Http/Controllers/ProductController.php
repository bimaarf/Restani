<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function shop()
    {
        
        $category   = Category::all();
        return view('shop.product', compact('category'));
    }

    public function shopElement()
    {
        $category   = Category::all();
        $product    = Product::orderBy('id', 'DESC')->get();
        return view('shop.elements.product', compact('category', 'product'));
    }
    
    public function preview($slug)
    {
        $product    = Product::where('slug', $slug)->first();
        return view('shop.preview', compact('product'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'foto'      =>      'required',
            'foto.*'      =>      'mimes:jpeg,jpg,png',
        ]);

        $product                    = new Product();
        $product->title             = $request->title;
        $product->slug              = Str::slug($request->title);
        $product->desc              = $request->desc;
        $product->harga             = $request->harga;
        $product->stok              = $request->stok;
        if($request->hasfile('foto'))
        {
   
           foreach($request->file('foto') as $image)
           {
               $name        =   time().'.'.$image->getClientOriginalName();
               $image->move(public_path().'/product/', $name);  
               $data[]      =   $name;  
           }
           
           $product->foto              = json_encode($data);
           $product->lokasi       = $request->lokasi;
           $product->kategori_id       = $request->kategori_id;
           $product->user_id           = Auth::id();
        }
       

        $product->save();
        return back()->with('success', 'Produk berhasil ditambahkan!');
      
    }
}
