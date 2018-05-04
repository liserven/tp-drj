<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 14:44
 */

namespace app\common\validate;


class PhoneValidate extends BaseValidate
{
    protected $rule = [
        'phone' => 'isMobile',
    ];

    protected $message = [
        'phone.isMobile' => '手机格式错误'
    ];
}