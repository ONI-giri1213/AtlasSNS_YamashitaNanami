<?php

namespace App\Http\Controllers;
use App\Models\Follow;
use App\Models\User;


use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function followList(){
        $follows = Follow::get();
        return view('follows.followList');
    }
    public function followerList(){
        $followers = Follow::get();
        return view('follows.followerList');
    }
}
