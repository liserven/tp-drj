<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/10/11
 * Time: 15:16
 */

namespace app\common\validate;


class DutyValidate extends BaseValidate
{
    protected $rule = [
        'dd_name' => 'require|isNotEmpty',
        'dd_describe' => 'require|isNotEmpty'
    ];
}