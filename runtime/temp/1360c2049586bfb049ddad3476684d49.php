<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:76:"D:\phpStudy\WWW\drhome\public/../application/admin\view\consumer\tolist.html";i:1526954140;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\layout.html";i:1525422713;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\header.html";i:1525942363;s:57:"D:\phpStudy\WWW\drhome\application\admin\view\footer.html";i:1525422713;}*/ ?>
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
    <legend>用户列表

    </legend>
</fieldset>
<div class="layui-col-md12">
    <div class="layui-form-query">
        <form class="layui-form" id="query_form" action="">
            <div class="layui-form-item" style="padding-left:20px ;">
                <div class="layui-block">
                    <label class="layui-form-mid">地区：</label>
                    <div class="layui-input-inline">
                        <select name="provice" id="provice" lay-filter="provice">
                            <option value="">请选择</option>
                            <?php if(is_array($provice) || $provice instanceof \think\Collection || $provice instanceof \think\Paginator): $i = 0; $__LIST__ = $provice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vo['provice_name']; ?>" data-id="<?php echo $vo['provice_id']; ?>" ><?php echo $vo['provice_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="city" id="city" lay-filter="city">
                            <option value="">选择市级</option>

                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="county" id="county" lay-filter="county">
                            <option value="">选择县级</option>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="town" id="town" lay-filter="town">
                            <option value="">选择镇级</option>
                        </select>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-mid">手机号：</label>
                        <div class="layui-input-inline">
                            <input name="phone" title="请输入用户手机号" class="layui-input" type="text">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-mid">用户名：</label>
                        <div class="layui-input-inline">
                            <input name="name" title="请输入用户用户名" class="layui-input" type="text">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline">
                            <button class="layui-btn" type="submit" lay-submit="seach_phone"><i class="layui-icon"></i>查询
                            </button>
                        </div>
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
                <th data-field="sex">
                    <div class="layui-table-cell"><span>地区</span></div>
                </th>


                <th data-field="createdTime">
                    <div class="layui-table-cell"><span>注册时间</span></div>
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
                        <div class="layui-table-cell"><?php echo $vo['province']; ?><?php echo $vo['city']; ?><?php echo $vo['county']; ?><?php echo $vo['town']; ?></div>
                    </td>
                    <td>
                        <div class="layui-table-cell"><?php echo date('Y-m-d,H:i:m',$vo['create_at']); ?></div>
                    </td>

                    <td>
                        <div class="layui-table-cell">
                            <input type="hidden" id="id" value="<?php echo $vo['ud_id']; ?>">
                            <?php if($vo['status'] == '1'): ?>
                            <a class="layui-btn layui-btn-xs layui-btn-danger forbidden " data-id="<?php echo $vo['ud_id']; ?>">禁用</a>
                            <?php endif; if($vo['status'] == '2'): ?>
                                <a class="layui-btn layui-btn-xs layui-btn-danger forbiddenr " data-id="<?php echo $vo['ud_id']; ?>">取消禁用</a>
                            <?php endif; ?>
                            <input type="hidden" name="id" value="<?php echo $vo['ud_id']; ?>">
                            <a class="layui-btn layui-btn-xs layui-btn-normal getUserAddress" name="<?php echo $vo['ud_name']; ?>">详情</a>


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
