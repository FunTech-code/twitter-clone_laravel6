<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Tweet;
use \App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function showUserPage()
    {
        $user_param = ['name' => Auth::user()->name];
        $user = User::select('select * from user where name = :name', $user_param);
        $tweet_param = ['id' => $user->id];
        $tweets = Tweet::select('select * from tweet where user_id = :id', $tweet_param);

        return view('user', [
            'tweets' => $tweets,
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
            'profile' => $data['profile'],
            ];
        User::where('name', Auth::user()->name)->update($param);

        return back();
    }
}
