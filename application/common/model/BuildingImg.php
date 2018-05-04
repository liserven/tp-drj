<?php
namespace app\common\model;
class BuildingImg extends BaseModel{
    public function BuildingDetails(){
        return $this->belongsTo('BuildingDetails');
    }

}