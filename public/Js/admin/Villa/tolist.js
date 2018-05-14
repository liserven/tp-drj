layui.use(['layer','custom'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom;
        form = layui.form

    $(".changes").each(function (e) {
        var _this = $(this);
        _this.click(function(){

            var id = _this.attr('data-id');
            $.post('/admin/Villa/changes', { id:id}, function (result) {
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



});

