<?php

namespace App\Http\Controllers;

use App\Http\Model\PublisherModel;

use Illuminate\Support\Facades\DB;
use Swoole\Http\Request;

class PublisherController extends Controller
{
    protected  $user;
    public function __construct()
    {
         $this->user = auth('api')->authenticate();
    }

    /** 发布/管理悬赏页
     *
     */
    public function index(){
        $rewardser = PublisherModel::where(['uid'=>$this->user->id])->first();
        $static =DB::raw('');
    }
    /**
     * @param $status 悬赏状态
     */
    public function publishAll($status){

    }

    /**
     * 悬赏主提现页
     */
    public function publisherCashShow(){

    }
    /**
     * 悬赏主提现
     */
    public function publisherCash(){

    }



    public function uploads(){

    }

}
