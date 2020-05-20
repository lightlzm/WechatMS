
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>发送日历</title>
	
	<? include("html/cssline.php"); ?>
	<style>
		.myar { width:590px; margin-left:auto; margin-right:0px;}
.myar_tit { display:block; height:30px; line-height:30px; font-size:16px; background:url(/planpoint/Public/img/huodong/myask.png) 0px center no-repeat;}
.myar_tit span{ display:block; height:30px; line-height:30px; font-size:16px; float:right; color:#626262;}
.myask ul { display:block; clear:both; margin-top:6px;}
.myask ul li { display:block; height:34px;}
.myask ul li a{ display:block; height:34px; line-height:28px; font-size:14px; color:#626262;}
.myask ul li a:hover{ display:block; height:34px; line-height:28px; font-size:14px; color:#325797;}
.geren_left,.geren_title,.geren_line,.geren_photos,.leiji,.ren{width:700px;}
.myar{width:670px;}
a.title{height:22px; font-size:18px; font-weight:bold; line-height:22px; margin-top:10px; margin-bottom:22px;}
a.title:hover{color:#325797;}



.main_title { height:18px; line-height:18px; font-size:14px; color:#2D2D2D; font-weight:bold; font-family:"微软雅黑";}
.main_title_red {color:#f13a2f; padding:0 5px; }
.main_cal_btn { width:657px; height:auto; overflow:hidden; text-align:right;}
.main_cal_btn a.mc_rl { display:inline-block; width:69px; height:24px; line-height:24px; background:url(/members/plugin/img/main_roll_btnl.png) no-repeat; overflow:hidden; text-align:center;}
.main_cal_btn a.mc_rr { display:inline-block; width:69px; height:24px; line-height:24px; background:url(/members/plugin/img/main_roll_btnr.png) no-repeat; overflow:hidden; text-align:center; margin:0 6px;}
.main_cal_btn a.mc_rc { display:inline-block; width:98px; height:24px; line-height:24px; background:url(/members/plugin/img/main_enter_cal.png) no-repeat; overflow:hidden; text-align:center; font-size:13px;}
.main_cal { width:664px; height:auto; margin:10px auto 0px auto;}
.main_cal_date{ width:664px; height:auto; margin:20px auto 20px;}
#main_cal_date li{ display:block; width:92px; height:38px; line-height:38px; float:left; overflow:hidden; 
	background:url(<? echo _URL_;?>assets/imgs/main_cal_datebg.gif) left top repeat-x; 
	border-left:#FFF solid 1px; border-right:#dedede solid 1px; text-align:center; font-size:14px; color:#333;}
#main_cal_date li.mc_frist {border-left:#dedede solid 1px;}
#main_cal_date li font { font-family:Arial, Helvetica, sans-serif; font-weight:bold; margin-right:3px;}
#main_cal_date li.mc_date_red { color: #e55459}


.date_list { width:92px; 
	/*height:87px; */
	height: 70px;
	/*background:#FFF url(/members/plugin/img/date_listbg.gif) left top repeat-x; */
	background: #fff;
	/*text-align:center; border-left:#FFF solid 1px;*/
	border-left: #dedede solid 1px;
	 border-right:#fff solid 1px; 
	 border-bottom: #dedede solid 1px;
	 position:relative; 
	 /*cursor:pointer; */
	 z-index:9}
.today { width:28px; height:17px; position:absolute; top:3px; right:3px; z-index:4px; background:url(/members/plugin/img/today.gif) left top no-repeat;}
td:nth-child(7n) .date_list{
	border-right:#dedede solid 1px;
}
.date_sun { font-size:34px; font-family: Arial, Helvetica, sans-serif; font-weight:bold; color:#e55459; display:block; line-height:36px; padding-top:8px;}
.date_non { 
	/*font-size:26px; */
	font-size: 20px;
	font-family: Arial, Helvetica, sans-serif; font-weight: normal; color: #C1C1C1; display:block; line-height:70px;/* padding-top:8px;*/
	/*background:url(assets/imgs/mc_date_between.png) center bottom no-repeat;*/
	/*padding-bottom: 10px;*/
	text-align: center;
	/*cursor: pointer;*/
}
.date_normal { 
	/*font-size:34px; */
	font-size: 20px;
	font-family: Arial, Helvetica, sans-serif; font-weight:bold; 
	/*color:#4085ac; */
	color: green;
	display:block; line-height:70px; /*padding-top:8px;*/
/*background:url(assets/imgs/mc_date_between.png) center bottom no-repeat;*/
/*padding-bottom: 10px; */
text-align: center;
cursor: pointer;}
.destination { display:block; width:92px; 
	/*height:34px; */
	height: 20px;
	line-height:34px; color:#333; background:url(assets/imgs/mc_date_between.png) center top no-repeat; margin-top:6px; font-size:14px;}
.destination_non { display:block; width:92px; height:34px; line-height:34px; color: #969696; background:url(/members/plugin/img/mc_date_between_non.png) center top no-repeat; margin-top:2px;}
.date_list del { width:6px; height:6px; position:absolute; left:2px; bottom:2px; z-index:9}
.mc_bottom { width:658px; color:#333; margin-bottom:40px; font-size:13px;}
.mc_p { display:block; float:right; color:#333; font-size:13px;}
.pop { width:511px; height:atuo; position:absolute; top:73px; z-index:9998; display:none; text-align:left; zoom:1; cursor: default;}
.pop_top { width:511px; height:12px; background:url(/members/plugin/img/cal_pop_top.png) left top no-repeat; }
.pop_bottom { width:511px; height:12px; background:url(/members/plugin/img/cal_pop_bottom.png) left top no-repeat; }
.pop_body { width:511px; height:auto; background:url(/members/plugin/img/cal_pop_body.png) center top repeat-y;}
.pop_body p { font-size:14px; line-height:24px; padding-left:30px; padding-bottom:10px; padding-top:10px; padding-right:30px;}
.pop_body p font.pop_title { font-weight:bold; color:#1369a5; margin-right:16px; font-size:14px;}
.pop_body p font.pop_time { font-family:Arial, Helvetica, sans-serif; color:#575757; margin-right:16px; font-size:14px;}
.pop_body p font.pop_myp_area { color:#1369a5; margin-right:16px; font-size:14px;}
.pop_body p font.pop_myp_hotel { color:#333; font-size:14px;}
.pop_body .pop_list_title { width:481px; height:20px; line-height:20px; margin:0 auto; background:url(/members/plugin/img/black_white_line.gif) center center repeat-x;}
.pop_body .pop_list_title span { display: inline-block; padding:0 5px; background:#FFF; float:left; margin-left:15px; font-weight:bold;}
.pop_body .pop_list_title a { display: inline-block; padding:0 5px; background:#FFF; float:right; margin-right:15px;}
.pop_body .pop_list_title a font { font-family:Arial, Helvetica, sans-serif; color:#1369a5}
.date_0 { left:-20px;}
.date_1 { left:-92px;}
.date_2 { left:-92px;}
.date_3 { left:-180px;}
.date_4 { left:-272px;}
.date_5 { left:-312px;}
.date_6 { left:-395px;}

.date_00 { left:-20px;}
.date_11 { left:-92px;}
.date_22 { left:-92px;}
.date_33 { left:-180px;}
.date_44 { left:-272px;}
.date_55 { left:-312px;}
.date_66 { left:-395px;}
.pop_point{ width:92px; height:29px; position:absolute; top:53px; left:0px; background:url(/members/plugin/img/cal_pop_point.png) center top no-repeat; z-index:9999; display:none}

.cal_btn a {
    font-size: 16px;
    color: #259;
    outline: none;
    font-weight: normal;
    text-decoration: none;
    display: inline;
}
.cal-title{
	margin-bottom: 30px;
	color: #666;
	font-size: 15px;


}
.cal-title span{
	color: #ff6a00;
	font-weight: bold;
	/*font-size: 13px;*/
}
.cal-title i{
	/*font-style: italic;*/
	/*color: #ff6a00;*/
	font-weight: bold;
	color: #181818;
}



	</style>

</head>
<body>
	
	<div class="layout">

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
									<h2>发送日历</h2>    
								</div>			

								<!-- 群成员表格 -->
								<div class="weui-desktop-panel weui-desktop-panel_overview">
							
									<div class="weui-desktop-panel__bd">

										<!-- title -->
										<!-- <div class="cal-title"><span class="group-name">财经快报群</span>发送日历</div> -->
										<div class="cal-title"><i class="user-name"><? echo $rb['nickname'];?></i>在<span class="group-name"><? echo $rm['topic'];?></span>发送日历</div>

										<!-- 发送日历 -->
										<input type="hidden" id="nowindex" value="34">

										<!-- 选择月份 -->
										<div class="main_cal">
											<div class="cal_btn" style="width:90%; text-align:center; color:#555;">选择
												<select name="" id="nowYear">
                                                    <? $y=date("Y");
													 for($year=$y; $year>2019;$year--){
													?>
													<option value="<? echo $year?>" <? if($nowYear==$year){?>selected="selected"<? }?>><? echo $year?></option>
													<? }?>
												</select>年
												<select name="" id="nowMonth">
													<option value="01" <? if($nowMonth=='01'){?>selected="selected"<? }?>>01</option>
													<option value="02" <? if($nowMonth=='02'){?>selected="selected"<? }?>>02</option>
													<option value="03" <? if($nowMonth=='03'){?>selected="selected"<? }?>>03</option>
													<option value="04" <? if($nowMonth=='04'){?>selected="selected"<? }?>>04</option>
													<option value="05" <? if($nowMonth=='05'){?>selected="selected"<? }?>>05</option>
													<option value="06" <? if($nowMonth=='06'){?>selected="selected"<? }?>>06</option>
													<option value="07" <? if($nowMonth=='07'){?>selected="selected"<? }?>>07</option>
													<option value="08" <? if($nowMonth=='08'){?>selected="selected"<? }?>>08</option>
													<option value="09" <? if($nowMonth=='09'){?>selected="selected"<? }?>>09</option>
													<option value="10" <? if($nowMonth=='10'){?>selected="selected"<? }?>>10</option>
													<option value="11" <? if($nowMonth=='11'){?>selected="selected"<? }?>>11</option>
													<option value="12" <? if($nowMonth=='12'){?>selected="selected"<? }?>>12</option>
												</select>月
 
　　　　　　										<a class="mc_rl followclick" href="index.php?action=room_member_calendar&contact_id=<? echo $_GET['contact_id'];?>&roomid=<? echo $_GET['roomid'];?>&Mon=<? echo $np['pMon'];?>&Year=<? echo $np['pYear'];?>">上一月</a> | 
												<a class="mc_rr followclick" href="index.php?action=room_member_calendar&contact_id=<? echo $_GET['contact_id'];?>&roomid=<? echo $_GET['roomid'];?>&Mon=<? echo $np['nMon'];?>&Year=<? echo $np['nYear'];?>">下一月</a>
											</div>
										</div>

										<div class="main_cal_date">
											<ul id="main_cal_date">
												<li class="mc_frist mc_date_red">
													<font class="mc_date_red">SUN</font>日
												</li>
												<li>
													<font>MON</font>一
												</li>
												<li>
													<font>TUE</font>二
												</li>
												<li>
													<font>WED</font>三
												</li>
												<li>
													<font>THU</font>四
												</li>
												<li>
													<font>FRI</font>五
												</li>
												<li class="mc_date_red">
													<font>SAT</font>六
												</li>
											</ul>

											<div class="clear_shen"></div>

											<div class="date_wrap">
												<table id="date_list" width="658" border="0" cellspacing="0" cellpadding="0" bgcolor="#EBEBEB">
                                                    <? foreach($list as $i=>$n){?>
                                                    <? if($i==0||$i==7||$i==14||$i==21||$i==28||$i==35){?>
													<tr>
                                                    <? }?>
														<td>
															<div  class="date_list" id="1">
                                                               <? if($n['isShow']){?>
																  <? if($n['yiguo']){?>
                                                                    <? if($n['total']>0){?> 
                                                                        <span class="date_normal" title="<? echo $n['total'];?>"  date="<? echo $n['d'];?>" ><? echo $n['n'];?></span>
                                                                    <? }else{ ?>
                                                                        <span class="date_non"><? echo $n['n'];?></span>
                                                                    <? }?>
                                                                <? }else{ ?>
                                                                     <span class="date_non"><? echo $n['n'];?></span>
                                                                <? }?>
                                                                
                                                                <? }?>
															</div>
														</td>
													<? if($i==6||$i==13||$i==20||$i==27||$i==34||$i==41){?>	 
													</tr>
                                                    <? }?>
													<? }//foreach?> 
												</table>
											</div>

                                         <div style="margin-top:20px;color: green;">
                                          绿色：有发送信息
                                         </div> 
                                         <div style="margin-top:10px;color:#C1C1C1;;">
                                          灰色：无发送信息
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
	    $('#nowMonth').change(function(){ 
		 popSquareLoading("正在加载...")
		 location="index.php?action=room_member_calendar&contact_id=<? echo $_GET['contact_id'];?>&roomid=<? echo $_GET['roomid'];?>&Year="+$("#nowYear").val()+"&Mon="+$("#nowMonth").val();
        });
		
		$(".date_normal").click(function(){
		    var date=$(this).attr("date");
			location="index.php?action=room_member_message&contact_id=<? echo $_GET['contact_id'];?>&roomid=<? echo $_GET['roomid'];?>&date="+date;
		})
	 })
		 
		 

	</script>
	
	
</body>
</html>