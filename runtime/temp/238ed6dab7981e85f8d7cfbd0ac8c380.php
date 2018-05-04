<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"D:\phpStudy\WWW\zgmrw\public/../application/admin\view\project\doedit.html";i:1516605135;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\layout.html";i:1516347325;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\header.html";i:1516347325;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\footer.html";i:1516347326;}*/ ?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台管理系统</title>
    <link rel="stylesheet" href="__STATIC__/layui/css/layui.css">
    <link rel="stylesheet" href="__STATIC__/static/css/style.css">
    <link rel="stylesheet" href="__STATIC__/static/css/style.css">
    <link rel="stylesheet" href="__CSS__/common.css">
    <link rel="icon" href="__STATIC__/editor/themes/simple/simple.css">
    <script src="__STATIC__/layui/layui.js"></script>
    <!--/meta 作为公共模版分离出去-->
    <script type="text/javascript">
        layui.config({
            base:'/Js/admin/',
        }).extend({
            custom : 'common'
        }).use('operation');
        var config = {
            root : "__ROOT__",
            url : "__URL__",
            curl : "__CURL__",
            uid: "<?php echo $User['am_id']; ?>",
            cName : "<?php echo $cName; ?>",
            nickname:"<?php echo $User['am_nickname']; ?>"
        };
        var baseUrl = 'http://www.zxzm.com';
    </script>

</head>
<body>

<div class="box-content">
    
<div class='layui-row' style="padding: 20px;">
    <form class="layui-form" method="post" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-col-md3">
                <input type="text" name="name" value="<?php echo $data['name']; ?>" lay-verify="required" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">顺序</label>
            <div class="layui-col-md1">
                <input type="number" name="order" value="<?php echo $data['order']; ?>"  lay-verify="required"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">上级项目：</label>
            <div class="layui-input-inline">
                <select name="pid" lay-verify="">
                	<option value="0">一级项目</option>
                    <?php if(is_array($pJect) || $pJect instanceof \think\Collection || $pJect instanceof \think\Paginator): $i = 0; $__LIST__ = $pJect;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $data['pid']): ?>selected<?php endif; ?> ><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否启用</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="启用" <?php if($data['status'] == '1'): ?>checked<?php endif; ?>>
                <input type="radio" name="status" value="2" title="停用" <?php if($data['status'] == '2'): ?>checked<?php endif; ?>>
            </div>
        </div>
        
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formEdit">立即提交</button>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
</div>
<script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>
<?php if(($aName == 'doadd') OR ($aName == 'doedit')): ?>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.all.min.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<?php endif; ?>
    </body>
</html>
