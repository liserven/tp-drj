//Demo
layui.use(['form','custom'], function(){
    var form = layui.form
        , $ = layui.jquery
        , common = layui.custom;

        var ue = UE.getEditor('editor_id',
            {
                fontsize:[18,20],
                fontfamily: [{ label:'',name:'songti',val:'宋体,SimSun'},{ label:'',name:'yahei',val:'微软雅黑,Microsoft YaHei'},],
                initialFrameHeight:800,
                autoHeight:false,
            }
        );
        common.QiniuUpload();
        form.on("select(sort)", function(data){
            var value = data.value;
            var url = common.url('admin/Sort/getTwoSort');
            $.get(url , { id : value}, function(result ){
                $('.two-sort').html(result);
                form.render(); //更新全部
            });
        });

        //添加标签
        $('.label-list').each(function () {
            var _this = $(this);
            _this.click(function () {
                var text = _this.text();
                var pre_text = $("#label-input").val();
                text = text+',';
                $("#label-input").val(pre_text+text);
            });
        });


});