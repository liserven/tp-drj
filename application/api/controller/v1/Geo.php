<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/23
 * Time: 17:26
 */

namespace app\api\controller\v1;

use app\common\service\BaiduApiService;
use app\common\service\GeoHash;
use app\common\model\UserData;
use app\lib\exception\PartnerException;
use app\lib\exception\UserException;
use Think\Db;
use enum\PartnerUserStatus;

class Geo extends Base
{

    protected $beforeActionList = [
//        'checkLogin'=> [ 'only'=> 'index' ]
    ];

    public function index()
    {
        $n_latitude = input('lat') ? input('lat') : 39.9148891;  //纬度
        $n_longitude = input('lng')? input('lng'):116.4038740; //经度
        $limit = $this->getLimit();
        if (!$n_longitude || !$n_latitude) {
            throw new UserException([
                'msg' => '当前定位不可为空'
            ]);
        }
        //搜索类型   1搜索用户 2搜索合伙人 默认搜索合伙人
        $type = 2;
        $hash = new GeoHash();
        $result = $hash->encode($n_latitude, $n_longitude);
        $this->checkLogins();
        if (!empty($this->user)) {
            if ($this->user['type'] == 2) {
                $type = 1;
            }
            $data = [
                'ud_id' => $this->user['ud_id'],
                'lat' => $n_latitude,
                'long' => $n_longitude,
                'geohash' => $result
            ];
            UserData::update($data);
        }
        $result = substr($result, 0, 3);
        //获取附近的所有用户列表
        $partners = UserData::where(['geohash' => ['LIKE', $result . '%'], 'type' => $type, 'status' => 1])->select();
        $ids = array_column(collection($partners)->toArray(), 'ud_id'); //获取所有用户id
        //跟查询条件查询用户

        //根据查询的type值来判定要查询的内容
        if ($type == 1) {
            //如果type值等于1，说明要查询的是用户
            $results = Db::table('seas')->alias('s')->where(['uid' => ['in', $ids], 'ud.type' => 1, 'ud.status' => 1])
                ->join('__USER_DATA__ ud', 'ud.ud_id=s.uid', 'left')
                ->field('ud.ud_name, ud.ud_id, ud.ud_logo, ud.ud_sex,ud.lat, ud.long, ud.ud_phone')->paginate($limit);
            if ($results->isEmpty()) {
                throw new PartnerException([
                    'msg' => '无对应数据'
                ]);
            }
        }
        if ($type == 2) {
            //如果type值等于2，说明要查询的是合伙人
            $results = $this->getPartnerList($ids, $limit);
//            return json($results);
        }
        $users = [];
        foreach ($results as $key => &$val) {
            $distance = $this->getDistance($n_latitude, $n_longitude, $val['lat'], $val['long']);
            $users[] = $val;
            $users[$key]['distance'] = $distance;
        }
        $total = count($users);
        $tmp = [];
        if ($total > 1) {
            for ($i = 0; $i < $total; $i++) {
                for ($j = 0; $j < $total - 1; $j++) {
                    if ($users[$j]['distance'] > $users[$j + 1]['distance']) {
                        $tmp = $users[$j + 1];
                        $users[$j + 1] = $users[$j];
                        $users[$j] = $tmp;
                    }
                    $users[$i]['juli'] = round($users[$i]['distance'] / 1000, 2) . 'km';
                }
            }
        } else {
            $users[0]['juli'] = round($users[0]['distance'] / 1000, 2) . 'km';
        }
        return show(true, 'ok', $users);
    }


    private function getDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earth_radius = 6371000;   //approximate radius of earth in meters

        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return round($d);   //四舍五入
    }


    private function getPartnerList($ids, $limit)
    {
        //先查看我有没有绑定的合伙人
        if ($this->user) {
            //如果是登录用户
            $partner_user = Db::table('partner_user')->where(['pu_user_id' => $this->user['ud_id']])
                ->paginate(10);
        } else {
            $partner_user = [];
        }
        if (empty($partner_user)) {

            $partner_data = Db::table('user_data')->alias('ud')
                ->where(['ud.ud_id' => ['in', $ids], 'ud.type' => 2, 'ud.status' => 1])
                ->join('__PARTNER_LAUD__ pl', 'pl.pid=ud.ud_id', 'left')
                ->group('ud.ud_id')
                ->field('ud.ud_name, ud.ud_phone, ud.ud_logo, ud.ud_sex, ud.city, ud.province, ud.county, ud.town,
                     count(distinct pl.id) as likes, ud.status,ud.ud_id,ud.long, ud.lat')->paginate($limit);
        } else {
            $partner_data = Db::table('user_data')->alias('ud')
                ->where(['ud.ud_id' => $partner_user[0]['pu_partner_id'], 'ud.type' => 2, 'ud.status' => 1])
                ->join('__PARTNER_LAUD__ pl', 'pl.pid=ud.ud_id', 'left')
                ->group('ud.ud_id')
                ->field('ud.ud_name, ud.ud_phone, ud.ud_logo, ud.ud_sex, ud.city, ud.province, ud.county, ud.town,
                     count(distinct pl.id) as likes, ud.status,ud.ud_id, ud.long, ud.lat')->paginate($limit);
        }
        if ($partner_data->isEmpty()) {
            throw new PartnerException([
                'msg' => '无对应数据'
            ]);
        }
        $partners = [];
        foreach ($partner_data as $key => &$partner) {
            $star = Db::table('partner_star')->where(['pid' => $partner['ud_id']])->avg('star');
            $partners[$key] = $partner;
            $partners[$key]['star'] = $star <= 0 ? 5 : $star;
            $partners[$key]['deal'] = Db::table('partner_user')->where(['pu_partner_id' => $partner['ud_id'], 'status' => PartnerUserStatus::SIGN])->count();
            $partners[$key]['comm'] = 999;
            $partners[$key]['share_url'] = 'http://www.61drhome.cn/share/card?id=' . $partner['ud_id'];
        }
        return $partners;
    }



    public function encode($lat, $lng)
    {
        $n_latitude = input('lat');  //纬度
        $n_longitude = input('lng'); //经度
        $limit = $this->getLimit();
        if (!$n_longitude || !$n_latitude) {
            throw new UserException([
                'msg' => '当前定位不可为空'
            ]);
        }
        //搜索类型   1搜索用户 2搜索合伙人 默认搜索合伙人
        $type = 2;
        $hash = new GeoHash();
        $result = $hash->encode($n_latitude, $n_longitude);
        return $result;
    }

}