layui.use(['form', 'custom', 'layer', 'laydate'], function () {
    var form = layui.form
        , $ = layui.jquery,
        layer = layui.layer
        , laydate = layui.laydate
        , common = layui.custom;


    $(".forbidden").each(function (e) {
        var _this = $(this);
        _this.click(function () {

            var id = _this.attr('data-id');
            $.post('/admin/Consumer/forbidden', {id: id}, function (result) {
                if (result.bol) {
                    common.dMsg({
                        msg: '成功',
                        bol: true
                    }, 1);
                }
                else {
                    common.dMsg({
                        msg: '失败',
                        bol: false
                    }, 1);
                }
            })

            return false;

        });

    });
    $(".forbiddenr").each(function (e) {
        var _this = $(this);
        _this.click(function () {

            var id = _this.attr('data-id');
            $.post('/admin/Consumer/forbiddenr', {id: id}, function (result) {
                if (result.bol) {
                    common.dMsg({
                        msg: '成功',
                        bol: true
                    }, 1);
                }
                else {
                    common.dMsg({
                        msg: '失败',
                        bol: false
                    }, 1);
                }
            })

            return false;

        });

    });
    //查看详情

    $(".getUserAddress").each(function(e){
        var _this = $(this);
        _this.click(function () {
            var id = document.getElementById("id").value
            var url = '/admin/Consumer/getUserAddress?id='+id;
            var name = _this.attr('name');
            var title = '查询 <strong style="color:#f60"> '+name+' </strong>详细情况';
            common.dialog({url:url, area:[ '50%','60%' ], title:title});
        });
    });
//4级联动
    function getHtml(config, idName, name) {
        var html = '<option value="">请选择</option>';
        for (var i = 0; i < config.length; i++) {

            html += '<option value="' + config[i][name] + ' " data-id="' + config[i][idName] + '">' + config[i][name] + '</option> ';
        }
        return html;
    }
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
    form.on("select(county)", function (result) {
        var value = $("select#county option:selected").attr('data-id');
        $.get('/api/v1/l_town', {pid: value}, function (result) {
            var html = getHtml(result.data, 'town_id', 'town_name');
            $('#town').html(html);
            form.render('select'); //更新全部
        });
    });

    });
