<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 8:57
 */

namespace app\common\validate;



class ProhibitValidate extends BaseValidate
{
    protected $rule = [
        'pd_text' => 'require',
    ];

    protected $message = [
        'pd_text.require' => '敏感词内容不能为空',
    ];
}