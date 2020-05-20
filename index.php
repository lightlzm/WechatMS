<?
/*
 * @Author: lightlizm
 * @Date: 2020-05-15 15:24:15
 * @LastEditors: lightlizm
 * @LastEditTime: 2020-05-19
 * @Description: 主程序入口
 */

include("config.php");
include_once(dirname(__file__)."/lib/connect_db.php");//链接数据库
include_once(dirname(__file__)."/func.php");
 
 
//检查安装
if(isinstall($dbname)==false){
   header("Location: install.php");
}
 

$action = empty($_GET['action'])?$_POST['action']:$_GET['action'];

$bid = empty($_GET['bid'])?"":$_GET['bid'];

if(empty($bid) && ($action!='' && $action!='botlist' )){
    include("html/nobot.php"); 
	exit();
}

switch($action){ 
   case "index":
         include("html/index.php"); 
		 break;  
   
   case "chatroom_list": 
         $i=chatroom_list($bid);
		 $sys_time = last_sys_time("init_chatroom_list");
         include("html/chatroom_list.php"); 
		 break;
   
   case "room_member":
         $roomid = $_GET['roomid'];
		 if(empty($roomid)){
			  $i=chatroom_list($bid);
			  $sys_time = last_sys_time("init_chatroom_list");
		      include("html/select_chatroom.php"); 
			  exit();
		 } 
		 
		 $order= empty($_GET['order'])?"last_send_date":$_GET['order'];
		 $sort = empty($_GET['sort'])?"desc":$_GET['sort'];
		 
         $i=room_member($roomid,$order,$sort);
		 $r=chatroom($roomid); 
		 $sys_time = last_sys_time("init_chatroom_member");
		 
         include("html/room_member.php"); 
		 break;
   
   case 'room_member_calendar': //index.php?action=room_member_calendar&contact_id=wxid_glteitckvahs22&roomid=23034176194@chatroom 
          $nowYear=empty($_GET['Year'])?date('Y'):intval($_GET['Year']);
		  $nowMonth=empty($_GET['Mon'])?date('m'):intval($_GET['Mon']);

		  if(substr($nowYear,0,2)!=='20'||strlen($nowYear)!=4||substr($nowYear,2,2)<10) $nowYear=date('Y');
		  if(strlen($nowMonth)>2|| intval($nowMonth)>12||intval($nowMonth)==0) $nowMonth=date('m');
		  if(strlen($nowMonth)==1) $nowMonth='0'.$nowMonth;
		  
		  $roomid = $_GET['roomid'];
		  $contact_id = $wxid = $_GET['contact_id'];
		  $list=room_member_calendar($nowYear,$nowMonth,$roomid,$contact_id); 
		  $np=getNextPre($nowYear,$nowMonth);
		  
		  $rm=chatroom($roomid);
		  $rb= chatroom_member($roomid,$wxid); 
		  //print_r($list);
		  include("html/room_member_calendar.php"); 
        break; 
		
    case "room_member_message":
         $roomid = $_GET['roomid'];
		 $contact_id = $wxid = $_GET['contact_id'];
		 $date = $_GET['date'];
		 $rm=chatroom($roomid);
		 $rb= chatroom_member($roomid,$wxid);  
		 $in = chatroom_member_message($roomid,$contact_id,$date); 
         include("html/room_member_message.php"); 
		 break;  
	
	case 'room_send_message':
	     $i=chatroom_list($bid); 
		 include("html/room_send_message.php");
	     break;
	
	case 'room_send_message_timeing':
	     $i=chatroom_list($bid); 
		 include("html/room_send_message_timeing.php");
	     break;
	
	
	case "room_welcome_message":
         $roomid = $_GET['roomid'];
		 if(empty($roomid)){
			  $i=chatroom_list($bid);
			  $sys_time = last_sys_time("init_chatroom_list");
		      include("html/select_chatroom.php"); 
			  exit();
		 } 
		  
		 $r=chatroom($roomid);  
		 
         include("html/room_welcome_message.php"); 
		 break;
	//群公告
	case "room_announce":
         $roomid = $_GET['roomid'];
		 if(empty($roomid)){
			  $i=chatroom_list($bid);
			  $sys_time = last_sys_time("init_chatroom_list");
		      include("html/select_chatroom.php"); 
			  exit();
		 }  
		 $r=chatroom($roomid);  
		 
         include("html/room_announce.php"); 
		 break;
	
	//添加关键字回复（个人）
	case "add_auto_reply": 
		 $i=chatroom_list($bid); 
		 
		 $id = $_GET['id'];
		 $nowstyle = 'text';
		 $roomid="";
		 if(!empty($id)){
		     $sql="SELECT *  FROM  `auto_reply` where id=$id";
			 $result = mysql_query($sql); 
             $row=mysql_fetch_assoc($result);
			 $data = json_decode($row['data'],true);
			 switch($row['action_name']){
			     case 'send_text': $nowstyle="text"; $initindex=0;break;
				 case 'send_image': $nowstyle="image"; $initindex=1;break;
				 case 'send_urlLink': $nowstyle="urlLink"; $initindex=2;break;
				 case 'join_room': $nowstyle="joinroom"; $initindex=3; $roomid = $data['roomid'];break;
			 } 
			 //echo $nowstyle;  print_r($data); exit();
		 }
         include("html/add_auto_reply.php"); 
		 break;
		 
	//自动回复列表（个人）
	case "auto_reply": 
		 $r=auto_reply($bid,NULL); 
         include("html/auto_reply.php"); 
		 break;	 	 	 
	
	
	//添加好友管理（个人）
	case "add_friend": 
		 $i=chatroom_list($bid);  
		 $nowstyle = 'text';
		 $roomid="";
		 
		 $sql="SELECT *  FROM  `bot` where wxid='$bid'";
		 $result = mysql_query($sql); 
         $bot=mysql_fetch_assoc($result);
		 
		 $initindex=0;  
		 if($bot['accept_friend_auto_reply']==1){
		     $sql="SELECT *  FROM  `auto_reply` where botid='$bid' and kwd='auto_add_friend_replay' and status =2";
			 $result = mysql_query($sql); 
             $row=mysql_fetch_assoc($result);
			 $data = json_decode($row['data'],true);
			 switch($row['action_name']){
			     case 'send_text': $nowstyle="text"; $initindex=0;break;
				 case 'send_image': $nowstyle="image"; $initindex=1;break;
				 case 'send_urlLink': $nowstyle="urlLink"; $initindex=2;break;
				 case 'join_room': $nowstyle="joinroom"; $initindex=3; $roomid = $data['roomid'];break;
			 }
			 
			 //echo $nowstyle;  print_r($data); exit();
		 } 
         include("html/add_friend.php"); 
		 break;	 	
	//群自动回复
	case "room_auto_reply": 
	     $roomid =$roomiid= $_GET['roomid'];
		 if(empty($roomid)){
			  $i=chatroom_list($bid);
			  $sys_time = last_sys_time("init_chatroom_list");
		      include("html/select_chatroom.php"); 
			  exit();
		 } 
		  
		 $m=chatroom($roomid);
		 $r=auto_reply($bid,$roomid); 
		 include("html/room_auto_reply.php");
		 break;
		  
	//添加关键字回复（群）
	case "room_add_auto_reply": 
		 $i=chatroom_list($bid);
		 $roomiid = $_GET['roomid']; 
		 $m=chatroom($roomiid);
		 
		 $id = $_GET['id'];
		 $nowstyle = 'text';
		 $roomid="";
		 if(!empty($id)){
		     $sql="SELECT *  FROM  `auto_reply` where id=$id";
			 $result = mysql_query($sql); 
             $row=mysql_fetch_assoc($result);
			 $data = json_decode($row['data'],true);
			 switch($row['action_name']){
			     case 'send_text': $nowstyle="text"; $initindex=0;break;
				 case 'send_image': $nowstyle="image"; $initindex=1;break;
				 case 'send_urlLink': $nowstyle="urlLink"; $initindex=2;break;
				 case 'join_room': $nowstyle="joinroom"; $initindex=3; $roomid = $data['roomid'];break;
			 } 
			 //echo $nowstyle;  print_r($data); exit();
		 }
         include("html/room_add_auto_reply.php"); 
		 break;
   
   //定时群发
   case 'room_send_message_timeing_list': 
        $r=room_send_message_timeing_list($bid); 
		include("html/room_send_message_timeing_list.php"); 
		break;	
   
   
   
   //开通微信群
   case "claim_chatroom":
         $b=wait_claim_chatroom($bid);
         include("html/claim_chatroom.php"); 
		 break;  	    	 	 
   
   case "botlist": 
   default:
         $b=botlist(); 
		 $url=str_replace('index.php',"lib/phpqrcodeV2.php","http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		 if(empty($action)){
		    $url=$url."?url=";
		 }else $url=$url."&url=";
		 if( $b['total'] ==0){
		     include("html/nobot.php"); 
			 exit();
		 }else{
		     $bid = $b['list'][0]['wxid'];
		 }
         include("html/botlist.php"); 
		 break;  
       
}


 

?>