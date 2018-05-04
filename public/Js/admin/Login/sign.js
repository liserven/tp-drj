$(function () {
    $("#form_login").ajaxForm({
        dataType:'json',
        success:function( dat ){
            if(dat.bol){
                layer.msg(dat.msg,{icon:1,time:1000});
                window.location.href=window.url('admin/Index/index');
            }else{
                layer.msg(dat.msg,{icon:2,time:1000});
            }
        }
    });

})
