layui.use(['layer','custom','upload','laydate'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom
        ,upload = layui.upload
        ,laydate = layui.laydate;
        
        
   common.QiniuUpload();

    laydate.render({
        type: 'datetime',
        elem:"#start_time"
    });

    laydate.render({
        type: 'datetime',
        elem:"#over_time"
    });

//监听提交
    form.on('submit(formDemo)', function(data){
        $.post('doAdd', data.field, function (result) {
            common.dMsg(result);
        });
        return false;
    });



});

