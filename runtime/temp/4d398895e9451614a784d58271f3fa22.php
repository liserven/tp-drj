<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"D:\phpStudy\WWW\drhome\public/../application/admin\view\villa\unvilla.html";i:1526882744;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\layout.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\header.html";i:1525942363;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\footer.html";i:1525422713;}*/ ?>
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
    <legend>别墅列表
        <a href="<?php echo url('user/leadingin'); ?>" class="layui-btn layui-btn-danger layui-btn-small">批量导入</a>
        <a href="<?php echo url('user/expuser'); ?>" class="layui-btn layui-btn-warm layui-btn-small">批量导出</a>
        <a href="javascript:;" class="layui-btn layui-btn-default layui-btn-small refresh"><i class="layui-icon">&#x1002;</i>刷新</a>
    </legend>
</fieldset>
<div class="layui-col-md12 layui-col-md-offset4">
    <div class="layui-form-query">
        <form class="layui-form" id="query_form" action="<?php echo url('villa/lookup'); ?>">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-mid">别墅名称：</label>
                    <div class="layui-input-inline">
                        <input name="name" title="请输入建材名称" class="layui-input" type="text">
                    </div>

                </div>
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <button class="layui-btn" type="submit" lay-submit="seach_phone"><i class="layui-icon"></i>查询</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="layui-form layui-border-box layui-table-view" lay-filter="content-box" style="padding: 20px;border: 0;">
    <div class="layui-table-box">
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

                <th data-field="id">
                    <div class="layui-table-cell laytable-cell-1-id">
                        <span>ID</span>

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
                <th>
                    <div class="layui-table-cell"><span>占地面积</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>建筑面积</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>层高</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>用户门</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>窗户</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>屋面瓦</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>外墙</span></div>
                </th>
                <th data-field="createdTime">
                    <div class="layui-table-cell"><span>缩略图</span></div>
                </th>
                <th data-field="type">
                    <div class="layui-table-cell"><span>推荐首页</span></div>
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
            <?php if(is_array($page) || $page instanceof \think\Collection || $page instanceof \think\Paginator): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr data-index="0" class="tbody_content" data-id="<?php echo $vo['id']; ?>">
                    <td >
                        <div class="layui-table-cell"><?php echo $key; ?></div>
                    </td>

                    <td>
                        <div class="layui-table-cell"><?php echo $vo['id']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['vd_name']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['vd_price']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['vd_unit_price']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['vd_covers_area']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['vd_building_area']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo msubstr($vo['vd_height'],0,8); ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['vd_door']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['vd_windows']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['vd_wmw']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo msubstr($vo['vd_wq'],0,8); ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><img src="<?php echo $vo['vd_logo']; ?>?imageView2/1/w/50/h/50"></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['is_index']==1?'是':'否'; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['room']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['office']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['wei']; ?></div>
                    </td>


                    <td>
                        <div class="layui-table-cell">

                            <a class="layui-btn layui-btn-xs layui-btn-normal regain" data-id="<?php echo $vo['id']; ?>">上架</a>
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
