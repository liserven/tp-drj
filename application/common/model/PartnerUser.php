<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/27
 * Time: 17:59
 */

namespace app\common\model;


class PartnerUser extends BaseModel
{

    public function getStatusAttr($value)
    {
        $str = '';
        switch ($value)
        {
            case 1 :
                $str = "跟进";
                break;
            case 2 :
                $str = "绑定";
                break;
            case 3 :
                $str = "签约";
                break;
            case 4 :
                $str = "施工";
                break;
            case 5 :
                $str = "结款";
                break;
        }
        return $str;
    }

    //根据合伙人查询客户
    public static function getCustomerListByPartnerId($partnerId)
    {
        return self::alias('pu')
                    ->where(['pu_partner_id'=> $partnerId])
                    ->join('__USER_DATA__ ud', 'ud.ud_id=pu.pu_user_id', 'left')
                    ->group('ud.ud_id')
                    ->order('pu.pu_id DESC')
                    ->field('pu.source, pu.status, ud.ud_name, ud.ud_logo, ud.ud_sex, ud.ud_phone, ud.county, ud.town, ud.ud_id')
                    ->select();
    }


    public static function getPartnerByUserId($userId , $status)
    {
        return self::alias('pr')
                    ->where([ 'pu_user_id'=> $userId, 'pr.status'=> [ '>=', $status] ])
                    ->join('__USER_DATA__ ud', 'ud.ud_id=pr.pu_partner_id', 'left')
                    ->field('ud.ud_name, ud.ud_logo, ud.ud_sex,ud.city, ud.county, ud.town, pr.status')
                    ->find();
    }
}