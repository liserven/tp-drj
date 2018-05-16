layui.use(['layer','custom'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom,
        form = layui.form

    form.on('submit(formEdits)', function(data){

        $.post('doEdit', data.field, function (result) {
            if( result.bol)
            {
                layer.msg(result.msg, {icon:1, time:2000});
            }
            else{
                layer.msg(result.msg, {icon:2, time:2000});
            }
        });
        return false;
    });


    $(".changes").each(function (e) {
        var _this = $(this);
        _this.click(function(){

            var id = _this.attr('data-id');
            $.post('/admin/Building/changes', { id:id}, function (result) {
                if( result.bol)
                {
                    common.dMsg({
                        msg: '成功',
                        bol: true
                    },1);
                }
                else{
                    common.dMsg({
                        msg: '失败',
                        bol: false
                    },1);
                }
            } )

            return false;

        });


    });
    $(".regain").each(function (e) {
        var _this = $(this);
        _this.click(function(){

            var id = _this.attr('data-id');
            $.post('/admin/Building/regain', { id:id}, function (result) {
                if( result.bol)
                {
                    common.dMsg({
                        msg: '成功',
                        bol: true
                    },2);
                }
                else{
                    common.dMsg({
                        msg: '失败',
                        bol: false
                    },1);
                }
            } )

            return false;

        });


    });


});

