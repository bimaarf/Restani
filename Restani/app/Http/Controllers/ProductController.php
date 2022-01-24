<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
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
    public function tag(Request $request)
    {
        $notFound = '';
        if($request->has(['search'])) {
            $product    = Product::where('kategori_id', 'LIKE', '%'.$request->search. '%')
                                    ->orderBy('id', 'DESC')->get();
        }
        
        if ($request->has(['title'])) { 
            $product    = Product::where('title', 'LIKE', '%'.$request->title. '%')
                                    ->orderBy('id', 'DESC')->get();
            // $product    = Product::orderBy('id', 'DESC')->get();
        }else {
            $notFound = 'Produk yg anda cari tidak tersedia 😇';
        }
        
        $productLaris    = Product::orderBy('id', 'DESC')->get();
        $category   = Category::all();
        return view('shop.tag', compact('product', 'category', 'productLaris', 'notFound'));
    }
    public function shopElement()
    {
        
        $product    = Product::orderBy('id', 'DESC')->get();
        $category   = Category::all();
        return view('shop.elements.product', compact('category', 'product'));
    }
    
    public function preview($key)
    {
        $num = 0;
        $product    = Product::where('key', $key)
                                ->first();
        $favo       = Favorite::where('product_id', $product->id)->get();
        if (count($favo) > 0) {
            $num = 1;
        }else {
            $num = 0;
        }
        return view('shop.preview', compact('product', 'favo', 'num'));
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
        $product->key               = Str::random(30);
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
