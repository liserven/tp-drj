<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/12/11
 * Time: 15:07
 */

namespace app\common\service;


use app\common\model\Auth;
use app\lib\exception\ParameterException;
use think\Request;

class ArticleServer
{


    protected $auth;        //身份验证
    protected $topic;   //标题
    protected $image = [];
    protected $sort;
    protected $content;
    protected $request;
    function __construct($auth = '')
    {
        if( $auth=='' || is_null($auth))
        {
            throw new ParameterException([
                'msg' => '身份验证不通过,缺少令牌',
                'code' => 403,
            ]);
        }
        $request = Request::instance();
        if(  $request->isPost() )
        {
            throw new ParameterException([
                'msg' => '请求此接口方式不对,只能是post请求',
                'code' => 404,
            ]);
        }
        $this->auth = $auth;
        $this->request = $request;
    }

    public function restAddArticle()
    {
        /*
         * rest添加文章接口逻辑
         * 需要携带 远程令牌验证身份
         * 验证通过 继续操作
         *
         * */
        //验证auth
        $mid = $this->checkAuth();

        $this->topic = $this->request->post('topic');
        $this->image = $this->request->post('images/a');
        $this->content = $this->request->post('content');
        checkProhibit($this->content); //验证敏感字
        $result = $this->addArticleResult($mid);
        return $result?true:false;
    }

    private function addArticleResult($mid)
    {
        $data = [
            'ai_topic' => $this->topic,
            'ai_smimg' => implode(',', $this->image),
            'ai_content' => $this->content,
            'ai_mid' => $mid,
            'ai_start_time' => 1,
        ];
    }
    private function checkAuth()
    {
        $mid = Auth::getByAuth($this->auth);
        if( !$mid )
        {
            throw new ParameterException([
                'msg' => '身份验证不通过,所带令牌错误',
                'code' => 403
            ]);
        }
        return $mid;
    }
}