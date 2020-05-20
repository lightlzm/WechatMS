
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>即时群发</title>
	
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
									<h2>即时群发</h2>    
								</div>
								
								<!-- 群发信息管理 -->
								<div class="weui-desktop-panel weui-desktop-panel_overview">
									<h3 class="weui-desktop-panel__title" style="margin-bottom:20px;">群发信息</h3>
                                    <div class="tmplmsg__search-wrap weui-desktop-data-overview-list" style="width: 800px;margin-bottom: 10px;display: flex">
                                        <label style="min-width:120px;line-height: 36px;color: #666;">@所有人：</label>
                                        <div style="color: #999;display: inline-block;cursor: pointer;line-height: 36px;margin-right: 20px;width:78px" class="at_all" data-open="开启">
                                            <div class="weui-desktop-icon-checkbox timing-send " style="margin-top: -2px;margin-right: 2px"></div>
                                            是
                                        </div>
                                        <div style="color: #999;display: inline-block;cursor: pointer;line-height: 36px;" class="at_all" data-open="关闭">
                                            <div class="weui-desktop-icon-checkbox repeat-send on" style="margin-top: -2px;margin-right: 2px"></div>
                                            否
                                        </div>
                                        
                                        <div style="color: #999;display: inline-block;line-height: 36px; padding-left:30px; font-size:12px;" >  
                                            注：群人数太多时，不建议开启，避免对用户造成打扰(仅文字、图片)。
                                        </div>
                                        
                                        
                                    </div>
                                    
                                    <div class="tmplmsg__search-wrap weui-desktop-data-overview-list" style="width: 600px;margin-bottom: 10px;display: flex">
                                        <label style="min-width:120px;line-height: 36px;color: #666;">发送通知群聊：</label>
                                        <span class="select-group" style="color:#4797eb;cursor: pointer;line-height: 36px;">选择群聊</span>
                                    </div>
                                        
									<!-- 群发信息的类型 -->
									<div class="title_tab">
                                        <label style="min-width:120px;line-height: 36px;color: #666;">提醒内容：</label>
										<div class="weui-desktop-tab weui-desktop-tab_title">
                                           
									  		<ul class="weui-desktop-tab__navs">

									  			<!-- 选中类名：selected -->
										    	<li class="weui-desktop-tab__nav selected" data="text">
										    		文字
										    	</li>

										    	<li class="weui-desktop-tab__nav"  data="image">
										    		图片
										    	</li>

										    	<li class="weui-desktop-tab__nav"  data="urlLink" >
										    		图文
										    	</li>

										    	<li class="weui-desktop-tab__nav" style="display:none;" >
										    		小程序
										    	</li>

									  		</ul>
										</div>
									</div>

									<!-- 群发内容 -->
									<div class="form-wrap">

										<!-- 文字 -->
										<div class="weui-desktop-panel__bd form">
											<div class="tmplmsg__search-wrap weui-desktop-data-overview-list">
												<label>文字：</label>
						                        <textarea name="" placeholder="" class="weui-desktop-form__textarea" style="resize: none;" id="text_text"></textarea>
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
						                        	输入图片链接
						                        	<input type="text" class="weui-desktop-form__input pic-link" id="image_url">
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
						                        <input type="text" class="weui-desktop-form__input info-title" id="urlLink_title">
						                    </div>
						                    <div class="tmplmsg__search-wrap weui-desktop-data-overview-list">
						                        <label>描述：</label>
						                        <input type="text" class="weui-desktop-form__input info-desc" id="urlLink_desc">
						                    </div>
						                    <div class="tmplmsg__search-wrap weui-desktop-data-overview-list">
						                        <label>图文链接：</label>
						                        <input type="text" class="weui-desktop-form__input txt-link" id="urlLink_url">
						                    </div>
						                    <div class="tmplmsg__search-wrap weui-desktop-data-overview-list">
						                        <label>缩略图链接：</label>
						                        <input type="text" class="weui-desktop-form__input thumbnail-link" id="urlLink_image_url">
						                    </div>
										</div>

										<!-- 小程序 -->
										<div class="weui-desktop-panel__bd form">
											小程序
										</div>

									</div>

									<div>
				                      	<button class="weui-desktop-btn weui-desktop-btn_default tmplmsg__panel-btn-top submit-btn" style="background: #4797eb;color: #fff;margin:0px 0 20px">提交</button>
                                        <span style="color:#999; font-size:12px; margin-left:30px;">Tips:提交发送后，微信接收信息有一定延时</span>
				                    </div>
								</div>
                                
                                
                                <!-- 群列表弹窗 -->
									<div class="weui-desktop-dialog__wrp pop-group-list" style="display:;">
										<div class="weui-desktop-mask">
											<div class="weui-desktop-dialog" style="width:600px;margin-top: 60px;padding:14px 30px 10px;box-sizing: border-box;position: relative;">
												<div  class="weui-desktop-panel__bd innerbox " style="max-height: 400px; <? if($i['total']>8) echo 'overflow-y: scroll;';?>padding: 0;margin-top: 40px">
													<table width="100%" border="0" cellpadding="1" cellspacing="1" style="background:#CCC;table-layout: fixed;color: #353535;width: 100%">
							                              <tbody>
							                              	<tr>
							                              		<td style="background-color: #f4f5f9;width: 80px" data-sequence="down">
							                                    	全选
							                                    	<div class="check-all check-btn" data-check-all="off">
																		<div class="weui-desktop-icon-checkbox"></div>
																	</div>
							                                    </td>
							                                    <td style="background-color: #f4f5f9;" data-sequence="down"> 
							                                    	群名称
							                                    </td>
							                                     
							                                  </tr>
							                                 <? foreach($i['list'] as $r){?>
                                                             <tr>
                                                                <td class="check-item">
                                                                    <div class="check-btn" data-check-all="on">
                                                                        <div class="weui-desktop-icon-checkbox" data-id="<? echo $r['roomid'];?>" data-topic="<? echo $r['topic'];?>"></div>
                                                                    </div>
                                                                </td>
                                                                <td class="group">
                                                                    <img class="member-header" src="<? echo $r['avatar'];?>" alt="" style="border-radius:0;">
                                                                    <span class="member-name"><? echo $r['topic']?$r['topic']:"未命名";?></span>
                                                                </td> 
                                                              </tr>
                                                                
                                                              
                                                             <? }?>
                                                             
		                                           
	                                         
	                                        </tbody>
	                                    </table>
                                        <button class="weui-desktop-btn weui-desktop-btn_default tmplmsg__panel-btn-top close-button" style="background: #4797eb;color: #fff;margin:20px 0 20px">确定</button>
                                                <!-- 分页 -->
                                                <div class="page" style="bottom: 40px; display:none;">
                                                    <div style="display:;">
                                                        <!-- 不可点 -->
                                                        <a href="">首页</a>
                                                        <a href="" class="unable last-page">上一页</a>
                                                        <a href="" class="active">1</a>
                                                        <a href="">2</a>
                                                        <a href="" class="next-page">下一页</a>
                                                        <a href="">尾页</a>
                                                    </div>
                                                    共<span><? echo $i['total'];?></span>个群
                                                </div>

												</div>
                                                <div class="close-btn close-button"></div>
											</div>
											
										</div>
									</div>
                                   <!--选群结束-->

 
								

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
			var roomid="";
			var roomSelectNum=0; //已选群数
			var roomSelectString="";//已选群名字
            var nowstyle="text";
			var nowimage="remote";//远程
			
			// 设置是否开启
			$(".at_all").click(function(){ 
				$(".at_all").find(".on").removeClass("on")
				$(this).find("div").addClass("on") 
				var openType = $(this).data("open")
				console.log(openType)  
			})
			
			// 打开群列表
			$(".select-group").click(function(){
				$(".pop-group-list").fadeIn()
			})

			// 关闭群列表
			$(".close-button").click(function(){
				$(".pop-group-list").fadeOut()
			})
			
			
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
			
			var isSubmit=false;
			$(".submit-btn").click(function(){
				var at_all = $(".at_all").find(".on").parent().attr("data-open")=="开启"?1:0;
				 
				 
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
					
					
					if(roomid==""){ 
					   popTipsFn("请选择微信群")
					   return;
					}
					if(isSubmit==true) return;
					else isSubmit=true;
					 
					popSquareLoading("正在发送...") 
					$.ajax({
						type: "GET",
						url: "<? echo API_URL;?>", 
						data: "action=create_job&name=send_chatroom_urlLink&bid=<? echo $bid;?>&title="+encodeURIComponent(urlLink_title)+"&roomid="+roomid+"&description="+encodeURIComponent(urlLink_desc)+"&url="+encodeURIComponent(urlLink_url)+"&thumbnailUrl="+encodeURIComponent(urlLink_image_url)+"&at_all="+at_all, 
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
					
					if(roomid==""){ 
					   popTipsFn("请选择微信群")
					   return;
					}  
					
					if(isSubmit==true) return;
					else isSubmit=true;
					popSquareLoading("正在发送...")
					
					$.ajax({
						type: "GET",
						url: "<? echo API_URL;?>", 
						data: "action=create_job&name=send_chatroom_image&bid=<? echo $bid;?>&url="+encodeURIComponent(url)+"&roomid="+roomid+"&at_all="+at_all, 
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
					
				}
				
				
			    if(nowstyle=='text'){ 
				    var text =$("#text_text").val().trim();
					if(text==""){
					   popTipsFn("请输入文字")
				       return;
					}
					if(roomid==""){ 
					   popTipsFn("请选择微信群")
					   return;
					}
					if(isSubmit==true) return;
					else isSubmit=true;
					 
					popSquareLoading("正在发送...") 
					$.ajax({
						type: "GET",
						url: "<? echo API_URL;?>", 
						data: "action=create_job&name=send_chatroom_text&bid=<? echo $bid;?>&text="+encodeURIComponent(text)+"&roomid="+roomid+"&at_all="+at_all, 
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

			
			// 选中
			var checkAll = "off";  //默认全不选中
			$("body").on("click",".check-btn",function(){

				// 全选按钮
				if($(this).hasClass("check-all")){

					// 当前全部的状态
					checkAll = $(this).attr("data-check-all")
					// 取消全部
					if(checkAll == "on"){

						$(this).find("div").removeClass("on").addClass("off")
						$(this).attr("data-check-all","off")
						checkAll = "off"

						// 处理单选
						$(".check-btn").attr("data-check-status","off").find("div").removeClass("on").addClass("off")

					}else{
						// 全部
						$(this).find("div").addClass("on")
						$(this).attr("data-check-all","on")
						checkAll = "on"

						// 处理单选
						$(".check-btn").attr("data-check-status","on").find("div").addClass("on")

					}

				}else{  // 单选按钮

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

					}

					// 设置全选或全不选样式
					var checked = $(".check-item .on").length;    // 已选中的个数
						allLength = $(".check-item").length;   // 可选的个数
					
					if(checked == allLength){  
						$(".check-all").find("div").addClass("on")
						$(".check-all").attr("data-check-all","on")
					}

				}

				// 选中的id集合
				var checkItems = $(".check-item .on"),
					idArr =[]  // 清空数组
				for(x=0;x<checkItems.length;x++){
					idArr.push($(checkItems[x]).data("id"))
				}
				  
				roomSelectNum = checkItems.length; 
				roomid = idArr.join(",")
				
				 
				if(roomSelectNum>0){ 
				   string= "已选中"+roomSelectNum+"个群："+$(checkItems[0]).data("topic")
				   if(roomSelectNum>1) string= string+"，"+$(checkItems[1]).data("topic")+"等"
				   $(".select-group").html(string);
				}else{
				   $(".select-group").html("选择群聊");
				}
				//alert(roomSelectNum);
				// console.log(data)


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