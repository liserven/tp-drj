<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2018/1/17
 * Time: 12:05
 */

namespace app\common\validate;


class SortValidate extends BaseValidate
{
    protected $rule = [
        'name' => 'require',
        'order' => 'require',
        'status' => 'require',
    ];

    protected $message = [
        'name.require' => '名称必须',
    ];
}