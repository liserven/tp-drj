<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/19
 * Time: 19:41
 */

namespace app\common\service;


use app\common\model\UserNotices;
use app\lib\exception\ParameterException;

class UserNoticeService
{
    protected $userId;

    protected $topic;

    protected $content;

    protected $img;


    public function __construct( $config=[]  )
    {
        if( !isset($config['user_id']) || !isset($config['content']) )
        {
            throw new ParameterException([
                'msg'=> '用户和内容不能为空'
            ]);
        }
        if( isset($config['topic']))
        {
            $this->topic = $config['topic'];
        }
        if( isset($config['img']))
        {
            $this->content = $config['content'];
        }
        $this->userId = $config['user_id'];
        $this->content = $config['content'];
    }

    public function setUserNotice()
    {
        UserNotices::create([

        ]);
    }


}