<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/11
 * Time: 15:17
 */

namespace app\common\validate;


class ActionValidate extends BaseValidate
{
    protected $rule = [
        'ad_url' => 'require|isNotEmpty',
        'ad_topic' => 'require|isNotEmpty',
        'ad_pid' => 'require|integer'
    ];

    protected $message = [
        'ad_url.isNotEmpty' => 'url不能为空',
    ];
}