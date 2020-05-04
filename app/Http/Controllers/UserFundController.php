<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFundController extends Controller
{
    protected  $user;

    public function __construct(Request $request){
        $this->user = auth('api')->authenticate($request->token);
    }

    /**
     * 资金/奖金提现
     */
    public function userCash(){

    }

    /**
     * 悬赏主余额提现
     */
    public function pubBalanceCash(){

    }
}
