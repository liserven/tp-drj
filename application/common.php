<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//对于api返回jsonp格式数据 封装方法
/**
 * @param array $data 需要返回的数据
 * @param bool $bol 返回成功失败的状态码
 * @param string $msg 返回提示信息
 * @return string       返回可用的数据格式
 */

function makeOrderNo()
{
    $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    $orderSn =
        $yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date(
            'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
            '%02d', rand(0, 99));
    return $orderSn;
}

function returnJsonp($data = [], $bol = true, $msg = 'ok !')
{
    $result = [
        'bol' => $bol,
        'msg' => $msg,
        'data' => $data
    ];
    $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
    return $callback . '(' . json_encode($result) . ')';
}

//生成6为验证码
function generate_code($length = 6)
{
    return substr(str_shuffle("012345678901234567890123456789"), 0, $length);
}

function getNum()
{
    return [
        '零', '一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二', '十三', '十四', '十五', '十六', '十七', '十八', '十九', '二十', '二十一', '二十二', '二十三', '二十四', '二十五', '二十六', '二十七', '二十八', '二十九', '三十'
    ];
}

//将对应的数组用,号分割,便于搜索区间
function impldeArr($arr)
{
    $str = array_column($arr, 'project_id');
    return $str;
}


//接口返回方法
function show($bol = true, $msg = 'ok', $data = [], $resultCode = 10000, $code = 200)
{
    $arr = [
        'bol' => $bol,
        'msg' => $msg,
        'data' => $data,
        'code' => $resultCode
    ];

    return json($arr, $code);
}

function getComment($pid, $cpid)
{
    $tmp = [];
    $allComment = \app\common\model\Comment::all(['ac_cpid' => $cpid]);
    foreach ($allComment as $key => $val) {
        if ($val['ac_pid'] == $pid) {
            $tmp[] = $val;
        }
    }

    return $tmp;
}

//友好输出
function dd($resources)
{
    halt($resources);
}

//验证敏感字
function checkProhibit($str = '')
{
    if (empty($str)) return $str;
    //创建一个新的字符串来做为返回值
    $n_str = '';
    //获取敏感字集
    $prohibitList = model('Admin/ProhibitData')->getProhibitList();
    if (empty($prohibitList)) {
        return true;
    }
    //遍历敏感字
    foreach ($prohibitList as $key => $val) {
        //如果存在敏感字，判断敏感等级
        if (strrpos($str, $val['pd_text']) !== false && $val['pd_state'] != 2) {
            $grade = $val['sorts']['ps_grade'];
            switch ($grade) {
                //如果是一级,直接返回false,并提示
                case 1:
                    $data = ['bol' => false, 'msg' => '存在敏感字符,["' . $val['pd_text'] . '"]'];
                    return $data;
                    break;
                //如果是不是级,将替换内容
                case 2:
                    $str = str_ireplace($val['pd_text'], $val['pd_replace'], $str);
                    break;
                //如果是3级,判断出现次数
                case 3:
                    if (substr_count($str, $val['pd_text']) >= 3) {
                        $data = ['bol' => false, 'msg' => '存在敏感字符,\"' . $val['pd_text'] . '""]过多。'];
                        return $data;
                        break;
                    }
            }
        }
    }
    return $str;
}

//从富文本获取纯文本
function getSimpleText($str = '')
{
    if (!empty($str)) {
        $content_02 = htmlspecialchars_decode($str);//把一些预定义的 HTML 实体转换为字符
        $content_03 = str_replace("&nbsp;", "", $content_02);//将空格替换成空
        $contents = strip_tags($content_03);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
    } else {
        $contents = '';
    }
    return $contents;
}

//从html中提取img标签
function getSimpleImg($str = '')
{
    if (!empty($str)) {
        $result = preg_replace("/.*<img[^>]*src[=\s\"\']+([^\"\']*)[\"\'].*/", "$1", $str);
    } else {
        $result = '';
    }
    return $result;
}

//获取今天结束的时间戳
function getEndToday()
{
    $dateStr = date('Y-m-d', time());
    $timestamp24 = strtotime($dateStr) + 86400;
    return $timestamp24;
}

//获取今天开始的时间戳
function getStartToday()
{
    $dateStr = date('Y-m-d', time());
    $timestamp24 = strtotime($dateStr);
    return $timestamp24;
}

//获取本月开始时间戳
function getStartThisMouth()
{
    $beginThismonth = mktime(0, 0, 0, date('m'), 1, date('Y'));
    return $beginThismonth;
}

//获取本月结束时间戳
function getEndThisMouth()
{
    $endThismonth = mktime(23, 59, 59, date('m'), date('t'), date('Y'));
    return $endThismonth;
}

//获取昨日开始时间戳
function getStartYesterday()
{
    $beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
    return $beginYesterday;
}

