<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserRewardLogModel extends Model
{

    protected $dateFormat = 'U';
    public const CREATED_AT = 'create_at';
    public const UPDATED_AT =  'update_at';
    public $timestamps = true;
}
