<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"D:\phpStudy\WWW\zgmrw\public/../application/admin\view\hospital\doedit.html";i:1517221823;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\layout.html";i:1516347325;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\header.html";i:1516347325;s:56:"D:\phpStudy\WWW\zgmrw\application\admin\view\footer.html";i:1517209356;}*/ ?>

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
            <label class="layui-form-label">名称：</label>
            <div class="layui-col-md3">
                <input type="text" name="name" lay-verify="required" value="<?php echo $data['name']; ?>" placeholder="请输入标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">电话：</label>
            <div class="layui-col-md3">
                <input type="text" name="phone" lay-verify="phone" value="<?php echo $data['phone']; ?>" placeholder="请输入手机" class="layui-input">
            </div>
        </div>
        <!--<div class="layui-form-item">-->
            <!--<label class="layui-form-label">国家</label>-->
            <!--<div class="layui-col-md3">-->
                <!--<input type="text" name="phone" lay-verify="required" placeholder="请输入地址" class="layui-input">-->
            <!--</div>-->
        <!--</div>-->
        <div class="layui-form-item">
            <label class="layui-form-label">所在地区：</label>
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
                	<option value="<?php echo $data['city']; ?>"><?php echo $data['city']; ?></option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">详细地址</label>
            <div class="layui-col-md3">
                <input type="text" name="address" lay-verify="required" value="<?php echo $data['address']; ?>" placeholder="请输入详细地址" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">资本类型：</label>
            <div class="layui-input-inline">
                <select name="capital_type" lay-verify="">
                    <option value="私立医院" <?php if($data['capital_type'] == '私立医院'): ?>selected<?php endif; ?> >私立医院</option>
                    <option value="私立医院" <?php if($data['capital_type'] == '公立医院'): ?>selected<?php endif; ?> >公立医院</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">成立时间</label>
            <div class="layui-col-md3">
                <input type="text" name="establish" lay-verify="required" id="establish" value="<?php echo $data['establish']; ?>" placeholder="请输入成立时间" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">医院形象图：</label>
            <div class="layui-col-md3">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="logo">上传图片</button>
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" src="<?php echo $data['logo']; ?>" id="logo_yl_img">
                        <p id="demoText"></p>
                    </div>
                </div>
                <input type="hidden" name="logo" value="<?php echo $data['logo']; ?>" id="logo_img">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">营业许可证：</label>
            <div class="layui-col-md3">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="yzzz">上传图片</button>
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" src="<?php echo $data['yzzz_img']; ?>" id="yzzz_yl_img">
                        <p id="demoText1"></p>
                    </div>
                </div>
                <input type="hidden" name="yyzz" value="<?php echo $data['yzzz_img']; ?>" id="yzzz_img">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">执业许可证：</label>
            <div class="layui-col-md3">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="zyxkz">上传图片</button>
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" src="<?php echo $data['zyxkz_img']; ?>" id="zyxkz_yl_img">
                        <p id="demoText2"></p>
                    </div>
                </div>
                <input type="hidden" name="zyxkz" value="<?php echo $data['zyxkz_img']; ?>" id="zyxkz_img">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">医疗审查证明：</label>
            <div class="layui-col-md3">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="ylsczm">上传图片</button>
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" src="<?php echo $data['ylsczm_img']; ?>" id="ylsczm_yl_img">
                        <p id="demoText3"></p>
                    </div>
                </div>
                <input type="hidden" name="ylsczm" value="<?php echo $data['ylsczm_img']; ?>" id="ylsczm_img">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">服务类型：</label>
            <div class="layui-input-inline">
                <select name="pid" lay-verify="" lay-filter="service">
                    <option value="">请选择</option>
                    <?php if(is_array($service) || $service instanceof \think\Collection || $service instanceof \think\Paginator): $i = 0; $__LIST__ = $service;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>" <?php if($data['service']['pid'] == $vo['id']): ?>selected<?php endif; ?> ><?php echo $vo['type']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">医院类型：</label>
            <div class="layui-input-inline">
                <select name="service type" class="service_type" lay-verify="">
                    <option value="<?php echo $data['service']['id']; ?>"><?php echo $data['service']['type']; ?></option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">擅长项目</label>
            <div class="layui-col-md3">
                <?php if(is_array($project) || $project instanceof \think\Collection || $project instanceof \think\Paginator): $i = 0; $__LIST__ = $project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <input type="checkbox" name="project[]" title="<?php echo $vo['name']; ?>" value="<?php echo $vo['id']; ?>" lay-skin="primary" <?php if(in_array( $vo['id'], array_column($data['projects'], 'project_id') )): ?>checked<?php endif; ?>  >
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">医院介绍</label>
            <div class="layui-col-md3">
                <textarea name="message" required lay-verify="required" placeholder="请输入介绍" class="layui-textarea"><?php echo $data['message']; ?></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">上班时间</label>
            <div class="layui-col-md3">
                <input type="text" id="business_start_time" name="business_start_time" value="<?php echo $data['business_start_time']; ?>"  lay-verify="required" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">下班时间</label>
            <div class="layui-col-md3">
                <input type="text" id="business_over_time" name="business_over_time" value="<?php echo $data['business_over_time']; ?>" lay-verify="required" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">顺序</label>
            <div class="layui-col-md1">
                <input type="number" name="order" value="99"  lay-verify="required"  value="<?php echo $data['order']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
            	<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
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
