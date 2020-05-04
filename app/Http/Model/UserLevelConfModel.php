<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserLevelConfModel extends Model
{
    //
    protected $table = 'user_level_conf';

    public $userLevelSet = [
        1=>1,
        2=>50,
        3=>100
    ];
}
