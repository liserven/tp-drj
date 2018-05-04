<?php
namespace app\common\model;
class Provice extends BaseModel{
//关联市级表
    public function district()
    {
        return $this->hasOne('City', 'province_id', 'province_id');
    }
}