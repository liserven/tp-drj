<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\phpStudy\WWW\zgmrw\public/../application/admin\view\city\getcitybyprovince.html";i:1517393701;}*/ ?>
    <?php if(is_array($citys) || $citys instanceof \think\Collection || $citys instanceof \think\Paginator): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['city']; ?></option>
    <?php endforeach; endif; else: echo "" ;endif; ?>
