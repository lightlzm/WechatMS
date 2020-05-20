
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>自动回复</title>
	<? include("html/cssline.php"); ?>
</head>
<body>
	
	<div class="wechatRobot layout">
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
									<h2>关键字自动回复</h2>    
                                    
								</div>
                              
                                    
								<!-- 选择群发的群 -->
								<div class="weui-desktop-panel" style="position: relative;padding-bottom: 40px;">
                                    <div class="weui-desktop-panel__bd form">
                                        <div class="table-title">
                                        <div class="group-header">
                                            <img src="<? echo $m['avatar'];?>" alt="">
                                        </div>
                                        <div class="group-intro">
                                            <div class="group-name"><? echo $m['topic']?$m['topic']:"未命名";?></div>
                                            <!-- <div class="people-num">群成员数：<span>6768</span>人</div> -->
                                        </div>
                                    </div>
                                            
                                    <div>
				                      	<button id="addword" class="weui-desktop-btn weui-desktop-btn_default tmplmsg__panel-btn-top add-btn" style="background: #4797eb;color: #fff;margin:20px 0 0;line-height: 30px;">+ 添加关键字</button>
				                    </div>
									<div class="weui-desktop-panel__bd" style="padding-top: 30px;"> 
										<table width="100%" border="0" cellpadding="1" cellspacing="1" style="background:#CCC;table-layout: fixed; width:100%">
	                                          <tbody>
	                                          	<tr>
	                                          		<td style="background-color: #f4f5f9;">
		                                            	关键字
		                                            	
		                                            </td>
                                                    <td style="background-color: #f4f5f9;"> 
		                                            	类型
		                                            </td>
		                                            <td style="background-color: #f4f5f9;"> 
		                                            	内容
		                                            </td>
		                                            <td style="background-color: #f4f5f9;"> 
		                                            	操作
		                                            </td>
		                                             
		                                          </tr>
                                                  <? foreach($r['list'] as $v){?>
		                                         <tr>
		                                         	<td>
		                                         		<? echo $v['kwd'];?>
		                                         	</td>
		                                            <td>
		                                            	<? 
														   if($v['action_name']=="send_text") echo "文字";
														   if($v['action_name']=="send_image") echo "图片";
														   if($v['action_name']=="send_urlLink") echo "图文";
														   if($v['action_name']=="join_room") echo "邀请加入群聊";
														
														?>
		                                            </td> 
                                                    <td>
		                                            	<? 
														   $data = json_decode($v['data'],true);
														   if($v['action_name']=="send_text") echo stripslashes($data['text']);
														   if($v['action_name']=="send_image") echo '<a href="'.$data['url'].'" target="_blank" style="color: #346ec6;">查看</a>';
														   if($v['action_name']=="send_urlLink") echo '<a href="'.$data['url'].'" target="_blank" style="color: #346ec6;">'.$data['title'].'</a>';
														   if($v['action_name']=="join_room"){
														       $roomid=$data['roomid'];
															   $roomd=chatroom($roomid);
															   echo $roomd['topic'];
														   }
														
														?>
		                                            </td> 
		                                            <td class="operate">
		                                            	<a href="index.php?action=room_add_auto_reply&bid=<? echo $bid;?>&id=<? echo $v['id'];?>&roomid=<? echo $roomiid;?>" class="edit-btn">编辑</a>
		                                            	<span class="delete-btn" word="<? echo $v['kwd'];?>" data="<? echo $v['id'];?>">删除</span>
		                                            </td>
		                                          </tr>
                                                  <? }?>
		                                         
	                                         
	                                        </tbody>
	                                    </table>

	                                    <!-- 分页 -->
	                                    <div class="page">
				                            <div style="display:;">
				                            	<? echo $r['page'][0];?>
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
		
	</div>

	<? include("html/jsline.php"); ?>

	<script>

		$(function(){
            $("#addword").click(function(){
			   location="index.php?action=room_add_auto_reply&bid=<? echo $bid;?>&roomid=<? echo $roomiid;?>";
			})
			// 删除
			$(".delete-btn").click(function(){
				var word = $(this).attr("word");
				var that=this;
				if(confirm("确定删除“"+word+"”吗？")){
					var id = $(this).attr("data");
					$.ajax({
						type: "GET",
						url: "<? echo API_URL;?>", 
						data: "action=remove_auto_reply&bid=<? echo $bid;?>&id="+id, 
						dataType: 'jsonp',
						timeout: 10000,
						jsonp: "callback",
						success: function(result){
							 
							 popSuccess("已删除");
							 setTimeout(function(){
							     hidePopSuccess()
								 //location="index.php?action=auto_reply&bid=<? echo $bid;?>"
								 $(that).parents("tr").hide()
							 }, 1000 * 2 );
						},
						error: function(msg){ 
						     hideSquareLoading();  
						}
					}) 
				}
	
				//$(this).parents("tr").hide()
			})


		})
		

	</script>
	
	
</body>
</html>