<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Repositories\RoomRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    //
    public function index(): View
    {
        $bookings = Booking::with('room')->where('user_id', auth()->id())->orderby('created_at', 'DESC')->get();

        return view('site.bookings.index', ['bookings' => $bookings]);
    }
}
