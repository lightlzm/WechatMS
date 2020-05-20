<?
/*
    安装
*/
$step  = $_GET['step'];
include("config.php");

switch($step){
   case '1'://安装数据库 
            $conn = mysql_connect($dbhost,$dbuser,$dbpwd);
		    if(!mysql_select_db($dbname,$conn)){//未安装
			    $sql="CREATE DATABASE  `".$dbname."` ;";
				mysql_query($sql);  
				mysql_select_db($dbname,$conn);
			    $sql="CREATE TABLE IF NOT EXISTS `auto_reply` (
					  `id` int(16) NOT NULL AUTO_INCREMENT,
					  `botid` varchar(50) NOT NULL,
					  `kwd` varchar(100) NOT NULL,
					  `action_name` varchar(50) NOT NULL COMMENT 'send_text/image/urlLink',
					  `data` text COMMENT 'data',
					  `wxstyle` tinyint(1) DEFAULT '1' COMMENT '1wechat2room',
					  `roomid` varchar(30) DEFAULT NULL COMMENT 'chatroomID',
					  `intime` varchar(20) NOT NULL COMMENT 'add time',
					  `uptime` varchar(20) DEFAULT NULL COMMENT 'update time',
					  `status` tinyint(1) DEFAULT '1' COMMENT 'status 0 uneffect 1 effect',
					  PRIMARY KEY (`id`),
					  KEY `kwd` (`kwd`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
				mysql_query($sql);
				
				$sql="CREATE TABLE IF NOT EXISTS `bot` (
					  `id` int(16) NOT NULL AUTO_INCREMENT,
					  `wxid` varchar(20) NOT NULL COMMENT 'wx ID',
					  `nickname` varchar(200) NOT NULL,
					  `qr_code` varchar(500) DEFAULT NULL COMMENT 'qr code link',
					  `auto_accept_friend` tinyint(1) DEFAULT '1' COMMENT '1 auto 2 manual',
					  `accept_friend_auto_reply` tinyint(1) DEFAULT '0' COMMENT '1 auto reply 0 not auto reply',
					  `join_date` varchar(20) NOT NULL COMMENT 'join date',
					  `last_login_date` varchar(20) DEFAULT NULL COMMENT 'last login date',
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
				mysql_query($sql); 
				
				$sql="CREATE TABLE IF NOT EXISTS `chatroom` (
					  `id` int(16) NOT NULL AUTO_INCREMENT,
					  `botid` varchar(50) DEFAULT NULL COMMENT 'wxID',
					  `ownerId` varchar(60) NOT NULL COMMENT 'owner room ID',
					  `topic` varchar(100) NOT NULL COMMENT 'room topic',
					  `roomid` varchar(20) NOT NULL COMMENT 'room ID',
					  `totaluser` int(16) DEFAULT '0' COMMENT 'total users',
					  `announce` text COMMENT '',
					  `avatar` varchar(200) NOT NULL COMMENT '',
					  `qrcode` varchar(200) DEFAULT NULL COMMENT '',
					  `ownername` varchar(100) DEFAULT NULL COMMENT '',
					  `memberinfo` longtext COMMENT '会员信息',
					  `is_sys_member` tinyint(1) DEFAULT NULL COMMENT '',
					  `join_welcome_msg` text,
					  `is_open_join_welcome_msg` tinyint(4) DEFAULT '0' COMMENT '',
					  `last_send_time` varchar(20) DEFAULT NULL COMMENT '',
					  `last_update_time` varchar(20) DEFAULT NULL COMMENT '',
					  `status` tinyint(1) DEFAULT '0' COMMENT '',
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
				mysql_query($sql); 
				$sql="CREATE TABLE IF NOT EXISTS `chatroom_log` (
					  `id` int(16) NOT NULL AUTO_INCREMENT,
					  `topic` varchar(200) DEFAULT NULL COMMENT '',
					  `roomid` varchar(20) NOT NULL COMMENT '',
					  `contact_id` varchar(30) NOT NULL COMMENT '',
					  `type` int(10) NOT NULL COMMENT '',
					  `text` text COMMENT '',
					  `send_date` varchar(10) DEFAULT NULL COMMENT '',
					  `send_time` varchar(20) DEFAULT NULL COMMENT '',
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
				mysql_query($sql); 
                
				$sql="CREATE TABLE IF NOT EXISTS `room_member` (
					  `id` int(16) NOT NULL AUTO_INCREMENT,
					  `roomid` varchar(20) NOT NULL COMMENT '',
					  `nickname` varchar(100) DEFAULT NULL COMMENT '',
					  `wxid` varchar(20) NOT NULL COMMENT 'wxid',
					  `alias` varchar(200) DEFAULT NULL COMMENT '',
					  `avatar` varchar(200) NOT NULL COMMENT '',
					  `gender` tinyint(4) DEFAULT '9' COMMENT '',
					  `join_date` varchar(20) DEFAULT NULL COMMENT '',
					  `inviter_wxid` varchar(30) DEFAULT NULL COMMENT '',
					  `last_send_date` varchar(20) DEFAULT NULL COMMENT '',
					  `send_total` int(11) DEFAULT '0' COMMENT '',
					  `last_check_time` varchar(20) DEFAULT NULL COMMENT '',
					  PRIMARY KEY (`id`),
					  KEY `wxid` (`wxid`),
					  KEY `roomid` (`roomid`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
				mysql_query($sql); 
				
				$sql="CREATE TABLE IF NOT EXISTS `schedule_job` (
					  `id` int(16) NOT NULL AUTO_INCREMENT,
					  `botid` varchar(50) DEFAULT NULL COMMENT '',
					  `name` varchar(100) NOT NULL COMMENT '',
					  `data` text NOT NULL COMMENT '',
					  `send_style` tinyint(1) DEFAULT '0' COMMENT '',
					  `doing_time` varchar(10) DEFAULT NULL COMMENT '',
					  `doing_date` varchar(500) DEFAULT NULL COMMENT '',
					  `is_open` tinyint(1) DEFAULT '0' COMMENT '',
					  `is_exe` tinyint(1) DEFAULT '0' COMMENT '',
					  `intime` varchar(20) NOT NULL COMMENT '',
					  `gettime` varchar(20) DEFAULT NULL COMMENT '',
					  `exetime` varchar(20) DEFAULT NULL COMMENT '',
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
				mysql_query($sql); 
				
				tips2($text="安装完成，正在跳转管理界面...");
				
			}else{
			    tips2($text="已安装完成，正在跳转管理界面...");
			}
		    
		   break;
		   
   default:  //检查配置文件
            
			if(empty($dbhost)||empty($dbuser)||empty($dbpwd)||empty($dbname)){ 
			   tips($text="请打开config.php配置数据库参数。");
			}else{
			    $conn = mysql_connect($dbhost,$dbuser,$dbpwd);
				if($conn==false){
					 tips($text="数据库参数有误，请修改config.php文件后再安装。"); 
				}else{
			        header("Location: install.php?step=1");
					exit();
				}
			}
		  
}

function tips($text){
   echo '<meta charset="UTF-8">';
   echo '<div style="width:50%; height:; border:1px solid #F93; margin:50px auto; padding:10px; text-align:center; background-color:#FFC">'.$text.'</div>';
   exit();
}

function tips2($text){
   echo '<meta charset="UTF-8">';
   echo '<div style="width:50%; height:; border:1px solid #F93; margin:50px auto; padding:10px; text-align:center; background-color:#FFC">'.$text.'</div>';
   echo ' <meta http-equiv="refresh" content="5;url=index.php?action=botlist" /> '; 
   exit();
}


?>
