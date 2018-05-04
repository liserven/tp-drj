<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/22
 * Time: 12:09
 */

namespace app\common\validate;


class BannerValidate extends BaseValidate
{
    protected $rule = [
        'title' =>  'require',
        'url' =>  'require',
        'order' =>  'integer',
    ];
}