<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/13
 * Time: 18:01
 */

namespace App\WebSocketService;


use App\Chat\Chat;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Hhxsv5\LaravelS\Swoole\WebSocketHandlerInterface;
use Illuminate\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;


class WebSocketService implements WebSocketHandlerInterface
{
    public function __construct()
    {

    }

    public function onOpen(Server $server, \Swoole\Http\Request $request)
    {
        //var_dump("fd".$request->fd);
        $data = ['task'=>'open','fd'=>$request->fd];
        $task = new Chat(json_encode($data));
        $ret = Task::deliver($task);
        echo $request->fd."open\n";
        // TODO: Implement onOpen() method.
    }
    public function onMessage(Server $server, Frame $frame)
    {
        var_dump($frame->data);
        $data = json_decode( $frame->data,true);
        switch ($data['sign']){
            case 'toUser':
                $data['data']['send_fd'] = $data['fd'];
                //$data['msg'] = $data['msg'];
                $data['task'] = 'toUser';
                $data['data']['receiver_fd'] =$data['receiver_fd'];
                $task = new Chat(json_encode($data));
                $ret = Task::deliver($task);
                //$data[true] = 22;
                break;

            default:

        }

        // TODO: Implement onMessage() method.
    }

    public function onClose(Server $server, $fd, $reactorId)
    {
        //var_dump($server->data);
        var_dump($fd);
        var_dump($reactorId);
        // TODO: Implement onClose() method.
    }
}