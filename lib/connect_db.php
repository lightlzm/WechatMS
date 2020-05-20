<?
/*
   链接数据库
*/

$conn = mysql_connect($dbhost,$dbuser,$dbpwd);
if($conn==false){
	 die("can not connect db");
}
mysql_select_db($dbname,$conn)  ;
mysql_query("set character set 'utf8'");//读库
mysql_query('set names utf8'); //写
ini_set('date.timezone','Asia/Shanghai'); 


	
?>