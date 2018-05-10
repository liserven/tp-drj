<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23
 * Time: 18:52
 */

namespace app\api\controller\v1;

use app\common\lib\CustomSms;
use app\common\model\BargainSte;
use app\common\model\PartnerDeal;
use app\common\model\PartnerStar;
use app\common\model\PartnerUser;
use app\common\model\PhoneCode;
use app\common\model\UserData;
use app\common\service\AlipayServer;
use app\common\service\PartnerAliPayNotifyService;
use app\common\service\PartnerService;
use app\common\service\PartnerWxNotify;
use app\common\service\PayService;
use app\common\validate\PhoneValidate;
use app\lib\exception\CustomException;
use app\lib\exception\ParameterException;
use app\lib\exception\PartnerException;
use enum\PartnerUserStatus;
use think\Db;

/**
 * Class Partner
 * @package app\api\controller\v1
 * 合伙人控制器
 */
class Partner extends Base
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    protected $beforeActionList = [
        //前置操作，验证用户权限，必须是合伙才有权限访问
        'checkPartner' => ['only' => 'getPartnerStatistics,getCustomer,partnerPhoneUser,PartnerBindingUser,potentialCustomers,redConfirm,partnerRedConfirm,getStatistics'],
        //前置操作 必须是用户才能访问
        'checkUserScope' => ['only' => 'applyPartner,setPartnerLike,setPartnerScore,getPartnerMoney'],
        //必须登录情况下访问
        'checkLogin' => ['only' => 'getPartnerCard']
    ];

    //获取客户列表资料
    public function getCustomer()
    {
        $limit = $this->getLimit();
        $status = input('status') ? input('status') : 0;
        $where = [
            'pu_partner_id'=> $this->user['ud_id']
        ];
        if( $status != 0 )
        {
            $where['pu.status'] = $status;
        }

        $customs = PartnerUser::getCustomerListByPartnerId($where, $limit);
        $customs->each(function($item, $key){
            if( $item['status'] >= 3 )
            {
                $villaOrderId = Db::table('villa_order')->where([ 'user_id'=> $item['ud_id']])->find();
                $item['villa_order_id'] = $villaOrderId['id'];
            }else{
                $item['villa_order_id'] = 0;
            }
        });
        if (empty($customs)) {
            throw new CustomException();
        } else {
            return show(true, 'ok', $customs);
        }
    }

    //获取合伙人名片

    public function getPartnerCard($id = '')
    {
        $userId = !empty($id) ? $id : $this->user['ud_id'];
        $partner_data = (new PartnerService($userId))->getPartnerInfo($userId);
        $star = Db::table('partner_star')->where(['pid' => $userId])->avg('star');
        $partner_data['star'] = $star <= 0 ? 5 : $star;
        $partner_data['deal'] = Db::table('partner_user')->where(['pu_partner_id' => $userId, 'status' => PartnerUserStatus::SIGN])->count();
        $partner_data['comm'] = 999;
        $partner_data['order'] = Db::table('building_order')->where(['user_id'=> $userId])->count();
        $partner_data['reds'] = Db::table('give_red')->where(['user_id'=> $userId])->count();
        $partner_data['customer'] = Db::table('villa_order')->where(['partner_id'=> $userId])->count();
        return show(true, 'ok', $partner_data);
    }


    //合伙人发起打电话动作
    public function partnerPhoneUser($user_id)
    {
        $data = ['pu_partner_id' => $this->user['ud_id'], 'pu_user_id' => $user_id];
        $partner_user = PartnerUser::get($data);
        if (empty($partner_user)) {
            //设置为跟进状态
            $data['status'] = PartnerUserStatus::FOLLOW;
            $data['source'] = PartnerUserStatus::WATES;
            PartnerUser::create($data);
        }
    }


    public function PartnerBindingUser($user_id)
    {
        $server = new PartnerService($this->user['ud_id']);
        $server->PartnerBindingUser($user_id);
        return show(true, '请求成功，请等待用户确认');
    }

    /**
     * 申请成为合伙人
     */
    public function applyPartner()
    {
        /**
         * 申请合伙人逻辑：
         * 首先必须是用户，
         * 再次查询该地区合伙人是否已经满了，如果满了 提示该地区满了，可以申请其他地区合伙人
         * 如果该地区合伙人名额没满， 该表单提示也是用户， 让他提交表单， 等待审核。
         */
        (new PhoneValidate())->goCheck();
        $phone = input('phone');
        $code = input('code');
        $phoneCode = PhoneCode::get(['code' => $code, 'phone' => $phone]);
        if (empty($phoneCode)) {
            throw new ParameterException([
                'msg' => '验证码错误'
            ]);
        }

        $partnerAudit = Db::table('partner_audit')->where([ 'user_id'=> $this->user['ud_id'], 'examine_status'=> [ 'in', '3,2'] ])->find();
        if( $partnerAudit )
        {
            Db::table('partner_audit')->where([ 'user_id'=> $this->user['ud_id']])->delete();
        }

        $partnerResult = (new PartnerService($this->user['ud_id']))->applyPartnerByUser();
//        PhoneCode::destroy([ 'phone'=> $this->user['ud_phone']]);
        if ($partnerResult) {
            $type = input('payment_type');
            if ($type != 'wx' && $type != 'zfb') {
                throw new ParameterException([
                    'msg' => '支付方式有误'
                ]);
            }
            //如果是微信
            if ($type == 'wx') {
                $wxPayServer = new PayService();
                $result = $wxPayServer->applyPartnerPay($partnerResult->order_no);
                return json($result);
            }
            //如果是支付宝。
            if ($type == 'zfb') {
                $zfbService = new AlipayServer();
                $money = BargainSte::find();
                $total = !empty($money['partner_money']) ? $money['partner_money'] : 20000.00;
                return $zfbService->get([
                    'order_name' => '定容家审核费用',
                    'order_no' => $partnerResult->order_no,
                    'order_money' => $total,
                    'NotifyUrl' => 'http://www.61drhome.cn/partner_zfb_notify',
                ]);
            }


        }

    }


    public function applyPartnerAliNotify()
    {
        $aliNotify = new PartnerAliPayNotifyService();
        $aliNotify->partnerNotify();
    }


    //合伙人审核支付异步返回方法
    public function applyPartnerNotify()
    {
        $server = new PartnerWxNotify();
        $server->Handle();
    }

    //合伙人申请验证码
    public function applyPartnerCode($phone)
    {
        $userData = UserData::get(['ud_phone' => $phone]);
        if (!$userData) {
            return show(false, '该手机号未注册');
        }
        $sms = new CustomSms();
        return $sms->Sms($phone);
    }


    //给合伙人点赞
    public function setPartnerLike($partner_id)
    {
        $data = ['uid' => $this->user['ud_id'], 'pid' => $partner_id];
        $likeData = Db::table('partner_laud')->where($data)->find();
        $is_like = true;

        try {
            if ($likeData) {
                Db::table('partner_laud')->where($data)->delete();
                $is_like = false;
            } else {
                Db::table('partner_laud')->insert($data);
            }
            return show(true, 'ok', ['is_like' => $is_like]);
        } catch (\Exception $e) {
            return show(true, $e->getMessage(), ['is_like' => $is_like]);
        }
    }


    //给合伙人评分
    public function setPartnerScore($partner_id)
    {

        $starNum = input('star/d');
        if (!$starNum) {
            throw new PartnerException([
                'msg' => '不能没有评分哦!'
            ]);
        }
        //给合伙人评分
        $partnerUser = PartnerUser::get(['pu_partner_id' => $partner_id, 'pu_user_id' => $this->user['ud_id']]);
        if (!$partnerUser) {
            throw new PartnerException([
                'msg' => '您不是该合伙人的客户无法评分'
            ]);
        }
        if ($partnerUser['status'] != '结款') {
            throw new PartnerException([
                'msg' => '项目正在进行中,无法评分'
            ]);
        }

        $star = PartnerStar::get(['pid' => $partner_id, 'uid' => $this->user['ud_id']]); //查询我是否给他评分过
        if ($star) {
            throw new PartnerException([
                'msg' => '您已经给他评分过，别让他骄傲了'
            ]);
        }
        $starData = [
            'pid' => $partner_id,
            'uid' => $this->user['ud_id'],
            'star' => $starNum,
        ];
        return $this->resultHandle(PartnerStar::create($starData));
    }


    //查重
    public function checkRepeat($phone)
    {
        if (!$phone) {
            return show(false, '手机号不能为空');
        }
        $userData = UserData::where(['ud_phone' => $phone, 'status' => 1])
            ->field('city, ud_id,type,ud_phone,ud_logo,ud_name,ud_sex,type')->find();

        if (!$userData) {
            return show(false, '该用户未入住平台', [], 40007);
        }
        $userData['city'] = is_null($userData['city']) ? '' : $userData['city'];

        if ($userData['type'] == 2) {
            return show(false, '该用户不存在', [], 40008);
        }
        $partnerUser = PartnerUser::getPartnerByUserId($userData['ud_id'], PartnerUserStatus::BINDING);
        if ($partnerUser) {
            $userData['is_binding'] = true;
            return show(true, '该用户已存在绑定。', $userData);
        } else {
            $userData['is_binding'] = false;
            return show(true, '该用户未被绑定', $userData, 40006);
        }


    }


    //合伙人潜在客户
    public function potentialCustomers()
    {
        //查询所有潜在客户
        $limit = input('limit') ? input('limit') : 10;
        $customers = Db::table('grab_red')->where(['partner_id' => $this->user['ud_id']])->paginate($limit);
        if ($customers->isEmpty()) {
            throw new PartnerException([
                'msg' => '当前没有潜在客户'
            ]);
        }
        $userd = [];
        $customers->each(function ($item, $key)
        {
            $user = Db::table('user_data')->where(['ud_phone' => $item['phone']])->field('ud_name, ud_logo, ud_sex, ud_id,ud_phone')->find();
            if($user)
            {
                $redUse = Db::table('red_use')->where([ 'partner_id'=> $this->user['ud_id'], 'user_id'=> $user['ud_id']])->find();
                $redUserIs = !$redUse ? 1 : 2;
                if( $redUse['status'] == 2 )
                {
                    $redUserIs = 3;
                }

                $userd = $item;
                $userd['red_confirm'] = $redUserIs;
                $userd['price'] = $item['money'];
                $userd['time'] = date('Y-m-d',$item['create_at']);
                $userd['red_id'] = $item['rid'];
                $userd['ud_name'] = $user['ud_name'];
                $userd['ud_logo'] = $user['ud_logo'];
                $userd['ud_sex'] = $user['ud_sex'];

                return $userd;
            }
        });
//        $customers->each(function ($item, $key) use ($customers){
//            $user = Db::table('user_data')->where(['ud_phone' => $item['phone']])->field('ud_name, ud_logo, ud_sex, ud_id,ud_phone')->find();
//            if( $user )
//            {
//                $redUse = Db::table('red_use')->where([ 'partner_id'=> $this->user['ud_id'], 'user_id'=> $user['ud_id']])->find();
//                $redUserIs = !$redUse ? 1 : 2;
//                if( $redUse['status'] == 2 )
//                {
//                    $redUserIs = 3;
//                }
//                $item['red_confirm'] = $redUserIs;
//                $item['price'] = $item['money'];
//                $item['time'] = date('Y-m-d',$item['create_at']);
//                $item['red_id'] = $item['rid'];
//                $item['ud_name'] = $user['ud_name'];
//            }
//            else{
//                $item['ud_name'] = 111;
//                unset($customers[$key]);
//            }
//            return $item;
//        });
//        foreach ($customers as $key => $val) {
//            $user = Db::table('user_data')->where(['ud_phone' => $val['phone']])->field('ud_name, ud_logo, ud_sex, ud_id,ud_phone')->find();
//            if( $user )
//            {
//                $users[$key] = Db::table('user_data')->where(['ud_phone' => $val['phone']])->field('ud_name, ud_logo, ud_sex, ud_id,ud_phone')->find();
//                $redUse = Db::table('red_use')->where([ 'partner_id'=> $this->user['ud_id'], 'user_id'=> $user['ud_id']])->find();
//                $redUserIs = !$redUse ? 1 : 2;
//                if( $redUse['status'] == 2 )
//                {
//                    $redUserIs = 3;
//                }
//                $users[$key]['red_confirm'] = $redUserIs;
//                $users[$key]['price'] = $val['money'];
//                $users[$key]['time'] = date('Y-m-d',$val['create_at']);
//                $users[$key]['red_id'] = $val['rid'];
//            }
//        }


        return show(true, 'ok', $customers);
    }

    //红包确认使用信息
    public function redConfirm()
    {

        //查询所有确认使用信息
        $confirm = Db::table('red_use')->alias('ru')->where(['ru.partner_id' => $this->user['ud_id'], 'ru.status' => 1])
            ->join('__USER_DATA__ ud', 'ud.ud_id=ru.user_id', 'left')
            ->field('ud.ud_name, ud.ud_logo, ud.ud_sex, ud.ud_id, ud.ud_phone,ru.red_id, ru.status')
            ->paginate(10);
        if ($confirm->isEmpty()) {
            throw new PartnerException([
                'msg' => '没有人使用红包'
            ]);
        }
        return show(true, 'ok', $confirm);
    }

    //合伙人确认使用红包
    public function partnerRedConfirm($red_id)
    {
        $reds = Db::table('red_use')->where(['id' => $red_id])->find();
        if ($reds['status'] == 2) {
            throw new ParameterException([
                'msg' => '该红包已经使用'
            ]);
        }
    }


    //获取合伙人申请金额信息
    public function getPartnerMoney()
    {
        $city = input('city');
        if (!$city) {
            throw new PartnerException([
                'msg' => '参数错误'
            ]);
        }
        $cityTotal = Db::table('city')->where(['city_name' => $city])->field('partner_limit')->find();
        $partnerTotal = Db::table('user_data')->where(['type' => 2, 'city' => $city])->count();
        $isApply = $cityTotal['partner_limit'] <= $partnerTotal ? false : true;
        $money = BargainSte::find();
        return show(true, 'ok', ['is_apply' => $isApply, 'money' => $money['partner_money']]);
    }




    //合伙人个人中心统计数据
    public function getStatistics()
    {
        //订单信息
        $customers = Db::table('villa_order')->where([ 'partner_id'=> $this->user['ud_id'] ])->field('count(distinct id) as totals, town')
            ->group('town')->select();
        return show(true, 'ok', $customers);
    }


    //获取合伙人数据统计
    public function getPartnerStatistics()
    {
        $fb = Db::table('villa_order')->alias('vo')->where([ 'partner_id'=> $this->user['ud_id']])->group('town')
            ->join('__VILLA_DATA__ vd', 'vo.villa_name=vd.vd_name', 'left')
            ->field('vo.town, sum(vd.vd_price)/10000 as money ')->order('money desc')->select();
        $cj = Db::query('SELECT FROM_UNIXTIME(create_at, "%m") AS crea,  COUNT(id) AS total FROM villa_order GROUP BY crea ');
        $m = ["01","02","03","04","05","06","07","08","09","10","11","12"];
        $arr = array_column($cj, 'crea');
        $max = max($arr);

        $k = array_diff($m, $arr);
        foreach ($k as $ey=> $v)
        {
            if( $v>$max){
                unset($k[$ey]);
            }
            else{
                $arrTemp['crea'] = $v;
                $arrTemp['total'] = 0;
                array_push($cj, $arrTemp);
            }
        }
        foreach ($cj as $key => $row) {
            $distance[$key] = $row['crea'];
            $money[$key] = $row['crea'];
        }
        array_multisort($distance, SORT_ASC, $cj);
        $data['cj'] = $cj;
        $data['fb'] = $fb;
        return show(true, '', $data);
    }

}


