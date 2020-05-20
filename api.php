<?
/*
 * @Author: lightlizm
 * @Date: 2020-04-16 11:31:15
 * @LastEditors: lightlizm
 * @LastEditTime: 2020-05-07 21:01:15
 * @Description: 接口
 */
/*
    API List:
	query_job  查询任务状态
	markup_job 标记任务已执行
	get_job    获取任务（执行）
	create_job 创建任务
	           --name=init_chatroom_list     初始化所有群里
			   --name=init_chatroom_member   初始化群聊会员
			   --name=send_chatroom_urlLink  发送链接卡片到群聊
			   --name=send_chatroom_text     发送文字到群聊
			   --name=send_chatroom_image    发送图片到群聊
			   --name=edit_chatroom_announce 修改群公告（群管理员才有权限）
			   --name=edit_chatroom_topic    修改群名（群管理员才有权限）
	
	log_chatroom_msg       更新群聊日志
	markup_join_room       记录新用户入群
	update_chatroom_member 更新群聊会员（数据结构整体更新）
	sys_member             更新群聊会员（数据库操作）
	update_chatroom        更新单个群聊资料
	edit_join_welcome_msg  编辑入群欢迎语
	get_join_welcome_msg   获取入群欢迎语
	add_auto_reply         添加自动回复
	
	get_job_timing         获取定时任务
	
			   
*/
include("config.php");
include_once(dirname(__file__)."/lib/connect_db.php");//链接数据库
include_once(dirname(__file__)."/func.php");

 
//$roomlist=array("24238356743@chatroom","23034176194@chatroom");
//http://127.0.0.1:8100/botapi/botjdapi.php

