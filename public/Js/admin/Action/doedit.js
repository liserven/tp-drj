//Demo
layui.use(['form','custom'], function(){
    var form = layui.form
        , $ = layui.jquery
        , common = layui.custom;
        form.on("submit(ActionEdit)", function (data) {
            var data = data.field;
            $.post('admin/Action/doEdit', data, function(result){
                if( result.bol)
                {
                    layer.msg(result.msg, {icon:1, time:2000});
                    window.parent.location.reload();
                }
                else{
                    layer.msg(result.msg, {icon:2, time:2000});
                }
            });
            return false;
        } )
});