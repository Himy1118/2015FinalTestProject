<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上架完畢</title>
<style type="text/css">
<!--
body {
	background-image: url();
	background-color: #FFFFFF;
}
.style1 {color: #FF0000}
-->
</style></head>

<body>
 <div align="center">
   <span class="style1">
   <?
 /*
 echo $_SESSION['s_product'];
echo $_SESSION['s_ps']; 
echo $_SESSION['s_money_old']; 
echo $_SESSION['s_money']; 
echo $_SESSION['s_text']; 
echo $_SESSION['s_file'];
*/
 ?>
   <? 
//$conn=mysql_connect("localhost","root","root"); //連接資料庫
/*
$conn=mysql_connect("localhost","root","root"); //連接資料庫

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET UTF8");

 mysql_select_db("eshop_db"); //選擇資料庫
 mysql_query("insert into s_product
 (s_product,s_ps,s_money_old,s_money,s_text,s_file)
 values
 ('".$_SESSION['s_product']."','".$_SESSION['s_ps']."','".$_SESSION['s_money_old']."','".$_SESSION['s_money']."','".$_SESSION['s_text']."','".$_SESSION['s_file']."')",
 $conn);
 */
?>
  上架完畢   </span>
   <hr> 
  <p>&nbsp;</p>
  <p><a href="s_upstore.php">回上頁</a></p>
</div><hr>

</body>
</html>
