<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class RewardsCateModel extends Model
{
    protected $table = 'rewards_cate';
    public function cateRewards(){
        return $this->hasMany('RewardsModel','cate_id','id');
    }
}
