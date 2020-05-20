<?
/*
    基础函数
*/ 
include("lib/limitpage.php"); 

function getAlldata($sql)
{ 
   $result = mysql_query($sql);
   $list=array();
   while($row=mysql_fetch_assoc($result)){
	  $list[]=$row; 
   }	
   return $list;
}
function insertB($table,$value=array()) { 
	foreach($value as $feild => $val){ 
			$feilds[]="`{$feild}`"; 
			$vals[]="'{$val}'"; 
	} 
	$sql="Insert INTO `{$table}` (".implode(",",$feilds).") value(".implode(",",$vals).")";   //echo $sql; echo "<br>"; return; exit();
	mysql_query($sql);     //echo mysql_error();
	return mysql_insert_id();
} 

function update($table,$value=array(),$where) { 
	foreach($value as $feild=>$val){ 
			$set[]="`{$feild}`='{$val}'"; 
	} 
	$sql="Update {$table} SET ".implode(",",$set)." Where ".$where;   
	mysql_query($sql); 
} 
 
//过滤四字节关键字
function replace_emojis($value) { 
	$value = preg_replace('/[\xf0-\xf7].{3}/', '', $value);
	$value = str_replace('\x26', '&', $value);
	$value = str_replace("'", '', $value);
	return $value;
}

/*
    当前选中菜单
*/
function menu($nowAction){
   $action = $_GET['action'];
   $exp = explode(',',$nowAction);
   if(in_array($action,$exp)){
        echo "on";
   }
}

/*
    获取群列表(已被认领)
*/  
function chatroom_list($bid){
     $sql="SELECT ownerId,topic,roomid,totaluser,announce,avatar,ownername,last_send_time,last_update_time  FROM  `chatroom` where botid='$bid' and status=1";
	 $list = getAlldata($sql);
	 return array("total"=>count($list),"list"=>$list);
}
/*
    获取群详情
*/  
function chatroom($roomid){
     $sql="SELECT *  FROM  `chatroom` where roomid='$roomid' ";
	 $result = mysql_query($sql);
	 $row=mysql_fetch_assoc($result);
	 return $row;
}


/*
    获取机器人列表
*/  
function botlist(){
     $sql="SELECT *  FROM  `bot`  order by last_login_date desc limit 0,1"; 
	 $list = getAlldata($sql);
	 return array("total"=>count($list),"list"=>$list);
}


/*
    获取群会员详情
*/  
function chatroom_member($roomid,$wxid){
     $sql="SELECT *  FROM  `room_member` where roomid='$roomid' and wxid='$wxid' ";
	 $result = mysql_query($sql);
	 $row=mysql_fetch_assoc($result);
	 return $row;
}

/*
    获取群成员列表
*/  
function room_member($roomid,$order,$sort){
	 $last_check_time = date("Y-m-d H:i:s",strtotime("-30 days"));
	 $page= intval($_GET['page']); 
	 $sql="SELECT id  FROM  `room_member` where roomid='$roomid' and last_check_time>='$last_check_time' ";  
	 $html = fenye($page,$sql,$pagenum=20);
	 
	 
     $sql="SELECT *  FROM  `room_member` where roomid='$roomid' and last_check_time>='$last_check_time' order by {$order} {$sort} limit ".$html[1].",".$html[2]; 
	 $list = getAlldata($sql);
	 return array("total"=>$html[3],"list"=>$list,'page'=>$html);
}

/*
   上次同步时间
*/
function last_sys_time($name){
    $sql="SELECT exetime  FROM  `schedule_job` where name='$name' and is_exe=2 order by id desc limit 0,1 ";
	$result = mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	return $row['exetime'];
}

