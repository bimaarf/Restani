<?php

namespace App\Http\Controllers;

use App\Models\Chatting;
use App\Models\Product;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChattingController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('user')) {

            $rooms = Room::where('user_id', Auth::id())->get();
        }if (Auth::user()->hasRole('mitra')) {

            $rooms = Room::where('mitra_id', Auth::id())->get();
        }
        
        $users = User::orderBy('id', 'DESC')->get();
        $chats = Chatting::get();

        return view('chats.index', compact('rooms', 'chats', 'users'));
    }
    public function addRoom(Request $request)
    {

        $filters    = Room::where('user_id', Auth::id())
                            ->where('mitra_id', $request->user_id)
                            ->get();
        foreach($filters as $filter){}
        if(count($filters) > 0) {
            return redirect()->route('chats.index');
        } else {

            $room               = new Room();
            $room->user_id      = Auth::id();
            $room->mitra_id     = $request->user_id;
            $room->save();
    
            return redirect()->route('chats.index');
        }
        
    }
    public function box($id)
    {
      
        $chats      = Chatting::where('room_id', $id)->get();
        
        return view('chats.elements.box', compact('chats'));
    }

    public function store(Request $request)
    {
        $chats               = new Chatting();
        $chats->chat         = $request->chat;
        $chats->user_id      = Auth::id();
        $chats->room_id      = $request->room_id;
        $chats->save();

    }
    public function sum()
    {
        if (Auth::user()->hasRole('user')) {

            $chats = Room::where('user_id', Auth::id())->count();
        }if (Auth::user()->hasRole('mitra')) {
            $chats = Room::where('mitra_id', Auth::id())->count();
        }
        return view('chats.elements.countChat', compact('chats'));
    }
}
