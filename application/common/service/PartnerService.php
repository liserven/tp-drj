<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/1
 * Time: 11:10
 */

namespace app\common\service;


use app\common\lib\Upload;
use app\common\model\City;
use app\common\model\ParthersAudit;
use app\common\model\PartnerAudit;
use app\common\model\PartnerUser;
use app\common\model\PartnerUserEum;
use app\common\model\UserData;
use app\common\model\UserNotices;
use app\common\validate\PartnerAuditValidate;
use app\lib\exception\ParameterException;
use app\lib\exception\PartnerException;
use enum\PartnerUserStatus;
use think\Db;

class PartnerService
{
    protected $userId;  //操作用户信息
    protected $signUserInfo; //登录用户信息 一般为合伙人
    /*
     * 该类主要实现用户的各个方面封装功能
     */

    //构造方法
    //构造方法
    function __construct($userId){
        $this->userId = $userId;
    }
    //获取用户需求
    public function getUserDemand()
    {
    }


    //修改用户资料
    public function editUserIndfo()
    {}


    //修改用户头像
    public function editUserInfoByLog()
    {}


    //绑定客户
    public function PartnerBindingUser($userid)
    {
        //获取合伙人想说的话
        $content = input('content');


        //获取当前登录合伙人信息 查询是否有权限获取客户资料
        $token = UserToken::getCurrentIdentity();
        $this->signUserInfo = $token;
        Token::needSuperScope(); //验证是否为合伙人
        $this->checkPartnerUserEum($this->userId, $userid);
        $userBinding = $this->getUserRelativePartner($userid);
        if( !empty($userBinding) )
        {
            if( $userBinding['pu_partner_id'] == $this->userId)
            {
                throw new PartnerException([
                    'msg' => '您已经绑定该用户'
                ]);
            }
            else{
                throw new PartnerException([
                    'msg' => '其他合伙人已经捷足先登'
                ]);
            }
        }
        else{
            //如果该用户没有任何绑定
            $dataEum = [
                'partner_id' => $this->userId,
                'user_id' => $userid,
            ];
            $dataNoticesData = [
                'user_id' => $userid,
                'topic' => $this->signUserInfo['ud_name'].'希望和你建立绑定',
                'content' => !empty($content) ? $content : '很高兴为您服务',
            ];
            Db::startTrans();
            try{
                PartnerUserEum::create($dataEum); //添加用户绑定信息
                UserNotices::create($dataNoticesData); //推送给某个人消息
                Db::commit();
            }catch (\Exception $e)
            {
                Db::rollback();
                throw new PartnerException([
                    'msg' => $e->getMessage()
                ]);
            }
        }


    }


//发送绑定通知是否存在
    public function checkPartnerUserEum($partner_id, $user_id)
    {
        if( PartnerUserEum::get([ 'partner_id'=> $partner_id, 'user_id'=> $user_id])){
            throw new PartnerException([
                'msg'=> '绑定通知不能重复发送，'
            ]);
        }
    }

    //签约客户
    public function partnerSignUser()
    {
        //获取当前登录合伙人信息 查询是否有权限获取客户资料
        $token = UserToken::getCurrentIdentity();
        $this->signUserInfo = $token;
        /*
         * 思路
         * 首先验证发起请求这是否是合伙人
         * 验证该用户是否还绑定了其他合伙人
         */
        Token::needSuperScope(); //验证是否为合伙人
        //验证是否绑定其他合伙人
        $isPartnerCheck = $this->isBinding();
        if( !empty($isPartnerCheck) )
        {
            //必须是和本合伙人处于绑定状态才能签约
            PartnerUser::update([]);

        }
    }

    //签约之前需要先验证是否和我处于绑定关系
    public function isBinding()
    {
        //验证和该合伙人是否存在绑定或者签约关系或者其他关系
        $partner = PartnerUser::get(['user_id'=> $this->userId, 'partner_id'=> $this->signUserInfo['ud_id'], 'status'=>['>=',PartnerUserStatus::BINDING] ]);
        return !empty($partner)?$partner:false;
    }

    //获取用户对应的合伙人 起到查重功能
    public function getUserRelativePartner($userId)
    {
        //查看
        //查重的思路： 可能以后会有跟进这个字段，先预留，然后就是他有这条数据并且还是绑定或者绑定更高的状态 就是已经有了绑定，即为存在重复
        $partner = PartnerUser::get(['pu_user_id'=> $userId, 'status'=>['>=',PartnerUserStatus::BINDING]]);
        return !empty($partner)?$partner:false;
    }



