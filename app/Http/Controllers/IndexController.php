<?php

namespace App\Http\Controllers;

use App\Http\Model\RewardsCateModel;
use App\Http\Model\RewardsModel;
use App\Http\Model\UserLevelConfModel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Model\UserRewardsModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function indexRand(Request $request){
        $authUser  =auth('api')->authenticate($request->token);
        $user = User::with(['userLevelConf'])->find($authUser->id);

        $res  = DB::table('rewards')
            ->where('reward_amount','<',$user->userLevelConf->reward_limit)
            ->inRandomOrder()
            ->first();
        return $this->success($res);
    }
    public function index(Request $request){
        $data['recommend'] = RewardsModel::select('title','reward','left_nums','finish_nums','publisher_avatar')
            ->limit(10)
            ->get();
        $data['recommendUser'] = User::select('id','name','avatar')->get();
        return $this->success($data);
    }
    /** 悬赏详情页
     * @param $id
     */
    public function detail($id){
        $res = RewardsModel::find($id);
        return $this->success($res);
    }

    /** 用户报名 ->
     * @param Request $request
     */
    public function accept(Request $request){
        $userRewards = new UserRewardsModel();
        $userRewards->rewarder_id = $request->rewarder_id;
        $userRewards->uid = $request->uid;
        $userRewards->acceptd_at = time();
        $userRewards->status = 0;
        $userRewards->save();
    }
    /** 用户提交步骤
     * @param Request $request
     */
    public function submit(Request $request){
        $userRewards = new UserRewardsModel();
        $rewards = RewardsModel::where(['id'=>$request->id])->first();
        $userRewards->sub_step = $request->step;
        $userRewards->expired_at = $rewards->expired_at;
        $userRewards->submitd_at = time();
        $userRewards->status = 1;
        $userRewards->save();

    }

    public function allRewards(){
        $categories = RewardsCateModel::with(['cateRewards'=>function($query){
            $query->select('id','title','reward_amount','left_nums','finish_nums','user_avatar');
        }])->get();

    }
    public function setHistory(Request $request){
        // Redis::clear();
        // exit();
        $user = auth('api')->authenticate($request->token);
        // $content = $request->all();
        $content['view_at'] = time();
        $content['title']  = $request->title;
        $content['amount']  = $request->amount;
        $content['reward_id']  = $request->reward_id;
        $hkey = $user->id.'userHistory';

        $ret = Redis::hset($hkey, $content['reward_id'],json_encode($content));
        // Redis::hset('userHistory',1,json_encode([$content]));
        $his  = Redis::hgetall($hkey);
        //$ret = json_decode($his,true);
        //var_dump($hkey);
        return response()->json([$his,$request->header()]);
    }
}
