<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        if ($request->has(['name'])) { 
            $users    = User::where('name', 'LIKE', '%'.$request->name. '%')
                                ->where('id', '!=', Auth::id())
                                ->orderBy('id', 'DESC')->simplePaginate(10);
        }else {
            $users = User::where('id', '!=', Auth::id())->simplePaginate(10);
        }
        
        return view('admin.dashboard', compact('users'));
    }
    public function product(Request $request)
    {
        if ($request->has(['title'])) { 
            $product    = Product::where('title', 'LIKE', '%'.$request->title. '%')
                                    ->orderBy('id', 'DESC')->get();
        }else {
            $product = Product::all();
        }
        $category = Category::all();
        return view('admin.product', compact('product', 'category'));
    }
}
