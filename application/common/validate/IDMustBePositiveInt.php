<?php
/**
 * Created by 李沈阳
 * User: 李沈阳
 * Date: 2017/10/8
 * Time: 12:35
 */
namespace app\common\validate;

class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
    ];
}
