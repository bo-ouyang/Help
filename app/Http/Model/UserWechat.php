<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/24
 * Time: 16:20
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class UserWechat extends Model
{
    protected $table = 'user_wechat';
    protected $dateFormat = 'U';
    protected static $unguarded = true;
    protected $casts = [
        'created_at'        =>'datetime:Y:m:d H:i:s',
        'updated_at'        =>'datetime:Y:m:d H:i:s'
    ];
}