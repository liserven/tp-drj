<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27
 * Time: 16:37
 */

namespace app\api\controller\v1;



class City extends Base
{


    public function getProvice()
    {
        $data = db('provice')->select();
        return show(true, 'ok', $data);
    }


    public function getCity($pid)
    {
        $data = db('city')->where([ 'province_id'=> $pid])->select();
        return show(true, 'ok', $data);
    }


    public function getCounty($pid)
    {
        $data = db('county')->where([ 'city_id'=> $pid])->select();
        return show(true, 'ok', $data);
    }


    public function getTown($pid)
    {
        $data = db('town')->where([ 'county_id'=> $pid])->select();
        foreach ($data as $key=>&$val)
        {
            $val['town_name'] = str_replace('办事处', '', $val['town_name']);
        }
        return show(true, 'ok', $data);
    }
}