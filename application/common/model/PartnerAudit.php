<?php
namespace app\common\model;
class PartnerAudit extends BaseModel{
    public static function getPartnerPage($where=[],$rows=10){
        return self::with([])
            ->where($where)
            ->find()
            ->paginate($rows);
    }

}