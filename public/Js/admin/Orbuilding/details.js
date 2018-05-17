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
        alert('dsaasd');return false;
        $.post('/admin/Orbuilding/logistics', data.field, function (result) {
           window.parent.location.reload();
        });
        return false;
    });



});