/*
  功能：获取日历起始日期；
*/
function getCalDay($nowYear,$nowMonth){
   
   $mktime=mktime(1,1,1,intval($nowMonth),1,$nowYear);
   $fstweek=date('w',$mktime);
   $fsttime=$mktime-$fstweek*3600*24;
   $fstCalDay=date('Y-m-d',$fsttime);//首日
   
   $totalday=date('t',mktime(1,1,1,intval($nowMonth),1,$nowYear));//$nowMonth月的日数；
   
   $mktime=mktime(1,1,1,intval($nowMonth),$totalday,$nowYear);
   $lstweek=date('w',$mktime);
   $lstlen=6-$lstweek;
   $lsttime=$mktime+$lstlen*3600*24;
   $lstCalDay=date('Y-m-d',$lsttime);//尾日
   
   $between=$lsttime-$fsttime;
   $betday=$between/86400; //日历跨度；
   return array('fstCalDay'=>$fstCalDay,'lstCalDay'=>$lstCalDay,'NowYear'=>$nowYear,'NowMonth'=>$nowMonth,
				'firstday'=>$nowYear.'-'.$nowMonth.'-01','lastday'=>$nowYear.'-'.$nowMonth.'-'.$totalday,'betday'=>$betday);
}

  /*
     功能：返回 相对其实日 +$i日
  */
  function transt($nowday,$i){
	  $week = array('Fri'=>'五','Sat'=>'六','Sun'=>'日','Mon'=>'一','Tue'=>'二','Wed'=>'三','Thu'=>'四'); 
	  list($y,$m,$d)=explode('-',$nowday);
	  $time=mktime(1,1,1,intval($m),intval($d),$y);
	  
	  $time=$time+$i*3600*24;
	  $focusday=date('Y-m-d',$time);
	  $weekday=date('D',$time);
	  $Dweek=$week[$weekday];
	  return array('focusday'=>$focusday,'weekday'=>strtoupper($weekday),'Dweek'=>$Dweek);
  }
  
/*
   个人在群里一个月发送日历
*/
function room_member_calendar($nowYear,$nowMonth,$roomid,$contact_id){
	  $curent_date = date("Y-m-d");
      $CalDay=getCalDay($nowYear,$nowMonth);
	  $lenday=41;//时间跨度
	  $nowday=$CalDay['fstCalDay'];
	  $sday=$CalDay['lstCalDay']; 
	  if($CalDay['betday']<$lenday) $lenday=$CalDay['betday'];
	  $list=array();
	  for($n=0;$n<=$lenday;$n++){
	      $transt=transt($nowday,$n); 
		  $focusday=$transt['focusday']; 
		  if($focusday>=$CalDay['firstday'] && $focusday<=$CalDay['lastday'] ){
		      $info = array("isShow"=>true);
			  if($focusday<=$curent_date){
			     $info['yiguo']=true;
				 $sql="SELECT id FROM  `chatroom_log`  WHERE  `roomid` =  '$roomid' AND  `contact_id` =  '$contact_id' AND  `send_date` =  '$focusday'"; 
				 $result = mysql_query($sql);
				 $total=mysql_num_rows($result);
				 $info['total']=$total;
			  }else{
			     $info['yiguo']=false;
			  }
			  $info['d']=$focusday;
			  $info['n']=substr($focusday,8,2);
			  $list[]=$info;
		  }else{
		     $list[]=array("isShow"=>false,'d'=>$focusday,'n'=>substr($focusday,8,2));
		  }
		  
	  }//print_r($list);
	 return $list;
	 // 
}

/*
  功能：获取上月，下月；
*/
function getNextPre($nowYear,$nowMonth){
   
   
   if(intval($nowMonth)==12){ 
	   $nYear=$nowYear+1; $nMon='01'; $pYear=$nowYear;$pMon=11;
   }else if(intval($nowMonth)<12&&intval($nowMonth)>1){
		$nYear=$pYear=$nowYear; $nMon=intval($nowMonth)+1;$pMon=intval($nowMonth)-1;
		if(strlen($nMon)==1) $nMon='0'.$nMon;
		if(strlen($pMon)==1) $pMon='0'.$pMon;
   }else if(intval($nowMonth)==1){
	   $nYear=$nowYear; $nMon='02'; $pYear=$nowYear-1;$pMon=12;
   }
  return array('nYear'=>$nYear,'nMon'=>$nMon,'pYear'=>$pYear,'pMon'=>$pMon); 
}


/*
    获取聊信息列表
*/  
function chatroom_member_message($roomid,$contact_id,$date){
	 $page= intval($_GET['page']); 
	 $sql="SELECT id FROM  `chatroom_log`  WHERE  `roomid` =  '$roomid' AND  `contact_id` =  '$contact_id' AND  `send_date` =  '$date' ";  
	 $html = fenye($page,$sql,$pagenum=20);
	 
    
     $sql="SELECT type ,text, send_time FROM  `chatroom_log`  WHERE  `roomid` =  '$roomid' AND  `contact_id` =  '$contact_id' AND  `send_date` =  '$date' order by id desc limit ".$html[1].",".$html[2]; 
	 $list = getAlldata($sql);
	 return array("total"=>$html[3],"list"=>$list,'page'=>$html);
}

//信息类型
function msg_type($type){
   // 信息类型  2声音 3名片 6:图片  5:表情  7:文字   9:小程序  13 图文
   $types=array("2"=>"语音","3"=>"名片","5"=>"表情","6"=>"图片","7"=>"文字","9"=>"小程序","13"=>"图文",);
   return $types[$type];
}

