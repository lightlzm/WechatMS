<?
//分页模块；


$page=$_GET['page'];
if($page=="") $page=0;
else $page=$_GET['page'];

$paget=$_GET[paget];
if($paget=="") $paget=0;
else $paget=$_GET[paget];

$pagenum=10;

function fenye($page,$sql,$pagenum )  //一个分页函数；
{
 //*****page 当前页
 //*****pagenum 每页记录条数
 //***** sql   sql语句； $sql="select * from pp_optic_group where is_pass=1 ORDER BY `pp_optic_group`.`gid` DESC ";
 //****** return arr(); msg,pre,$pagenum;
 
 //***** msg  返回信息
 //***** pre  返回开始搜索位置；
//*****pagenum 返回每页记录条数
//*****num 总记录条数
//在应用处加 limit $pre,$pagenum
 
  
  $pre=$page*$pagenum; //开始位置
 
  $result=mysql_query($sql);
  $num=mysql_num_rows($result);
  
  if($num!=$pagenum)
    $totle=floor($num/$pagenum)+1; //总页数
  else   $totle=floor($num/$pagenum);
 
 
if($num<$pagenum||$num==$pagenum) //仅一页；
 {
   $page=$page+1; //用于显示
   $msg="<a href='' class='unable last-page'>主页</a><a href='' class='unable last-page'>上一页</a><a href='' class='unable last-page'>下一页</a><a href='' class='unable last-page'>尾页</a>  &nbsp;共{$totle}页&nbsp;{$num}条记录&nbsp;第{$page}页";
 }
 else if($page==0)//第一页
 {
 
  $vala=$page+1;
  $valb=$totle-1;
  $urla= changeUrl($vala);
  $urlb= changeUrl($valb);
  $page=$page+1; //用于显示
  $msg=" <a href='' class='unable last-page'>首页</a>  <a href='' class='unable last-page'>上一页</a> <a href='{$urla}'>下一页</a><a href='{$urlb}'>尾页</a> &nbsp;共{$totle}页&nbsp;{$num}条记录&nbsp;第{$page}页";
 }
 else if($page==$totle-1)//最后一页
 {
  $vala=$page-1;
  $valb=0;
  $urla= changeUrl($vala);
  $urlb= changeUrl($valb);
  $page=$page+1; //用于显示
  $msg=" <a href='{$urlb}'>首页</a> <a href='{$urla}'>上一页</a> <a href='' class='unable last-page'>下一页</a><a href='' class='unable last-page'>尾页</a> &nbsp;共{$totle}页&nbsp;{$num}条记录 &nbsp;第{$page}页";
  }
 else{               //中间页；
    $vala=$page-1;
    $valc=$page+1;
	$valb=$totle-1;
	$vald=0;
    $urla= changeUrl($vala);
    $urlc= changeUrl($valc);
	$urlb= changeUrl($valb);
	$urld= changeUrl($vald);
	$page=$page+1; //用于显示
  $msg=" <a href='{$urld}'>首页</a> <a href='{$urla}'>上一页</a><a href='{$urlc}'>下一页</a><a href='{$urlb}'>尾页</a> &nbsp;共{$totle}页&nbsp;{$num}条记录 &nbsp;当前第{$page}页";
 }

$arr=array();
$arr[0]=$msg;
$arr[1]=$pre;
$arr[2]=$pagenum;
$arr[3]=$num;

return $arr;

}

function GetCurUrl()
{//获取当前页面的url
if(!empty($_SERVER["REQUEST_URI"])){
$scriptName = $_SERVER["REQUEST_URI"];
$nowurl = $scriptName;
}else{
$scriptName = $_SERVER["PHP_SELF"];
if(empty($_SERVER["QUERY_STRING"])) $nowurl = $scriptName;
else $nowurl = $scriptName."?".$_SERVER["QUERY_STRING"];
}
return $nowurl;
}

//
function changeUrl($val) 
{ //把值传进去；
   $findme    = 'page=';
   $str = GetCurUrl();

$pos2 = stripos($str, $findme);
if($pos2===false) //没找到page
{ 
   
    if(stripos($str, '?')===false) //没参数；
     {
       $url=$str."?page=".$val;   //&==>?
      }else 
     {
        $url=$str."&page=".$val;
      }
 }
else //有page;
{
    $str= substr($str,0,$pos2-1);
     if(stripos($str, '?')===false) //没参数；
     {
       $url=$str."?page=".$val;    //&==>?
      }else
     {
        $url=$str."&page=".$val;
      }
 
 }
 return $url;
}

