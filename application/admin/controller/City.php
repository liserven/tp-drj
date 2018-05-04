<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 14:15
 */

namespace app\admin\controller;

use app\common\model\City as CityModel;

class City extends Base
{
    public function getCityByProvince($id)
    {
        $citys = CityModel::all([ 'father'=>$id ]);
        $this->assign('citys', $citys);
        return $this->fetch();
    }
}