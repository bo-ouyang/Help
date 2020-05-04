<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/16
 * Time: 14:38
 */

namespace App\Admin\Model;


use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    //protected $dateFormat =false;
    //protected $dateFormat = 'U';
    protected $casts=[
     // 'created_at'=>'date'
    ];
}