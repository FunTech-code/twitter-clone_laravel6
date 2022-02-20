<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Tweet;
use \App\User;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\DB;

class UserController extends Controller
{
    //
    public function showUserPage()
    {
        //TODO:なんかIDとれていない？
        $id = Tweet::select(
            'select id from user where name = :name', ['name' => Auth::user()->name]
        );
        $tweet_param = ['id' => $id,];
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
