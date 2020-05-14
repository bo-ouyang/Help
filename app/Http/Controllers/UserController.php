<?php

namespace App\Http\Controllers;



use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    protected  $user;
    public function __construct(Request $request)
    {
        try{
            $this->user = JWTAuth::parseToken()->authenticate($request->token);
        }catch (TokenExpiredException $tokenExpiredException){
          // echo  $tokenExpiredException->getMessage();
            JWTAuth::parseToken();
        }catch (JWTException $JWTException){

        }

        //$this->user = auth('api')->parseToken()->authenticate();
    }
    public function index(Request $request){
        return response()->json([JWTAuth::user(),$request->header()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @URL=/auth
     */
    public function getAuthUser(Request $request)
    {
        /*$this->validate($request, [
            'token' => 'required'
        ]);*/
        //echo 111;
        now();

        $user = auth('api')->user();
        $wx = User::find($user->id);
        return response()->json(['user' => $wx,'user_wechat'=>$wx->userWechat,'token'=>auth('api')->tokenById($user->id)]);
    }

    /**
     * 等级信息
     */
    public function level(){

    }
    /**
     * 用户报名的悬赏
     */
    public function userHelps(Request $request){
        $user = auth('api')->authenticate($request->token);
        $res = User::getUserHelps($user->id,$request->status?:0);
        return $this->success($res);
    }

    /**
     *  浏览历史
     */
    public function history(Request $request){


    }
    public function userCash(Request $request){
        $type = $request->post('type');
        if ($type=='reward'){

        }else if ($type=='prize'){

        }
    }



}
