<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>購買商品</title>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
	background-image: url();
}
.style1 {color: #999966}
.style2 {color: #999966; font-weight: bold; }
.style3 {color: #6A6A46; font-weight: bold; }
.style7 {color: #486000; font-weight: bold; }
.style8 {
	color: #425700;
	font-weight: bold;
}
.style9 {
	color: #FF0000;
	font-weight: bold;
}
.style10 {
	color: #666666;
	font-size: small;
}
.style11 {color: #CCCCFF}
-->
</style></head>

<body>
   <?PHP 


 
$_SESSION['s_product']=$_SESSION['s_product'].$_POST['s_product'].",";

$_SESSION['s_money']=$_SESSION['s_money'].$_POST['s_money'].",";
$_SESSION['s_number']=$_SESSION['s_number'].$_POST['s_number'].",";


?>


<?php 
if ($_GET['shop']=="false"){

$_SESSION['s_product']="";
$_SESSION['s_money']="";
$_SESSION['s_number']="";


};?>
<hr>
<div align="center"><br>
 
  <form name="form1" method="post" action="buy_shop2.php?buyok=true">
  <br>
    <table width="442" border="1">
	  <?php   $arr= split(",",$_SESSION['s_product']);
  $arr3= split(",",$_SESSION['s_money']);
  $arr2= split(",",$_SESSION['s_number']);
  for ($i=0;$i<=count($arr);$i++){
  //echo $arr[$i] . " " . $arr2[$i] . " " . $arr3[$i] . " " . "<br>";
  //echo "<tr><td >". $arr[$i] ."</td><td >". $arr2[$i] ."</td><td >". ($arr3[$i] ) ."</td></tr>";
  
  $sum=$sum + ($arr3[$i] * $arr2[$i]);
  };?>
      <tr>
        <td width="381" background="../images/fdsfdsg.jpg"><div align="center">
		<?php
		mysql_connect("localhost","root","root"); //連接資料庫
		mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET UTF8");
 mysql_select_db("phone_shop_db"); //選擇資料庫
 mysql_query("insert into sale_product
(a_account,sale_sn,s_product,sale_num,s_money,sale_date,se_name,se_phone,se_address,se_stud,se_si,si_class,sendtype)
 
 values
 ('". $_SESSION['MM_Username'] ."','". $_SESSION[$sale_id] ."','". $_SESSION['s_product'] ."','". $_SESSION['s_number'] ."','". $_SESSION['s_money'] ."','". date("Y-m-d") ."','".$_POST['se_name']."','".$_POST['se_phone']."','".$_POST['se_address']."','".$_POST['se_stud']."','".$_POST['se_si']."','".$_POST['si_class']."','".$_POST['sendtype']."')
");
		$_SESSION[$sale_id]=md5(uniqid(rand()));
		
		echo "購物完畢"."<br>";
		echo "<font color=red >金額為:". $sum ."元</font><br>";
	
		
$_SESSION['s_product']="";
$_SESSION['s_money']="";
$_SESSION['s_number']="";
		

		?>
        <br />
        請將款項匯到銀行帳號:xxx<br />
        代號:xxx</div></td>
    
	  </tr>
    </table>
  </form>
  <a href="../index.php">回首頁</a>
  <hr>
  <p><span class="style3">   
  </span> </p>
  <p>      <br>
  </p>
</div>
<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><span class="style3">
  </span></p>


</div>
</body>
</html>
