
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>群公告</title>
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
									<h2>群公告管理</h2>    
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
												<label style="line-height: 36px;color: #666;">群公告： </label>
						                        <textarea name="" class="weui-desktop-form__textarea" style="resize: none;min-height: 150px" id="announce" placeholder=""><? if(!empty($r['announce'])) echo $r['announce'];?></textarea><span style="color: #F00; font-size:12px;">注：请确认已添加机器人为群管理员，不然没权限修改群公告。</span>
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
		     
			
			var isSubmit=false;
			$(".submit-btn").click(function(){  
				var announce =$("#announce").val().trim();  
				if(announce=="" ){
				   popTipsFn("请输入群公告")
				   $("#announce").focus();
				   return;
				}
				 
				if(isSubmit==true) return;
				else isSubmit=true;
				
				popSquareLoading("正在发送...") 
				$.ajax({
					type: "GET",
					url: "<? echo API_URL;?>", 
					data: "action=create_job&name=edit_chatroom_announce&bid=<? echo $bid;?>&roomid=<? echo $roomid;?>&text="+encodeURIComponent(announce), 
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