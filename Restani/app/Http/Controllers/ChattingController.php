<?php

namespace App\Http\Controllers;

use App\Models\Chatting;
use App\Models\Product;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class ChattingController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('user')) {

            $rooms = Room::where('user_id', Auth::id())
                            ->orderBy('id', 'DESC')    
                            ->get();
        }else {

            $rooms = Room::where('mitra_id', Auth::id())
                            ->orderBy('id', 'DESC')    
                            ->get();
        }
        $rooma = $request->session()->get('rooma');
        
        $users = User::orderBy('id', 'DESC')->get();
        $chats = Chatting::get();

        return view('chats.index', compact('rooms', 'chats', 'users', 'rooma'));
    }
    public function addRoom(Request $request)
    {
        $filters    = Room::where('user_id', Auth::id())
                            ->where('mitra_id', $request->user_id)
                            ->get();
                            $request->session()->forget('rooma');
        if(count($filters) > 0) {
            session()->regenerate();

            $rooma                           = new Room();
            $rooma['user_id']               = Auth::id();
            $rooma['mitra_id']               = $request->user_id;
            $request->session()->put('rooma', $rooma);
            return redirect()->route('chats.index');
        } else {
            $rooma               = new Room();
            session()->regenerate();
            $rooma['user_id']               = Auth::id();
            $rooma['mitra_id']               = $request->user_id;
            $request->session()->put('rooma', $rooma);

            $room              = new Room();
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
        if ($room = $request->session()->get('room')) {
            $room->mitra_id = $room['user_id'];
            $request->session()->forget('room');
        }
        
    }
    public function sum()
    {
        if (Auth::user()->hasRole('user')) {

            $chats = Room::where('user_id', Auth::id())->count();
        }else {
            $chats = Room::where('mitra_id', Auth::id())->count();
        }
        return view('chats.elements.countChat', compact('chats'));
    }
}
