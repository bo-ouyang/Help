<?php

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{

    const PASSWORD_AUTH_FAILED = 40001;
    const Auth_Failed =40003;
    public static $UserExceptionMes = [
        self::Auth_Failed =>'授权失败',
        self::PASSWORD_AUTH_FAILED=>'密码错误;'
    ];
}



