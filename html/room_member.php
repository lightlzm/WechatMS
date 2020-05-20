
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>群成员</title>
	<? include("html/cssline.php"); ?>
</head>
<body>
	
	<div class="groupMemberListPage  layout"> 
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
									<h2>群成员列表 (<? echo $r['totaluser'];?>)</h2>    
									<div class="refresh-data-btn" title="上次同步：<? echo $sys_time;?>">同步数据<i></i></div>
								</div>			
 
								
								<!-- 群成员表格 -->
								<div class="weui-desktop-panel weui-desktop-panel_overview">
							
									<div class="weui-desktop-panel__bd">
                                    
                                        <!-- 群名 -->
										<div class="table-title">
											<div class="group-header">
												<img src="<? echo $r['avatar'];?>" alt="">
											</div>
											<div class="group-intro">
												<div class="group-name"><? echo $r['topic']?$r['topic']:"未命名";?></div>
												<div class="people-num">群成员数：<span><? echo $r['totaluser'];?></span>人</div>
											</div>
										</div>    


										 <table width="100%" border="0" cellpadding="1" cellspacing="1" style="background:#CCC;">
	                                          <tbody><tr>
	                                            <td style="background-color: #f4f5f9;" data-sort="群成员名字" data-sequence="down"> 
	                                            	群成员名字
	                                            </td> 
	                                            <td style="background-color: #f4f5f9;" data-sort="加入群日期" data-sequence="down">
	                                            	加入群日期
	                                            	<span class="icon_rank rank_area" order="join_date" sort="<? if($order=='join_date'){ if($sort=='desc') echo "asc";else echo "desc";}else{ echo "desc";}?>">
									                    <i class="arrow arrow_up" <? if($order=='join_date'&&$sort=="asc"){?>style="border-bottom-color: #333333;"<? }?>></i>
									                    <i class="arrow arrow_down"  <? if($order=='join_date'&&$sort=="desc"){?>style="border-top-color: #333333;"<? }?>></i>
									                </span>
	                                            </td>
	                                            <td style="background-color: #f4f5f9;" data-sort="发送信息次数" data-sequence="down">
	                                            	发送信息次数
	                                            	<span class="icon_rank rank_area" order="send_total"  sort="<? if($order=='send_total'){ if($sort=='desc') echo "asc";else echo "desc";}else{ echo "desc";}?>">
									                    <i class="arrow arrow_up" <? if($order=='send_total'&&$sort=="asc"){?>style="border-bottom-color: #333333;"<? }?>></i>
									                    <i class="arrow arrow_down"  <? if($order=='send_total'&&$sort=="desc"){?>style="border-top-color: #333333;"<? }?>></i>
									                </span>
	                                            </td>
	                                            <td style="background-color: #f4f5f9;" data-sort="最后发送时间" data-sequence="down">
	                                            	最后发送时间
	                                            	<span class="icon_rank rank_area" order="last_send_date" sort="<? if($order=='last_send_date'){ if($sort=='desc') echo "asc";else echo "desc";}else{ echo "desc";}?>">
									                    <i class="arrow arrow_up" <? if($order=='last_send_date'&&$sort=="asc"){?>style="border-bottom-color: #333333;"<? }?>></i>
									                    <i class="arrow arrow_down"  <? if($order=='last_send_date'&&$sort=="desc"){?>style="border-top-color: #333333;"<? }?>></i>
									                </span>
	                                            </td>  
	                                            <td style="background-color: #f4f5f9;" data-sort="管理" data-sequence="down">
	                                            	管理
	                                            </td>  
	                                          </tr>
                                              <? foreach($i['list'] as $n){?>
	                                         <tr>
                                                <td class="member">
                                                   <a href="index.php?action=room_member_calendar&contact_id=<? echo $n['wxid'];?>&roomid=<? echo $_GET['roomid'];?>">
	                                            	<img class="member-header" src="<? echo $n['avatar'];?>" alt="">
	                                            	<span class="member-name"><? echo $n['nickname'];?></span>
                                                    </a>
	                                            </td> 
	                                        
	                                            <td><? echo $n['join_date'];?></td> 
	                                            <td><? echo $n['send_total'];?></td>  
	                                            <td><? echo $n['last_send_date'];?></td>  
	                                            <td class="delete-member" style="color:#CCC;">踢人</td>
	                                          </tr>
	                                          <? }?>
	                                        </tbody>
	                                    </table>
                                        <!-- 分页 -->
	                                    <div class="page" style="position: relative; margin-top:50px;">
				                            <div style="display:;">
				                            	 <? echo $i['page'][0];?>
				                            </div> 
				                        </div>
									</div> 
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
	
	        $(".icon_rank").click(function(){
			    var order=$(this).attr("order");
				var vsort=$(this).attr("sort");
				location="index.php?action=room_member&roomid=<? echo $roomid?>&bid=<? echo $bid;?>&order="+order+"&sort="+vsort;
			})
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
					data: "action=create_job&name=init_chatroom_member&topic=<? echo urlencode($r['topic']);?>&roomid=<? echo $roomid?>&bid=<? echo $bid;?>", 
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
	
    
    
	<script>
    $(function(){
 
			// 踢人
			$(".delete-member").click(function(){
				//$(this).parent("tr").hide()
			})

		})  
	</script>
	
	
</body>
</html>