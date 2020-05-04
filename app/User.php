<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'users';

    protected $dateFormat = 'U';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'U',
        'created_at'        =>'datetime:Y:m:d H:i:s',
        'updated_at'        =>'datetime:Y:m:d H:i:s'
    ];

    public function userLevelConf(){
        return $this->hasOne('UserLevelConfModel','id','level');
    }
    public function userWechat(){
        return $this->hasOne('UserWechatModel','open_id','open_id');
    }


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
