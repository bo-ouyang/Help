<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class RewardsModel extends Model
{
    //
    protected $table = 'rewards';
    protected $casts = [
        'tags'=>'array',
        'step'=>'array'
    ];
    public $RewardStatus = [
        0   =>  '未付款',
        1   =>  '待审核',
        2   =>  '展示中',
        3   =>  '已暂停',
        4   =>  '审核失败',
        5   =>  '退款中',
        6   =>  '复审',
        7   =>  '举报',
    ];

    public function user(){
        return $this->hasOne('User','id','uid');
    }
}
