<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\phpStudy\WWW\lsy\public/../application/admin\view\duty\doedit.html";i:1515567970;s:54:"D:\phpStudy\WWW\lsy\application\admin\view\layout.html";i:1515546977;s:54:"D:\phpStudy\WWW\lsy\application\admin\view\header.html";i:1515546977;s:54:"D:\phpStudy\WWW\lsy\application\admin\view\footer.html";i:1515546978;}*/ ?>

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
    <link rel="stylesheet" href="__CSS__/common.css">
    <link rel="icon" href="__STATIC__/static/image/code.png">
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
    
<div style="padding: 20px;">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">角色名称</label>
            <div class="layui-input-block">
                <input type="text" name="topic" value="<?php echo $data['dd_name']; ?>"  lay-verify="required" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">角色描述</label>
            <div class="layui-input-block">
                <textarea name="describe" placeholder="请输入内容" class="layui-textarea"><?php echo $data['dd_describe']; ?></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否启用</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="启用" <?php if($data['dd_status'] == '1'): ?>checked<?php endif; ?> >
                <input type="radio" name="status" value="2" title="停用" <?php if($data['dd_status'] == '2'): ?>checked<?php endif; ?> >
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">对应权限</label>
            <div class="layui-input-block">
                <?php if(is_array($actionPidList) || $actionPidList instanceof \think\Collection || $actionPidList instanceof \think\Paginator): $i = 0; $__LIST__ = $actionPidList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <fieldset class="layui-elem-field">
                        <legend><?php echo $vo['ad_topic']; ?></legend>
                        <div class="layui-field-box">
                            <?php if(is_array($vo['actions']) || $vo['actions'] instanceof \think\Collection || $vo['actions'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['actions'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <input type="checkbox" value="<?php echo $v['ad_id']; ?>" name="actions[]" title="<?php echo $v['ad_topic']; ?>" <?php if(in_array(($v['ad_id']), is_array($data['actionlist'])?$data['actionlist']:explode(',',$data['actionlist']))): ?>checked<?php endif; ?>  lay-skin="primary"  >
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </fieldset>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formEdit" id="submit">立即提交</button>
                <input type="hidden" name="id" value="<?php echo $data['dd_id']; ?>">
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

</div>
</div>
    <script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>
    </body>
</html>
