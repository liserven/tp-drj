<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\phpStudy\WWW\lsy\public/../application/admin\view\link\tolist.html";i:1515659348;s:54:"D:\phpStudy\WWW\lsy\application\admin\view\layout.html";i:1515634681;s:54:"D:\phpStudy\WWW\lsy\application\admin\view\header.html";i:1515634681;s:54:"D:\phpStudy\WWW\lsy\application\admin\view\footer.html";i:1515634682;}*/ ?>

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
    
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>友情链接 <a href="javascript:;" class="layui-btn layui-btn-small add">添加链接</a>
        <a href="<?php echo url('user/leadingin'); ?>" class="layui-btn layui-btn-danger layui-btn-small">批量导入</a>
        <a href="<?php echo url('user/expuser'); ?>" class="layui-btn layui-btn-warm layui-btn-small">批量导出</a>
        <a href="javascript:;" class="layui-btn layui-btn-default layui-btn-small refresh"><i class="layui-icon">&#x1002;</i>刷新</a>
    </legend>
</fieldset>
<div class="layui-form layui-border-box layui-table-view" lay-filter="content-box" style="padding: 20px;border: 0;">
    <div class="layui-table-box" style="overflow: auto">
        <table class="layui-table" style="width: 100%; border: 1px solid #eee">
          <colgroup>
            <col width="50">
            <col width="50">
          </colgroup>
            <thead>
            <tr>
                <th data-field="0">
                    <div class="layui-table-cell laytable-cell-1-0 laytable-cell-numbers">
                        <span>#</span>
                    </div>
                </th>
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
                            <i class="layui-edge layui-table-sort-asc"></i><i
                            class="layui-edge layui-table-sort-desc"></i>
                        </span>
                    </div>
                </th>
                <th data-field="name">
                    <div class="layui-table-cell">
                        <span>标题</span>
                    </div>
                </th>
                <th data-field="type">
                    <div class="layui-table-cell"><span>地址</span></div>
                </th>
                <th data-field="type">
                    <div class="layui-table-cell"><span>logo</span></div>
                </th>
                 <th data-field="type">
                    <div class="layui-table-cell"><span>排序</span></div>
                </th>
                <th data-field="createdTime">
                    <div class="layui-table-cell"><span>创建时间</span></div>
                </th>
                <th data-field="modifiedTime">
                    <div class="layui-table-cell"><span>修改时间</span></div>
                </th>
                 <th>
                    <div class="layui-table-cell"><span>状态</span></div>
                </th>
                <th data-field="11">
                    <div class="layui-table-cell" align="center"><span>操作</span></div>
                </th>
            </tr>
            </thead>
            <tbody class="">
            <?php if(is_array($page) || $page instanceof \think\Collection || $page instanceof \think\Paginator): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr data-index="0" class="tbody_content" data-id="<?php echo $vo['id']; ?>">
                <td >
                    <div class="layui-table-cell"><?php echo $key; ?></div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <input name="layTableCheckbox" class="" lay-skin="primary" value="1" type="checkbox">
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary">
                            <i class="layui-icon"></i>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['id']; ?></div>
                </td>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['title']; ?></div>
                </td>

                <td>
                    <div class="layui-table-cell"><?php echo $vo['url']; ?></div>
                </td>
                <td>
                    <div class="layui-table-cell" style="height:50px"><img src="<?php echo $vo['logo']; ?>" alt=""></div>
                </td>
                <td>
                    <div class="layui-table-cell"><input value='<?php echo $vo['order']; ?>' class='layui-input edit-order' style='height:28px;line-height: 28px;'/></div>
                </td>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['create_at']; ?></div>
                </td>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['update_at']; ?></div>
                </td>
                <td data-id="1">
                    <div class="layui-table-cell">
                        <input type="checkbox" lay-filter="eidt_status" lay-skin="switch" lay-text="启用|停用"
                               type-d="<?php echo $vo['status']==1?2:1; ?>" <?php echo $vo['status']==1?'checked' :''; ?>>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <a class="layui-btn layui-btn-xs edit">编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs do_del">删除</a>
                        
                    </div>
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
<script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>
    </body>
</html>
