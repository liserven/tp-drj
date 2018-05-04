<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/13
 * Time: 15:10
 */

namespace app\common\lib;

include(APP_PATH."../extend/CCP/SDK/CCPRestSDK.php");
class SMSsend
{

    //说明：需要包含接口声明文件，可将该文件拷贝到自己的程序组织目录下。

    public $accountSid= '8a216da85f9fd676015fc421659c1181';
    //说明：主账号，登陆云通讯网站后，可在控制台首页看到开发者主账号ACCOUNT SID。

    public $accountToken= '6fdf82dd54594f349fb1fa55cb1959ac';
    //说明：主账号Token，登陆云通讯网站后，可在控制台首页看到开发者主账号AUTH TOKEN。

    public $appId= '8a216da85f9fd676015fc42165fa1188';
    //说明：请使用管理控制台中已创建应用的APPID。

    public $serverIP='app.cloopen.com';
    //说明：生产环境请求地址：app.cloopen.com。


    public $serverPort='8883';
    //说明：请求端口 ，无论生产环境还是沙盒环境都为8883.

    public $softVersion='2013-12-26';
    //说明：REST API版本号保持不变。

    public function sendTemplateSMS($to, $datas, $tempId = 1)

    {
        // 初始化REST SDK
        $rest = new \REST($this->serverIP,$this->serverPort,$this->softVersion);
        $rest->setAccount($this->accountSid,$this->accountToken);
        $rest->setAppId($this->appId);


        // 发送模板短信
        $result = $rest->sendTemplateSMS($to,$datas,$tempId);
        if($result == NULL ) {
            $data['bol'] = false;
            $data['msg'] = '发送失败';
        }
        if($result->statusCode!=0) {

            $data['bol'] = false;
            $data['msg'] = $result->statusMsg;
            //下面可以自己添加错误处理逻辑
        }else{
            $data['bol'] = true;
            $data['msg'] = '发送成功';
            //下面可以自己添加成功处理逻辑
        }
        return $data;
    }



}