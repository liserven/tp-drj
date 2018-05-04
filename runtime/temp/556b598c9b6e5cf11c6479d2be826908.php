<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\phpStudy\WWW\drj\public/../application/admin\view\user\tolist.html";i:1524995236;s:54:"D:\phpStudy\WWW\drj\application\admin\view\layout.html";i:1519356432;s:54:"D:\phpStudy\WWW\drj\application\admin\view\header.html";i:1519809078;s:54:"D:\phpStudy\WWW\drj\application\admin\view\footer.html";i:1523864180;}*/ ?>

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
    <legend>合伙人列表
        <a href="javascript:;" class="layui-btn layui-btn-small add">添加合伙人</a>
    </legend>
</fieldset>
<div class="layui-col-md12 layui-col-md-offset4">
    <div class="layui-form-query">
        <form class="layui-form" id="query_form" action="">
            <div class="layui-form-item">
                <div class="layui-form-label">
                    <select class="layui-form-mid">
                        <option>名称</option>
                        <option>地区</option>
                        <option>手机号</option>
                    </select>
                    <div class="layui-input-inline">
                        <input name="phone" title="请输入用户手机号" class="layui-input" type="text">
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
                    <div class="layui-table-cell"><span>拉黑</span></div>
                </th>
                <th data-field="state">
                    <div class="layui-table-cell"><span>地区</span></div>
                </th>
                <th data-field="createdTime">
                    <div class="layui-table-cell"><span>创建时间</span></div>
                </th>
                <th data-field="modifiedTime">
                    <div class="layui-table-cell"><span>修改时间</span></div>
                </th>
                <th data-field="modifiedTime">
                    <div class="layui-table-cell"><span>操作</span></div>
                </th>

            </tr>
            </thead>
            <tbody class="">
            <?php if(is_array($page) || $page instanceof \think\Collection || $page instanceof \think\Paginator): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr data-index="0" class="tbody_content" data-id="<?php echo $vo['ud_id']; ?>">
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
                <td data-id="1">
                    <div class="layui-table-cell">
                        <input type="checkbox" lay-filter="eidt_status" lay-skin="switch" lay-text="启用|停用"
                               type-d="<?php echo $vo['status']==1?2:1; ?>" <?php echo $vo['status']==1?'checked' :''; ?>>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['province']; ?><?php echo $vo['city']; ?><?php echo $vo['county']; ?><?php echo $vo['town']; ?></div>
                </td>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['create_at']; ?></div>
                </td>
                <td>
                    <div class="layui-table-cell"><?php echo $vo['update_at']; ?></div>
                </td>
                <td class="layui-table-cell ">
                      <input type="hidden" name="id" value="<?php echo $vo['ud_id']; ?>">
                    <a class="layui-btn layui-btn-xs find-ali-status" name="<?php echo $vo['ud_name']; ?>"  >查看详情</a>

                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
            <!--
            <tfoot>
                <tr>

                </tr>
            </tfoot>
            -->
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
