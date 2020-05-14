<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/24
 * Time: 16:20
 */

namespace App\Http\Model;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserWechatModel extends User implements JWTSubject
{
    protected $table = 'user_wechat';
    protected $dateFormat = 'U';
    protected static $unguarded = true;
    protected $casts = [
        'created_at'        =>'datetime:Y-m-d H:i:s',
        'updated_at'        =>'datetime:Y-m-d H:i:s'
    ];
    protected $hidden = [
       'open_id'
    ];
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.

        return $this->getKey();
    }
}