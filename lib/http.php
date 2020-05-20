<?
 
/*
   HTTP : POST
*/
function vpost($url,$data){ // 模拟提交数据函数  
    $curl = curl_init(); // 启动一个CURL会话    
	$useragent='Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11';    //洲际访问识别浏览器！！！！
	if(strpos($url,'globalvillahotel.com.cn')!==false){  
	    $http_array[]='Content-Type:text/xml';//http://weibo.com/lightheat/home?wvr=5';
	}
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址                
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查    
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在    
    curl_setopt($curl, CURLOPT_USERAGENT, $useragent); // 模拟用户使用的浏览器    
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转    
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer    
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包    
    curl_setopt($curl, CURLOPT_COOKIEJAR, $GLOBALS['cookie_file']); // 存放Cookie信息的文件名称    
    curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息    
    curl_setopt($curl, CURLOPT_TIMEOUT, 90); // 设置超时限制防止死循环    
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容    
	curl_setopt($curl, CURLOPT_HTTPHEADER, $http_array);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回    
    $tmpInfo = @curl_exec($curl); // 执行操作    
    if (curl_errno($curl)) {    
       return $url . 'Errno'.curl_error($curl);   
    }    
	//$info = curl_getinfo($curl); 
    curl_close($curl); // 关键CURL会话    
    return $tmpInfo; // 返回数据    
} 

/*
   HTTP:GET
*/   
function vget($url){ // 模拟获取内容函数 
    $curl = curl_init(); // 启动一个CURL会话   
	$useragent='Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0';    //洲际访问识别浏览器！！！！ 
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址  
	//curl_setopt($curl, CURLOPT_SSLVERSION, 3); //设定SSL版本      
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查    
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在    
    curl_setopt($curl, CURLOPT_USERAGENT, $useragent); // 模拟用户使用的浏览器    
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转    
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer    
    curl_setopt($curl, CURLOPT_HTTPGET, 1); // 发送一个常规的Post请求    
    curl_setopt($curl, CURLOPT_TIMEOUT, 10); // 设置超时限制防止死循环    
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10); //在发起连接前等待的时间，如果设置为0，则无限等待。
	  
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回  
	curl_setopt($curl, CURLOPT_COOKIEJAR, $GLOBALS['cookie_file']); // 存放Cookie信息的文件名称    
    curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息
	 
	if(strpos($url, 'doItemHighCommissionPromotionLink')!==false){
	      //file_put_contents(dirname(dirname(__file__))."/tkapi/log/curl_err.txt",date("Y-m-d H:i:s")." 【URL】:".$url."\r\n",FILE_APPEND );
	      $s = fopen(dirname(dirname(__file__))."/tkapi/log/curl_err.txt",'a+');  
		  curl_setopt($curl, CURLOPT_VERBOSE, true);
		  curl_setopt($curl, CURLOPT_STDERR, $s);
	} 
    $tmpInfo = @curl_exec($curl); // 执行操作  
	/*
	if(strpos($url, 'doItemHighCommissionPromotionLink')!==false){
	      file_put_contents(dirname(dirname(__file__))."/tkapi/log/curl_err.txt",date("Y-m-d H:i:s")." 【RESULT】:".$tmpInfo."\r\n",FILE_APPEND );
	}
	*/
     
    if (curl_errno($curl)) {    
	   return $url . 'Errno'.curl_error($curl);    
    }    
	 $info = curl_getinfo($curl);
    curl_close($curl); // 关闭CURL会话    
    return $tmpInfo; // 返回数据    
}   


