layui.use(['form','custom'], function() {
    var form = layui.form
        , $ = layui.jquery
        , common = layui.custom;


    var screen = 2;
    $("#add_set").click(function () {
        html = '<div class="layui-form-item set_box_t"><label class="layui-form-label">详情选项：</label><div class="layui-input-inline">\n' +
            '              <input type="text" name="name[]" lay-verify="required" placeholder="请输入选项" class="layui-input">\n' +
            '              </div></div>';
        $(".set_box").append(html);

        set++
        return false;
    });

    $("#del_set").click(function () {
        if($(".set_box").find(".set_box_t").length > 1)
        {
            $(".set_box").find(".set_box_t:last-child").remove();
        }
        else{
            layer.msg("务必添加一个规格");
        }
        set--;
        return false;
    });















})