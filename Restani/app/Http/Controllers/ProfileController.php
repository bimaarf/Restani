<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comments;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index($name)
    {
        $users = User::where('name', $name)->first();
        $product = Product::where('user_id', $users->id)->get();
        foreach ($product as $prod) {
            $prodFav = Favorite::where('product_id', $prod->id)->get();
            foreach ($prodFav as $fav){
                $fave[] = $fav;
            }
            $comments = Comments::where('product_id', $prod->id)->get();
            foreach ($comments as $comment) {
                $com[]  = $comment;
            }
        }
        if (!empty($fave)) {
            $favCount = count($fave);

        }else {
            $favCount = 0;
        }
        if (!empty($com)) {

            $comCount = count($com);
        }else {
            $comCount = 0;
        }
        $category = Category::all();
        return view('profile.index', compact('product', 'category', 'favCount', 'comCount', 'users'));
    }
    public function updTelp(Request $request)
    {
        $users  = User::where('id', Auth::id())->first();
        $users->no_telp     = $request->no_telp;
        $users->update();
        
    }
    public function updPass(Request $request)
    {
        $users  = User::where('id', Auth::id())->first();
        $users->password     = Hash::make($request->password);
        $users->update();
        
    }
    public function updAvatar(Request $request)
    {
        $request->validate([
            'avatar'        =>      'required',
            'avatar.*'      =>      'mimes:jpeg,jpg,png',
        ]);

        $users  = User::where('id', Auth::id())->first();
        $name        =   time().'.'.$request->avatar->getClientOriginalName();
        $request->avatar->move(public_path().'/assets/avatar/', $name);  
        $users->avatar = $name;
        $users->update();
        return back();

    }
}
