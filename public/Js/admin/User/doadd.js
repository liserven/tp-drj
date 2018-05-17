layui.use(['form','custom'], function(){
    var form = layui.form
        , $  = layui.jquery
        , common = layui.custom;
    common.imgUpload({
        bthObj : '#img-upload-a', //点击上传按钮
        imgObj : '#img-upload-a', //图片预览img对象
        inputObj : '#img-upload-a',  //上传成功，表单放置对象
    });
    common.imgUpload({
        bthObj : '#img-upload-b', //点击上传按钮
        imgObj : '#img-upload-b', //图片预览img对象
        inputObj : '#input-form-b',  //上传成功，表单放置对象
    });
    common.imgUpload({
        bthObj : '#img-upload-c', //点击上传按钮
        imgObj : '#img-upload-c', //图片预览img对象
        inputObj : '#input-form-c',  //上传成功，表单放置对象
    });
    common.imgUpload({
        bthObj : '#img-upload-d', //点击上传按钮
        imgObj : '#img-upload-d', //图片预览img对象
        inputObj : '#input-form-d',  //上传成功，表单放置对象
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

})








