<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/24
 * Time: 18:35
 */

namespace app\common\model;


class ChatData extends BaseModel
{


    //聊天公共方法
    public function Common()
    {

    }

    public static function getChatListByPatnerId($patnerId)
    {
        return self::alias("cd")
                    ->where(['partner_id'=> $patnerId])
                    ->join("__USER_DATA__ ud", 'ud.ud_id=cd.user_id', 'left')
                    ->group("ud.ud_id")
                    ->order('cd.id DESC')
                    ->field('cd.content, cd.create_at as pre_time, cd.type as content_type, ud.ud_name as user_name, ud.ud_logo as user_name, ud.ud_sex as user_sex')
                    ->select();
    }

}