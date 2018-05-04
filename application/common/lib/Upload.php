<?php
/**
 * Created by PhpStorm.
 * User:李沈阳
 * Date: 17/10/10
 * Time: 上午12:29
 */
namespace app\common\lib;

//引入鉴权类
use Qiniu\Auth;
//引入上传类
use Qiniu\Storage\UploadManager;

/**
 * 七牛图片基础类库
 * Class Upload
 * @package app\common\lib
 */
class Upload {

    /**
     * 图片上传
     */
    public static function image( $imgName = 'file' ) {
        if(empty($_FILES[$imgName]['tmp_name'])) {
            exception('您提交的图片数据不合法', 404);
        }
        /// 要上传的文件的
        $file = $_FILES[$imgName]['tmp_name'];
        $pathinfo = pathinfo($_FILES[$imgName]['name']);
        $ext = $pathinfo['extension'];

        $config = config('qiniu');
        // 构建一个鉴权对象
        //生成上传的token
        $token = (new Auth( $config['ak'], $config['sk']))->uploadToken($config['bucket']);
        // 上传到七牛后保存的文件名
        $key  = date('Y')."/".date('m')."/".substr(md5($file), 0, 5).date('YmdHis').rand(0, 9999).'.'.$ext;

        //初始UploadManager类
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $file);

        if($err !== null) {
            return null;
        } else {
            return config('qiniu.image_url').'/'.$key;
        }
    }

    public static function images() {
        // 构建一个鉴权对象
        //生成上传的token
        $config = config('qiniu');
        $auth = new Auth($config['ak'],$config['sk']);
        $token = $auth->uploadToken($config['bucket']);
        $uploadMgr = new UploadManager();
        $files = $_FILES;
        if(!$files)
        {
            return null;
        }
        $arr = ($files['file']['name']);
        if ( empty($arr) )
        {
            exception('您提交的图片数据不合法', 404);
        }
        $imgsUrl = [];
        foreach ( $arr as $k => $value)
        {
            /// 要上传的文件的
            $file = $files['file']['tmp_name'][$k];
            $pathinfo = pathinfo($files['file']['name'][$k]);
            $ext = $pathinfo['extension'];
            // 上传到七牛后保存的文件名
            $key  = date('Y')."/".date('m')."/".substr(md5($file), 0, 5).date('YmdHis').rand(0, 9999).'.'.$ext;
            list($ret, $err) = $uploadMgr->putFile($token, $key, $file);
            if($err !== null) {
                return null;
            } else {
                $imgsUrl[] = $key;
            }
        }
        return $imgsUrl;
    }
    
    
    public static function getToken()
    {
        $config = config('qiniu');
        $token = (new Auth( $config['ak'], $config['sk']))->uploadToken($config['bucket']);
        return $token;
    }

}