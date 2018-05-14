<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\phpStudy\WWW\drhome\public/../application/admin\view\consumer\getuseraddress.html";i:1526290166;}*/ ?>
<div>
    收货地址:
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <span>收货人姓名：<?php echo $data['u_name']; ?></span><br>
                <span>收货人电话：<?php echo $data['u_phone']; ?></span><br>
                <span>收货人地址：<?php echo $data['u_save']; ?><?php echo $data['u_city']; ?><?php echo $data['u_county']; ?><?php echo $data['u_town']; ?><?php echo $data['u_other']; ?></span><br>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>