/*
   HTTP:GET
*/   
function vget_timeout($url,$timeout){ // 模拟获取内容函数    
    $curl = curl_init(); // 启动一个CURL会话   
	$useragent='Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0';    //洲际访问识别浏览器！！！！ 
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址  
	//curl_setopt($curl, CURLOPT_SSLVERSION, 3); //设定SSL版本      
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在    
    curl_setopt($curl, CURLOPT_USERAGENT, $useragent); // 模拟用户使用的浏览器    
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转    
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer    
    curl_setopt($curl, CURLOPT_HTTPGET, 1); // 发送一个常规的Post请求    
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout); // 设置超时限制防止死循环    
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回  
	curl_setopt($curl, CURLOPT_COOKIEJAR, $GLOBALS['cookie_file']); // 存放Cookie信息的文件名称    
    curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息   
    $tmpInfo = @curl_exec($curl); // 执行操作    
    if (curl_errno($curl)) {    
	   //echo $url;
       //echo 'Errno'.curl_error($curl);    
    }    
	$info = curl_getinfo($curl);
    curl_close($curl); // 关闭CURL会话    
    return $tmpInfo; // 返回数据    
}   


/*
   HTTP:GET
*/   
function vget_more($url){ // 模拟获取内容函数    
    $curl = curl_init(); // 启动一个CURL会话   
	$useragent='Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0';    //洲际访问识别浏览器！！！！ 
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址  
	//curl_setopt($curl, CURLOPT_SSLVERSION, 3); //设定SSL版本      
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查    
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在    
    curl_setopt($curl, CURLOPT_USERAGENT, $useragent); // 模拟用户使用的浏览器    
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转    
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer    
    curl_setopt($curl, CURLOPT_HTTPGET, 1); // 发送一个常规的Post请求    
    curl_setopt($curl, CURLOPT_TIMEOUT, 10); // 设置超时限制防止死循环    
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回  
	curl_setopt($curl, CURLOPT_COOKIEJAR, $GLOBALS['cookie_file']); // 存放Cookie信息的文件名称    
    curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息   
    $tmpInfo = @curl_exec($curl); // 执行操作    
    if (curl_errno($curl)) {    
	   //echo $url;
       //echo 'Errno'.curl_error($curl);    
    }    
	$info = curl_getinfo($curl);
    curl_close($curl); // 关闭CURL会话    
    return array('result'=>$tmpInfo,'info'=>$info); // 返回数据    
}    

