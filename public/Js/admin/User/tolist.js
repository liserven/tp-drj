layui.use(['layer','custom','form'], function () {
    var $ = layui.jquery,
        layer = layui.layer,
        common = layui.custom;
        //给时间添加按钮
        common.date();
        //时间控件
        $('.seach-btn').click(function () {
            var data = [];
            $('tbody .laytable-cell-checkbox .layui-form-checkbox').each(function (e) {
                var _this = $(this);
                if (_this.hasClass('layui-form-checked')) {
                    data.push(_this.prev().val());
                }
            });
        });

    $(".find-ali-status").each(function(e){
        var _this = $(this);
        _this.click(function () {
            var id = document.getElementById("id").value;
            var url = '/admin/User/getUserStar?id='+id;
            var name = _this.attr('name');
            var title = '查询 <strong style="color:#f60"> '+name+' </strong>详细情况';
         common.dialog({url:url, area:[ '40%','50%' ], title:title});
        });
    });
    $(".black_pull").each(function (e) {
        var _this = $(this);
        _this.click(function(){

            var id = _this.attr('data-id');
            $.post('/admin/User/black', { id:id}, function (result) {
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

