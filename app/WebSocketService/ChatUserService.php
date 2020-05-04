<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/13
 * Time: 20:58
 */

namespace App\WebSocketService;


class ChatUserService
{
    protected $fd=0,$name = '', $avatar = '',$email='',$roomId=0;

    public function __construct(array $options = array())
    {
        if(!empty($options)){
            foreach($options as $k=>$v){
                if(isset($this->$k)){
                    $this->$k = $v;
                }
            }
        }
    }
    public  function getOnlineUsers(){
        $list = [];

        return $list;
    }

    public  function saveUser(){
        $data = [
          'roomId'=>$this->roomId,
           'fd'=>$this->fd,
           'name'=>$this->name,
            'avatar'=>$this->avatar
        ];
        //app('swoole')->ws_usersTable->set('user'.$this->fd,$data);
    }
}