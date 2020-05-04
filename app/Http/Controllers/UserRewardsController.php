<?php

namespace App\Http\Controllers;

use App\Http\Model\UserRewardsModel;
use Illuminate\Http\Request;

class UserRewardsController extends Controller
{
    /**
     *  我的帮忙列表
     */
    public function index($status){
        $res = UserRewardsModel::where('status',$status)->get();
    }
}
