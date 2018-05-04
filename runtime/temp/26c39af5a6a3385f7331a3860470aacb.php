<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:70:"D:\phpStudy\WWW\drj\public/../application/admin\view\villa\lookup.html";i:1523874639;s:54:"D:\phpStudy\WWW\drj\application\admin\view\layout.html";i:1519356432;s:54:"D:\phpStudy\WWW\drj\application\admin\view\header.html";i:1519809078;s:54:"D:\phpStudy\WWW\drj\application\admin\view\footer.html";i:1523864180;}*/ ?>

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
    <legend>查询结果

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

                <th data-field="1" data-unresize="true">
                    <div class="layui-table-cell laytable-cell-1-1 laytable-cell-checkbox">
                        <input name="layTableCheckbox" lay-skin="primary" lay-filter="layTableAllChoose" type="checkbox">
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary">
                            <i class="layui-icon"></i>
                        </div>
                    </div>
                </th>
                <th data-field="id">
                    <div class="layui-table-cell laytable-cell-1-id">
                        <span>ID</span>
                        <span class="layui-table-sort layui-inline">
                            <i class="layui-edge layui-table-sort-asc"></i><i>
                            class="layui-edge layui-table-sort-desc"></i>
                        </span>
                    </div>
                </th>
                <th data-field="name">
                    <div class="layui-table-cell">
                        <span>别墅名称</span>
                    </div>
                </th>
                <th data-field="type">
                    <div class="layui-table-cell"><span>总价</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>平米价格</span></div>
                </th>
                <th data-field="createdTime">
                    <div class="layui-table-cell"><span>室</span></div>
                </th>
                <th data-field="modifiedTime">
                    <div class="layui-table-cell"><span>厅</span></div>
                </th>
                <th data-field="modifiedTime">
                    <div class="layui-table-cell"><span>卫</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>操作</span></div>
                </th>
            </tr>
            </thead>
            <tbody class="">

                <tr data-index="0" class="tbody_content" data-id="<?php echo $list['id']; ?>">

                    <td>
                        <div class="layui-table-cell">
                            <input name="layTableCheckbox" class="" lay-skin="primary" value="1" type="checkbox">
                            <div class="layui-unselect layui-form-checkbox" lay-skin="primary">
                                <i class="layui-icon"></i>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $list['id']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $list['vd_name']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $list['vd_price']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $list['vd_unit_price']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $list['room']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $list['office']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $list['wei']; ?></div>
                    </td>


                    <td>
                        <div class="layui-table-cell">
                            <a class="layui-btn layui-btn-xs edit">编辑</a>
                            <a class="layui-btn layui-btn-danger layui-btn-xs do_del">删除</a>

                        </div>
                    </td>
                </tr>

            </tbody>

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
