layui.use(['form','custom'], function(){
    var form = layui.form
        , $ = layui.jquery
        , common = layui.custom;


    common.ImageUploads({
        demoListView: $('#zs-detail'), //显示图片信息地方
        elem : '#zs-list', //点击选择图片按钮
        bindAction : '#zs-start-btn', //开始上传按钮
        fileName : 'zs-input',
    });

});