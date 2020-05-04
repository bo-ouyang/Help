<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/13
 * Time: 17:00
 */

namespace App\Chat;


use App\WebSocketService\ChatUserService;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\Log;


class Chat extends Task
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;

    }

    public function handle(){

       // Log::info(__CLASS__ . ':handle start', [$this->data]);
        //sleep(2);// Simulate the slow codes
        // throw new \Exception('an exception');// all exceptions will be ignored, then record them into Swoole log, you need to try/catch them

        $swoole = app('swoole');
        $data =json_decode($this->data,true);

        //$swoole->push($data['fd'],json_encode($pushMsg));
        switch ($data['task']){
            case 'open':
               // $pushMsg = ChatService::open( $data );
                $pushMsg= ['open'=>'connect open','fd'=>$data['fd'],'msg'=>'open connect'];
                if (is_array($pushMsg)){
                    var_dump($pushMsg);
                }
                (new ChatUserService($data))->saveUser();
                $user = $swoole->ws_usersTable->get('user'.$data['fd']);
                $pushMsg['user'] = $user;
                $swoole->push( $data['fd'] , json_encode($pushMsg) );
                return 'Finished';
            case 'text':
                //$this->sendMsgToOne($swoole,$pushMsg,$data['send_fd']);
                break;
            case 'joinGroup':
                break;
            case 'createGroup':
                break;
            case 'toUser':
                $this->sendMsgToOne($swoole,$data,$data['data']['send_fd']);
                break;
        }
        if(true){
           // $this->sendMsg($swoole,$data,$data['fd']);
        }
        //var_dump($this->data);
    }
    public function finish(){

    }

    private function sendMsgToOne($swoole,$pushMsg,$myfd){

        //判断用户是否在线
        //var_dump($pushMsg);
        $user = app('swoole')->ws_usersTable->get('user'.$pushMsg['data']['receiver_fd']);
        var_dump($user);
        if ($user){
            //发送给发送方
            if ($myfd == $pushMsg['data']['send_fd']){
                $pushMsg['data']['mine'] = 1;
                $swoole->push($pushMsg['data']['send_fd'], json_encode($pushMsg));
            }

            //发送给接受方
            $pushMsg['data']['mine'] = 0;
            $swoole->push($pushMsg['data']['receiver_fd'], json_encode($pushMsg));
        }
        $swoole->push($pushMsg['data']['receiver_fd'], json_encode($pushMsg));

    }
    //群发，广播,给所有人
    private function sendMsg($swoole,$pushMsg,$myfd){

        echo "当前服务器共有 ".count(app('swoole')->ws_usersTable). " 个连接\n";
        foreach(app('swoole')->ws_usersTable as $key => $row) {
            if($row['fd'] === $myfd){
                $pushMsg['data']['mine'] = 1;
            } else {
                $pushMsg['data']['mine'] = 0;
            }

            $swoole->push($row['fd'], json_encode($pushMsg));
        }
        $swoole->push($myfd['fd'], json_encode($pushMsg));
    }
}