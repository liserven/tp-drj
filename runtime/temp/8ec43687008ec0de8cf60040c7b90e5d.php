<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\phpStudy\WWW\drhome\public/../application/admin\view\partner\aliPayFind.html";i:1525686587;}*/ ?>
<div>
    <p>付款人手机: <span class=""><?php echo $data['phone']; ?></span></p>
    <p>付款时间: <span class=""><?php echo $data['pay_time']; ?></span></p>
    <p>付款金额: <span class=""><?php echo $data['total']; ?></span></p>
    <p>支付宝流水号: <span class=""><?php echo $data['zfb_order_no']; ?></span></p>
    <p>付款人状态: <span class=""><?php echo aliPayStatus($data['pay_status']); ?></span></p>
    <p>审核订单号: <span class=""><?php echo $data['order_no']; ?></span></p>
</div>