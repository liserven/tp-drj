<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\phpStudy\WWW\zgmrw\public/../application/admin\view\sort\getsortbypid.html";i:1517296048;}*/ ?>
<?php if(is_array($sort) || $sort instanceof \think\Collection || $sort instanceof \think\Paginator): $i = 0; $__LIST__ = $sort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
<?php endforeach; endif; else: echo "" ;endif; ?>