<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"D:\phpStudy\WWW\drhome\public/../application/admin\view\custom\tolist.html";i:1528697465;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\layout.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\header.html";i:1525942363;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\footer.html";i:1525422713;}*/ ?>
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
    
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>客服列表
        <a href="javascript:;" class="layui-btn layui-btn-small add">添加客服</a>
    </legend>
</fieldset>
<div class="layui-form layui-border-box layui-table-view" lay-filter="content-box" style="padding: 20px;border: 0;">
    <div class="layui-table-box">
        <table class="layui-table" style="width: 100%; border: 1px solid #eee">
          <colgroup>
            <col width="50">
            <col width="50">
          </colgroup>
            <thead>
            <tr>
                <th data-field="id">
                    <div class="layui-table-cell laytable-cell-1-id">
                        <span>ID</span>

                    </div>
                </th>
                <th data-field="name">
                    <div class="layui-table-cell laytable-cell-1-name">
                        <span>用户名</span>
                        <span class="layui-table-sort layui-inline">
                    </span>
                    </div>
                </th>
                <th data-field="type">
                    <div class="layui-table-cell"><span>手机号</span></div>
                </th>
                <th data-field="city">
                    <div class="layui-table-cell"><span>头像</span></div>
                </th>
                <th data-field="sex">
                    <div class="layui-table-cell"><span>性别</span></div>
                </th>
                <th data-field="state">
                    <div class="layui-table-cell"><span>地区</span></div>
                </th>
                <th data-field="state">
                    <div class="layui-table-cell"><span>个人说明</span></div>
                </th>
                <th data-field="modifiedTime">
                    <div class="layui-table-cell"><span>操作</span></div>
                </th>
            </tr>
            </thead>
            <tbody class="">
            <?php if(is_array($page) || $page instanceof \think\Collection || $page instanceof \think\Paginator): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr data-index="0" class="tbody_content" data-id="<?php echo $vo['ud_id']; ?>">

                <td>
                    <div class="layui-table-cell"><?php echo $vo['ud_id']; ?></div>
                </td>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['ud_name']; ?></div>
                </td>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['ud_phone']; ?></div>
                </td>
                <td>
                    <div class="layui-table-cell" style="height:55px;">
                        <img src="<?php echo $vo['ud_logo']; ?>?imageView2/1/w/50/h/50" alt="">
                    </div>
                </td>
                <?php if($vo['ud_sex'] == 1): ?>
                    <td>
                        <div class="layui-table-cell">男</div>
                    </td>
                    <?php elseif($vo['ud_sex'] == 2): ?>
                        <td>
                            <div class="layui-table-cell">女</div>
                        </td>
                    </elseif>
                    <?php else: ?>
                        <td>
                            <div class="layui-table-cell">保密</div>
                        </td>
                    </else>

                <?php endif; ?>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['ud_address']; ?></div>
                </td>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['message']; ?></div>
                </td>
                <td class="layui-table-cell ">
                    <input type="hidden" id="id" value="<?php echo $vo['ud_id']; ?>">

                    <a class="layui-btn layui-btn-xs edit">编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs do_del">删除</a>


                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="13"><?php echo $page->render();; ?></td>
            </tr>
            </tfoot>
        </table>

    </div>
</div>
</div>
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
