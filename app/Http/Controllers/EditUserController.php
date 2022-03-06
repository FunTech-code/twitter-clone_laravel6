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
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'tel_number' => ['required', 'string', 'regex:/\A([0-9-]{11-13})+\z/u', 'min:11', 'max:13'],
            'Image_url' => ['string', 'max:200'],
            'profile' => ['string', 'max:200'],
        ]);
    }

    public function editComplete(Request $request)
    {
        if(!empty($request['image_url'])){
            $filename = $request->image_url->getClientOriginalName();
            $image_url = $request->image_url->storeAs('',$filename,'public');
        }

        $param = [
            'name' => $request['name'],
            'email' => $request['email'],
            'tel_number' => $request['tel_number'],
            'update_user' => $request['name'],
            'profile' => $request['profile'],
            'image_url' => $image_url,
        ];

        DB::table('users')->where('id', Auth::user()->id)->update($param);
        $tweets = DB::table('tweets')->where('user_id', Auth::user()->id)->get();
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        
        return view('user', [
            'user' => $user,
            'tweets' => $tweets
        ]);
    }
}
