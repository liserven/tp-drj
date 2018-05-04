<?php
/**
 * Created by PhpStorm.
 * User: lishenyang
 * Date: 2017/12/3
 * Time: 21:35
 */

namespace app\common\validate;


class ConfigValidate extends BaseValidate
{

    protected $rule = [
        'instructions_validity' => 'require'
    ];
}