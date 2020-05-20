<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>微信管理系统</title>
	
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
				<div class="weui-desktop-layout__main" style="background-color: #FFF;">
					<div class="weui-desktop-layout__main__area">
						<div class="weui-desktop-layout__main__inner">
							<div class="main_bd">
                                   <div style="padding-left:10px; padding-top:10px; margin-top:20px; color:green;">  1、微信管理系统已安装成功。<br></div>
                                   <div style="padding-left:10px; margin-top:20px; color:red;">  2、Wechaty仍未初始化，快去启动吧。 详情见：xxx</div> 
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


	})
	

</script>
	
	
</body>
</html>