<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/20
 * Time: 9:33
 */

namespace app\common\validate;


class FeedBackValidate extends BaseValidate
{
    protected $rule = [
        'uf_content' => 'require',
    ];

    protected $message = [
        'uf_content' => '内容不能为空'
    ];
}