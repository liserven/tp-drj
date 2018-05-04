<?php
/**
 * Created by PhpStorm.
 * User: 李沈阳
 * Date: 2017/11/29
 * Time: 9:27
 */

namespace app\common\lib;


use app\common\model\PhoneCode;

class CustomSms
{
    protected $account ;
    protected $password ;
    protected $phone;



    function __construct()
    {
        $this->account = config('sms.account');
        $this->password = config('sms.pwd');
    }

    public function Sms($phone = '')
    {
        $this->phone = $phone;
        $code = generate_code();
        $content = "您本次的验证码为". $code ."若非本人操作，请不予理会，本次验证码15分钟内有效【定荣家】";
        if(!empty($this->phone)){
            $un = $this->account; //用户名
            $pw = $this->password; //密码
            $da = $this->phone; //手机号
            $sm = $content; //内容
            $result = $this->set_phone(
                $un,$pw,$da,$sm
            );
            if( $result > 0 )
            {
                /*
                 * 如果发送成功，是一个大于零的数字 不管是多少只要大于零都是成功的
                 * 成功的时候  创建数据，插入数据库
                 */
                if( $this->createSms($code) )
                {
                    return show( true, '发送成功');
                }
                else{
                    return show( false,'创建数据失败');
                }

            }else{

            }
        }
        else{
            return show(false, '什么提交都没有');
        }
    }
    private function set_phone($un,$pw,$da,$sm){
        date_default_timezone_set('PRC'); //设置默认时区为北京时间
        //将发送内容转码
        $sm = rawurlencode(mb_convert_encoding($sm, "gb2312", "utf-8"));
        //post
        $url = "https://mb345.com/ws/BatchSend2.aspx?";
        $curpost = "CorpID=".$un."&Pwd=".$pw."&Mobile=".$da."&Content=".$sm;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curpost);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    private function createSms( $code )
    {
        $data['phone'] = $this->phone;
        $data['code']  = $code;
        $data['over_time'] = time()+60*15;
        $result = PhoneCode::create($data);
        return $result;
    }

}