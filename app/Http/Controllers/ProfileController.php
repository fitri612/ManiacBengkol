<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('pages.profile.profile_user.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'image_profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);

        if ($request->file('image_profile')) {
            $path = $request->file('image_profile')->store('public/profile_image');
            $validatedData['image_profile'] = Storage::url($path);
        }

        $user->update($validatedData);

        return redirect('/profile')->with('update', 'success update data profile');
    }

    public function getData()
    {
        $user = User::all();
        // dd($user);
        return view('dashboard.user.index', compact('user'));
    }
}