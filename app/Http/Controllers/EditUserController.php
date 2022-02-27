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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:50'],
            'profile' => ['required', 'string', 'max:200'],
        ]);
    }

    public function editUser(array $data)
    {
        $param = [
            'name' => $data['name'],
            'email' => $data['email'],
            'tel_number' => $data['tel_number'],
            'password' => Hash::make($data['password']),
            'update_user' => $data['name'],
            'profile' => $data['profile'],
            'image_url' => $data['image_url'],
            ];
        User::where('id', Auth::user()->id)->update($param);

        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $tweets = DB::table('tweets')->where('user_id', Auth::user()->id)->get();

        return view('user', [
            'user' => $user,
            'tweets' => $tweets,
            ]);
    }
}
