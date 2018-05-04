<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\phpStudy\WWW\zgmrw\public/../application/admin\view\service\gettwotype.html";i:1516776259;}*/ ?>
<?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['type']; ?></option>
<?php endforeach; endif; else: echo "" ;endif; ?>
