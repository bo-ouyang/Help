<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/13
 * Time: 20:56
 */

namespace App\WebSocketService;


class ChatService
{
    public static  function onOpen($data){

    }
    public static function doLogin($data){

    }
    public static function login($data){

    }
    public static function getRooms(){

    }
    public static function getOnlineUsers(){
        return ChatUserService::getOnlineUsers();
    }
}