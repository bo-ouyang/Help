<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class RewardsController extends Controller
{

    protected $user;

    public function __construct(Request $request)
    {
       // $this->user = auth('api')->authenticate($request->token);
    }

    /**
     *  发布/管理悬赏页面
     */
    public function index(){

    }
    /**
     *  发布悬赏
     */
    public function pubRewrds(){

    }

    /**
     * 获取悬赏
     */
    public function getRewards(){

    }




}
