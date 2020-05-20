
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>定时群发历史</title>
	
	<? include("html/cssline.php"); ?>

	<style type="text/css">
		td.pic img{
			max-width: 80%;
		}
		td.operate{
			display: table-cell;
		}
	</style>

</head>
<body>
	
	<div class="timingSend layout">
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
									<h2>定时群发历史</h2>    
								</div>	

								<div class="weui-desktop-panel weui-desktop-panel_overview" style="padding-bottom: 50px;margin-bottom: 0;position: relative;">

									<div>
				                      	<button class="weui-desktop-btn weui-desktop-btn_default tmplmsg__panel-btn-top add-btn" style="background: #4797eb;color: #fff;margin:20px 0 0;line-height: 30px;">+ 添加定时群发</button>
				                    </div>

									<!-- 表格 -->
									<div class="weui-desktop-panel__bd">
										<table width="100%" border="0" cellpadding="1" cellspacing="1" style="background:#CCC;table-layout: fixed;width: 100%">
	                                        <tbody>
	                                          	<tr>
	                                          		<td style="background-color: #f4f5f9;">
		                                            	提醒标题
		                                            </td>
		                                            <td style="background-color: #f4f5f9;"> 

		                                            	提醒时间
		                                            </td>
		                                            <td style="background-color: #f4f5f9;"> 
		                                            	发送通知群聊
		                                            </td>
		                                            <td style="background-color: #f4f5f9; width:50px;"> 
		                                            	开启
		                                            </td>
		                                            <td style="background-color: #f4f5f9;width:80px;"> 
		                                            	@所有人
		                                            </td>
		                                            <td style="background-color: #f4f5f9;"> 
		                                            	提醒内容
		                                            </td>
                                                    <td style="background-color: #f4f5f9;  width:60px;"> 
		                                            	状态
		                                            </td>
		                                            <td style="background-color: #f4f5f9;  width:40px;"> 
		                                            	操作
		                                            </td>
		                                             
		                                          </tr>
                                                  <? foreach($r['list'] as $v){?>
		                                         <tr>
		                                         	<td title="<? echo $v['data']['job_title'];?>">
		                                         		<? echo FsubstrcnChange($v['data']['job_title'], $len=10, $dot = '...');?>
		                                         	</td>
		                                            <td>
		                                            	<? echo $v['send_time'];?>
		                                            </td> 
		                                            <td title="<? echo $v['roomString'];?>">
		                                            	<? echo $v['oneroomString'];?>
                                                        <? if($v['roomnum']>1) echo "共".$v['roomnum']."个群"?>
		                                            </td> 
		                                            <td>
		                                            	<? echo $v['is_open']?"<span style='color:green'>是</span>":"否";?>
		                                            </td> 
		                                            <td>
		                                            	<? echo $v['data']['at_all']?"是":"否";?>
		                                            </td> 
		                                            <td class="pic">
		                                            	<? 
														   if("send_chatroom_text"==$v['name']){
														      echo $v['data']['text'];
														   }
														   
														   if("send_chatroom_image"==$v['name']){ 
															  echo '<a href="'.$v['data']['url'].'" target="_blank"><img src="'.$v['data']['url'].'" style="width:30px;" alt=""></a>'; 
														   }
														   
														   if("send_chatroom_urlLink"==$v['name']){ 
															  echo '<a href="'.$v['data']['url'].'" target="_blank">'.$v['data']['title'].'</a>'; 
														   }
														
														?>
		                                            	
		                                            </td> 
                                                     <td>
		                                            	 <? echo $v['status'];?>
		                                            </td>
		                                            <td class="operate">
                                                       <? if($v['is_open']){?>
		                                            	<span class="delete-btn" jobid="<? echo $v['id'];?>" title="<? echo $v['data']['job_title'];?>">删除</span>
                                                        <? }?>
		                                            </td>
		                                          </tr>
												<? }?>
	                                         
	                                        </tbody>
	                                    </table>

	                                    <!-- 分页 -->
	                                    <div class="page">
				                            <div> 
                                                <? echo $r['page'][0]?>
				                            </div>
				                            共<span><? echo $r['page'][3]?></span>条
				                        </div>
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
           $(".add-btn").click(function(){
		      location="index.php?action=room_send_message_timeing&bid=<? echo $bid?>";
		   })
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
			$(".pop-enlarge-pic .close-btn").click(function(){
				$(".pop-enlarge-pic").fadeOut()
			})
           
		   // 删除
			$(".delete-btn").click(function(){
				var word = $(this).attr("title");
				var that=this;
				if(confirm("确定删除"+word+"吗？")){
					var id = $(this).attr("jobid");
					$.ajax({
						type: "GET",
						url: "<? echo API_URL;?>", 
						data: "action=remove_schedule_job&bid=<? echo $bid;?>&id="+id, 
						dataType: 'jsonp',
						timeout: 10000,
						jsonp: "callback",
						success: function(result){ 
							 popSuccess("已删除");
							 setTimeout(function(){
							     hidePopSuccess()
								 //location="index.php?action=auto_reply&bid=wxid_glteitckvahs22"
								 $(that).parents("tr").hide()
							 }, 1000 * 2 );
						},
						error: function(msg){ 
						     hideSquareLoading();  
						}
					}) 
				}
	
				 
			})
			
			
		})

	</script>

</body>
</html>

