<?php

namespace App\Http\Controllers;

use App\Http\Model\UserLevelConfModel;
use App\Http\Model\UserWechatModel;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;


class LoginController extends Controller
{
    public $loginAfterSignUp = true;

    public function __construct()
    {
        $this->middleware('api');
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        event(new Registered($user));
        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;
        //echo 222;
        $guard = auth('api');
        if (!$jwt_token = $guard->attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            $guard = auth('api');
            $guard->invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);

        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function Wxlogin(Request $request){
        $data = $request->all();
        $mini = config('wechat.mini_program.default');
        $app = Factory::miniProgram($mini);
        try{
            $user = $app->auth->session($data['code']);
            //print_r($user);
        }catch (InvalidConfigException $invalidConfigException){
            return response()->json([
                'success' => false,
                'msg' => $invalidConfigException->getMessage(),
            ]);
        }


        //$ret = DB::table('user_wechat')->where('open_id',$user['openid'])->first();unset($data['user']['language']);
        //print_r($data['user']);
        unset($data['user']['language']);
        $userWx = UserWechatModel::updateOrCreate(
            ['open_id' => $user['openid']],
            $data['user']
        );

        $user = User::firstOrNew(['open_id'=>$user['openid']]);
        $user->open_id = $userWx->open_id;
        $user->save();
        $jwt_token = null;
        //auth('api')->setUser($user['openid']);

        //$retUser = User::with('userWechat')->where('open_id',$user->open_id)->first()->toArray();
        $jwt_token = auth()->login($user);
        $token = auth('api')->tokenById($user->id);
        //$userLevelConf = UserLevelConfModel::all();
        return response()->json([
            'success' => true,
            'username'=>$user->username?$user->username:$userWx->nickName,
            'token'=>$token,
            'jwt_token'=>$jwt_token,
            'user'=>$user
        ]);
    }
}
