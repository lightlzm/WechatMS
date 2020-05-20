
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>入群欢迎</title>
	<? include("html/cssline.php"); ?>

</head>
<body>
	
	<div class="indexPage layout">
       <? include("html/topbar.php"); ?>  
		
		<div class="main">
			
			<!-- 左侧导航 -->
			<div class="menu-wrap">
               <? include("html/menu.php"); ?>
			</div>

			<!-- 右侧具体内容 -->
			<div class="content-wrap">
				
				<!-- 右边主要内容 -->
				<div class="weui-desktop-layout__main">
					<div class="weui-desktop-layout__main__area">
						<div class="weui-desktop-layout__main__inner">
							<div class="main_bd">

								<!-- 大标题和tab -->
								<div class="weui-desktop-layout__main__hd">    
									<h2>入群欢迎</h2>    
								</div>	

								<div class="weui-desktop-panel weui-desktop-panel_overview">
									<div class="form-wrap">
											<!-- 欢迎词 -->
											<div class="weui-desktop-panel__bd form">
												<div class="table-title">
												<div class="group-header">
													<img src="<? echo $r['avatar'];?>" alt="">
												</div>
												<div class="group-intro">
													<div class="group-name"><? echo $r['topic']?$r['topic']:"未命名";?></div>
													<!-- <div class="people-num">群成员数：<span>6768</span>人</div> -->
												</div>
											</div>
										
											<div class="tmplmsg__search-wrap weui-desktop-data-overview-list" style="width: 600px;margin-bottom: 5px;">
												<label style="line-height: 36px;color: #666;">欢迎词： </label>
						                        <textarea name="" class="weui-desktop-form__textarea" style="resize: none;min-height: 150px" id="join_welcome_msg" placeholder=""><? if(!empty($r['join_welcome_msg'])) echo $r['join_welcome_msg']; else echo "欢迎{name}加入群聊。"?></textarea><span style="color:#AAA; font-size:12px;">注：{name}代表入群好友昵称</span>
						                    </div>
                                            
						                     <div style="color: #999;display: inline-block;cursor: pointer; margin-top:20px;" class="">
												<div class="weui-desktop-icon-checkbox welcome" data="<? echo intval($r['is_open_join_welcome_msg']);?>" style="margin-top: -2px;margin-right: 2px"></div>
												入群时是否发送欢迎词
											</div>
										</div>

									</div>



									<div>
				                      	<button class="weui-desktop-btn weui-desktop-btn_default tmplmsg__panel-btn-top submit-btn" style="background: #4797eb;color: #fff;margin:10px 0 20px">提交</button>
				                    </div>
								</div>


							</div>

						</div>
					</div>
				</div>
				
			</div>

		</div>
		
	</div>

	<? include("html/jsline.php"); ?>

	<script>

		$(function(){ 
		    var i=<? echo intval($r['is_open_join_welcome_msg']);?>;
			if(i==1){
			    $(".welcome").addClass("on")
			}
			// 是否开启欢迎语
			$(".welcome").parent().click(function(){
				if($(".welcome").hasClass("on")){
					$(".welcome").removeClass("on")
					$(".welcome").attr("data","0");
				}else{
					$(".welcome").addClass("on")
					$(".welcome").attr("data","1")
				}
			})
			
			var isSubmit=false;
			$(".submit-btn").click(function(){  
				var join_welcome_msg =$("#join_welcome_msg").val().trim();
				var is_open_join_welcome_msg = $(".welcome").attr("data");
				 
				if(join_welcome_msg=="" && is_open_join_welcome_msg==1){
				   popTipsFn("请输入入群欢迎语")
				   $("#join_welcome_msg").focus();
				   return;
				}
				 
				if(isSubmit==true) return;
				else isSubmit=true;
				
				popSquareLoading("正在发送...") 
				$.ajax({
					type: "GET",
					url: "<? echo API_URL;?>", 
					data: "action=edit_join_welcome_msg&bid=<? echo $bid;?>&roomid=<? echo $roomid;?>&join_welcome_msg="+encodeURIComponent(join_welcome_msg)
					      +"&is_open_join_welcome_msg="+is_open_join_welcome_msg, 
					dataType: 'jsonp',
					timeout: 10000,
					jsonp: "callback",
					success: function(result){
						 isSubmit=false
						 jobid = result.job;
						 hideSquareLoading();
						 popSuccess("已提交");
						 setTimeout(function(){
							 hidePopSuccess()
						 }, 1000 * 2 );
					},
					error: function(msg){ 
						 hideSquareLoading();
						 isSubmit=false     
					}
				}) 
					 
				 
			})//click
			
  })//function
		

	</script>
	
	
</body>
</html>