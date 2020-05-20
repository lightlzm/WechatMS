
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>微信管理系统</title>
	
	<? include("html/cssline.php"); ?>

	<style type="text/css">
		td {
		    background-color: #FFF;
		    height: 35px;
		    padding-left: 20px;
		}
		td .erweima{
			position: relative;
		}
		td .erweima img{
			width: 50px;
			margin: 10px 0 4px;
		}
		td .enlarge-pic{
			position: absolute;
			right: -75px;
			top: -25px;
			padding:5px;
			border: 1px solid #999;
			background: #fff;
			font-size: 0;
			display: none
		}
		td .enlarge-pic:after{
		    content: "";
		    position: absolute;
		    top: 47px;
		    left: -17.5px;
		    width: 0;
		    height: 0;
		    border-top: 9px solid transparent;
		    border-left: 9px solid transparent;
		    border-right: 9px solid #fff;
		    border-bottom: 9px solid transparent;
		}
		td .enlarge-pic:before{
		    content: "";
		    position: absolute;
		    top: 46px;
			left: -20px;
		    width: 0;
		    height: 0;
		    border-top: 10px solid transparent;
		    border-left: 10px solid transparent;
		    border-right: 10px solid #999;
		    border-bottom: 10px solid transparent;
		}
		td .enlarge-pic img{
			width: 120px;
			max-width: 120px;
			margin: 0
		}
	</style>

</head>
<body>
	
	<div class="homePage layout">

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
									<h2>小助手</h2>    
								</div>	

								<div class="weui-desktop-panel weui-desktop-panel_overview">
							
									<div class="weui-desktop-panel__bd"> 

										 <table width="100%" border="0" cellpadding="1" cellspacing="1" style="background:#CCC;">
	                                          <tbody>
	                                          	<tr>
		                                            <td style="background-color: #f4f5f9;" data-sequence="down"> 
		                                            	序号
		                                            </td> 
		                                            <td style="background-color: #f4f5f9;">
		                                            	助手名称
		                                            </td>
		                                            
		                                            <td style="background-color: #f4f5f9;">
		                                            	二维码
		                                            </td>
		                                            <td style="background-color: #f4f5f9;">
		                                            	助手状态
		                                            </td>
		                                            <td style="background-color: #f4f5f9;">
		                                            	助手详情
	                                            	</td>
	                                          	</tr>
                                                <? foreach($b['list'] as $v){?>
		                                        <tr>
		                                            <td>
		                                            	00<? echo $v['id'];?>
		                                            </td> 
		                                            <td><? echo $v['nickname'];?></td> 
		                                             
		                                            <td>
		                                            	<div class="erweima">
		                                            		<img src="<? echo $url.urlencode($v['qr_code']);?>">
		                                            		<div class="enlarge-pic">
		                                            			<img src="<? echo $url.urlencode($v['qr_code']);?>">
		                                            		</div>
		                                            	</div>
		                                            </td>  
		                                            <td>正常</td>
		                                            <td class="check-btn">查看</td>
		                                        </tr>
		                                        <? }?>
	                                        </tbody>
	                                    </table>

									</div> 

									<!-- 名片弹窗 -->
									<div class="weui-desktop-dialog__wrp pop-robot-card" style="color: #353535;">
										<div class="weui-desktop-mask" style="color: #353535;">
											<div class="weui-desktop-dialog" style="width:600px;margin-top: 100px;padding:0 30px;box-sizing: border-box;position: relative;">
													
													<h3 class="weui-desktop-panel__title">小助手名片二维码</h3>

													<div class="card-wrap">

														<div style="line-height:30px;">
															1.微信扫一扫下方小助手二维码，添加小助手为好友;<br>
                                                            2.将小助手邀请至您需要管理的群内;<br>
                                                            3.任意发送表情或文字到群内，让小助手感知自己的存在哦O(∩_∩)O<br>
                                                            4.点击群管理=>新群开通 ,进行开通
                                                            
														</div>

											
														<div class="erweima" style="width:150px; height:150px;">
															<img src="assets/imgs/erweima.jpg">
														</div>

														<div class="info-wrap">
<!-- 															<div class="nickname">
																<span>返现易机器人</span>
															</div> -->
														</div>

													</div>
                                                    <div class="close-btn"></div>
											</div>
											
										</div>
									</div>

								</div>
									
							</div>	

						</div>

					</div>

				</div>
				
			</div>
			<!-- end .content-wrap -->

		</div>
		
	</div>

	<? include("html/jsline.php"); ?>
	<script>

		$(function(){

			// 打开机器人名片
			$(".check-btn").click(function(){
				// 获取二维码并赋值
				var erweimaSrc = $(this).parent("tr").find(".erweima img").attr("src");
				$(".pop-robot-card").find(".erweima img").attr("src",erweimaSrc);
				$(".pop-robot-card").fadeIn()
			})

			// 关闭群列表
			$(".pop-robot-card .close-btn").click(function(){
				$(".pop-robot-card").fadeOut()
			})

			$("td .erweima").hover(function(){
				$(this).find(".enlarge-pic").show()
			},function(){
				$(this).find(".enlarge-pic").hide()
			})

		})

	</script>
	
	
</body>
</html>