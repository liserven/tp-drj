//Demo
layui.use(['form','custom'], function(){
    var form = layui.form
        , $ = layui.jquery
        , common = layui.custom;
    //监听提交
    form.on('submit(formDemo)', function(data){
        var fromData = data.field;
        if( fromData.password != fromData.confirmPassword )
        {
            layer.msg('两次密码不一致', {icon:2});
        }
        var url = 'doAdd';
        $.post(url, fromData, function (result) {
            common.dMsg(result, 2000, false);
        });
        return false;
    });
});