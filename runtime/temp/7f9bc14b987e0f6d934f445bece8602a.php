<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\phpStudy\WWW\drhome\public/../application/admin\view\orbuilding\detail.html";i:1525743177;}*/ ?>
<div>
    <p>发票类型: <span class=""><?php echo $list['g_receipt']; ?></span></p>
    <p>发票抬头: <span class=""><?php echo $list['g_rise']; ?></span></p>
    <p>发票内容: <span class=""><?php echo $list['g_content']; ?></span></p>
    <p>纳税人识别号: <span class=""><?php echo $list['taxpayer_number']; ?></span></p>
    <p>收货地址: <span class=""><?php echo $page['u_save']; ?><?php echo $page['u_city']; ?><?php echo $page['u_county']; ?><?php echo $page['u_town']; ?><?php echo $page['u_other']; ?></span></p>

    <p>物流编码: <span class=""><?php echo $list['express_code']; ?></span></p>

</div>