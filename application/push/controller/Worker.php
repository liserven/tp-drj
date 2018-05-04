<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/12/29
 * Time: 18:22
 */

namespace app\push\controller;


use think\worker\Server;

class Worker extends Server
{
    protected $socket = 'websocket://172.17.88.85:2346';
    protected $user=[]; //在聊天界面的用户
    protected $indexUser=[];//在其他页面的用户
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        $connection->lastMessageTime = time();
        $sendStrToArr = explode(':', $data);
        if($sendStrToArr[0] == 'auth')
        {
            $userArr['uid'] = $sendStrToArr[1];
            $userArr['id'] = $connection->id;
            $userArr['connection'] = $connection;
            array_push($this->user, $userArr);
            if(isset($sendStrToArr[2]) && $sendStrToArr[2] == 2 )
            {
                array_push($this->indexUser, $userArr);
            }
            cache('users', array_column($this->indexUser, 'uid'));
        }
        if($sendStrToArr[0] == 'auth1')
        {
            $userArr['uid'] = $sendStrToArr[1];
            $userArr['id'] = $connection->id;
            $userArr['connection'] = $connection;
            array_push($this->indexUser, $userArr);
        }
        if($sendStrToArr[0] == 'message')
        {
            $sendData['users'] = array_column($this->user,'uid');
            $sendData['content'] = $sendStrToArr[1];
            $sendData['nickname'] = $sendStrToArr[2];
            $sendData['time'] = date('Y-m-d H:i:s', time());
            $sendStr = json_encode($sendData);
            $this->sendUser($sendStr);
        }

    }
    //  群发
    private function sendUser($sendStr)
    {
        foreach ( $this->user as $value )
        {
            $value['connection']->send($sendStr);
        }
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {

    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
        WokerService::closeUser($this->user, $connection->id);
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {
    }
}