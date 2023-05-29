<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
         $this->middleware('auth');
    }
 
    public function index()
    {

        return view('booking_user.index',[
            'bookings'=>Booking::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking_user.create',[
            'products'=>Product::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            "note"=>"required|max:255",
            "nopol"=>"required|max:18",
            "jam_kedatangan"=>"required",
            "status_booking"=>"required",
            "user_id"=>"",
            "product_id"=>"",

        ]);

        foreach ($request->product_id as $key => $value) {
            Booking::create([
                "note"=>$request->input("note"),
                "product_id"=>$request->input("product_id")[$key],
                "nopol"=>$request->input("nopol"),
                "jam_kedatangan"=>$request->input("jam_kedatangan"),
                "user_id"=>$request->input("user_id"),
                "status_booking"=>$request->input("status_booking"),
            ]);

        }

        return redirect('/booking')->with('success','berhasil booking');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
