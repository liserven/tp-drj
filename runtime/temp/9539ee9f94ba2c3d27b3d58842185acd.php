<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\WWW\drhome\public/../application/admin\view\clum\getset.html";i:1525422713;}*/ ?>
<?php if(is_array($set) || $set instanceof \think\Collection || $set instanceof \think\Paginator): $i = 0; $__LIST__ = $set;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="layui-form-item">
        <label class="layui-form-label"><?php echo $vo['name']; ?></label>
        <div class="layui-input-inline">
            <input type="hidden" name="set_name[]" value="<?php echo $vo['name']; ?>">
            <input type="text" name="set[]" placeholder="请输入" class="layui-input" required>
        </div>
    </div>
<?php endforeach; endif; else: echo "" ;endif; ?>