//获取昨日结束时间戳
function getEndYesTerDay()
{
    $endYesterday = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 1;
    return $endYesterday;
}

/**
 * @param string $url post请求地址
 * @param array $params
 * @return mixed
 */
function curl_post($url, array $params = array())
{
    $data_string = json_encode($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt(
        $ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json'
        )
    );
    $data = curl_exec($ch);
    curl_close($ch);
    return ($data);
}

function curl_post_raw($url, $rawData)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $rawData);
    curl_setopt(
        $ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: text'
        )
    );
    $data = curl_exec($ch);
    curl_close($ch);
    return ($data);
}

/**
 * @param string $url get请求地址
 * @param int $httpCode 返回状态码
 * @return mixed
 */
function curl_get($url, &$httpCode = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //不做证书校验,部署在linux环境下请改为true
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $file_contents = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $file_contents;
}

function getRandChar($length)
{
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol) - 1;

    for ($i = 0;
         $i < $length;
         $i++) {
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}


function fromArrayToModel($m, $array)
{
    foreach ($array as $key => $value) {
        $m[$key] = $value;
    }
    return $m;
}


function format_date($time)
{
    $t = time() - intval($time);
    $f = array(
        '31536000' => '年',
        '2592000' => '个月',
        '604800' => '星期',
        '86400' => '天',
        '3600' => '小时',
        '60' => '分钟',
        '1' => '秒'
    );
    foreach ($f as $k => $v) {
        $c = floor($t / $k);
        if ($c > 0) {
            return ceil($c) . $v . '前';
        }
    }
}

//给数组按某个元素排序
function arrayMultisort($array = [], $key, $sort)
{
    $flag = array();
    foreach ($array as $arr2) {
        $flag[] = $arr2[$key];
    }

    array_multisort($flag, $sort, $array);
    return $array;
}

function getWxOpenId()
{
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . config('wx.appid') . '&secret=' . config('wx.appsrcret') . '&code=' . $code . '&grant_type=authorization_code';
        $tokenResult = curl_post($url);
        $jsonToArr = json_decode($tokenResult, true);
        //换取用户信息
        $getUserInfoUrl = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $jsonToArr["access_token"] . '&openid=' . $jsonToArr['openid'];
        $userResult = curl_post($getUserInfoUrl);
        $userInfo = json_decode($userResult, true);
        $openId = $userInfo['openid'];
        $name = $userInfo['nickname'];
        $head = $userInfo['headimgurl'];
    } else {
        header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd5b1c33a802635c3&redirect_uri=http://wh.lsybk.com/wx/' . $id . '&response_type=code&scope=snsapi_userinfo&state=1');
    }
}


function umeng_push($uid, $title)
{
    // 获取token
    $device_tokens = D('OauthUser')->getToken($uid, 2);
    // 如果没有token说明移动端没有登录；则不发送通知
    if (empty($device_tokens)) {
        return false;
    }
    // 导入友盟
    Vendor('Umeng.Umeng');
    // 自定义字段   根据实际环境分配；如果不用可以忽略
    $status = 1;
    // 消息未读总数统计  根据实际环境获取未读的消息总数 此数量会显示在app图标右上角
    $count_number = 1;
    $data = array(
        'key' => 'status',
        'value' => "$status",
        'count_number' => $count_number
    );
    // 判断device_token  64位表示为苹果 否则为安卓
    if (strlen($device_tokens) == 64) {
        $key = C('UMENG_IOS_APP_KEY');
        $timestamp = C('UMENG_IOS_SECRET');
        $umeng = new \Umeng($key, $timestamp);
        $umeng->sendIOSUnicast($data, $title, $device_tokens);
    } else {
        $key = C('UMENG_ANDROID_APP_KEY');
        $timestamp = C('UMENG_ANDROID_SECRET');
        $umeng = new \Umeng($key, $timestamp);
        $umeng->sendAndroidUnicast($data, $title, $device_tokens);
    }
    return true;
}

function aliPayStatus($status)
{
    if($status == 'TRADE_SUCCESS')
    {
        return '付款成功';
    }
}
function aliPayStatusNum($status)
{
    if($status == '4')
    {
        return '<span class="layui-badge layui-bg-green">付款成功</span>';
    }
}

//驼峰转换下划线
function toUnderScore($str){

    $array = array();
    for($i=0;$i<strlen($str);$i++){
        if($str[$i] == strtolower($str[$i])){
            $array[] = $str[$i];
        }else{
            if($i>0){
                $array[] = '_';
            }
            $array[] = strtolower($str[$i]);
        }
    }

    $result = implode('',$array);
    return $result;
}

//下划线风格转驼峰命名法
function toCamelCase($str){

    $array = explode('_', $str);
    $result = '';
    foreach($array as $value){
        $result.= ucfirst($value);
    }

    return $result;
}