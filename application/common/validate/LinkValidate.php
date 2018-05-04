<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/11
 * Time: 16:32
 */

namespace app\common\validate;


class LinkValidate extends BaseValidate
{
    protected $rule = [
        'title' => 'require',
        'url' => 'require',
    ];

    protected $message = [
        'title.require' => '标题不能为空',
        'url.require' => '地址必须',
    ];
}