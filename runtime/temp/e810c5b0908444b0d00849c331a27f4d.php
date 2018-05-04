<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\phpStudy\WWW\drj\public/../application/admin\view\district\getsortbypid.html";i:1524810683;}*/ ?>
<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['city_name']; ?></option>
<?php endforeach; endif; else: echo "" ;endif; ?>