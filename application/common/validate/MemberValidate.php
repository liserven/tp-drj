<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/11
 * Time: 14:54
 */

namespace app\common\validate;


class MemberValidate extends BaseValidate
{
    protected $rule = [
        'am_nickname' => 'require|isNotEmpty',
        'am_phone' => 'require|isMobile',
        'am_email' => 'require|email'
    ];

    protected $message = [
        'am_nickname.require' =>'用户名称必须',
        'am_nickname.isNotEmpty' =>'用户名称不能为空',
        'am_phone.isMobile' =>'手机格式错误',
        'am_email.email' =>'邮箱格式错误',
    ];
}