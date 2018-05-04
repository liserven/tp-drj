<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 11:47
 */

namespace app\common\service;


use app\common\model\PartnerUser;
use app\common\model\PartnerUserEum;
use app\lib\exception\ParameterException;
use app\lib\exception\PartnerException;
use enum\PartnerBindingUserEnum;
use think\Db;

class UserService
{
    public $userId;



    //确定绑定合伙人
    public function ConfirmBindingPartner($userId, $partner_id)
    {
        /**
         * 用户确定绑定关系逻辑：
         * 首先该用户不能同时绑定一个以上的合伙人，只能有一个。
         * 当他绑定完成后有一个给所有给他发起绑定关系的合伙人一个通知。
         * 当他绑定的时候有一个取消的动作 如果超出时间，无法解除绑定
         */
        $isBinding = $this->checkBinding($userId);
        if($isBinding)
        {
            throw new PartnerException([
                'msg' => '您已经存在绑定关系了',
                'errorCode' => 80010
            ]);
        }
        //如果不存在跟别人的绑定关系
        $partnerUser = PartnerUser::get([ 'pu_partner_id'=> $partner_id, 'pu_user_id'=> $userId]);
        $partnerUserEum = PartnerUserEum::get([ 'partner_id'=> $partner_id, 'user_id'=> $userId]); // 获取用户有没有接收到别的合伙人发来的绑定请求
        //如果已经是跟进状态
        Db::startTrans();
        try{
            if( $partnerUser )
            {
                //如果之前存在跟进关系就修改一下状态
                $partnerUser->status = PartnerBindingUserEnum::BINDING;
                $partnerUser->save();
            }else{
                //如果之前没有跟进 填加新的数据
                $partnerUserData = [
                    'pu_partner_id' => $partner_id,
                    'pu_user_id' => $userId,
                    'status' => PartnerBindingUserEnum::BINDING,
                ];
                PartnerUser::create($partnerUserData);
            }
            if( $partnerUserEum )
            {
                $partnerUserEum->status = 1;
                $partnerUserEum->save();
            }
            else{
                $partnerUserEumData = [
                    'partner_id'=> $partner_id,
                    'user_id'=> $userId,
                    'status'=> 1
                ];
                PartnerUserEum::create($partnerUserEumData);
            }
            //删除掉除我和当前绑定合伙人的数据外的其他数据
            PartnerUserEum::where('user_id', '<>', $userId)->delete();
            PartnerUser::where([ 'pu_user_id'=> $userId, 'pu_partner_id'=> [ 'neq', $partner_id]])->delete();
            Db::commit();
        }catch (\Exception $e){
            Db::rollback();
            throw new ParameterException([
                'msg' => $e->getMessage()
            ]);
        }
        return true;
    }




    //公共方法，
    private  function checkBinding($userId)
    {
        //查看
        //查重的思路： 可能以后会有跟进这个字段，先预留，然后就是他有这条数据并且还是绑定或者绑定更高的状态 就是已经有了绑定，即为存在重复
        $partner = PartnerUser::get(['pu_user_id'=> $userId, 'status'=>['>=',PartnerBindingUserEnum::BINDING]]);
        return !empty($partner)?$partner:false;
    }

}