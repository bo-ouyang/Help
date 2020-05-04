<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 9:55
 */

namespace App\Http\Service;


use App\Http\Model\RewardsModel;
use App\Http\Model\UserRewardLogModel;
use App\Http\Model\UserRewardsModel;
use Illuminate\Support\Facades\DB;

class Publisher
{
    /**
     * @param $uid
     * @param $status
     * @return
     */
    public static function getRewardsByStatus($uid,$status=0){
        $res = [];
        if(!$status){
            $res = RewardsModel::where('status',$status)->get();
        }

        $res = RewardsModel::all();
        return $res;

    }

    public static function setUserRewardStatus($rewardId,$uid,$status=3){
        UserRewardsModel::where('reward_id',$rewardId)->update(['status'=>$status]);
        $rewardAmount = UserRewardsModel::where('reward_id',$rewardId)->value('reward_amount');
        UserLog::insertUserRewardLog();
    }

}