    //添加合伙人和用户绑定关系数据
    public function addPartnerRelativeUser()
    {
    }


    //登陆用户申请合伙人
    public function applyPartnerByUser()
    {
        $city = input('city');  //获取市级合伙人数量
        if(empty($city))
        {
            throw new ParameterException([
                'msg' => '地区不可缺少',
            ]);
        }

        $this->checkPartnerIs();

        $cityPartnerLimit = City::getPartnerLimitNum($city);


        if($cityPartnerLimit)
        {
            if( $cityPartnerLimit['partners'] >= $cityPartnerLimit['partner_limit'] )
            {
                //如果当前区域合伙人的额度满了的话，无法申请合伙人、
                throw new PartnerException([
                    'msg' => '该地区合伙人已经满了...',
                    'errCode' => 80006
                ]);
            }
        }

        $this->whetherPartner();  //验证该手机是否已经是合伙人

        //验证该手机是否已经提交过审核。 如果提交过审核提示耐心等待。
        //组合数据添加数据
        $partnerAuditData = $this->binationPartnerBuditData();
        try{
            $partner_result = PartnerAudit::create($partnerAuditData);
            return $partner_result;
        }catch (\Exception $e)
        {
            return show(false, $e->getMessage() );
        }


    }

    //组合申请合伙人信息
    public function binationPartnerBuditData()
    {
        if(!request()->file('code_just'))
        {
            throw new ParameterException([
                'msg' => '身份证正面不能为空'
            ]);
        }

        if(!request()->file('code_back'))
        {
            throw new ParameterException([
                'msg' => '身份证反面不能为空'
            ]);
        }

        if(!request()->file('id_photo'))
        {
            throw new ParameterException([
                'msg' => '一寸照片不能为空'
            ]);
        }
        $codeJust = Upload::image('code_just');
        $codeBack = Upload::image('code_back');
        $photo = Upload::image('id_photo');


        $partnerAuditData = [
            'name' => input('name') ,   //姓名
            'sex' => input('sex') ,       //年龄
            'birthday' => input('birthday') ,  //生日
            'address' => input('address'),       //地址
            'id_code_just' => $codeJust ,       // 身份证正面
            'id_code_back' => $codeBack ,       // 身份证反面
            'id_photo' => $photo ,          //一寸照片
            'phone' => input('phone') ,         //手机
            'city' => input('city') ,          //所在市
            'province' => input('province') ,          //所在省
            'county' => input('county') ,          //所在县
            'town' => input('town') ,          //所在镇
            'referee_phone' => input('referee_phone') , //推荐人手机号
            'referee' => input('referee')  ,          //推荐人姓名
            'user_id' => $this->userId ,       //用户id
            'order_no' => makeOrderNo(),
            'type'=> input('type'),
        ];
        (new PartnerAuditValidate())->goCheck($partnerAuditData);
        return $partnerAuditData;

    }

    private function  whetherPartner()
    {
        $phone = input('phone');
        $result = PartnerAudit::get([ 'phone'=> $phone]);
        if( !$result ) return true;
        if( $result['examine_status'] == 1 )
        {
            throw new PartnerException([
                'msg' => '您已经是合伙人了',
                'errCode' => 80003
            ]);
        }
        if( $result['examine_status'] == 3 )
        {
            throw new PartnerException([
                'msg' => '您的申请还在审核当中,请耐心等待。',
                'errCode' => 80003
            ]);
        }
        return true;
    }



    //获取合伙人名片
    public function getPartnerInfo($userId)
    {
        //获取合伙人数据
        $partner_data = UserData::getPartnerDataById($userId);
        if( empty($partner_data))
        {
            throw new PartnerException();
        }
        return $partner_data;
    }


    public function checkPartnerIs()
    {
        $refee_phone = input('referee_phone') ;
        $refeePartner = UserData::get([ 'ud_phone'=> $refee_phone, 'type'=>2 ]);
        if( !$refeePartner )
        {
            throw new ParameterException([
                'msg'=> '推荐人必须是合伙人'
            ]);
        }
        return true;
    }


}