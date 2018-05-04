<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 8:57
 */

namespace app\common\validate;



class UserValidate extends BaseValidate
{
    protected $rule = [
        'ud_name' => 'require',
        'ud_phone' => 'require|isMobile',
    ];

    protected $message = [
        'au_iphone.isMobile' => '请输入正确的手机号...',
        'au_email.email' => '请输入正确的邮箱',
    ];
}