<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function showUserPage()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $tweets = DB::table('tweets')->where('user_id', Auth::user()->id)->get();

        return view('user', [
            'user' => $user,
            'tweets' => $tweets,
        ]);
    }

}