//-------------------------------------------------------------------------------------
function fenyet($paget,$sql,$pagenum )  //两个分页函数；
{
 //*****page 当前页
 //*****pagenum 每页记录条数
 //***** sql   sql语句； $sql="select * from pp_optic_group where is_pass=1 ORDER BY `pp_optic_group`.`gid` DESC ";
 //****** return arr(); msg,pre,$pagenum;
 
 //***** msg  返回信息
 //***** pre  返回开始搜索位置；
//*****pagenum 返回每页记录条数
//*****num 总记录条数
//在应用处加 limit $pre,$pagenum
 
  
  $pre=$paget*$pagenum; //开始位置
 
  $result=mysql_query($sql);
  $num=mysql_num_rows($result);
  $totle=floor($num/$pagenum)+1; //总页数

if($num<$pagenum) //仅一页；
 {
   $msg="主页|上一页|下一页|尾页  &nbsp;共{$totle}页&nbsp;{$num}条记录&nbsp;当前第{$page}页";
 }
 else if($paget==0)//第一页
 {
 
  $vala=$paget+1;
  $valb=$totle-1;
  $urla= changeUrlt($vala);
  $urlb= changeUrlt($valb);
  $msg=" 首页|上一页|	<a href='{$urla}'>下一页</a><a href='{$urlb}'>| 尾页</a> &nbsp;共{$totle}页&nbsp;{$num}条记录&nbsp;当前第{$paget}页";
 }
 else if($paget==$totle-1)//最后一页
 {
  $vala=$paget-1;
  $valb=0;
  $urla= changeUrlt($vala);
  $urlb= changeUrlt($valb);
  $msg=" <a href='{$urlb}'>首页</a> | <a href='{$urla}'>上一页</a>|下一页| 尾页 &nbsp;共{$totle}页&nbsp;{$num}条记录 &nbsp;当前第{$paget}页";
  }
 else{               //中间页；
    $vala=$paget-1;
    $valc=$paget+1;
	$valb=$totle-1;
	$vald=0;
    $urla= changeUrlt($vala);
    $urlc= changeUrlt($valc);
	$urlb= changeUrlt($valb);
	$urld= changeUrlt($vald);
  $msg=" <a href='{$urld}'>首页</a>|<a href='{$urla}'>上一页</a>|<a href='{$urlc}'>下一页</a><a href='{$urlb}'>| 尾页</a> &nbsp;共{$totle}页&nbsp;{$num}条记录 &nbsp;当前第{$paget}页";
 }

$arr=array();
$arr[0]=$msg;
$arr[1]=$pre;
$arr[2]=$pagenum;
$arr[3]=$num;

return $arr;

}




//
function changeUrlt($val) 
{ //把值传进去；
   $findme    = 'paget=';
   $mystring2 = GetCurUrl();

$pos2 = stripos($mystring2, $findme);
if(!$pos2) //没找到
{ 
   
    if(!stripos($mystring2, '?')) //没参数；
     {
       $url=$mystring2."?paget=".$val;
      }else
     {
        $url=$mystring2."&paget=".$val;
      }
 }
else 
{
    $mystring2= substr($mystring2,0,$pos2-1);
     if(!stripos($mystring2, '?')) //没参数；
     {
       $url=$mystring2."?paget=".$val;
      }else
     {
        $url=$mystring2."&paget=".$val;
      }
 
 }
 return $url;
}

/****截取字符串*****/
function substrcn($str, $len, $dot = '...')
    {
        $patten = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";

        preg_match_all($patten, $str, $regs);

        $v = 0; $s = '';
        for($i=0; $i<count($regs[0]); $i++)
  {
            (ord($regs[0][$i]) > 129) ? $v += 2 : $v++;
            $s .= $regs[0][$i];

   if($v >= $len * 2)
   {
                $s .= $dot;
    break;
      }
  }

        return $s;
    }

 

?>