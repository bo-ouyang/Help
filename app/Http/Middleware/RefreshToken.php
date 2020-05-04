<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 14:46
 */

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RefreshToken extends BaseMiddleware
{

    protected $expect = [
      'login',
      'register'
    ];
    public function handle($request,\Closure $next){
       // echo 666;
        $this->checkForToken($request);
       // echo 111;
        try{
            if($this->auth->parseToken()->authenticate()){
                //echo 333;
                return $next($request);
            }
            throw new UnauthorizedHttpException('jwt-auth','未登录');
        }catch (TokenInvalidException $invalidException){
            return response()->json(['code'=>500,'msg'=>'token格式错误']);
        }catch (TokenBlacklistedException $blacklistedException){
            return response()->json(['code'=>500,'msg'=>'TOKEN_BLACKLISTED']);
        }catch (TokenExpiredException $tokenExpiredException){
            // 此处捕获到了 token 过期所抛出的 TokenExpiredException 异常，我们在这里需要做的是刷新该用户的 token 并将它添加到响应头中
            try{
                $token= $this->auth->refresh();
               // echo $token;
                Auth::guard('api')
                    ->onceUsingId(
                        $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']
                    );
            }catch (JWTException $JWTException){
                //echo 1212;
                // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
                throw new UnauthorizedHttpException('jwt-auth', $JWTException->getMessage());
            }

        }
        // 在响应头中返回新的 token

        echo 222;
        return $this->setAuthenticationHeader($next($request), $token);
    }
}