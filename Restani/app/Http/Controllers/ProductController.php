<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Checkouts;
use App\Models\Comments;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Ratting;
use App\Models\Subscribe;
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
        $ratting       = Ratting::get();

        if($request->has(['search'])) {
            $product    = Product::where('kategori_id', 'LIKE', '%'.$request->search. '%')
                                    ->orderBy('id', 'DESC')->get();
            
        }
        
        if ($request->has(['title'])) { 
            $product    = Product::where('title', 'LIKE', '%'.$request->title. '%')
                                    ->orderBy('id', 'DESC')->get();
        }else {
            $notFound = 'Produk yg anda cari tidak tersedia 😇';
        }
        
        $productLaris    = Product::orderBy('id', 'DESC')->get();
        $category   = Category::all();

        
        return view('shop.tag', compact('product', 'category', 'productLaris', 'notFound', 'ratting'));
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

        $ratting       = Ratting::where('product_id', $product->id)
                                ->orderBy('id', 'DESC')
                                ->get();
        $mean = 0;
        foreach ($ratting as $rats) {
            $mean += $rats->stars;
        }
        return view('shop.preview', compact('product', 'favo', 'num', 'ratting', 'mean'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'foto'      =>      'required',
            'foto.*'      =>      'image|mimes:jpeg,jpg,png',
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
           $product->lokasi            = $request->lokasi;
           $product->kategori_id       = $request->kategori_id;
           $product->user_id           = Auth::id();
        }
       

        $product->save();
        return back()->with('success', 'Produk berhasil ditambahkan!');
      
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title             = $request->title;
        $product->slug              = Str::slug($request->title);
        $product->harga             = $request->harga;
        $product->stok              = $request->stok;
        $product->kategori_id              = $request->kategori_id;
        $product->update();
        return back()->with('success', 'Berhasil diubah!');
    }
    public function trash($id)
    {
        $product = Product::find($id);
        $product->delete();
        foreach (json_decode($product->foto) as $img_decode) {

            unlink('product/'. $img_decode);
        }
        $checkouts = Checkouts::where('product_id', $id)->get();
        $bookings = Booking::where('product_id', $id)->get();
        $subscribe = Subscribe::where('product_id', $id)->get();
        $favorite = Favorite::where('product_id', $id)->get();
        foreach ($checkouts as $check) {
            $check->delete();
        }
        foreach ($bookings as $book) {
            $book->delete();
        }
        foreach ($subscribe as $sub) {
            $sub->delete();
        }
        foreach ($favorite as $fav) {
            $fav->delete();
        }
    }
}
