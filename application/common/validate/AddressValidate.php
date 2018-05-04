<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/15
 * Time: 13:59
 */

namespace app\common\validate;


class AddressValidate extends BaseValidate
{
    protected $rule = [
        'u_name' => 'require',
        'u_phone' => 'require|isMobile',
        'u_other' => 'require'
    ];

    protected $message = [
        'u_name.require' => '联系人姓名必须填写',
        'u_phone.require' => '联系人手机必须填写',
        'u_phone.isMobile' => '手机格式错误',
        'u_other' => '详细地址必须填写'
    ];
}