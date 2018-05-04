$(function () {

    $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
    });

    alert('dsadsa');
    $("#form-prohibit-add").ajaxForm({
        beforeSubmit:function(a,form,options){
            for(var i=0;i<a.length;i++) {
                var id = $("input[name='" + a[i].name + "']").attr('id');

                if( a[i].name == 'replace' ){
                    return true;
                }else{
                    if (a[i].value == '') {
                        layer.tips('这个值不能为空', '#' + id);
                        return false;
                    }
                }
            }
        },
        dataType:'json',
        success:function( dat ){
            if(dat.bol){
                layer.msg(dat.msg,{icon:1,time:1000});
                setTimeout(function () {
                    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                    parent.layer.close(index);
                },1000);
                window.parent.location.reload();

            }else{
                layer.msg(dat.msg,{icon:2,time:1000});
            }
        }
    });

})