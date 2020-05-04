<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 10:10
 */

namespace App\Http\Service;


use App\Http\Model\UserRewardLogModel;
use App\User;

class UserLog
{
    public static function insertUserRewardLog($uid,$type,$balance=0){
       UserRewardLogModel::insert([
           'uid'=>$uid,
           'balance'=>$balance,
           'type'=>$type
       ]);
    }
}