<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"D:\phpStudy\WWW\drhome\public/../application/admin\view\ordlist\tolist.html";i:1526293112;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\layout.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\header.html";i:1525942363;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\footer.html";i:1525422713;}*/ ?>
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
    <legend>别墅订单
        <a href="javascript:;" class="layui-btn layui-btn-default layui-btn-small refresh"><i class="layui-icon">&#x1002;</i>刷新</a>
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
                        <span>订单编号</span>
                    </div>
                </th>
                <th data-field="type">
                    <div class="layui-table-cell"><span>客户名称</span></div>
                </th>
                <th data-field="type">
                    <div class="layui-table-cell"><span>客户手机号</span></div>
                </th>
                <th data-field="type">
                    <div class="layui-table-cell"><span>客户住址</span></div>
                </th>

                <th data-field="createdTime">
                    <div class="layui-table-cell"><span>合伙人名称</span></div>
                </th>
                <th data-field="createdTime">
                    <div class="layui-table-cell"><span>合伙人手机号</span></div>
                </th>
                <th data-field="modifiedTime">
                    <div class="layui-table-cell"><span>别墅类型</span></div>
                </th>
                <th data-field="modifiedTime">
                   <div class="layui-table-cell"><span>证书照片</span></div>
                </th>
                <th data-field="modifiedTime">
                    <div class="layui-table-cell"><span>别墅照片</span></div>
                </th>
                <th data-field="modifiedTime">
                    <div class="layui-table-cell"><span>施工状态</span></div>
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
                        <div class="layui-table-cell"><?php echo $vo['order_id']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['user_id']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['user_phone']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['address']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['partner_id']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo $vo['par_phone']; ?></div>
                    </td>

                    <td>
                        <div class="layui-table-cell"><?php echo $vo['villa_type']==1?'标准别墅':'定制别墅'; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><img src="<?php echo $vo['contract']; ?>?imageView2/1/w/50/h/50"></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><img src="<?php echo $vo['villa_img']; ?>?imageView2/1/w/50/h/50"></div>
                    </td>

                    <td>
                        <?php if($vo['status'] == '1'): ?>
                        <div class="layui-table-cell">签订合同</div>
                        <?php endif; if($vo['status'] == '2'): ?>
                            <div class="layui-table-cell">施工中</div>
                        <?php endif; if($vo['status'] == '3'): ?>
                            <div class="layui-table-cell">已完工</div>
                        <?php endif; ?>
                    </td>

                   

                    <td>
                        <div class="layui-table-cell">

                            <a class="layui-btn layui-btn-danger layui-btn-xs do_del">删除</a>


                        </div>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
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