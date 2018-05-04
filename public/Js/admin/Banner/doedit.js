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
});

