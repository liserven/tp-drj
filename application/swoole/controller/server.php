<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/8
 * Time: 12:18
 */

class Swoole{

    private $user = [];

    public function init(){
        $ws = new swoole_websocket_server("0.0.0.0", 8888);

        //在线用户
        $user = [];
        //监听WebSocket连接打开事件
        $ws->on('open', function($ws, $request){
            $this->onOpen($ws, $request);
        } );
        //监听WebSocket消息事件
        $ws->on('message', function ($ws, $frame) {
            $this->onMessage($ws, $frame);
        });
        //监听WebSocket连接关闭事件
        $ws->on('close', function ($ws, $fd) {
            $this->onClose($ws, $fd);
        });

        $ws->start();
    }

    private function onMessage($ws, $frame)
    {
        $data = $frame->data;
        $sendStrToArr = explode(':', $data);
        if($sendStrToArr[0] == 'auth')
        {
            $userArr['uid'] = $sendStrToArr[1];
            $userArr['id'] = $frame->fd;
            $userArr['connection'] = $ws;
            array_push($this->user, $userArr);

            if(isset($sendStrToArr[2]) && $sendStrToArr[2] == 2 )
            {
                array_push($this->indexUser, $userArr);
            }

        }
        if($sendStrToArr[0] == 'auth1')
        {
            $userArr['uid'] = $sendStrToArr[1];
            $userArr['id'] = $ws->fd;
            $userArr['connection'] = $ws;
            array_push($this->indexUser, $userArr);
        }
        if($sendStrToArr[0] == 'message')
        {
            //群发
            $sendData['users'] = array_column($this->user,'uid');
            $sendData['content'] = $sendStrToArr[1];
            $sendData['time'] = date('Y-m-d H:i:s', time());
            $sendData['id'] = $frame->fd;
            $sendData['key'] = 1;
            $sendStr = json_encode($sendData);
            $this->sendUser($sendStr);
        }
        if( $sendStrToArr[0] == 'one_message' )
        {
            $userId = $sendStrToArr[1];

        }

    }


    private function sendUser($sendStr)
    {

        foreach ( $this->user as $value )
        {
            $value['connection']->push($value['id'], $sendStr);
        }
    }

    private function sendUserToOne($sendStr)
    {

        foreach ( $this->user as $value )
        {
            $value['connection']->push($value['id'], $sendStr);
        }
    }
    private function onOpen($ws, $request){

    }


    protected function onClose($ws, $fd){

    }
}
$obj = new Swoole();
$obj->init();