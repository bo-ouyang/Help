<?php

namespace App\Http\Controllers;

use App\Events\UserSignIn;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PublicController extends Controller
{
    //

    public function test(){
      User::with('userWechat')->where('open_id','ow-xH47ygRe-dSQquy8c8s6pbfI8')->delete();
    }
}
