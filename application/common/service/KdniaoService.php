<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 12:17
 */

namespace app\common\service;


use think\Db;

class KdniaoService
{

    private $EBusinessID;

    private $AppKey;


    public function __construct()
    {
        $config = config('kdniao');
        $this->EBusinessID = $config['EBusinessID'];
        $this->AppKey = $config['APIkey'];
    }

    public function getOrderTracesByJson($ShipperCode, $LogisticCode, $pay_time='2017-8-8'){
        $url = 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';
        $requestData= "{'OrderCode':'','ShipperCode':'".$ShipperCode."','LogisticCode':'".$LogisticCode."'}";

        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $this->AppKey);
        $result=$this->sendPost($url, $datas);

        //根据公司业务处理返回的信息......
        $result = json_decode($result, true);
        $kd_name = Db::table('express_code')->where([ 'code'=> $result['ShipperCode']])->find();
        $result['kd_name'] = $kd_name['name'];
        $arr = [
            'AcceptStation' => '支付成功',
            'AcceptTime' => date('Y-m-d H:i:s',$pay_time)
        ];
        array_unshift($result['Traces'], $arr);
        $num = (count($result['Traces'])-1);
        $traces = [];
        for ($i= $num;  $i>=0; $i-- )
        {
            $result['Traces'][$i]['AcceptStation'] = str_replace('到达：','', $result['Traces'][$i]['AcceptStation']);
            $traces[] = $result['Traces'][$i];
        }
        $result['Traces'] = $traces;
        return $result;
    }
    /**
     *  post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return url响应返回的html
     */
    public function sendPost($url, $datas) {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }

    /**
     * 电商Sign签名生成
     * @param data 内容
     * @param appkey Appkey
     * @return DataSign签名
     */
    private function encrypt($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }

}