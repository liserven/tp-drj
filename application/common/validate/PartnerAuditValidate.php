<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19
 * Time: 16:41
 */

namespace app\common\validate;


class PartnerAuditValidate extends BaseValidate
{
    protected $rule = [
        'name' => 'require',
        'id_code_just' => 'require',
        'id_code_back' => 'require',
        'id_photo' => 'require',
        'city'=> 'require',
        'type'=> 'require'
    ];
}