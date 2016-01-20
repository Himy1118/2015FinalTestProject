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
.style3 {color: #6A6A46; font-weight: bold; }
.style8 {
	color: #000000;
	font-weight: bold;
	font-size: small;
}
.style9 {
	color: #FF0000;
	font-weight: bold;
	font-size: small;
}
.style11 {color: #CCCCFF}
.style12 {font-size: small}
.style14 {font-family: "標楷體"}
.style15 {color: #000000}
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
<div align="center">
  <span class="style14">[購物清單] </span><br>
 
  <form name="form1" method="post" action="buy_shop4.php"><?php echo date("Y-m-d");?>    <br>
    <table width="554" border="1">
      <tr bgcolor="#E9FFA4">
        <td colspan="4" background="../user/image/bg198_gif.gif"><div align="center" class="style8">購買者:<?php  echo $_SESSION['MM_Username'];?></div></td>
      </tr>
      <tr bgcolor="#CCFF33">
	  <td width="110" background="../user/image/bg198_gif.gif">&nbsp; </td>
        <td width="221" background="../user/image/bg198_gif.gif"><div align="center" class="style8">產品名稱</div></td>
        <td width="83" background="../user/image/bg198_gif.gif"><div align="center" class="style8">產品數量</div></td>
        <td width="112" background="../user/image/bg198_gif.gif"><div align="center" class="style8">產品 單價</div></td>
      </tr>
	  <?php   $arr= split(",",$_SESSION['s_product']);
  
  $arr2= split(",",$_SESSION['s_number']);
  $arr3= split(",",$_SESSION['s_money']);
  
  for ($i=0;$i<=count($arr);$i++){
  //echo $arr[$i] . " " . $arr2[$i] . " " . $arr3[$i] . " " . "<br>";
 if($arr[$i]<>""){
  echo "<tr><td><a href=buy_edit.php?r_id=". $i .">修改</a> | <a href=buy_del.php?r_id=". $i .">刪除</a></td><td >". $arr[$i] ."</td><td >". $arr2[$i] ."</td><td >". ($arr3[$i] ) ."</td></tr>";
 }
  
  $sum=$sum + ($arr3[$i] * $arr2[$i]);
  };?>
	  
	  
      
	  
	  
      <tr bgcolor="#E9FFA4">
	  
        <td colspan="3" bgcolor="#FFFFFF"><div align="center" class="style12"><strong>總金額</strong></div></td>
        <td bgcolor="#FFFFFF"><span class="style9"><?php echo $sum;?></span></td>
      </tr>
      <tr>
        <td colspan="3"><div align="center">

		
		
          <input type="submit" name="Submit" value="結 算">
          <br>
          <br>
          <a href="../index.php">繼續購物</a> <span class="style11">   </span><a href="buy_shop2.php?shop=false">清空購物車</a></div></td>
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
