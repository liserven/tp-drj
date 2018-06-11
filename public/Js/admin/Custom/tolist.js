layui.use(['form', 'custom', 'layer', 'laydate'], function () {
    var form = layui.form
        , $ = layui.jquery,
        layer = layui.layer
        , laydate = layui.laydate
        , common = layui.custom;
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

//监听提交
    form.on('submit(find)', function (data) {
        $.get('getByWhere', data.field, function (result) {
            if( result.is_empty )
            {
                html = '<span style="color:#f60; font-size:25px; display:inline-block; text-align:center; height:45px; line-height:45px;width: 100%;\n' +
                    'background: #eee;">该地区未存在合伙人</span>';
            }else{
                html = result.html;

            }


            $('.findBox').html(html);
        });
        return false;
    });

});

