$(function () {

    $('.one-sort-pro a').each(function (e) {
        var _this = $(this);
        var sort = $(this).attr('data-sort');
        var url = '/get_pro/' + sort;
        _this.click(function () {
            var two_pro = '';
            var three_pro = '';
            $.get(url, {}, function (result) {
                var data = result.data;
                if( result.bol )
                {
                    for (var i = 0; i < data.length; i++) {
                        var clas = i == 0 ? 'on' : '';
                        two_pro += '<a class="' + clas + '" data-sort="' + data[i].id + '">' + data[i].name + '</a>';
                    }
                    for (var j = 0; j < data[0]['next_pro'].length; j++) {
                        var clas = j == 0 ? 'on' : '';
                        three_pro += '<a class="' + clas + '" data-sort="' + data[0]['next_pro'][j].id + '">' + data[0]['next_pro'][j].name + '</a>';
                    }
                }
                $('.two-sort-pro').html(two_pro);
                $('.three-sort-pro').html(three_pro);
                $('.two-sort-pro a').each(function (e) {
                    var _this = $(this);
                    var sort = _this.attr('data-sort');
                    var url = '/get_pro/' + sort;
                    _this.click(function () {
                        _this.addClass('on').siblings('a').removeClass('on');
                        var three_pro = '';
                        $.get(url, {}, function (result) {
                            var data = result.data;
                            if( result.bol)
                            {
                                for (var i = 0; i < data.length; i++) {
                                    var clas = i == 0 ? 'on' : '';
                                    three_pro += '<a class="' + clas + '" data-sort="' + data[i].id + '">' + data[i].name + '</a>';
                                }
                            }
                            $('.three-sort-pro').html(three_pro);
                            $.get('/getscience/'+data[0]['id'], {}, function (result) {
                                $('.operation').html(result);
                            });
                            $('.three-sort-pro a').each(function (e) {
                                var _this = $(this);
                                var sort = _this.attr('data-sort');
                                var url = '/getscience/' + sort;
                                _this.click(function () {
                                    _this.addClass('on').siblings('a').removeClass('on');
                                    $.get(url, {}, function (result) {
                                        $('.operation').html(result);
                                    });
                                });
                            });
                        });
                    });
                });
            });
        });
    });

    //点击第二级
    $('.two-sort-pro a').each(function (e) {
        var _this = $(this);
        var sort = _this.attr('data-sort');
        var url = '/get_pro/' + sort;
        _this.click(function () {
            var three_pro = '';
            $.get(url, {}, function (result) {
                var data = result.data;
                if( result.bol)
                {
                    for (var i = 0; i < data.length; i++) {
                        var clas = i == 0 ? 'on' : '';
                        three_pro += '<a class="' + clas + '" data-sort="' + data[i].id + '">' + data[i].name + '</a>';
                    }
                }
                $('.three-sort-pro').html(three_pro);
                $.get('/getscience/'+data[0]['id'], {}, function (result) {
                    $('.operation').html(result);
                });
                $('.three-sort-pro a').each(function (e) {
                    var _this = $(this);
                    var sort = _this.attr('data-sort');
                    var url = '/getscience/' + sort;
                    _this.click(function () {
                        _this.addClass('on').siblings('a').removeClass('on');
                        $.get(url, {}, function (result) {
                            $('.operation').html(result);
                        });
                    });
                });
            });
        });
    });
    //直接点击第三级
    $('.three-sort-pro a').each(function (e) {
        var _this = $(this);

        var sort = _this.attr('data-sort');
        var url = '/getscience/' + sort;
        _this.click(function () {
            $.get(url, {}, function (result) {
               $('.operation').html(result);
            });
        });
    });
});