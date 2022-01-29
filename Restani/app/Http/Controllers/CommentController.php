<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Product;
use App\Models\SubComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $comment = new Comments();
        $comment->message = $request->message;
        $comment->product_id = $id;
        $comment->user_id = Auth::id();
        $comment->save();
    }
    public function subStore(Request $request, $id)
    {
        $sub    = new SubComment();
        $sub->message   = $request->message;
        $sub->user_id   = Auth::id();
        $sub->comment_id   = $id;
        $sub->save();
    }
    public function comElement($id)
    {   
        $subs        = SubComment::orderBy('id', 'DESC')->get();
        $comments   = Comments::where('product_id', $id)->orderBy('id', 'DESC')->get();
        return view('shop.elements.comment', compact('comments', 'subs'));
    }
    
}
