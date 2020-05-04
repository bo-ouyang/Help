<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserRewardsModel extends Model
{
    //
    protected $table = 'user_rewards';

    protected $casts = [
        'sub_step'=>'array'
    ];
    protected $userRewardsStatus = [
        1    => '待提交',
        2    => '已提交',
        3    => '待审核',
        4    => '已通过',
        5    => '未通过',
        6    => '被举报',
        7    => '复审'
     ];
}
