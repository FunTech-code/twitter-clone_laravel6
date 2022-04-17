<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Tweet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TimelineController extends Controller
{
    public function showTimelinePage()
    {
        $tweets = DB::table('tweets')->latest()->paginate(5);

        return view('timeline', [
            'user' => Auth::user(),
            'tweets' => $tweets,
        ]);
    }

    public function postTweet(Request $request)
    {
        $rules = [
            'tweet' => ['string', 'required', 'max:140'],
            'image_url' => ['string', 'max:200'],
        ];
        $message = [
            'tweet.required' => 'ツイートは必ず入力してください。',
            'tweet.max:140' => 'ツイートは140文字以内で入力してください。',
            'image_url.max:200' => '画像URLは200文字以内としてください。',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return redirect('/timeline')
            ->withErrors($validator)
            ->withInput();
        }
        
        $image_url = null;
        if(!empty($request['image_url'])){
            $filename = $request->image_url->getClientOriginalName();
            $image_url = $request->image_url->storeAs('',$filename,'public');
        }
        Tweet::create([
            'user_id'   => Auth::user()->id,
            'tweet'     => $request->tweet,
            'image_url' => $image_url,
            'created_user' => Auth::user()->name,
            'update_user' => Auth::user()->name,
        ]);

        return back();
    }
}
