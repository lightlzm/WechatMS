
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
									<h2>新群开通</h2>    
								</div>	

								<div class="weui-desktop-panel weui-desktop-panel_overview" style="padding-top:30px;">
							         <div class="tmplmsg__search-wrap weui-desktop-data-overview-list" style="width: 98%;margin-bottom: 10px;display: flex;  padding:10px; border:1px solid #ff6a00; background-color: #FFE8D0;border-radius: 3px; line-height:1.5rem; font-size:12px;"">
                                        开群流程：
                                        在助手管理中扫描二维码，添加小助手为好友;
                                        将小助手邀请至您需要管理的群内;
                                        任意发送表情或文字到群后，在本页开通群。此处只会显示过去24小时内未开通的群，超时未开通请把助手踢出后重新拉进群再开通。开群成功后可在“群列表”中管理已开通的群。
                                    </div>
									<div class="weui-desktop-panel__bd"> 

										 <table width="100%" border="0" cellpadding="1" cellspacing="1" style="background:#CCC;">
	                                          <tbody>
	                                          	<tr>
                                                    <td style="background-color: #f4f5f9;">
		                                            	群头像
		                                            </td>
		                                            <td style="background-color: #f4f5f9;" data-sequence="down"> 
		                                            	群名称
		                                            </td> 
		                                            <td style="background-color: #f4f5f9;">
		                                            	助手名称
		                                            </td>
		                                            
		                                            <td style="background-color: #f4f5f9;">
		                                            	助手进群时间
		                                            </td>
		                                            <td style="background-color: #f4f5f9;">
		                                            	邀请人
		                                            </td>
		                                            <td style="background-color: #f4f5f9;">
		                                            	操作
	                                            	</td>
                                                    <td style="background-color: #f4f5f9;">
		                                            	删除
	                                            	</td>
	                                          	</tr>
                                                <? foreach($b['list'] as $v){?>
		                                        <tr>
                                                    <td>
		                                            	<div class="erweima">
		                                            		<img src="<? echo $v['avatar'];?>" style="width:30px; height:30px; margin:3px;">
		                                            		 
		                                            	</div>
		                                            </td>  
		                                            <td>
		                                            	 <? echo $v['topic']?$v['topic']:"未命名";?>
		                                            </td> 
		                                            <td><? echo $v['nickname'];?></td> 
		                                            
		                                            <td>
		                                            	<? echo $v['join_date'];?> 
		                                            </td>  
		                                            <td><? echo $v['inviter_wxid'];?></td>
		                                            <td><span class="opengroup" style="border:1px solid #ff6a00;border-radius: 3px; padding:3px 10px; color:#ff6a00; cursor:pointer;" roomid="<? echo $v['roomid']?>">开通</span></td>
                                                    <td><span class="deletegroup" style="border:1px solid #ccc;border-radius: 3px; padding:3px 10px; color:#666;cursor:pointer;"  roomid="<? echo $v['roomid']?>">删除</span></td>
		                                        </tr>
		                                        <? }?>
	                                        </tbody>
	                                    </table>

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

			 
			$("td .erweima").hover(function(){
				$(this).find(".enlarge-pic").show()
			},function(){
				$(this).find(".enlarge-pic").hide()
			})
			
			$(".opengroup").click(function(){  
			    var that =$(this); 
			    var roomid = $(this).attr("roomid"); 
				popSquareLoading("正在开通...") 
				$.ajax({
					type: "GET",
					url: "<? echo API_URL;?>", 
					data: "action=open_chatroom&roomid="+roomid+"&bid=<? echo $bid;?>", 
					dataType: 'jsonp',
					timeout: 10000,
					jsonp: "callback",
					success: function(result){
						  hideSquareLoading();
						  popSuccess(result.msg);
						  setTimeout(function(){
							 hidePopSuccess()
							 that.parent("td").parent("tr").hide()
						 }, 1000 * 2 );
					}
				}) 
             })
			 
			 
			 $(".deletegroup").click(function(){  
			    var that =$(this); 
			    var roomid = $(this).attr("roomid"); 
				popSquareLoading("正在删除...") 
				$.ajax({
					type: "GET",
					url: "<? echo API_URL;?>", 
					data: "action=delete_chatroom&roomid="+roomid+"&bid=<? echo $bid;?>", 
					dataType: 'jsonp',
					timeout: 10000,
					jsonp: "callback",
					success: function(result){
						  hideSquareLoading();
						  popSuccess(result.msg);
						  setTimeout(function(){
							 hidePopSuccess()
							 that.parent("td").parent("tr").hide()
						 }, 1000 * 2 );
					}
				}) 
				
				//机器人退出群聊
				$.ajax({
					type: "GET",
					url: "<? echo API_URL;?>", 
					data: "action=create_job&name=quit_chatroom&roomid="+roomid+"&bid=<? echo $bid;?>", 
					dataType: 'jsonp',
					timeout: 10000,
					jsonp: "callback",
					success: function(result){ 
					}
				}) 
				
				
             })
		})

	</script>
	
	
</body>
</html>