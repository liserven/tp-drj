<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"D:\phpStudy\WWW\drj\public/../application/admin\view\quinta\tolist.html";i:1521104355;s:54:"D:\phpStudy\WWW\drj\application\admin\view\layout.html";i:1519356432;s:54:"D:\phpStudy\WWW\drj\application\admin\view\header.html";i:1519809078;s:54:"D:\phpStudy\WWW\drj\application\admin\view\footer.html";i:1519356432;}*/ ?>

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
    
<tr>
    <td class="tableleft">标题</td>
    <td>
        <input name="title" type="text" id="title" style="width:150px;vertical-align:middle;"      maxlength="40"  >
        <lable>文件名</lable>
        <input name="filename" type="text" id="filename" style="width:150px;vertical-align:middle;" maxlength="40" >
        <lable>时间</lable>
        <input name="time" type="text" id="time" style="width:150px;vertical-align:middle;" maxlength="40" onClick="WdatePicker()">
        <lable>内容简介</lable>
        <input name="content"  type="text" id="content" style="width:300px;vertical-align:middle;" maxlength="50"  >

    </td>

</tr>
<input type="button"   class="btn btn-success"  value="增加" id="addTable" onclick="add_tr(this)"/>
<input type="button"  class="btn btn-success"   value="删除" id="deleteTable" onclick="del_tr(this)"/>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script>
    function add_tr(obj) {
        var tr = $(obj).siblings(tr);
        tr.after(tr.clone());
    }
    function del_tr(obj) {
        $(obj).parent().parent().remove();
    }
</script>

</div>

<?php if(($aName == 'doadd') OR ($aName == 'doedit')): ?>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/ueditor.all.min.js"></script>
    <script type="text/javascript" src="__STATIC__/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="__STATIC__/qiniu/dist/qiniu.min.js"></script>
    <script src="__JS__/<?php echo $mName; ?>/wangEditor/release/wangEditor.js"></script>

<?php endif; ?>
<script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>

<?php if(($cName == 'Index')): ?>
    <script type="text/javascript" src="__JS__/<?php echo $mName; ?>/chat.js"></script>
    <script type="text/javascript" src="__JS__/jquery-3.2.1.min.js"></script>
<?php endif; ?>
    </body>
</html>
