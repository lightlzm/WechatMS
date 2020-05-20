
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加群关键词回复</title>
	
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
									<h2>自动回复管理</h2>    
								</div>
								
								<!-- 群发信息管理 -->
								<div class="weui-desktop-panel weui-desktop-panel_overview">
                                    <h3 class="weui-desktop-panel__title">添加群关键词回复</h3>
                                    <div class="weui-desktop-panel__bd form">
                                        <div class="table-title">
                                        <div class="group-header">
                                            <img src="<? echo $m['avatar'];?>" alt="">
                                        </div>
                                        <div class="group-intro">
                                            <div class="group-name"><? echo $m['topic'];?></div>
                                            <!-- <div class="people-num">群成员数：<span>6768</span>人</div> -->
                                        </div>
                                    </div>
                                    
									
                                    <div class="tmplmsg__search-wrap weui-desktop-data-overview-list" style="width: 600px;margin: 20px 0;">
                                    <label style="line-height: 36px;color: #666;">关键字：</label>
                                    <input type="text" class="weui-desktop-form__input" id="kwd" value="<? echo $row['kwd'];?>" placeholder="最多10个汉字">
                                </div>
                                
									<!-- 群发信息的类型 -->
									<div class="title_tab">
										<div class="weui-desktop-tab weui-desktop-tab_title">
									  		<ul class="weui-desktop-tab__navs">

									  			<!-- 选中类名：selected -->
										    	<li class="weui-desktop-tab__nav <? if($nowstyle=="text")echo "selected";?>" data="text">
										    		文字
										    	</li>

										    	<li class="weui-desktop-tab__nav <? if($nowstyle=="image")echo "selected";?>"  data="image">
										    		图片
										    	</li>

										    	<li class="weui-desktop-tab__nav <? if($nowstyle=="urlLink")echo "selected";?>"  data="urlLink" >
										    		图文
										    	</li>

										    	<li class="weui-desktop-tab__nav <? if($nowstyle=="joinroom")echo "selected";?>" data="joinroom"  >
										    		加群
										    	</li>

									  		</ul>
										</div>
									</div>

									<!-- 群发内容 -->
									<div class="form-wrap">

										<!-- 文字 -->
										<div class="weui-desktop-panel__bd form">
											<div class="tmplmsg__search-wrap weui-desktop-data-overview-list">
												<label>回复文字：</label>
						                        <textarea name="" placeholder="" class="weui-desktop-form__textarea" style="resize: none;" id="text_text"><? if($nowstyle=="text") echo stripslashes($data['text']);?></textarea>
						                    </div>
										</div>
										
										<!-- 图片 -->
										<div class="weui-desktop-panel__bd form">
											<div class="overview" style="padding-top: 0">
												<div class="content-tab-box">
													<div class="selected content-tab" data="remote" >
														图片链接
													</div>
													<div class="content-tab" data="local" >
														本地上传
													</div>
												</div>
											</div>
											<div class="tmplmsg__search-wrap weui-desktop-data-overview-list">
												<!-- <label>图片：(上传本地图片或者直接输入图片链接)</label> -->
						                        
						                        <div class="upload-content upload-link" style="display:block;">
						                        	回复图片
						                        	<input type="text" class="weui-desktop-form__input pic-link" id="image_url" value="<? if($nowstyle=="image") echo stripslashes($data['url']);?>" placeholder="输入图片链接">
						                        </div>
                                                <div class="upload-content upload-local" style="display:none;">
						                        	上传本地图片：
						                        	<div class="webuploader-container weui-desktop-btn weui-desktop-btn_default">
					                        			上传文件
						                        		<input type="file" onchange="upload('local_image')" id="local_image" name="local_image" >
						                        	</div>
						                        	<div class="img-wrap" style="display:none;" id="w-img-wrap">
						                        		<img src="" alt="">
						                        	</div>
						                        </div>
						                    </div>
										</div>


										<!-- 图文 -->
										<div class="weui-desktop-panel__bd form">
											<div class="tmplmsg__search-wrap weui-desktop-data-overview-list">
						                        <label>标题：</label>
						                        <input type="text" class="weui-desktop-form__input info-title" id="urlLink_title" value="<? if($nowstyle=="urlLink") echo stripslashes($data['title']);?>">
						                    </div>
						                    <div class="tmplmsg__search-wrap weui-desktop-data-overview-list">
						                        <label>描述：</label>
						                        <input type="text" class="weui-desktop-form__input info-desc" id="urlLink_desc" value="<? if($nowstyle=="urlLink") echo stripslashes($data['description']);?>">
						                    </div>
						                    <div class="tmplmsg__search-wrap weui-desktop-data-overview-list">
						                        <label>图文链接：</label>
						                        <input type="text" class="weui-desktop-form__input txt-link" id="urlLink_url" value="<? if($nowstyle=="urlLink") echo $data['url'];?>">
						                    </div>
						                    <div class="tmplmsg__search-wrap weui-desktop-data-overview-list">
						                        <label>缩略图链接：</label>
						                        <input type="text" class="weui-desktop-form__input thumbnail-link" id="urlLink_image_url" value="<? if($nowstyle=="urlLink") echo stripslashes($data['thumbnailUrl']);?>">
						                    </div>
										</div>

										<!-- 小程序 -->
										<div class="weui-desktop-panel__bd form">
											<table width="100%" border="0" cellpadding="1" cellspacing="1" style="background:#CCC;table-layout: fixed;">
	                                          <tbody>
	                                          	  <tr>
	                                          		<td style="background-color: #f4f5f9;width: 80px" data-sequence="down">
		                                            	选择
		                                            </td>
		                                            <td style="background-color: #f4f5f9;" data-sequence="down"> 
		                                            	群名称
		                                            </td>
		                                            <td style="background-color: #f4f5f9; width:80px;" data-sequence="down" > 
		                                            	人数
		                                            </td>
		                                          </tr>
                                                  
                                                 <? foreach($i['list'] as $r){?>
		                                         <tr>
		                                         	<td class="check-item">
		                                         		<div class="check-btn" data-check-all="on">
															<div class="weui-desktop-icon-checkbox" data-id="<? echo $r['roomid'];?>"></div>
														</div>
		                                         	</td>
		                                            <td class="group">
		                                            	<img class="member-header" src="<? echo $r['avatar'];?>" alt="" style="border-radius:0;">
		                                            	<span class="member-name"><? echo $r['topic'];?></span>
		                                            </td> 
                                                    <td>
		                                            	 <? echo $r['totaluser'];?>
		                                            </td> 
		                                          </tr>
                                                 <? }?>
		                                           
	                                         
	                                        </tbody>
	                                    </table>
                                        <div style="color: #F00; font-size:12px; margin-top:20px;">注：当群员数>100时，请确认已添加机器人为群管理员，不然没权限拉人进群。</div>
										</div>

									</div>

									<div>
				                      	<button class="weui-desktop-btn weui-desktop-btn_default tmplmsg__panel-btn-top submit-btn" style="background: #4797eb;color: #fff;margin:0px 0 20px">提交</button>
                                         
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
    <script src="<? echo _URL_;?>assets/js/ajaxfileupload.js"></script>
	<script>
        var isUpload=false;
		$(function(){
			var roomiid="<? echo $roomiid;?>";
			var roomid="<? echo $roomid;?>";
            var nowstyle="<? echo $nowstyle;?>";
			var nowimage="remote";//远程
			
			<? if($id>0){//编辑?>
			   var initindex=<? echo $initindex;?>;
			   $(".form-wrap .form").eq(initindex).show().siblings().hide();
			<? }?>
			
			<? if($nowstyle=="joinroom"){//初始化选中群聊?>
			   $(".check-btn").each(function(){
			       if($(this).find("div").attr("data-id")==roomid){
				        $(this).attr("data-check-status","on")
						$(this).find("div").addClass("on")
						checkStatus="on";  
				   }
			   })
			<? }?>
			
			
			// 选择信息类型
			$(".weui-desktop-tab__navs li").click(function(){
				if(!$(this).hasClass("selected")){
					$(this).addClass("selected").siblings().removeClass("selected")
				}

				var index = $(this).index()
				$(".form-wrap .form").eq(index).show().siblings().hide()
				// console.log(index)
				nowstyle = $(this).attr("data"); 
			})
			
			//选群
			$("body").on("click",".check-btn",function(){
			    $(".check-btn").each(function(){
				    $(this).attr("data-check-status","off")
					$(this).find("div").removeClass("on").addClass("off")
				})
				 
				 // 当前选中状态
				checkStatus = $(this).attr("data-check-status")
              
				// 检测是否已经选中
				if(checkStatus == "on"){ // 取消 
					$(this).attr("data-check-status","off")
					$(this).find("div").removeClass("on").addClass("off")

					if(checkAll == "on"){
						$(".check-all").find("div").removeClass("on").addClass("off")
						$(".check-all").attr("data-check-all","off")
					} 
				}else{  // 选中
					$(this).attr("data-check-status","on")
					$(this).find("div").addClass("on")
					checkStatus="on";  
					roomid = $(this).find("div").attr("data-id");
				} 
				 
			})
			
			
			function lengthbyte(str){
			  var bytesCount=0;
			  for (var i = 0; i < str.length; i++)
			  {
				var c = str.charAt(i);
				if (/^[\u0000-\u00ff]$/.test(c)) //匹配双字节
				{
				bytesCount += 1;
				}
				else
				{
				bytesCount += 2;
				}
			  }
			  return bytesCount;
			}

			var isSubmit=false;
			$(".submit-btn").click(function(){ 
			    var kwd = $("#kwd").val();
				if(kwd==""){
				    popTipsFn("请输入关键字")
					$("#kwd").focus();
				    return;
				}
				if(lengthbyte(kwd)>20){
				    popTipsFn("关键字最多10个汉字")
					$("#kwd").focus();
				    return;
				}
				
				if(nowstyle=='joinroom'){
				    if(roomid==""){
					   popTipsFn("请选择群聊") 
				       return;
					}
					if(isSubmit==true) return;
					else isSubmit=true;
					 
					popSquareLoading("正在提交...") 
					$.ajax({
						type: "GET",
						url: "<? echo API_URL;?>", 
						data: "action=add_auto_reply&name=join_room&bid=<? echo $bid;?>&roomid="+roomid+"&kwd="+encodeURIComponent(kwd)+"&roomiid=<? echo $roomiid;?>", 
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
								 location="index.php?action=room_auto_reply&bid=<? echo $bid;?>&roomid=<? echo $roomiid;?>"
							 }, 1000 * 2 );
						},
						error: function(msg){ 
						     hideSquareLoading();
							 isSubmit=false     
						}
					}) 
				}
				
			    if(nowstyle=='urlLink'){ 
				    var urlLink_title =$("#urlLink_title").val().trim();
					if(urlLink_title==""){
					   popTipsFn("请输入标题")
					   $("#urlLink_title").focus();
				       return;
					}
					var urlLink_desc =$("#urlLink_desc").val().trim();
					if(urlLink_desc==""){
					   popTipsFn("请输入描述")
					   $("#urlLink_desc").focus();
				       return;
					}
					var urlLink_url =$("#urlLink_url").val().trim();
					if(urlLink_url==""){
					   popTipsFn("请输入图文链接")
					   $("#urlLink_url").focus();
				       return;
					}
					
					var urlLink_image_url =$("#urlLink_image_url").val().trim();
					if(urlLink_image_url==""){
					   popTipsFn("请输入缩略图链接")
					   $("#urlLink_image_url").focus();
				       return;
					}
				 
					if(isSubmit==true) return;
					else isSubmit=true;
					 
					popSquareLoading("正在提交...") 
					$.ajax({
						type: "GET",
						url: "<? echo API_URL;?>", 
						data: "action=add_auto_reply&name=send_urlLink&bid=<? echo $bid;?>&title="+encodeURIComponent(urlLink_title)+"&description="+encodeURIComponent(urlLink_desc)+"&url="+encodeURIComponent(urlLink_url)+"&thumbnailUrl="+encodeURIComponent(urlLink_image_url)+"&kwd="+encodeURIComponent(kwd)+"&roomiid=<? echo $roomiid;?>", 
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
								 location="index.php?action=room_auto_reply&bid=<? echo $bid;?>&roomid=<? echo $roomiid;?>"
							 }, 1000 * 2 );
						},
						error: function(msg){ 
						     hideSquareLoading();
							 isSubmit=false     
						}
					}) 
					 
				}
				
				if(nowstyle=='image'){
					if(nowimage=="remote"){
					   var url=$("#image_url").val().trim();
					   if(url==""){
						   popTipsFn("请输入图片超链接")
						   return;
						}  
					}else if(nowimage=="local"){
					   var url=$(".img-wrap").find("img").attr("src");;
					   if(url==""){
						   popTipsFn("请上传图片")
						   return;
						}  
					}  
					 
					if(isSubmit==true) return;
					else isSubmit=true;
					popSquareLoading("正在提交...")
					
					$.ajax({
						type: "GET",
						url: "<? echo API_URL;?>", 
						data: "action=add_auto_reply&name=send_image&bid=<? echo $bid;?>&url="+encodeURIComponent(url)+"&kwd="+encodeURIComponent(kwd)+"&roomiid=<? echo $roomiid;?>", 
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
								 location="index.php?action=room_auto_reply&bid=<? echo $bid;?>&roomid=<? echo $roomiid;?>"
							 }, 1000 * 2 );
						},
						error: function(msg){ 
						     hideSquareLoading();   
							 isSubmit=false  
						}
					}) 
					
				}
				
				
			    if(nowstyle=='text'){ 
				    var text =$("#text_text").val().trim();
					if(text==""){
					   popTipsFn("请输入回复文字")
				       return;
					}
					 
					if(isSubmit==true) return;
					else isSubmit=true;
					 
					popSquareLoading("正在提交...") 
					$.ajax({
						type: "GET",
						url: "<? echo API_URL;?>", 
						data: "action=add_auto_reply&name=send_text&bid=<? echo $bid;?>&text="+encodeURIComponent(text)+"&kwd="+encodeURIComponent(kwd)+"&roomiid=<? echo $roomiid;?>", 
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
								 location="index.php?action=room_auto_reply&bid=<? echo $bid;?>&roomid=<? echo $roomiid;?>"
							 }, 1000 * 2 );
						},
						error: function(msg){ 
						     hideSquareLoading();   
							 isSubmit=false  
						}
					}) 
					 
				}
			})

			// 本地上传，图片链接
			$(".content-tab").click(function(){ 
				if(!$(this).hasClass("selected")){
					$(this).addClass("selected").siblings().removeClass("selected")
				} 
				var index = $(this).index()
				$(".upload-content").eq(index).show().siblings().hide()
				nowimage = $(this).attr("data");  
			})

			 
			


		})//function
		

