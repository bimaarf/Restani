<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function booking()
    {
        
        return view('shop.booking');
    }

    public function bookElement()
    {
        $bookings = Booking::where('user_id', Auth::id())
        ->orderBy('id', 'DESC')->get();

        $total = 0;
        foreach ($bookings as $booking) {
            $total += $booking->total;
        }
        
        return view('shop.elements.booking', compact('bookings', 'total'));
    }
    public function updateBook(Request $request, $id)
    {
        $book   = Booking::find($id);
        $book->jumlah   = $request->jumlah;
        $book->total    = $book->product->harga * $request->jumlah;
        $book->update();
    }
    public function deleteBook($id)
    {
        $book   = Booking::find($id);
        $book->delete();
    }
    public function addBook(Request $request, $id)
    {
        
        $filters         = Booking::where('product_id', $id)
                                ->where('user_id', Auth::id())
                                ->get();
        $sum = 0;
        $sumJumlah = array();
        $product            = Product::find($id);
        
        if (count($filters) > 0) {
            foreach ($filters as $filter) {
              
                $sum += $filter->jumlah;
                array_push($sumJumlah, $sum);
            }
            $book               = Booking::where('product_id', $id)->first();
            $book->jumlah       = $sum + $request->jumlah;
            $book->total        = $product->harga * ($sum + $request->jumlah);
            $book->product_id   = $id;
            $book->user_id      = Auth::id();
            $book->update();
        }else {
            $product            = Product::find($id);
            $book               = new Booking();
            $book->jumlah       = $request->jumlah;
            $book->total        = $product->harga * $book->jumlah;
            $book->product_id   = $id;
            $book->user_id      = Auth::id();
            $book->save();
        }
    }
}
