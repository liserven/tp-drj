//Demo
layui.use(['layedit', 'form','custom'], function(){
    var layedit = layui.layedit
        ,$ = layui.jquery
        ,form=layui.form
        ,common = layui.custom;
    var index = layedit.build('content',{
        height:'600px'
    });
//监听提交
    form.on('submit(formAbout)', function(data){
        var Formdata = {
            id : data.field.id,
            content: layedit.getContent(index),
        };
        $.post('doEdit',Formdata, function (result) {
            common.dMsg(result);
        });
        return false;
    });
});