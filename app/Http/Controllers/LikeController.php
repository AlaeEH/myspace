<?php

 

namespace App\Http\Controllers;

 

use Illuminate\Http\Request;

use App\Like;
use Auth;

 

class LikeController extends Controller

{

    public function like(Request $request)

    {

        if(Like::where('user_id', Auth::id())->where('user_liked_id', $request->id)->count()) {

            Like::where('user_id', Auth::id())->where('user_liked_id', $request->id)->delete();

        }

        else {

            $like = new Like;

            $like->user_id = Auth::id();

            $like->user_liked_id = $request->id;

            $like->save();

        }

        return back()->with('status', 'You have succesfully liked this profile');

    }

}