/*
    下载图片
*/
function getImg($url = "", $filename = "") { 
	//global $cookie_file; 
	//delcookie($cookie_file);
	if(stripos($url,"login.sina.com.cn/cgi/pin.php")!==false){
		$referer='https://login.sina.com.cn/signup/signin.php';
	}
	//vget("https://passport.ceair.com/cesso/login2!auth.shtml");
	$useragent='Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11';    //洲际访问识别浏览器！！！！
    $hander = curl_init();
    $fp = fopen($filename,'wb');
    curl_setopt($hander,CURLOPT_URL,$url);
    curl_setopt($hander,CURLOPT_FILE,$fp);
	curl_setopt($hander, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($hander, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($hander, CURLOPT_COOKIEJAR, $GLOBALS['cookie_file']); // 存放Cookie信息的文件名称    
    curl_setopt($hander, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息    
	curl_setopt($hander, CURLOPT_USERAGENT, $useragent); // 模拟用户使用的浏览器    
    curl_setopt($hander,CURLOPT_HEADER,0);
    curl_setopt($hander,CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($hander, CURLOPT_REFERER, $referer); 
    curl_setopt($hander,CURLOPT_TIMEOUT,60);
    @curl_exec($hander); curl_errno($hander);
    curl_close($hander);
    fclose($fp);
}
 /*
  上传远程图片到static.planpoint.cn服务器，并返回url
*/
function getWxImageUrl($fileurl, $filetype,$w,$h) {
	 $url = '';

	 if ($fileurl) { 
		 $stamp = time();
		 $y = date('Y', strtotime($stamp));
		 $m = date('n', strtotime($stamp));
		 $d = date('j', strtotime($stamp));
		 $sign = ($stamp - $y)/$d+$m; 

		 $link = "http://mobileapp.planpoint.cn:8080/services/user/static.php?t={$stamp}&s={$sign}&flag=2&w={$w}&h={$h}";

		 $tmpname = urlencode($fileurl);
		 $tmptype = $filetype;
		 $data = array('name' => $tmpname, 'type' => $tmptype);

		 $ch = curl_init();
		 //curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
		 curl_setopt($ch, CURLOPT_URL, $link);
		 curl_setopt($ch, CURLOPT_POST, true);
		 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		 curl_setopt($ch, CURLOPT_HEADER, false);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 $return_data = @curl_exec($ch);
		 if (curl_errno($ch)) {    
			 $return_data = 0;  
		 } 
		 curl_close($ch);

		 if (get_headers($return_data)) {
			 $url = $return_data;
		 } 
	 } 
  return $url;
}
	


/*
   发送公众号消息通知
   例子： sendMessage($title="", $name="采集亚马逊订单", $content="获取订单失败;\n报错文件：tkapi/amazon_Getorder.php\n估计原因：通常是cookie过期) ".$keyword, $desc="", $openid=array('oleZ9wOXDj4LtaG61VFhrb0AWE5c'));
*/
function sendMessage($title, $name, $content, $desc, $openid, $url) {
	$data['first'] = $title;
	$data['keyword1'] = $name;
	$data['keyword2'] = $content;
	$data['remark'] = $desc;

	$msg['openid'] = $openid;
	$msg['data'] = $data;
	$msg['url'] = $url;

	$str ="action=wxmsg_pp&msg=" . urlencode(json_encode($msg));
	$str .= "&token=" . md5('im.planpoint.cn');

	return vget_timeout("https://im.planpoint.cn/api/api.php?" . $str, 3);
}


/*
   HTTP:GET
   带文件头
*/   
function fxy_vget($url,$http_array){ // 模拟获取内容函数    
    $curl = curl_init(); // 启动一个CURL会话   
	$useragent='Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11';    //洲际访问识别浏览器！！！！
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址 
	//curl_setopt($curl, CURLOPT_SSLVERSION, 3); //设定SSL版本      
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查 
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在    
    curl_setopt($curl, CURLOPT_USERAGENT, $useragent); // 模拟用户使用的浏览器    
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转    
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer    
    curl_setopt($curl, CURLOPT_HTTPGET, 1); // 发送一个常规的Post请求    
	 
    curl_setopt($curl, CURLOPT_TIMEOUT, 10); // 设置超时限制防止死循环    
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回  
	curl_setopt($curl, CURLOPT_COOKIEJAR, $GLOBALS['cookie_file']); // 存放Cookie信息的文件名称    
    curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息   
	curl_setopt($curl, CURLOPT_HTTPHEADER, $http_array);  
    $tmpInfo = @curl_exec($curl); // 执行操作    
    if (curl_errno($curl)) {    
	   return $url .' Errno'.curl_error($curl);    
    }    
	$info = curl_getinfo($curl);
    curl_close($curl); // 关闭CURL会话    
    return $tmpInfo; // 返回数据    
}  


 
/*
   HTTP : POST
   带文件头
*/
function fxy_vpost($url,$data,$http_array){ // 模拟提交数据函数  
    $curl = curl_init(); // 启动一个CURL会话    
	$useragent='Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11';    //洲际访问识别浏览器！！！！
	curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址                
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查    
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在    
    curl_setopt($curl, CURLOPT_USERAGENT, $useragent); // 模拟用户使用的浏览器    
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转    
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer    
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包    
    curl_setopt($curl, CURLOPT_COOKIEJAR, $GLOBALS['cookie_file']); // 存放Cookie信息的文件名称    
    curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息    
    curl_setopt($curl, CURLOPT_TIMEOUT, 10); // 设置超时限制防止死循环    
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容    
	curl_setopt($curl, CURLOPT_HTTPHEADER, $http_array);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回    
    $tmpInfo = @curl_exec($curl); // 执行操作    
    if (curl_errno($curl)) {    
        return  'Errno'.curl_error($curl);    
    }    
	$info = curl_getinfo($curl); 
    curl_close($curl); // 关键CURL会话   
    return $tmpInfo; // 返回数据    
} 
 
?>