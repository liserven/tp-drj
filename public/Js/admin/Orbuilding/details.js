layui.use(['layer','custom','form'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom,
        form = layui.form

    /*
        $(".tj").each(function (e) {
            var _this = $(this);
            _this.click(function(){

                var id = _this.attr('data-id');
                $.post('/admin/Orbuilding/logistics', { id:id}, function (result) {
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
    */
    form.on("submit(details)", function(data){
        $.post('/admin/Orbuilding/details', data.field, function (result) {
            if( result.bol)
            {
                layer.msg(result.msg, {icon:1, time:1000});
                window.parent.location.reload();
            }else{
                layer.msg(result.msg, {icon:2, time:1000});

            }
        });
        return false;
    });



});

