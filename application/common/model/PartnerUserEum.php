<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 11:33
 */

namespace app\common\model;


class PartnerUserEum extends BaseModel
{


    public static function getPage($where=[], $rows=20)
    {
        return self::alias('pue')
                ->where($where)
                ->join('__USER_DATA__ ud', 'ud.ud_id=pue.partner_id', 'left')
                ->field('ud.ud_name, ud.ud_logo,  pue.id, pue.user_id, pue.create_at,pue.partner_id, pue.status')
                ->order('id desc')
                ->paginate($rows);
    }
}