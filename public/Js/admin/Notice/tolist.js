$(function () {

    $('.noticve-add').click(function () {
        var cid = $(this).attr('data-id');
        var url = window.url('admin/Notice/doAdd');
        var index = layer.open({
            type: 2,
            title: '添加公告',
            content: url,
            area: ['900px', '650px']
        });
    });


    $('.do_edit').click(function () {
        var id = $(this).attr('data-id');
        var url = window.url('admin/Notice/doEdit/id/'+id);
        var index = layer.open({
            type: 2,
            title: '修改公告',
            content: url,
            area: ['900px', '650px']
        });
    });

//修改状态方法
    $('.edit_state').click(function(){
        var url = window.url('admin/Member/editState');
        var data= {id:$(this).attr('data-id'),state:$(this).attr('type')};
        layer.confirm('确定要停用么', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post(url,data,function(dat){
                if( dat.bol){

                    layer.msg(dat.msg,{icon:1,time:2000});
                    window.location.reload();
                }else{
                    layer.msg(dat.msg,{icon:2,time:2000});
                }
            });
        });
    });

})