<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"D:\phpStudy\WWW\zgmrw\public/../application/admin\view\hospital\getdatalist.html";i:1517449072;}*/ ?>
<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <option value="<?php echo $vo['name']; ?>"></option>
<?php endforeach; endif; else: echo "" ;endif; ?>