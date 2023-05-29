<?php

namespace App\Http\Controllers;

use App\Model\Booking;
use Illuminate\Http\Request;

class BookingAdmin extends Controller
{
    public function index{
        return view('dashboard.booking.index'[
            'bookings'=Booking::all()
        ]);
    }
}
