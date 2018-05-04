<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:73:"D:\phpStudy\WWW\zgmrw\public/../application/admin\view\meeting\doadd.html";i:1517363466;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\layout.html";i:1516347325;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\header.html";i:1516347325;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\footer.html";i:1517209356;}*/ ?>

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
    
<div class='layui-row' style="padding: 20px;">
    <form class="layui-form" method="post" action="<?php echo url('admin/Banner/doAdd'); ?>" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-col-md3">
                <input type="text" name="title" lay-verify="required" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">海报：</label>
            <div class="layui-col-md3">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="img-upload">上传图片</button>
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" id="yl-img">
                        <p id="error-box"></p>
                    </div>
                </div>
                <input type="hidden" name="logo" id="input-form">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否收费：</label>
            <div class="layui-input-block">
                <input type="radio" name="money" value="1" lay-filter="money" title="收费" checked>
                <input type="radio" name="money" value="2" lay-filter="no-money" title="免费">
            </div>
        </div>
        <div class="layui-form-item money-bz">
            <label class="layui-form-label">费用标准</label>
            <div class="layui-col-md3">
                <input type="number" name="charge_money" lay-verify="required" placeholder="请输入价格" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">举办地区：</label>
            <div class="layui-input-inline">
                <select name="ppid" lay-verify="" lay-filter="province">
                    <option value="0">请选择</option>
                    <?php if(is_array($province) || $province instanceof \think\Collection || $province instanceof \think\Paginator): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['provinceID']; ?>"><?php echo $vo['province']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="layui-input-inline ">
                <select name="city" class="city" lay-verify="">
                    <option value="0">请选择</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">会议类型：</label>
            <div class="layui-input-inline">
                <select name="sort" lay-verify="" lay-filter="">
                    <option value="0">请选择</option>
                    <?php if(is_array($meetingSort) || $meetingSort instanceof \think\Collection || $meetingSort instanceof \think\Paginator): $i = 0; $__LIST__ = $meetingSort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">详细地址：</label>
            <div class="layui-col-md3">
                <input type="text" name="address" lay-verify="required" placeholder="请输入详细地址" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">会议介绍：</label>
            <div class="layui-col-md3">
                <textarea name="message" required lay-verify="required"  style="width:600px;" placeholder="请输入" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">主办方：</label>
            <div class="layui-col-md9">
                <?php if(is_array($partner) || $partner instanceof \think\Collection || $partner instanceof \think\Paginator): $i = 0; $__LIST__ = $partner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" name="zbf[]" title="<?php echo $vo['name']; ?>" value="<?php echo $vo['id']; ?>" lay-skin="primary">
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">联合主办：</label>
            <div class="layui-col-md9">
                <?php if(is_array($partner) || $partner instanceof \think\Collection || $partner instanceof \think\Paginator): $i = 0; $__LIST__ = $partner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" name="lhzb[]" title="<?php echo $vo['name']; ?>" value="<?php echo $vo['id']; ?>" lay-skin="primary">
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">协办单位：</label>
            <div class="layui-col-md9">
                <?php if(is_array($partner) || $partner instanceof \think\Collection || $partner instanceof \think\Paginator): $i = 0; $__LIST__ = $partner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" name="xbdw[]" title="<?php echo $vo['name']; ?>" value="<?php echo $vo['id']; ?>" lay-skin="primary">
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <a href="">
                    新增</a>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">合作媒体：</label>
            <div class="layui-col-md9">
                <?php if(is_array($partner) || $partner instanceof \think\Collection || $partner instanceof \think\Paginator): $i = 0; $__LIST__ = $partner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" name="hzmt[]" title="<?php echo $vo['name']; ?>" value="<?php echo $vo['id']; ?>" lay-skin="primary">
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">合作伙伴：</label>
            <a href="">
                新增</a>
            <div class="layui-col-md9">
                <?php if(is_array($partner) || $partner instanceof \think\Collection || $partner instanceof \think\Paginator): $i = 0; $__LIST__ = $partner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" name="hzhb[]" title="<?php echo $vo['name']; ?>" value="<?php echo $vo['id']; ?>" lay-skin="primary">
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">邀请嘉宾：</label>
            <div class="layui-col-md9">
                <?php if(is_array($guest) || $guest instanceof \think\Collection || $guest instanceof \think\Paginator): $i = 0; $__LIST__ = $guest;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" name="yqjb[]" title="<?php echo $vo['name']; ?>" value="<?php echo $vo['id']; ?>" lay-skin="primary">
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="hyyc">
            <div class="layui-form-item hyyc-box">
                <label class="layui-form-label">会议议程</label>
                <div class="layui-col-md2">
                    <input type="text" name="yc_start_time[]" lay-verify="required" placeholder="请输入起止时间 8:00~9:00" class="layui-input time">
                </div>
                <div class="layui-col-md3">
                    <input type="text" name="yc_zt[]" lay-verify="required" placeholder="请输入该时间段主题" class="layui-input">
                </div>
                <div class="layui-col-md3">
                    <input type="text" name="yc_guest[]" placeholder="请输入该时间段嘉宾 以,分割" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item hyyc-box">
                <label class="layui-form-label"></label>
                <div class="layui-col-md2">
                    <input type="text" name="yc_start_time[]" lay-verify="required" placeholder="请输入开始时间  8:00~9:00" class="layui-input time">
                </div>
                <div class="layui-col-md3">
                    <input type="text" name="yc_zt[]" lay-verify="required" placeholder="请输入该时间段主题" class="layui-input">
                </div>
                <div class="layui-col-md3">
                    <input type="text" name="yc_guest[]" placeholder="请输入该时间段嘉宾 以,分割" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-col-md3">
                <a href="javascript:;" class="add-yc">增加一条日程</a>
                <a href="javascript:;" class="del-yc">删除一条日程</a>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">开始时间</label>
            <div class="layui-col-md3">
                <input type="text" id="start_time" name="start_time" lay-verify="required" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">结束时间</label>
            <div class="layui-col-md3">
                <input type="text" id="over_time" name="over_time" lay-verify="required" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否启用</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="启用" checked>
                <input type="radio" name="status" value="2" title="停用">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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
<?php endif; ?>
<script src="__JS__/<?php echo $mName; ?>/<?php echo $cName; ?>/<?php echo $aName; ?>.js"></script>
    </body>
</html>
