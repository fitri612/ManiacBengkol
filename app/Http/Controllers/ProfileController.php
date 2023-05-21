<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('pages.profile.profile_user.index', compact('user'));
    }

    public function getData(){
        $user = User::all();
        // dd($user);
        return view('dashboard.user.index', compact('user'));
    }

    public function update(Request $request){
        $user = Auth::user();
        $validatedData= $request->validate([
            'name'=>'required|max:50',
            'image_profile'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'=>'required|email|unique:users,email,'.$user->id
        ]);

        if($request->file('image_profile')){
            $validatedData['image_profile']=$request->file('image_profile')->store('profile_image');
        }

        $user->update($validatedData);

        return redirect('/profile')->with('update','success update data profile');
    }
    
}
