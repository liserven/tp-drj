<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\phpStudy\WWW\zgmrw\public/../application/home\view\policies\getpagelist.html";i:1517378781;}*/ ?>
<?php if(is_array($page) || $page instanceof \think\Collection || $page instanceof \think\Paginator): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <dd><a href="policiefood.html"><?php echo $vo['title']; ?></a><span><?php echo $vo['create_at']; ?></span></dd>
<?php endforeach; endif; else: echo "" ;endif; ?>