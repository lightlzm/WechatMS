
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>微信管理系统</title>
	<? include("html/cssline.php"); ?>
</head>
<body>
	
	<div class="groupListPage layout"> 
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

								<!-- 大标题 -->
								<div class="weui-desktop-layout__main__hd">    
									<h2>选择微信群 (<? echo $i['total'];?>)</h2>    
									<div class="refresh-data-btn"  title="上次同步：<? echo $sys_time;?>">同步数据<i></i></div>
								</div>			
 
									<!-- 块状显示群列表 -->
								<div class="group-list">
                                   <? foreach($i['list'] as $n){?>
									<div class="group">
										<a href="index.php?action=<? echo $action;?>&roomid=<? echo $n['roomid'];?>&bid=<? echo $bid;?>">
											<div class="group-name"><? echo $n['topic']?$n['topic']:"未命名";?></div>
											<div class="group-wrap">
												<div class="group-header">
													<img src="<? echo $n['avatar'];?>" alt="">
												</div>
												<div class="group-intro">
													
													<div class="people-num">群成员数：<span><? echo $n['totaluser'];?></span>人</div>
													<div class="last-time">最后活跃时间：<span><? echo $n['last_send_time']?></span></div>
													
												</div>								
											</div>
										</a>
									</div> 
                                    <? }?> 
								</div>
                                 
							</div>
							<!-- end.main_bd -->

						</div>
					</div>
				</div>
				<!-- end.weui-desktop-layout__main -->
				
			</div>

		</div>
		
	</div>

    <? include("html/jsline.php"); ?>
	<script>
    $(function(){ 
			// 同步数据
			var is_sys=0; //0未同步1同步中2同步完
			var jobid=0;
			$(".refresh-data-btn").click(function(){
				if(is_sys==1) return 
				else is_sys=1 
				// 点击开始同步
				$(this).find("i").addClass("on")
				popSquareLoading("正在同步...")
				
				$.ajax({
					type: "GET",
					url: "<? echo API_URL;?>", 
					data: "action=create_job&name=init_chatroom_list&bid=<? echo $bid;?>", 
					dataType: 'jsonp',
					timeout: 10000,
					jsonp: "callback",
					success: function(result){
						 jobid = result.job;
					}
				}) 
				// 同步完数据
				// 移除类名，并更新同步最新时间
				// $(this).find("i").removeClass("on") 
				//$(this).find("i").attr("title","上次同步：2020-02-20 12:20") 
				// 关闭加载中弹窗
				// hideSquareLoading() 
			})
			
			query_job();
			function query_job() {  
				setTimeout( query_job, 1000 * 3 );
				if(is_sys==0 || is_sys==2 || jobid==0) return; 
				$.ajax({
					type: "GET",
					url: "<? echo API_URL;?>", 
					data: "action=query_job&jobid="+jobid, 
					dataType: 'jsonp',
					timeout: 10000,
					jsonp: "callback",
					success: function(result){
						 is_exe = result.is_exe;
						 if(is_exe==2){
						     is_sys=2;//同步完
							 hideSquareLoading() 
							 popSuccess("同步完成");
							 $(".refresh-data-btn").find("i").removeClass("on") 
							 setTimeout( goto, 1000 * 2 );
							 
						 }
					}
				}) 
			}
           
		   function goto(){
		       location="<? echo "..".$_SERVER['REQUEST_URI']."&t="; echo time();?>";
		   }
			
		})  
	</script>
	
	
</body>
</html>