<?php

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('login','LoginController@login');

Route::get('register','LoginController@register');

Route::get('index','IndexController@index');

Route::get('/rewards/index/{id}','RewardsController@index');

Route::get('/index/setHistory','IndexController@setHistory');

Route::any('/public/test','PublicController@test');

Route::post('/uploads','ToolController@uploads');



Route::get('/video','ToolController@video');

//Route::get('/publish','PublishController@publish');
Route::post('/signIn','ActivityController@signIn');
Route::middleware(['refreshToken'])->group(function (){
    Route::get('/user/index','UserController@index');
    Route::get('/user/userDetail','UserController@userDetail');
    Route::get('/index/setHistory','IndexController@setHistory');
    Route::post('/publish','PublishController@publish');
   // Route::post('/signIn','ActivityController@signIn');




    Route::post('/auth','UserController@getAuthUser');


});
Route::middleware(['wechat.oauth'])->group(function (){

});
Route::post('/wxlogin','LoginController@Wxlogin');
//Route::post('/auth');

