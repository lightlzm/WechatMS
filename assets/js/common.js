$(function(){

	// 设置导航的具体高度
	$(".menu-item-wrap").css("height",$("body").height()-55)
	// console.log($(".main").height())

	
	// 展开/收起二级导航
	$(".menu-btn").click(function(){
		if($(this).hasClass("on")){
			$(".menu-wrap").css("left","-240px")
			$(this).removeClass("on")
			$(".content-wrap").css("padding-left","20px")
		}else{
			$(".menu-wrap").css("left","0")
			$(this).addClass("on")
			$(".content-wrap").css("padding-left","260px")
		}

	})
	
	// 展开/收起二级导航
	$(".menu-title").click(function(){

		// 控制导航的箭头
		$(this).next().slideToggle(function(){

	        if($(this).is(":visible")){
	           	$(this).parent().addClass("on")
	        }else{
            	$(this).parent().removeClass("on")
	        }

	    })
	})
})

// 弹窗-提示语
function popTipsFn(text){
    if(!$(".popTips").length){
      $("body").append('<div class="popTips"><span class="txt">'+ text +'</span></div>');
    }else{
        $(".popTips").find("span").html(text);
    }

    $('.popTips').fadeIn();
    setTimeout(function(){
        $('.popTips').fadeOut();
    },1000);
}

// 正方形的加载中
function popSquareLoading(text){
    if(!$(".pop-square-loading").length){
      $("body").append('<div class="pop-square-loading"><div><i></i><p>' + text + '</p></div></div>');
    }
    $(".pop-square-loading p").text(text)
    $('.pop-square-loading').fadeIn();
}

function hideSquareLoading(){
    $('.pop-square-loading').fadeOut();
}

// 成功
function popSuccess(text){
    if(!$(".pop-success").length){
      $("body").append('<div class="pop-success"><div><i></i><p>' + text + '</p></div></div>');
    }
    $(".pop-success p").text(text)
    $('.pop-success').fadeIn();
}

function hidePopSuccess(){
    $('.pop-success').fadeOut();
}

// 确认弹框
function popConfirm(text){
    if(!$(".pop-confirm").length){
      $("body").append('<div class="pop-wrap pop-confirm">' + 
		'<div class="pop-box">' + 
			'<p class="tips">是否确认删除？</p>' + 
			'<div class="btn-wrap">' + 
				'<div class="cancel-btn">取消</div>' +
				'<div class="submit-btn">确认</div>' +
			'</div>' +
		'</div>' +
	'</div>');
    }
    $('.pop-confirm').fadeIn();
}

// 获取时间
function getDate(){

    var date = new Date;
    // var year = myDate.getFullYear(); //获取当前年
    // var mon = myDate.getMonth() + 1; //获取当前月
    // var date = myDate.getDate(); //获取当前日
    // var h = myDate.getHours();//获取当前小时数(0-23)
    // var m = myDate.getMinutes();//获取当前分钟数(0-59)
    // var s = myDate.getSeconds();//获取当前秒
    Y = date.getFullYear() + '-';
    M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';

    D = date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate();
    h = date.getHours() + ':';
    m = (date.getMinutes() < 10 ? '0'+(date.getMinutes()) : date.getMinutes()) + ':';
    s = (date.getSeconds() < 10 ? '0'+(date.getSeconds()) : date.getSeconds());



    // var time = year + "年" + mon + "月" + date + "日" + h + ":" + m + ":" + s;
    var time = Y + M + D;
    return time 
}