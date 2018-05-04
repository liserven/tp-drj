<?php
/**
 * Created by PhpStorm.
 * User: lishenyang
 * Date: 2017/12/1
 * Time: 22:23
 */

namespace app\common\validate;


class VoteValidate extends BaseValidate
{
    protected $rule = [
        'topic' => 'require|isNotEmpty',
        'explain' => 'require|isNotEmpty',
    ];

    protected $message = [
        'topic.isNotEmpty' => '标题不能为空',
        'explain.isNotEmpty' => '投票说明不能为空',
    ];
}