//群详情
function msg_show($type,$text){
    switch($type){
	    case '5':
		case '6':
		      
	}
}

/*
    关键字自动回复
*/  
function auto_reply($botid,$roomid){
	 $addsql="";
	 if(!empty($roomid)){
	    $addsql=" and roomid='".$roomid."'";
	 }else{
	    $addsql=" and wxstyle=1 ";
	 }
	 
	 $page= intval($_GET['page']); 
	 $sql="SELECT id FROM  `auto_reply`  WHERE  `botid` =  '$botid' AND  `status` =  '1' {$addsql} ";  
	 $html = fenye($page,$sql,$pagenum=20);
	 
	 
	 
     $sql="SELECT * FROM  `auto_reply`  WHERE  `botid` =  '$botid' AND  `status` =  '1' {$addsql} order by id desc limit ".$html[1].",".$html[2]; 
	 $list = getAlldata($sql);
	 
	 return array("total"=>$html[3],"list"=>$list,'page'=>$html);
}


/*
    关键字自动回复
*/  
function room_send_message_timeing_list($botid){ 
	 $page= intval($_GET['page']); 
	 $sql="SELECT id FROM  `schedule_job`  WHERE  `botid` =  '$botid' AND send_style>0 ";  
	 $html = fenye($page,$sql,$pagenum=20);
	 
     $sql="SELECT * FROM  `schedule_job`  WHERE  `botid` =  '$botid' AND send_style>0  order by is_open desc,id desc limit ".$html[1].",".$html[2]; 
	 $result = mysql_query($sql);
	 $list=array();
	 $roomlist=array();
	 while($row=mysql_fetch_assoc($result)){
		 $row['data']= json_decode($row['data'],true);
		 
		 if($row['send_style']==1){
		    $row['send_time']=$row['doing_date']." ".$row['doing_time'];
			if($row['is_exe']){
				 $row['is_open']="0";
				 $row['status']="已发送";
			}else{
		         $row['status']="待发送";
			} 
		 }elseif($row['send_style']==2){
		     $row['send_time'] = "逢周".str_replace(array("0","1","2","3","4","5","6"), array("日","一","二","三","四","五","六"), $row['doing_date'])." ".$row['doing_time'];
		     
			 if($row['is_open']){ 
				 $row['status']="待发送";
			 }else{
		         $row['status']="已关闭";
			 } 
		 }
		 
		 $roomString=""; 
		 foreach($row['data']['roomlist'] as $roomid){
		     if(empty($roomlist[$roomid])){
			     $room = chatroom($roomid);
				 $roomlist[$roomid] = $room['topic'];
			 }
			 $roomString=$roomlist[$roomid].",".$roomString;
		 }
		 $row['roomnum']=count($row['data']['roomlist']);
		 $roomString = substr($roomString,0,-1);
		 $row['roomString']=$roomString;
		 $row['oneroomString']= $roomlist[$roomid];
		 $list[]=$row; 
	 }	
	 
	 return array("total"=>$html[3],"list"=>$list,'page'=>$html);
}

/*
  截取php字符串 ,改进截取方式
*/
 function FsubstrcnChange($str, $len, $dot = '...'){ 
	   $patten = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
       preg_match_all($patten, $str, $regs);
       $v = 0; $s = '';
       for($i=0; $i<count($regs[0]); $i++)
       {
            (ord($regs[0][$i]) > 129) ? $v += 2 : $v++;
            $s .= $regs[0][$i];

            if($v >= $len * 2){
                $s .= $dot;
              break;
            }
        } 
        return $s;
 }


/*
    获取未认领群
*/  
function wait_claim_chatroom($bid){
	 
	     $sql="SELECT c.roomid,c.topic,c.avatar,b.nickname  FROM  `bot`  b ,`chatroom` c where  c.status=0 and c.botid='$bid' and c.botid=b.wxid ";
	     $list = getAlldata($sql);
	  
	  /*
		 $join_date = date("Y-m-d H:i:s",strtotime("-1 days"));
		 $sql="SELECT a.*,b.nickname,c.topic,c.avatar  FROM  `room_member`  a , `bot`  b ,chatroom c
			  WHERE  a.`wxid` = b.wxid  and a.join_date>='$join_date' and a.roomid=c.roomid and c.status=0";// echo $sql; exit(); 
		 $list = getAlldata($sql);
	  */
	 return array("total"=>count($list),"list"=>$list);
}

/*
    检查是否安装 
*/
function isinstall($dbname){
   if(mysql_select_db($dbname)){
	    return true;
   }
   return false;
}

?>
