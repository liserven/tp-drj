<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 15:12
 */

namespace app\api\controller\v1;




use Redis\Redis;

class Notices extends Base
{



    //
    public function notices()
    {

        $redis = Redis::init();
        $arr = [1,2,3,4,5,6,7,8,1,3];
//        dd($redis->hMset('user:2', $arr));
        dd($redis->hGetAll('user:2'));

    }

}