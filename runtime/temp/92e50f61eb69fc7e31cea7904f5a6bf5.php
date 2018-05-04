<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"D:\phpStudy\WWW\lsy\public/../application/admin\view\index\welcome.html";i:1515634685;s:54:"D:\phpStudy\WWW\lsy\application\admin\view\layout.html";i:1515634681;s:54:"D:\phpStudy\WWW\lsy\application\admin\view\header.html";i:1515634681;s:54:"D:\phpStudy\WWW\lsy\application\admin\view\footer.html";i:1515634682;}*/ ?>

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
    <blockquote class="layui-elem-quote success-color">该系统由北京至善至美文化传播有限公司开发 <i class="layui-icon">&#xe6af;</i></blockquote>
    <fieldset class="layui-elem-field layui-col-md4">
        <legend>字段集区块 - 默认风格</legend>
        <div class="layui-field-box">
            内容区域
        </div>
    </fieldset>
</div>

</div>
<script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>
    </body>
</html>
