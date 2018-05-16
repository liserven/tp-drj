layui.use(['form','custom'], function(){
    var form = layui.form
        , $  = layui.jquery
        , common = layui.custom;
    common.imgUpload({
        bthObj : '#img-upload-a', //点击上传按钮
        imgObj : '#img-upload-a', //图片预览img对象
        inputObj : '#img-upload-a',  //上传成功，表单放置对象
    });
    common.imgUpload({
        bthObj : '#img-upload-b', //点击上传按钮
        imgObj : '#img-upload-b', //图片预览img对象
        inputObj : '#input-form-b',  //上传成功，表单放置对象
    });
    common.imgUpload({
        bthObj : '#img-upload-c', //点击上传按钮
        imgObj : '#img-upload-c', //图片预览img对象
        inputObj : '#input-form-c',  //上传成功，表单放置对象
    });
    common.imgUpload({
        bthObj : '#img-upload-d', //点击上传按钮
        imgObj : '#img-upload-d', //图片预览img对象
        inputObj : '#input-form-d',  //上传成功，表单放置对象
    });
})