$action = empty($_GET['action'])?$_POST['action']:$_GET['action'];
switch($action){
   //创建任务
   case "create_job":
         $name = $_GET['name'];
		 $bid = $_GET['bid']; 
		 $at_all = intval($_GET['at_all']);
		 $send_style = intval($_GET['send_style']);//0实时1定时2重复
		 $is_open =0 ; //是否开启1是0否（限定时发送）
		 switch($name){
			 case "quit_chatroom"://退出群聊
			       $roomid = $_GET['roomid'];  
				   $data = array("roomid"=>$roomid); 
				   
				   break; 
			 case "edit_chatroom_topic"://修改群名字
			       $text = $_GET['text'];   
				   $roomid = $_GET['roomid'];  
				   $data = array("roomid"=>$roomid,'text'=>$text); 
				   
				   $sql="update `chatroom` set topic='$text' where roomid='$roomid'";  
			       $result=mysql_query($sql);
				   
			       break;
			 case "edit_chatroom_announce"://修改群公告
			       $text = $_GET['text'];   
				   $roomid = $_GET['roomid']; 
				   $roomlist=explode(",",$roomid);
				   $data = array("roomlist"=>$roomlist,'text'=>$text);
				   
				   $sql="update `chatroom` set announce='$text' where roomid='$roomid'"; 
			       $result=mysql_query($sql);
			 
			       break;
				   
			 case "send_chatroom_image": //支持多群发送
				   $url = $_GET['url'];   
				   $roomid = $_GET['roomid']; 
				   $roomlist=explode(",",$roomid);
				   $data = array("roomlist"=>$roomlist,'url'=>$url,'at_all'=>$at_all);
				   if($send_style>0){
					   $data['job_title']=$_GET['title']; //标题
					   $is_open = 1;
				       if($send_style==1){
					       $send_time = $_GET['send_time'];
						   list($date,$time) = explode(" ",$send_time);
						   $doing_time=$time; //时间 HH:ii
						   $doing_date = $date; //日期 YYYY-mm-dd
					   }elseif($send_style==2){
					       $doing_time = $_GET['send_time']; //时间 HH:ii
						   $doing_date = $_GET['weekday'];  //0-6  
					   }
				   } 
			       break; 
			 case "send_chatroom_text": //支持多群发送
				   $text = $_GET['text'];   
				   $roomid = $_GET['roomid']; 
				   $roomlist=explode(",",$roomid);
				   $data = array("roomlist"=>$roomlist,'text'=>$text,'at_all'=>$at_all);  
				   
				   if($send_style>0){
					   $data['job_title']=$_GET['title']; //标题
					   $is_open = 1;
				       if($send_style==1){
					       $send_time = $_GET['send_time'];
						   list($date,$time) = explode(" ",$send_time);
						   $doing_time=$time; //时间 HH:ii
						   $doing_date = $date; //日期 YYYY-mm-dd
					   }elseif($send_style==2){
					       $doing_time = $_GET['send_time']; //时间 HH:ii
						   $doing_date = $_GET['weekday'];  //0-6  
					   }
				   }
				   
			       break; 
			case "send_chatroom_urlLink": //群发图文
			/*
http://129.204.230.149:8100/botapi/api.php?action=create_job&name=send_chatroom_urlLink&topic=%E6%B5%8B%E8%AF%954&roomid=23034176194@chatroom&title=%E7%BE%8E%E5%9B%BD%E4%B9%90%E5%AE%B6%E6%9D%8F%E4%BB%81%E7%B3%961105g49%EF%BC%8C%E5%98%89%E5%A3%AB%E5%88%A9%E7%94%9C%E8%96%84%E8%84%86%E9%A5%BC%E5%B9%B2832g19.9%EF%BC%8C%E9%A9%AC%E5%BA%94%E9%BE%99%E7%9C%BC%E9%9C%9C39&url=http%3A%2F%2Fmp.weixin.qq.com%2Fs%3F__biz%3DMzIyOTQ3NjUwMQ%3D%3D%26mid%3D100002191%26idx%3D1%26sn%3D7f0001d2c661a57346fbf7ed31fe44e2%26chksm%3D684358755f34d163cdbc4d91f60d1c9c067a2542f28fbbe39fb64d4b3ff7ba340fe40a51a13a%23rd&description=%E4%B8%89%E9%87%91%E5%8C%BB%E7%94%A8%E9%9D%A2%E8%86%9C10%E7%89%8739%EF%BC%8C%E6%BE%B3%E6%B4%B2HealthyCare%E8%91%A1%E8%90%84%E7%B1%BD%E8%83%B6%E5%9B%8A180%E7%B2%92%E4%B8%A4%E7%93%B6118&thumbnailUrl=http%3A%2F%2Fmmbiz.qpic.cn%2Fmmbiz_jpg%2FiatqZz6ibfvUqJqdRkkaTiaeiaDNwdPJwPx7hic72WTAxJTqEvRax8Lx2LI8Nr9H9icLYdVibV1jOMfWwcDNto9Bw5oNg%2F0%3Fwx_fmt%3Djpeg
*/
			     $topic =$_GET['topic']; 
				 $roomid = $_GET['roomid'];
				 $roomlist=explode(",",$roomid); 
				 
				 $title = $_GET['title'];//标题
				 $url = $_GET['url'];
				 $description = $_GET['description'];
				 $thumbnailUrl = $_GET['thumbnailUrl'];
				 $data = array("roomlist"=>$roomlist,'title'=>$title,'url'=>$url,'description'=>$description,'thumbnailUrl'=>$thumbnailUrl,'at_all'=>$at_all);
			     
				 if($send_style>0){
					   $data['job_title']=$_GET['title']; //标题
					   $is_open = 1;
				       if($send_style==1){
					       $send_time = $_GET['send_time'];
						   list($date,$time) = explode(" ",$send_time);
						   $doing_time=$time; //时间 HH:ii
						   $doing_date = $date; //日期 YYYY-mm-dd
					   }elseif($send_style==2){
					       $doing_time = $_GET['send_time']; //时间 HH:ii
						   $doing_date = $_GET['weekday'];  //0-6  
					   }
				   }
				 break;
			 case "init_chatroom_list": //初始化所有群  http://127.0.0.1:8100/botapi/api.php?action=create_job&name=init_chatroom_list
			      $data = array(); 
				  break;
				  
		     case "init_chatroom_member": //初始化群员  http://127.0.0.1:8100/botapi/api.php?action=create_job&name=init_chatroom_member&topic=%E6%B5%8B%E8%AF%954&roomid=23034176194@chatroom
			      $topic =$_GET['topic'];
				  $roomid = $_GET['roomid'];
				  $data = array("topic"=>$topic,'roomid'=>$roomid);
			      break;
		 }
		 if($name){
			 //判断已定时任务发送时间是否被占用~
			 if($send_style>0){
			      $time = $doing_time;
				  $date = $doing_date;
				  $week = $doing_date; 
				 
				 $sql="SELECT id,name,data,send_style FROM  `schedule_job` where  botid='$bid'  and is_open=1  
					   and  (send_style=1 and is_exe=0  and doing_time='$time' and doing_date='$date'  
					   or   send_style=2 and doing_time='$time' ) "; 
				 $result=mysql_query($sql);
				 $num=mysql_num_rows($result);
				 if($num){
				     $info=array("msg"=>"机器人该时间段已被占用，定时时间请加减1分钟再试",'status'=>"fail");
				 }
				 
				 if($send_style==1){
				    if(date("Y-m-d H:i")>$doing_date." ".$doing_time){
					     $info=array("msg"=>"请选择正确提醒时间",'status'=>"fail");
					}
				 }
					 
			 }
			 
			 if(empty($info['status'])){
				 $json = json_encode($data);
				 $data = addslashes($json);
				 $info = array('botid'=>$bid,"name"=>$name,'data'=>$data,'doing_time'=>$doing_time,'doing_date'=>$doing_date,'send_style'=>$send_style,'is_open'=>$is_open,'intime'=>date("Y-m-d H:i:s"));
				 insertB($table='schedule_job',$info); 
				 $jobid=mysql_insert_id();
				 $info['action']=$action;
				 $info['job']=$jobid; 
				 $info['msg']="已提交";
			 }
		 }else{
		     $info=array("action"=>$action,"status"=>"fail","msg"=>"出错了~");
		 }
		 
		 $content = json_encode($info);;
		 $callback = isset($_GET['callback'])?trim($_GET['callback']):'';
		 if(!empty($callback)){
			 echo $callback.'('.$content.')'; 
		 }else{ 
		     echo $content;
		 } 
		 break;
		 
   //查询任务状态
   case "query_job":
         $jobid = $_GET['jobid'];
		 $sql="SELECT is_exe FROM  `schedule_job` where id=".$jobid;
		 $result=mysql_query($sql); 
		 $row = mysql_fetch_assoc($result);
		 $is_exe = $row['is_exe'];
		 $info = array("is_exe"=>$is_exe,"jobid"=>$jobid);
		 
		 $content = json_encode($info);;
		 $callback = isset($_GET['callback'])?trim($_GET['callback']):'';
		 if(!empty($callback)){
			 echo $callback.'('.$content.')'; 
		 }else{ 
		     echo $content;
		 } 
		 
         break;
  	 
   //标记任务已执行
   case "markup_job":
         $jobid = $_GET['jobid'];
		 $gettime = date("Y-m-d H:i:s"); 
		 $sql="update `schedule_job` set is_exe=2,exetime='$gettime' where id=".$jobid; //标记已经取
		 $result=mysql_query($sql);
		 echo json_encode(array("action"=>"markup_job","jobid"=>$jobid));
         break;
   
   //获取任务（实时执行） send_style=0
   case "get_job":
         $bid = $_GET['bid'];
         $sql="SELECT id,name,data FROM  `schedule_job` where is_exe=0 and send_style=0  and botid='$bid' limit 0,1";
		 $result=mysql_query($sql);
		 $num=mysql_num_rows($result);
		 if($num){
		     $row = mysql_fetch_assoc($result);
			 $id = $row['id'];
			 $gettime = date("Y-m-d H:i:s");
			 $row['status']="HasScheduleJob";
			 $sql="update `schedule_job` set is_exe=1,gettime='$gettime' where id=".$id; //标记已经取
			 $result=mysql_query($sql);
		 }else{
		     $row=array("status"=>"NoScheduleJob");
		 }
		 echo json_encode($row);
		 break;
   
   //获取任务（定时执行） send_style=1,2
   case "get_job_timing":
         $bid = $_GET['bid'];
		 $time =date("H:i");
		 $date = date("Y-m-d");
		 $week = date("w");
		 
		 //上次提取间隔大于1分钟
		 $lstgettime=date("Y-m-d H:i:s",strtotime("-60 seconds"));
		 
		 
		 // 1 定时发送 2 重复发送
         $sql="SELECT id,name,data,send_style FROM  `schedule_job` where  botid='$bid'  and is_open=1  
		       and  (send_style=1 and is_exe=0  and doing_time='$time' and doing_date='$date'   or   send_style=2 and doing_time='$time' and doing_date like '%".$week."%' ) 
			   and  (gettime is null or  gettime<'$lstgettime' );
			   "; //echo $sql; exit();
		 $result=mysql_query($sql);
		 $num=mysql_num_rows($result);
		 if($num){
		     $row = mysql_fetch_assoc($result);
			 $id = $row['id'];
			 $gettime = date("Y-m-d H:i:s");
			 $row['status']="HasScheduleJob";
			 $send_style = $row['send_style'];
			 if($send_style==1){
			     $addsql=" ,is_open=0 ";
			 }
			 $sql="update `schedule_job` set is_exe=1,gettime='$gettime' {$addsql} where id=".$id; //标记已经取
			 $result=mysql_query($sql);
			 
		 }else{
		     $row=array("status"=>"NoScheduleJob");
		 }
		 echo json_encode($row);
		 break;
		 
   
   //更新群聊日志
   case "log_chatroom_msg":
         $data['contact_id']=$_GET['contact_id'];
		 $data['topic']=$_GET['topic'];
		 $data['roomid'] = $_GET['roomid'];
		 $data['type']= intval($_GET['type']);
		 $data['text']=$_GET['text'];
		 $senddate = $_GET['senddate']; 
		 //$senddate='Apr 26 2020 22:47:02';
		 $pattern="/([A-Za-z]{3,3}) ([0-9]{2,2}) ([0-9]{4,4}) ([0-9]{2,2}):([0-9]{2,2}):([0-9]{2,2})/s";
		 $monthlist=array("Jan"=>"01","Feb"=>"02","Mar"=>"03","Apr"=>"04","May"=>"05","Jun"=>"06","Jul"=>"07","Aug"=>"08","Sep"=>"09","Oct"=>"10","Nov"=>"11","Dec"=>"12");
		 if(preg_match($pattern,$senddate,$match)){
		   $month = $match[1];
		   $month=$monthlist[$month];
		   $send_date = $match[3]."-".$month."-".$match[2];
		   $send_time = $match[4].":".$match[5].":".$match[6];
		 }
         $data['send_date']=$send_date;
		 $data['send_time']=$send_date." ".$send_time;
		 insertB($table='chatroom_log',$value=$data);
		 $flag="insert"; 
		 
		 //更新群员发言时间
		 $sql="update `room_member`  set send_total=send_total+1 ,last_send_date='".$data['send_time']."' where roomid='".$data['roomid']."' and wxid='".$data['contact_id']."'"; 
		 mysql_query($sql); 
		 //更新群最后发言时间
		 $sql="update `chatroom`  set  last_send_time='".$data['send_time']."' where roomid='".$data['roomid']."'"; 
		 mysql_query($sql);
		 echo json_encode(array("action"=>"log_chatroom_msg","status"=>"success",'flag'=>$flag)); 
         break;
   
   //标记新用户入群
   case 'markup_join_room':
         $info = $_POST;
		 $roomid = $_GET['roomid']; 
		 $update=0;
		 $insert=0;
		 
		 $list=array();
		 foreach($info as $line){
		     if(strpos($line,'~!~!')!==false){
			     list($wxid,$nickname,$alias,$avatar,$gender,$join_date,$inviter_wxid)=explode('~!~!',$line);
				 $data=array('roomid'=>$roomid,'wxid'=>$wxid,'nickname'=>replace_emojis($nickname),'alias'=>replace_emojis($alias),
				             'avatar'=>$avatar,'gender'=>$gender,'inviter_wxid'=>$inviter_wxid,'join_date'=>$join_date,'last_check_time'=>date("Y-m-d H:i:s"));
				 $list[]=$data;
				 /*  */
				 $sql="select id from `room_member` where roomid='".$data['roomid']."' and wxid='".$data['wxid']."'  limit 0,1";
				 $result = mysql_query($sql);
				 $num=mysql_num_rows($result);
				 if($num){ 
					 update($table='room_member',$value=$data,$where=" roomid='".$data['roomid']."' and wxid='".$data['wxid']."'");
					 $update++; 
				 }else{
					 insertB($table='room_member',$value=$data); 
					 $insert++;
				 }  
			 }
		 }
		  
		 echo json_encode(array("action"=>"markup_join_room","status"=>"success",'insert_num'=>$insert,'update_num'=>$update));
		 break;
   //更新群员信息
   case "update_chatroom_member":
         $info = $_POST;
		 $roomid = $_GET['roomid'];
		 $sflag = $_GET['sflag'];//=strong(强制更新会员列表)
		 $update=0;
		 $insert=0;
		
		 
		 $list=array();
		 foreach($info as $line){
		     if(strpos($line,'~!~!')!==false){
			     list($wxid,$nickname,$alias,$avatar,$gender)=explode('~!~!',$line);
				 $data=array('roomid'=>$roomid,'wxid'=>$wxid,'nickname'=>replace_emojis($nickname),'alias'=>replace_emojis($alias),'avatar'=>$avatar,'gender'=>$gender);
				 $list[]=$data;
				 /* 太慢了~ 批量入库~再分解
				 $sql="select id from `room_member` where roomid='".$data['roomid']."' and wxid='".$data['wxid']."'  limit 0,1";
				 $result = mysql_query($sql);
				 $num=mysql_num_rows($result);
				 if($num){
					 if($sflag=="strong"){//强制更新
						 update($table='room_member',$value=$data,$where=" roomid='".$data['roomid']."' and wxid='".$data['wxid']."'");
						 $update++;
					 }
				 }else{
					 insertB($table='room_member',$value=$data); 
					 $insert++;
				 } 
				 */ 
			 }
		 }
		 $json = json_encode($list);
		 $memberinfo = addslashes($json);
		 $data=array("memberinfo"=>$memberinfo,'is_sys_member'=>0);  
		 update($table='chatroom',$value=$data,$where=" roomid='".$roomid."' ");
		 echo json_encode(array("action"=>"update_chatroom_member","status"=>"success",'total'=>count($list),'roomid'=>$roomid));
		 break;
   
   //更新群表 - 会员信息 ( 425人耗时 40秒)
   case "sys_member":
        $roomid = $_GET['roomid'];
        $sql="SELECT memberinfo  FROM  `chatroom` where roomid='$roomid' and is_sys_member=0";
		$result = mysql_query($sql);
		$info = mysql_fetch_assoc($result);
		$insert = $update=0;
		if(!empty($info)){
		    $memberinfo = $info['memberinfo'];
			$list= json_decode($memberinfo,true);
			$total=count($list);
			if($total>0){ 
				 foreach($list as $data){
					 $sql="select id from `room_member` where roomid='".$data['roomid']."' and wxid='".$data['wxid']."'  limit 0,1";
					 $result = mysql_query($sql);
					 $num=mysql_num_rows($result);
					 if($num){
						  $data['last_check_time']=date("Y-m-d H:i:s"); 
						  update($table='room_member',$value=$data,$where=" roomid='".$data['roomid']."' and wxid='".$data['wxid']."'");
						  $update++; 
					 }else{
						 insertB($table='room_member',$value=$data); 
						 $insert++;
					 }
				 }
			}
		}else{
		   $total=0;
		}
		$data=array('is_sys_member'=>1);
		update($table='chatroom',$value=$data,$where=" roomid='".$roomid."' ");
		 
		echo json_encode(array("action"=>"sys_member","status"=>"success",'insert_num'=>$insert,'update_num'=>$update,'roomid'=>$roomid,'total'=>$total));
		break;
   //更新群资料信息	
   case "update_chatroom":  
		 $data['roomid']  = $_GET['roomid'];
		 $data['topic']  = replace_emojis($_GET['topic']);
		 $data['ownerId']  = $_GET['ownerId'];
		 $data['totaluser']  = $_GET['totaluser'];
		 $data['announce']  = replace_emojis($_GET['announce']);
		 if($_GET['f']!='one'){//不更新头像（不准）
		    $data['avatar'] = $_GET['avatar'];
		 }
		 $data['qrcode']=$_GET['qrcode'];
		 $data['ownername']= replace_emojis($_GET['ownername']);
		 $data['last_update_time']=date("Y-m-d H:i:s");
		 $data['botid'] = $_GET['botid'];
		 $sql="select id from `chatroom` where roomid='".$data['roomid']."' limit 0,1";
		 $result = mysql_query($sql);
		 $num=mysql_num_rows($result);
		 if($num){
		     update($table='chatroom',$value=$data,$where=" roomid='".$data['roomid']."' ");
			 $flag="update";
		 }else{
		     insertB($table='chatroom',$value=$data);
			 $flag="insert";
		 }
		 echo json_encode(array("action"=>"update_chatroom","status"=>"success",'flag'=>$flag,'roomid'=>$data['roomid']));
		 break;
   
   //编辑入群欢迎语
   case "edit_join_welcome_msg":
        $data['join_welcome_msg'] = strip_tags($_GET['join_welcome_msg']);
		$data['is_open_join_welcome_msg']	 = intval($_GET['is_open_join_welcome_msg']);
		$data['roomid'] = $_GET['roomid'];
		update($table='chatroom',$value=$data,$where=" roomid='".$data['roomid']."' ");  
		$content =  json_encode(array("action"=>"edit_join_welcome_msg","status"=>"success"));
		$callback = isset($_GET['callback'])?trim($_GET['callback']):'';
		if(!empty($callback)){
			 echo $callback.'('.$content.')'; 
		}else{ 
		     echo $content;
		} 
		break;
   //获取入群欢迎语
   case "get_join_welcome_msg":
        $roomid  = $_GET['roomid'];
		$sql="select join_welcome_msg,is_open_join_welcome_msg from chatroom where roomid='$roomid'";
		$result = mysql_query($sql);
	    $list=array();
	    $row=mysql_fetch_assoc($result);
		$is_open_join_welcome_msg = $row['is_open_join_welcome_msg'];
		$join_welcome_msg = $row['join_welcome_msg'];
		$hasWelcome=1;
		if($is_open_join_welcome_msg==0 || empty($join_welcome_msg)){
		    $hasWelcome=0;
		}
		$info =  array("hasWelcome"=>$hasWelcome,"msg"=>$join_welcome_msg);
		echo json_encode($info);
		
		break;
   
   //添加自动回复 
   case "add_auto_reply":
          
         $name = $_GET['name'];
		 $bid = $_GET['bid'];
		 $kwd =  strtoupper($_GET['kwd']);
		 
		 $wxstyle = 1; //1个人号2微信群
		 $status =1; //状态0无效1有效 2添加好友事件
			  
		 if($_GET['flag']=='accept_friend_manage'){ //添加好友事件
		      $kwd='auto_add_friend_replay';
			  $wxstyle = 1;
			  $status =2;
			  $data1['auto_accept_friend'] = intval($_GET['auto_accept_friend']);
			  $data1['accept_friend_auto_reply'] = intval($_GET['accept_friend_auto_reply']);
			  update($table='bot',$data1,$where=" wxid='$bid'");
		 }
		 if(!empty($_GET['roomiid'])){ //微信群设置
		      $wxstyle = 2;
			  $roomiid = $_GET['roomiid'];
		 }
		 
		 switch($name){ 
			  case "send_text": //支持多群发送
				   $text = $_GET['text'];    
				   $data = array('text'=>$text);
				   $style=1; 
			       break; 
			 case "send_image": //支持多群发送
				   $url = $_GET['url'];    
				   $data = array('url'=>$url);
				   $style=2; 
			       break; 
			 
			case "send_urlLink": //群发图文  
				 $title = $_GET['title'];//标题
				 $url = $_GET['url'];
				 $description = $_GET['description'];
				 $thumbnailUrl = $_GET['thumbnailUrl'];
				 $data = array('title'=>$title,'url'=>$url,'description'=>$description,'thumbnailUrl'=>$thumbnailUrl);
				 $style=3;
			     break;
			 case "join_room": //支持多群发送
				   $roomid = $_GET['roomid'];    
				   $data = array('roomid'=>$roomid);
				   $style=4; 
			       break;  
		 }
		 if($name){
			 $json = json_encode($data);
			 $data = addslashes($json);
			 $info = array('botid'=>$bid,"action_name"=>$name,'kwd'=>$kwd,'data'=>$data,'wxstyle'=>$wxstyle,'status'=>$status,'uptime'=>date("Y-m-d H:i:s"));
			 if(!empty($roomiid)){
			    $info['roomid']=$roomiid;
				$addsql=" and roomid='".$roomiid."'";
			 }
			 $sql="select id from auto_reply where kwd='".$info['kwd']."' and status in(1,2) and botid='".$bid."' and wxstyle='".$info['wxstyle']."' {$addsql} limit 0,1";
			 $result=mysql_query($sql);
			 if(mysql_num_rows($result)){
			     $row = mysql_fetch_assoc($result);
				 $id = $row['id'];
				 update($table='auto_reply',$value=$info,$where=" id=$id");
			 }else{
				 $info['intime']=date("Y-m-d H:i:s");
			     insertB($table='auto_reply',$info); 
			 }
			 $info['action']=$action;
			 
		 }else{
		     $info=array("action"=>$action,"status"=>"fail");
		 }
		 
		 $content = json_encode($info);;
		 $callback = isset($_GET['callback'])?trim($_GET['callback']):'';
		 if(!empty($callback)){
			 echo $callback.'('.$content.')'; 
		 }else{ 
		     echo $content;
		 } 
		 break;
   
   //获取自动回复
   case "get_wx_auto_reply":
        $bid = $_GET['bid'];
		$kwd = strtoupper($_GET['kwd']);
		$roomid = $_GET['roomid'];
		
		if(strlen($kwd)>30){ //大于10个汉字，不认为是关键字
		    $row=array("status"=>"NoAutoReply");
		}else{ 
			if(!empty($roomid)){
				$addsql=" and roomid='".$roomid."'";
			}
			$sql="select id,action_name,data  from auto_reply where botid='$bid' and kwd='$kwd' and status=1 {$addsql} limit 0,1";
			$result = mysql_query($sql); 
			$num = mysql_num_rows($result);
			if($num){
				 $row = mysql_fetch_assoc($result);  
				 $row['status']="YesAutoReply";  
			 }else{
				 $row=array("status"=>"NoAutoReply");
			 }
		 }
		 echo json_encode($row); 
		break;
   //删除自动回复
   case 'remove_auto_reply':
         $bid = $_GET['bid'];
		 $id = $_GET['id'];
		 $uptime = date("Y-m-d H:i:s");
		 $sql="update auto_reply set status=0,uptime='$uptime' where botid='$bid' and id='$id'";
		 $result=mysql_query($sql);
		 $info=array("status"=>"success");
		 $content = json_encode($info);;
		 $callback = isset($_GET['callback'])?trim($_GET['callback']):'';
		 if(!empty($callback)){
			 echo $callback.'('.$content.')'; 
		 }else{ 
		     echo $content;
		 } 
		break;	
   //保存添加好友设置
   case 'accept_friend_manage':
        $bid = $_GET['bid'];
		$data['auto_accept_friend'] = intval($_GET['auto_accept_friend']);
        $data['accept_friend_auto_reply'] = intval($_GET['accept_friend_auto_reply']);
		update($table='bot',$data,$where=" wxid='$bid'");
		 
		 $info=array("status"=>"success");
		 $content = json_encode($info);;
		 $callback = isset($_GET['callback'])?trim($_GET['callback']):'';
		 if(!empty($callback)){
			 echo $callback.'('.$content.')'; 
		 }else{ 
		     echo $content;
		 }  
        break;	
   //查询机器人设置状态
   case 'query_bot':
        $bid = $_GET['bid'];
		$sql="select auto_accept_friend,accept_friend_auto_reply  from bot where wxid='$bid' limit 0,1";
		$result = mysql_query($sql); 
		$num = mysql_num_rows($result);
		if($num){
			 $row = mysql_fetch_assoc($result);  
			 $row['status']="success";  
			 if($row['accept_friend_auto_reply']==1){
				 $sql2="select id,action_name,data  from auto_reply where botid='$bid' and kwd='auto_add_friend_replay' and status=2 limit 0,1";
				 $result2 = mysql_query($sql2); 
				 $num2 = mysql_num_rows($result2);
				 if($num2){
					$row2 = mysql_fetch_assoc($result2);  
					$row['action_name'] = $row2['action_name'];	  
					$row['data'] = $row2['data'];	  
				 }else{
						 
				 }
			 }
		}else{
			 $row=array("status"=>"fail");
		}
		echo json_encode($row); 	
		break;
  //删除定时发送
   case 'remove_schedule_job':
         $bid = $_GET['bid'];
		 $id = $_GET['id'];
		 $uptime = date("Y-m-d H:i:s");
		 $sql="update schedule_job set is_open=0 where botid='$bid' and id='$id'";
		 $result=mysql_query($sql);
		 $info=array("status"=>"success");
		 $content = json_encode($info);;
		 $callback = isset($_GET['callback'])?trim($_GET['callback']):'';
		 if(!empty($callback)){
			 echo $callback.'('.$content.')'; 
		 }else{ 
		     echo $content;
		 } 
		break;	
   
   //开通群功能
   case 'open_chatroom':
         $roomid = $_GET['roomid'];
		 $bid = $_GET['bid']; 
		 $sql="update chatroom set 	status=1 where 	roomid='$roomid' and botid='$bid'";
		 $result=mysql_query($sql);
		 $info=array("status"=>"success","msg"=>"开通成功");
		 $content = json_encode($info);;
		 $callback = isset($_GET['callback'])?trim($_GET['callback']):'';
		 if(!empty($callback)){
			 echo $callback.'('.$content.')'; 
		 }else{ 
		     echo $content;
		 } 
		break;
   //删除群功能
   case 'delete_chatroom':
         $roomid = $_GET['roomid'];
		 $bid = $_GET['bid']; 
		 $sql="delete from chatroom  where roomid='$roomid' and botid='$bid'";
		 $result=mysql_query($sql);
		 $info=array("status"=>"success","msg"=>"已删除");
		 $content = json_encode($info);;
		 $callback = isset($_GET['callback'])?trim($_GET['callback']):'';
		 if(!empty($callback)){
			 echo $callback.'('.$content.')'; 
		 }else{ 
		     echo $content;
		 } 
		break;
	
	//初始化机器人
   case 'bot_init':  
		 $bid = $_GET['bid']; 
		 $data=array('nickname'=>$_GET['nickname'],'wxid'=>$bid,'qr_code'=>$_GET['qr_code'],'last_login_date'=>date("Y-m-d H:i:s"));  
		 $sql="select id from `bot` where wxid='".$data['wxid']."' limit 0,1";
		 $result = mysql_query($sql);
		 $num=mysql_num_rows($result);
		 if($num){
		     update($table='bot',$value=$data,$where=" wxid='".$data['wxid']."' ");
			 $flag="update";
		 }else{
			 $data['join_date']=date("Y-m-d H:i:s");
		     insertB($table='bot',$value=$data);
			 $flag="insert";
		 }
		 echo json_encode(array("action"=>"init_bot","status"=>"success"));
		break;
		
   default:
       
}

	  

 

?>