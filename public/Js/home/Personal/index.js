$(function(){
    //医美科普  生成随机背景颜色
    $(".c1").each(function(index){  
    	$(this).addClass("on"+randValue());  
	})  
	//生成1~7的随机数  
	function randValue() {  
	   return (Math.floor(Math.random() * 7) + 1);  
    }  
    

    /***tab封装的函数  可以直接调用**/ 
    function tab(menus, conts) {
        $(menus).on("click",function(){
            var index = $(this).index();
            $(this).addClass("active").siblings().removeClass("active");
			$(conts).eq(index).removeClass("active").siblings().addClass("active");
        })
    };
    tab(".tabon", ".tabindexs");


    // 选择性别
    $('.information li label').click(function(){
        $(this).addClass('on').siblings().removeClass('on');
    });


    // 认证审核 切换
    $('.tabindex').click(function(){
        var index = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");
        $(".showlogost").eq(index).removeClass("active").siblings().addClass("active");
    });
    $('.onfor').click(function(){
        var index = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");
        $(".infor").eq(index).removeClass("active").siblings().addClass("active");
    });
});