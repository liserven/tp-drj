
$(function(){
//医美科普  生成随机背景颜色
    $(".cedicalcommon-sense li dd a").each(function(index){  
    	$(this).addClass("on"+randValue());  
	})  
	//生成1~7的随机数  
	function randValue() {  
	   return (Math.floor(Math.random() * 7) + 1);  
	}  

	$('.table tbody tr:even').css('background-color','#fbfbfb')

/***tab封装的函数  可以直接调用**/ 
    function tab(menus, conts) {
        $(menus).on("click",function(){
            var index = $(this).index();
            $(this).addClass("active").siblings().removeClass("active");
			$(conts).eq(index).removeClass("active").siblings().addClass("active");
        })
    }
    tab(".tabon", ".tabindexs")


// 选择城市类型
	$('.choosecity li a').on('click',function(){
		$(this).addClass('on').siblings().removeClass('on')
	})

	$(".policiecontent li dd:last").css('padding','0 0 15px 0!important')

	// 判断翻页是否为首页或者尾页
	var firstpage = $('.lastpages').next();
	var lastpage = $('.nextpages').prev();
	if( firstpage.hasClass('on') ){
		firstpage.prev().css('color','#d1d1d1');
	}
	if( lastpage.hasClass('on') ){
		lastpage.next().css('color','#d1d1d1');
	}


// 首页专家推荐 hover旋转动画
	// 在前面显示的元素，隐藏在后面的元素
	var eleBack = null, eleFront = null,eleList=null;
		// 纸牌元素们 
	// 确定前面与后面元素
	function test(){
		eleList.each(function() {
			if ($(this).hasClass("out")) {
				eleBack = $(this);
			} else {
				eleFront = $(this);
			}
		});
	}
	// 切换的顺序如下
	// 1. 当前在前显示的元素翻转90度隐藏, 动画时间225毫秒
	// 2. 结束后，之前显示在后面的元素逆向90度翻转显示在前
	// 3. 完成翻面效果
	$(".recommendationcontent ul").hover(function(){
			eleList =$(this).find(".list"); 
			test();
			eleFront.addClass("out").removeClass("in");
			setTimeout(function() {
				eleBack.addClass("in").removeClass("out");
				// 重新确定正反元素
				test();
			}, 225);
		return false;	
	},function(){
			/**/
			$(this).find(".on").removeClass("out");	
			$(this).find(".hositry").removeClass("in").addClass("out");	
			/**/
	});
		// 切换的顺序如下
		// 1. 当前在前显示的元素翻转90度隐藏, 动画时间225毫秒
		// 2. 结束后，之前显示在后面的元素逆向90度翻转显示在前
		// 3. 完成翻面效果


//报名 购票 地图模式
	$('.colse_open').on('click',function(){
		$('#fade').hide();
	})

	// function tomapattern(e){
	// 	$('#fade, .intomap').show();
	// }
	$('.tomapattern').on('click',function(){
		$('#fade, .intomap').show();
	})

    //美容科普 项目分类
    $('.classification li dd a').on('click',function(){
        $(this).addClass('on').siblings().removeClass('on');
	})
	

// 导航背景色的高度自适应
	var oheight = $('.classification').height();
	var doctor = $('.doctorintroduction').height();
	$('.tableft').height(oheight + 50 +'px');
	$('.doctormessage').height(doctor - 60 + 'px');
	// $('.introduce').height($('.meetinglocation').height() +50 +'px');

// 关注 收藏
	$('.follow').on('click',function () {
        var _this = $(this);
        if( _this.hasClass('on') ){
            _this.removeClass('on');
            _this.find('i').removeClass('add');
            _this.find('text').html('关注');
        } else {
            _this.addClass('on');
            _this.find('i').addClass('add');
            _this.find('text').html('已关注');
        }
    })

	$('.nullcolloct').on('click',function () {
		var _this = $(this);
		if( _this.hasClass('a') ) {
            _this.removeClass('a');
            _this.find('i').removeClass('add');
            _this.find('text').html('收藏');
		} else {
            _this.addClass('a');
            _this.find('i').addClass('add');
            _this.find('text').html('已收藏');
		}
    })


//限制textarea字数
    $('.numberwords').on("keyup", function () {
        $('.numberofwords').text($('.numberwords').val().length + "/150");//这句是在键盘按下时，实时的显示字数
        if ($('.numberwords').val().length > 150) {
            $('.numberofwords').text(150);//长度大于100时0处显示的也只是100
            $('.numberwords').val($('.numberwords').val().substring(0, 150));//长度大于100时截取钱100个字符
        }
    })
    $('.numberofwords').text($('.numberwords').val().length + "/150");//这句是在刷新的时候仍然显示字数


//地区三级联动
	var $distpicker = $('#distpicker');

	$distpicker.distpicker({
		province: '福建省',
		city: '厦门市',
		district: '思明区'
	});

	$('#reset').click(function () {
		$distpicker.distpicker('reset');
	});

	$('#reset-deep').click(function () {
		$distpicker.distpicker('reset', true);
	});

	$('#destroy').click(function () {
		$distpicker.distpicker('destroy');
	});

	$('#distpicker1').distpicker();

	$('#distpicker2').distpicker({
		province: '---- 所在省 ----',
		city: '---- 所在市 ----',
		district: '---- 所在区 ----'
	});

	$('#distpicker3').distpicker({
		province: '浙江省',
		city: '杭州市',
		district: '西湖区'
	});

	$('#distpicker4').distpicker({
		placeholder: false
	});

	$('#distpicker5').distpicker({
		autoSelect: false
	});


//添加标签
	$('.addlable').each(function(){
		var c = $(this).find("span").html();
			b = 0;
		console.log(c);
		$(this).bind('click', function(){
			if( $(this).hasClass('select') ) {
				$(this).removeClass('select');
			} else {
				$(this).addClass('select');
				$(this).unbind();
				$(this).parent().prev().append($("<a "+b+' title="'+c+'" href="javascript:void(0);" class="ontap" ><span>'+c+"</span><em><img src='/Image/removelabel-icon.png' alt=''></em></a>"));
			}
		})
	})
	$('.ontap em').bind('click', '.ontap', function(){
		alert(1);
		$('.ontap').remove();
	})

})