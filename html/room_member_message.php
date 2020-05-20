
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>群发信息</title>
	<? include("html/cssline.php"); ?>
    <style>
		.weui-desktop-panel__bd{
			position: relative;
			padding-bottom: 80px;
		}
		.group-title{
			margin-bottom: 10px;
			color: #666;
			font-size: 15px;
		}
		.group-title span{
			color: #ff6a00;
			font-weight: bold;
		}
		table{
			margin-bottom: 20px;
		}
		td img{
			max-width: 100px;
		}
		 
.groupMemberListPage td{
 width:auto;
}
 
	</style>
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
									<h2>群聊信息 (<? echo $_GET['date'];?>)</h2>    
									 
								</div>			
 
								
								<!-- 群成员表格 -->
								<div class="weui-desktop-panel weui-desktop-panel_overview">
							
									<div class="weui-desktop-panel__bd">
                                    
                                         <!-- 群名 -->
										<div class="group-title"><i class="user-name"><? echo $rb['nickname'];?></i>在<span class="group-name"><? echo $rm['topic'];?></span>聊天记录(<? echo $in['total'];?>条)</div> 

										 <table width="100%" border="0" cellpadding="1" cellspacing="1" style="background:#CCC;table-layout:fixed;">
	                                          <tbody><tr>
	                                            <td style="background-color: #f4f5f9;width:150px;" data-sort="时间"> 
	                                            	时间
	                                            	<span class="icon_rank rank_area">
									                    <i class="arrow arrow_up"></i>
									                    <i class="arrow arrow_down"></i>
									                </span>
	                                            </td> 
	                                            <td style="background-color: #f4f5f9;width:60px;" data-sort="类型" data-sequence="down">
	                                            	类型
	                                            	
	                                            </td>
	                                            <td style="background-color: #f4f5f9;" data-sort="详情" data-sequence="down">
	                                            	详情
	                                            </td>
	                                          </tr>
                                             <? foreach($in['list'] as $n){?>
	                                         <tr>
	                                            <td class="time">
	                                            	<? echo $n['send_time'];?>
	                                            </td> 
	                                            <td><? $type = $n['type']; echo msg_type($type);?></td> 
	                                            
                                                <? if($type==5 ||$type==6){?>
                                                <td class="pic">
	                                            	<img src="<? echo $n['text'];?>">	
	                                            </td>
                                                <? }else{?>
                                                <td> 
												
												       <? echo $n['text'];?>
                                                
                                                </td>         
                                                
												<? }?>  	                                      
	                                          </tr>
	                                         <? }?>
	                                         
	                                        </tbody>
	                                    </table>

	                                    <!-- 分页 -->
	                                     <div class="page">
				                            <div> 
                                                <? echo $in['page'][0]?>
				                            </div>
				                            共<span><? echo $in['page'][3]?></span>条
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
 
			// 图片放大
			$("td.pic").click(function(){
				var picSrc = $(this).find("img").attr("src")
				console.log(picSrc)
				$(".pop-enlarge-pic").find("img").attr("src",picSrc)
				$(".pop-enlarge-pic").fadeIn()
			})

			$(".pop-enlarge-pic").click(function(){
				$(".pop-enlarge-pic").fadeOut()
			})
			$(".close-btn").click(function(){
				$(".pop-enlarge-pic").fadeOut()
			})

		})  
	</script>
	
	
</body>
</html>