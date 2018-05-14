<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"D:\phpStudy\WWW\drhome\public/../application/admin\view\sum\tolist.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\layout.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\header.html";i:1525942363;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\footer.html";i:1525422713;}*/ ?>
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
    <link rel="icon" href="__JS__/<?php echo $mName; ?>/wangEditor/release/wangEditor.css">
    <script src="__JS__/jquery.min.js"></script>
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
    <form class="layui-form" action="<?php echo url('admin/Sum/doEdit'); ?>">
        <div class="layui-form-item">
            <label class="layui-form-label" style="width:100px" >红包单个金额</label>
            <div class="layui-input-inline">
                <input type="text" name="red_set"  lay-verify="required" placeholder="<?php echo $page['red_set']; ?>" class="layui-input" value="<?php echo $page['red_set']; ?>">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label"style="width:100px">砍价总金额</label>
            <div class="layui-input-inline">
                <input type="text" name="bargain_set"  lay-verify="required" placeholder="请输入百分比" class="layui-input"value="<?php echo $page['bargain_set']; ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"style="width:100px">砍价总人数</label>
            <div class="layui-input-inline">
                <input type="text" name="bargain_num"  lay-verify="required" placeholder="请输入百分比" class="layui-input"value="<?php echo $page['bargain_set']; ?>">
            </div>
        </div>
        <div class="layui-form-item">
        <label class="layui-form-label" style="width:100px">合伙人申请费用</label>
        <div class="layui-input-inline">
            <input type="text" name="partner_money"  lay-verify="required" placeholder="请输入百分比" class="layui-input"value="<?php echo $page['partner_money']; ?>">
        </div>
    </div>
         <input type="hidden" name="id" value="<?php echo $page['id']; ?>">
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formEdit" id="submit">立即提交</button>

            </div>
        </div>
    </form>

</div>
</div>
<?php if(($aName == 'doadd') OR ($aName == 'doedit')): ?>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.all.min.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="__STATIC__/qiniu/dist/qiniu.min.js"></script>
    <script src="__JS__/<?php echo $mName; ?>/wangEditor/release/wangEditor.js"></script>

<?php endif; ?>
<script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js?v=<?php echo time(); ?>"></script>


<?php if(($cName == 'Index')): ?>
    <script type="text/javascript" src="__JS__/<?php echo $mName; ?>/chat.js"></script>
    <script type="text/javascript" src="__JS__/jquery-3.2.1.min.js"></script>
<?php endif; ?>
    </body>
</html>
