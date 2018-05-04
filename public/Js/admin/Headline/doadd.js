//Demo
layui.use(['form','custom'], function(){
    var form = layui.form
        , $ = layui.jquery
        , common = layui.custom;

        var ue = UE.getEditor('editor_id',
            {fontsize:[18,20],
                fontfamily: [{ label:'',name:'songti',val:'宋体,SimSun'},{ label:'',name:'yahei',val:'微软雅黑,Microsoft YaHei'},],
            }
        );

});