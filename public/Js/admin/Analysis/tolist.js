layui.use(['form', 'custom', 'layer', 'laydate'], function () {
    var form = layui.form
        , $ = layui.jquery,
        layer = layui.layer
        , laydate = layui.laydate
        , common = layui.custom;

    laydate.render({
        type: 'date',
        elem: "#over_time"
    });
    laydate.render({
        type: 'date',
        elem: "#start_time"
    });


    function getHtml(config, idName, name) {
        var html = '<option value="">请选择</option>';
        for (var i = 0; i < config.length; i++) {

            html += '<option value="' + config[i][name] + ' " data-id="' + config[i][idName] + '">' + config[i][name] + '</option> ';
        }
        return html;
    }

    //省市二级联动并更新合伙人数量限制
    form.on("select(provice)", function (data) {
        var value = $("select#provice option:selected").attr('data-id');
        var url = '/api/v1/l_city';
        $.get(url, {pid: value}, function (result) {
            var html = getHtml(result.data, 'city_id', 'city_name');
            $('#city').html(html);
            form.render(); //更新全部
        });

        form.render('select'); //更新全部

    });
    form.on("select(city)", function (result) {
        var value = $("select#city option:selected").attr('data-id');
        $.get('/api/v1/l_county', {pid: value}, function (result) {
            var html = getHtml(result.data, 'county_id', 'county_name');
            $('#county').html(html);
            form.render('select'); //更新全部
        });
    });

//监听提交
    form.on('submit(find)', function (data) {
        $.get('getByWhere', data.field, function (result) {
            if( result.is_empty )
            {
                html = '<span style="color:#f60; font-size:25px; display:inline-block; text-align:center; height:45px; line-height:45px;width: 100%;\n' +
                    'background: #eee;">该地区未存在别墅订单</span>';
            }else{
                html = result.html;

            }


            $('.findBox').html(html);
        });
        return false;
    });


})