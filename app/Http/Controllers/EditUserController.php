<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EditUserController extends Controller
{
    public function showEditUserPage()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        return view('edit', [
            'user' => $user,
        ]);
    }


    public function editComplete(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50'],
            'tel_number' => ['required', 'string', 'regex:/^[0-9-]{10,13}$/', 'min:10', 'max:13'],
            'image_url' => [ 'max:200'],
            'profile' => ['string', 'max:200'],
        ];
        $message = [
            'name.required' => '名前は必ず入力してください。',
            'name.max:50' => '名前は50文字以内で入力してください。',
            'email.required' => 'メールアドレスは必ず入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.max:50' => 'メールアドレスは50文字以内で入力してください。',
            'tel_number.required' => '電話番号は必ず入力してください。',
            'tel_number.regex:/^[0-9-]{10,13}$/' => '電話番号は数字もしくは-で記入してください。',
            'tel_number.min:10' => '電話番号は10文字以上13文字以内で入力してください。',
            'tel_number.max:13' => '電話番号は10文字以上13文字以内で入力してください。',
            'image_url.max:200' => '画像URLは200文字以内としてください。',
            'profile.max:200' => 'プロフィールは200文字以内で入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return redirect('/edituser')
            ->withErrors($validator)
            ->withInput();
        }
        $image_url = null;
        if(!empty($request['image_url'])){
            $filename = $request->image_url->getClientOriginalName();
            $image_url = $request->image_url->storeAs('',$filename,'public');
        }else if(!empty($request['image_url_before'])){
            $image_url = $request['image_url_before'];
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
