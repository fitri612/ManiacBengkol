<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{   
    public function index(){
        return view('dashboard.booking.index',[
            'bookings'=> Booking::all(),
        ]);
    }

    public function edit($id){
        return view('dashboard.booking.edit',[
            'bookings'=> Booking::find($id)
        ]);
    }

    public function update(Request $request, $id){

        $validatedData = $request->validate([
            "total_service"=>'required|numeric',
            "total_cash"=>'required|numeric',
            "kembalian"=>'required|numeric|min:0',
            "status_booking"=>'required'
        ]);

        Booking::where('id',$id)->update($validatedData);
        return redirect('/booking-admin')->with('update','pembayaran behasil!');

    }


    public function destroy($id){
        Booking::destroy($id);
        return redirect('/booking-admin')->with('delete','hapus data berhasil!');
    }
}
