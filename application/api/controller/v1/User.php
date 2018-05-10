<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23
 * Time: 18:46
 */

namespace app\api\controller\v1;
use app\common\lib\Upload;
use app\common\model\GrabRed;
use app\common\model\OpinionBack;
use app\common\model\UserData;
use app\common\model\UserDelivery;
use app\common\model\UserNeed;
use app\common\service\UserService;
use app\common\validate\AddressValidate;
use app\common\validate\IDMustBePositiveInt;
use app\lib\exception\UserException;
use think\Db;

/**
 * Class User
 * @package app\api\controller\v1
 * 用户控制器
 */
class User extends Base
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    protected $beforeActionList = [
        //前置操作 必须是用户才能访问
        'checkLogin' => [ 'except'=> 'confirmBinding' ],
        'checkUserScope' => [ 'only'=> 'confirmBinding'],
        'checkPartner' => ['only' => 'getNeed,editNeed']
    ];

    // 合伙人获取用户基本信息
    public function PartnerGetUserInfo($uid)
    {

    }

    //获取用户个人信息
    public function getUserInfo()
    {
        $userData = UserData::getUserInfoById($this->user['ud_id']);
        if( $this->user['type'] == 2 )
        {
            $userData['reds'] = Db::table('give_red')->where(['user_id'=>$this->user['ud_id']])->count();

        }else{
            $userData['reds'] = GrabRed::where(['phone'=>$userData['ud_phone']])->count();
        }
        $userData['reds'] = GrabRed::where(['phone'=>$userData['ud_phone']])->count();
        $userData['customer'] = Db::table('villa_order')->where(['partner_id'=> $this->user['ud_id']])->count();
        $userData['town'] = $userData['town'] ? $userData['town'] : false;
        $userData['url'] = config('app.root_url').'share/card?id='.$userData['ud_id'];
        $villaOrder = Db::table('villa_order')->where(['user_id'=> $this->user['ud_id']])->field('id, order_id, user_id, villa_type, 
        
        villa_name, villa_img, status')->find();
        if( !empty($villaOrder))
        {
            $villaOrderDetail = Db::table('villa_order_detail')->where(['order_id'=> $villaOrder['id']])->select();
            $villaOrder['details'] = $villaOrderDetail;
            $userData['villa_order'] = $villaOrder;
        }
        else{
            $userData['villa_order'] = [];
        }
        if( empty($userData) )
        {
            throw new UserException([
                'msg' => '未找到该用户'
            ]);
        }
        return show(true, 'ok', $userData);
    }


    //用户回馈接口
    public function addFeedback()
    {
        if( $this->request->isPost() )
        {

            $data['uid'] = $this->user['ud_id'];
            $data['content'] = input('post.content');
            try{
                $result = OpinionBack::create($data);
                if( $result )
                {
                    return show( true, '感谢您的反馈...');
                }else{
                    return show( false, '反馈失败');
                }
            }catch (\Exception $e){
                return show( false, $e->getMessage() );
            }
        }else{
            throw new MethodException();
        }
    }

    /**
     * 更改头像
     * @return \think\response\Json
     */
    public function editLogo()
    {
        if($this->request->isPost()){
            if( !$this->request->file())
            {
                throw new UserException([
                    'msg' => '无提交图片'
                ]);
            }
            $logo = Upload::image();
            $data['ud_logo'] = $logo;
            try{
                $result = UserData::where('ud_id',$this->user['ud_id'])->update($data);
                if( $result )
                {
                    return show( true, '修改成功', [ 'logo'=>$data['ud_logo'] ]);
                }
                else{
                    return show( false,'修改失败');
                }
            }catch (\Exception $e){
                return show(false,$e->getMessage());
            }
        }
    }

    /**
     * @url api/v1/user/einfo  路由地址
     * @param 个人需要修改的资料
     * @return 返回 成功更新个人资料 失败返回原因
     */
    public function editInfo(){
        if( $this->request->isPost())
        {
            $data = input('post.');
            if( empty($data) )
            {
                return show(false,'没有修改的内容');
            }
            $userModel = new UserData();
            $userData = $userModel->find($this->user['ud_id']);
            if( !$userData )
            {
                throw new UserException();
            }
            if( !empty($data['username'] ))
            {
                $userData->ud_name = $data['username'];
            }
            if( !empty($data['sex'] ))
            {
                $userData->ud_sex = $data['sex'];
            }
            //修改用户个性签名
            if( !empty($data['message'] ))
            {
                $userData->message = $data['message'];
            }
            if( $userData->save() )
            {
                return show(true,'修改成功', $data);
            }else{
                return show( false,'修改失败,或没有更改',[]);
            }
        }
    }


    //获取收货地址列表
    public function getAddressList()
    {
        $addressList = Db::table('user_delivery')->where([ 'uid'=> $this->user['ud_id']])->order([ 'is_default'=> 'asc'])->select();
        if( empty($addressList))
        {
            throw new UserException([
                'msg' => '还没有地址呢',
            ]);
        }
        return show( true, 'ok', $addressList);
    }




    //添加收货地址
    public function addAddress()
    {
        $userDeliveryModel = new UserDelivery();
        $data = [
            'u_name' => input('name'),
            'u_phone' => input('phone'),
            'u_other' => input('address'),
            'u_save' => input('province'),
            'u_city' => input('city'),
            'u_town' => input('town'),
            'u_county' => input('county'),
            'is_default' => input('is_default') ? input('is_default') : 2,
            'uid' => $this->user['ud_id']
        ];
        //验证数据
        (new AddressValidate())->goCheck($data);
        if( $data['is_default'] == 1 )
        {
            //如果为1就是要设置为默认， 如果之前有默认的， 修改为不默认的， 将当前设置为默认。
            $userDeliveryModel->save([ 'is_default'=> 2],[ 'uid'=> $this->user['ud_id'] ]);
        }
        try{
            $result =UserDelivery::create($data);
            return $this->resultHandle($result);
        }catch (\Exception $e){
            return show(false, $e->getMessage());
        }
    }

    //修改收货地址
    public function editAddress()
    {
        $userDeliveryModel = new UserDelivery();
        $data = [
            'u_name' => input('name'),
            'u_phone' => input('phone'),
            'u_other' => input('address'),
            'u_save' => input('province'),
            'u_city' => input('city'),
            'u_town' => input('town'),
            'u_county' => input('county'),
            'is_default' => input('is_default') ? input('is_default') : 2,
            'id' => input('id')
        ];
        $data = array_filter($data);

        //验证数据
        if( $data['is_default'] == 1 )
        {
            //如果为1就是要设置为默认， 如果之前有默认的， 修改为不默认的， 将当前设置为默认。
            $userDeliveryModel->save([ 'is_default'=> 2], [ 'uid'=> $this->user['ud_id']]);
        }
        $result = UserDelivery::update($data);
        return $this->resultHandle($result);
    }

    //将地址设为默认
    public function editAddressDefault($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $address = UserDelivery::get($id);
        $userDeliveryModel = new UserDelivery();
        if( !$address || $address['uid'] != $this->user['ud_id'])
        {
            throw new UserException([
                'msg'=> '该地址不是你的，或者不存在'
            ]);
        }
        $userDeliveryModel->save([ 'is_default'=> 2], [ 'uid'=> $this->user['ud_id']]);
        $address->is_default = 1;
        return $this->resultHandle($address->save());
    }

    //删除地址
    public function delAddress( $id )
    {
        (new IDMustBePositiveInt())->goCheck();
        $userId = $this->user['ud_id'];
        $address = UserDelivery::get($id);
        if( $address['uid'] != $userId )
        {
            throw new UserException([
                'msg' => '该地址不是你的哦'
            ]);
        }
        try{
            $address->delete();
            return show(true , 'ok', []);
        }catch (\Exception $e)
        {
            return show( false, $e->getMessage(), []);
        }





    }

    //设置用户接收推送开关
    public function setUserPush( $type=1 )
    {
        $data = [
            'ud_id' => $this->user['ud_id'],
            'ud_push' => $type,
        ];
        return $this->resultHandle(UserData::update($data));
    }

    /**
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function getNeed()
    {
        $id = input('user_id');
        $data = UserNeed::get([ 'user_id'=> $id, 'partner_id'=> $this->user['ud_id']]);
        return show(true, 'ok', $data);
    }

    public function editNeed()
    {
        $userId = input('user_id');
        $needData = UserNeed::get([ 'user_id'=> $userId, 'partner_id'=> $this->user['ud_id']]);
        if( !$needData )
        {
            $data['un_name'] = input('name');
            $data['un_phone'] = input('phone');
            $data['un_address'] = input('address');
            $data['un_area_covered'] = input('covered');
            $data['un_pattern'] = input('pattern');
            $data['un_floor'] = input('floor');
            $data['un_layout'] = input('layout');
            $data['un_remarks'] = input('remarks');
            $data['user_id'] =  $userId;
            $data['partner_id'] =  $this->user['ud_id'];
            $data['un_topic'] =  input('topic');
            $result = UserNeed::create($data);
        }
        else{
            $needData->un_name = input('name');
            $needData->un_phone = input('phone');
            $needData->un_address = input('address');
            $needData->un_area_covered = input('covered');
            $needData->un_pattern = input('pattern');
            $needData->un_floor = input('floor');
            $needData->un_layout = input('layout');
            $needData->un_remarks = input('remarks');
            $needData->un_topic =  input('topic');
            $result = $needData->save();
        }
        return $this->resultHandle($result);
    }



    public function confirmBinding($partner_id)
    {
        return $this->resultHandle((new UserService())->ConfirmBindingPartner($this->user['ud_id'], $partner_id));
    }
    //用户反馈
    public function Feedback()
    {
        $type = input('type');
        $content = input('content');
        $result = Db::table('opinion_back')->insert([
            'type'=> $type,
            'content'=> $content,
            'uid'=> $this->user['ud_id']
        ]);
        return $this->resultHandle($result);
    }





}