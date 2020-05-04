<?php


use Illuminate\Http\Request;
use SwooleTW\Http\Websocket\Facades\Websocket;

/*
|--------------------------------------------------------------------------
| Websocket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register websocket events for your application.
|
*/

Websocket::on('connect', function ($websocket, Request $request) {

    var_dump($request->fd);
    var_dump($request->get);
    var_dump($request->server);
    // called while socket on connect
});

Websocket::on('disconnect', function ($websocket,$fd) {
    var_dump($fd);
    // called while socket on disconnect
});

Websocket::on('message', function ($websocket, $data) {
    echo 111;
    $websocket->emit('message', $data);
});
