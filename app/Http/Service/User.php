<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 14:13
 */

namespace App\Http\Service;


use App\Http\Model\UserRewardsModel;

class User
{
    public static function getUserHelps($uid,$status=0){
       return UserRewardsModel::where(['uid'=>$uid,'status'=>$status])->all();
    }
}