<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/18
 * Time: 10:50
 */

namespace App\Http\Controllers;


use App\Http\Requests\PublishRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
class PublishController extends Controller
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

    /**
     *
     */
    public function allPublish(){

    }

    public function publish(
        //PublishRequest
        Request
        $publishRequest){
        $validator = Validator::make($publishRequest->all(),[
            'title'=>'required | max:5',
            'num'=>'numeric'
        ],[
            'title.require'=>'标题不能为空',
            'title.max'=>'标题不能多余5个',
            'num.numeric'=>'数量必须为数字'
        ]);
        var_dump($validator->fails());

        print_r($validator->errors()->getMessages());
       // $test = $publishRequest->validated();
        //$validator->failed();
         //$validator = $publishRequest->validationData();
        //$validator->error();
           // var_dump($validator->fails());
            //var_dump($test);
            /*if(!$publishRequest->validated()){
                return;
            }*/
    }
    /**
     * 通过
     */
    public function allow(){

    }

    /**
     * 驳回
     */
    public function reject(){

    }

    /**
     * 举报
     */
    public function tipsOff(){

    }



}