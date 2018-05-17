layui.use(['rate'], function(){
    var rate = layui.rate;
    //基础效果
    rate.render({
        elem: '#test1'
    })

    //显示文字
    rate.render({
        elem: '#test2'
        ,value: 2 //初始值
        ,text: true //开启文本
    });

    //半星效果
    rate.render({
        elem: '#test3'
        ,value: 2.5 //初始值
        ,half: true //开启半星
    })
    rate.render({
        elem: '#test4'
        ,value: 3.5
        ,half: true
        ,text: true
    })

    //自定义文本
    rate.render({
        elem: '#test5'
        ,value: 3
        ,text: true
        ,setText: function(value){ //自定义文本的回调
            var arrs = {
                '1': '极差'
                ,'2': '差'
                ,'3': '中等'
                ,'4': '好'
                ,'5': '极好'
            };
            this.span.text(arrs[value] || ( value + "星"));
        }
    })
    rate.render({
        elem: '#test6'
        ,value: 1.5
        ,half: true
        ,text: true
        ,setText: function(value){
            this.span.text(value);
        }
    })

    //自定义长度
    rate.render({
        elem: '#test7'
        ,length: 3
    });
    rate.render({
        elem: '#test8'
        ,length: 10
        ,value: 8 //初始值
    });

    //只读
    rate.render({
        elem: '#test9'
        ,value: 4
        ,readonly: true
    });

    //主题色
    rate.render({
        elem: '#test10'
        ,value: 3
        ,theme: '#FF8000' //自定义主题色
    });
    rate.render({
        elem: '#test11'
        ,value: 3
        ,theme: '#009688'
    });

    rate.render({
        elem: '#test12'
        ,value: 2.5
        ,half: true
        ,theme: '#1E9FFF'
    })
    rate.render({
        elem: '#test13'
        ,value: 2.5
        ,half: true
        ,theme: '#2F4056'
    });
    rate.render({
        elem: '#test14'
        ,value: 2.5
        ,half: true
        ,theme: '#FE0000'
    })
});