/*
   发送图片
*/
  
//file发生变化		
function upload(picID){   
	 var picture=$a(picID).value; 
	 if(picture==''){ popTipsFn("× 请上传图片"); return;}
	 var extname2=picture.substring(picture.lastIndexOf(".")+1,picture.length);
	 extname2=extname2.toLowerCase(); 
	 if(extname2!= "png"&&extname2!= "jpg"&&extname2!= "gif"&&extname2!= "jpeg"){
		 popTipsFn("× 图片支持格式：png,jpg,gif");   return false ;
	 } 
	 ajaxFileUpload(picID);	 
}
  
function $a(id){
	return document.getElementById(id);
}
	
 
			 
	function ajaxFileUpload(sth)
	{ 
	    if(isUpload==false){
			 isUpload=true ; //设置开关
		}else{
		    popTipsFn("正在上传图片..")
			return;
		}
		image=sth;  
		cerisSubmit=1; 
		
		//正在上传
		popTipsFn("正在上传图片..")
		 
		//上传图片
		$.ajaxFileUpload
		(
			{
				url:'lib/uploadimg.php',  
				secureuri:false,
				fileElementId:image,
				dataType: 'json',
				data:{'image':image},
				success: function (data, status)
				{  
				    
					if(data.status==true){  
						  $("#w-img-wrap").show();
						  $("#w-img-wrap").find("img").attr("src",data.url);
					}else{
						popTipsFn(data.error)
					}
					
					cerisSubmit=0; 
					isUpload=false;
				},
			  	
				error: function (data, status, e)
				{ 
					 
					 cerisSubmit=0;
					 isUpload=false;
				}
				
				
			}
		)
		 

	}



	</script>
	
	
</body>
</html>