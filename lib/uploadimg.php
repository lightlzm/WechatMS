<?php
 /*
     上传图片
 */ 
    
    ini_set('date.timezone','Asia/Shanghai');
    $error = "";
	$msg = "";
	$flag=0;   //是否有图片的标志；
    
	//$url="http://static.planpoint.cn/image/fanxianyi/";
	//$url="http://xxx.planpoint.cn/commission/";
	//$url="http://127.0.0.1:8100/commission/";
	
	$fileElementName = $_POST['image'];
	
	//$fileElementName = 'picture';
	
 
	if(!empty($_FILES[$fileElementName]['error'])) //有错；
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = '图片文件最大4M，请缩小图片，重新上传';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none') //上传文件为空；
	{   
	    $flag=0;
		$error = 'No file was uploaded..';
	}else   //上传成功
	{       
	        
		    
			 
		    
			
			$filename = $_FILES[$fileElementName]["tmp_name"];
			$filetype = str_replace('image/','',$_FILES[$fileElementName]["type"]);
			
			if (is_file($filename)) {
				$stamp = time();
				$y = date('Y', strtotime($stamp));
				$m = date('n', strtotime($stamp));
				$d = date('j', strtotime($stamp));
				$sign = ($stamp - $y)/$d+$m;
		
				$link = "http://mobileapp.planpoint.cn:8080/services/user/static.php?t={$stamp}&s={$sign}";
				 
				$tmpname = urlencode(basename($filename));
				$tmpfile = $filename;
				$tmptype = $filetype;
				$data = array('image'=>'@'.$tmpfile.";type=".$tmptype.";filename=".$tmpname);
		
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
				curl_setopt($ch, CURLOPT_URL, $link);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$return_data = curl_exec($ch);
				if (curl_errno($ch)) {
					$return_data = 0;
				}
				curl_close($ch);
		
				if ($return_data) {
					$url = $return_data;
					$flag=1;
				}
			}
     
		 
	  
	
	}
	

//******************************************图片出错××××××××××××××××××××××
if($flag==0){ 
	$info = array("status"=>false,"error"=>$error,"msg"=>$msg);
}else{
    $info = array("status"=>true,"error"=>$error,"msg"=>$msg,'url'=>$url);
}   
echo json_encode($info);

?>