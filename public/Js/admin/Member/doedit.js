//Demo
layui.use(['form','custom'], function(){
    var form = layui.form
        , $ = layui.jquery
        , common = layui.custom;
    //监听提交
    form.on('submit(formDemo)', function(data){
        $.post('doEdit', data.field, function (result) {
            common.dMsg(result);
        });
        return false;
    });
});