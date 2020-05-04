<?php

namespace App\Http\Controllers;

use App\Jobs\UserSignIn;
use App\User;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     *  签到
     */
        public function signIn(Request $request){
            $id  =$request->post('id');
            //var_dump($id) ;die();
            $this->dispatch(new UserSignIn(User::find($id)));
            return User::find($id);
        }
}
