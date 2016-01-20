<?php require_once('../Connections/easyshop.php'); ?>
<?php
$colname_rs = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = sprintf("SELECT * FROM a_account WHERE a_account = '%s'", $colname_rs);
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
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
.style13 {font-size: small}
.style16 {color: #000000; font-size: small; }
.style26 {color: #000000}
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
<div align="center">填寫送貨人<br>
 
  <form name="form1" method="post" action="buy_shop5.php" onsubmit="return postit3();"><?php echo date("Y-m-d");?>    <br>
    <table width="598" border="0">
      <tr bgcolor="#CCCCCC">
        <td colspan="3" bgcolor="#FFFFFF"><div align="left" class="style13"><span class="style26"></span></div></td>
      </tr>
      <tr bgcolor="#E9FFA4">
        <td colspan="3" bgcolor="#FFFFFF"><div align="center" class="style8">購買會員:
        <?php  echo $_SESSION['MM_Username'];?></div></td>
      </tr>
      <tr bgcolor="#CCFF33">
        <td width="108" bgcolor="#FFFFFF"><div align="center" class="style8">產品名稱</div></td>
        <td width="180" bgcolor="#FFFFFF"><div align="center" class="style8">數量</div></td>
        <td width="232" bgcolor="#FFFFFF"><div align="center" class="style8">單價</div></td>
      </tr>
	  <?php   $arr= split(",",$_SESSION['s_product']);
  $arr3= split(",",$_SESSION['s_money']);
  $arr2= split(",",$_SESSION['s_number']);
  for ($i=0;$i<=count($arr);$i++){
  //echo $arr[$i] . " " . $arr2[$i] . " " . $arr3[$i] . " " . "<br>";
  echo "<tr><td >". $arr[$i] ."</td><td >". $arr2[$i] ."</td><td >". ($arr3[$i] ) ."</td></tr>";
  
  $sum=$sum + ($arr3[$i] * $arr2[$i]);
  };?>
	  
	  
      
	  
	  
      <tr bgcolor="#E9FFA4">
        <td colspan="2" bgcolor="#FFFFFF"><div align="center" class="style8">總金額</div></td>
        <td bgcolor="#FFFFFF"><span class="style8"><?php echo $sum;?></span></td>
      </tr>
      <tr>
        <td colspan="3"><span class="style13"></span></td>
      </tr>
    </table>
    <br>
    <table width="674" border="1">
      
      <tr>
        <td colspan="4" bgcolor="#FFFFFF"><div align="center" class="style16">收件人
            <input name="sendtype" type="hidden" id="sendtype" value="<?php echo $_POST['sendtype'];?>">
        </div></td>
      </tr>
      <tr>
        <td width="55" bgcolor="#FFFFFF"><span class="style8">姓名</span></td>
        <td width="445" colspan="3"><div align="left" class="style16">
            <div align="left">
              <input name="se_name" type="text" id="se_name">
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><span class="style8">電話</span></td>
        <td colspan="3"><div align="left" class="style16">
            <div align="left">
              <input name="se_phone" type="text" id="se_phone">
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><span class="style8">地址</span></td>
        <td colspan="3"><div align="left" class="style16">
            <div align="left">
              <input name="se_address" type="text" id="se_address" size="60">
            </div>
        </div></td>
      </tr>
	  
	
	  
      <tr>
        <td colspan="4"><div align="left" class="style16">
          <div align="center">
            <input type="submit" name="Submit" value="我 要 結 帳">
            <br>
            <br>
            <a href="../index.php">[繼續購物]</a>  <a href="buy_shop2.php?shop=false">[清空購物車]</a></div>
        </div></td>
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
<?php
mysql_free_result($rs);
?>

<script language="javascript">
function postit3(){


if(document.form1.se_name.value==""){
alert ("姓名要填唷!")
return false;
}else if (document.form1.se_address.value==""){
alert ("地址要填唷!");
return false;
}

//alert ("新增完畢");




}
</script>