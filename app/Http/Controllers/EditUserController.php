<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditUserController extends Controller
{
    public function showEditUserPage()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        return view('edit', [
            'user' => $user,
        ]);
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'name' => ['required', 'string', 'max:50'],
            'profile' => ['required', 'string', 'max:200'],
        ]);
    }

    public function editComplete(Request $request)
    {
        $param = [
            'name' => $request['name'],
            'email' => $request['email'],
            'tel_number' => $request['tel_number'],
            'update_user' => $request['name'],
            'profile' => $request['profile'],
            'image_url' => $request['image_url'],
            ];
        $user = DB::table('users')->where('id', Auth::user()->id)->update($param);
        $tweets = DB::table('tweets')->where('user_id', Auth::user()->id)->get();
        return view('user', [
            'user' => $request,
            'tweets' => $tweets
        ]);
    }
}
