<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Tweet;
use Illuminate\Support\Facades\DB;

class TimelineController extends Controller
{
    public function showTimelinePage()
    {
        //$tweets = Tweet::latest()->paginate(5);
        $tweets = DB::table('tweets')->latest()->paginate(5);


        return view('timeline', [
            'user' => Auth::user(),
            'tweets' => $tweets,
        ]);
    }

    public function postTweet(Request $request)
    {
        $request->validate([
            'user_id' => ['Integer', 'required'],
            'tweet' => ['string', 'required', 'max:140'],
            'Image_url' => ['string', 'max:200'],
        ]);

        if(!empty($request['image_url'])){
            $img = $request->image_url->store('img');
        }
        Tweet::create([
            'user_id'   => Auth::user()->id,
            'tweet'     => $request->tweet,
            'image_url' => $request->image_url,
            'created_user' => Auth::user()->name,
            'update_user' => Auth::user()->name,
        ]);

        return back();
    }
}
