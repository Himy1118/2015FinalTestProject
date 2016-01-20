<?php // require_once('../../Connections/easyshop.php'); ?>
<?php require_once('../Connections/easyshop.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE sale_product SET sale_ps=%s WHERE s_id=%s",
                       GetSQLValueString($_POST['sale_ps'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($updateSQL, $easyshop) or die(mysql_error());

  $updateGoTo = "s_system.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs = "1";
if (isset($_GET['id'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = sprintf("SELECT * FROM sale_product WHERE s_id = %s", $colname_rs);
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);

$colname_rs2 = "-1";
if (isset($_GET['id'])) {
  $colname_rs2 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs2 = sprintf("SELECT * FROM sale_product WHERE s_id = %s", $colname_rs2);
$rs2 = mysql_query($query_rs2, $easyshop) or die(mysql_error());
$row_rs2 = mysql_fetch_assoc($rs2);
$totalRows_rs2 = mysql_num_rows($rs2);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
mysql_select_db($database_easyshop, $easyshop);
$query_RSP = "SELECT * FROM a_account WHERE a_account ='". $row_rs['a_account'] ."'"; 
$RSP = mysql_query($query_RSP, $easyshop) or die(mysql_error());
$row_RSP = mysql_fetch_assoc($RSP);
$totalRows_RSP = mysql_num_rows($RSP);
?>
<title>購買商品</title>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
	background-image: url();
}
.style3 {color: #6A6A46; font-weight: bold; }
.style1 {font-size: small}
.style23 {color: #000000}
.style24 {font-weight: bold; font-size: small;}
-->
</style></head>

<body>
   




<?php require_once('system_top.php'); ?>

<div align="center">
  <span class="style23">[購買記錄] <br>
  </span>
  <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" class="style23">    
  <br>
  <table width="816" border="1" align="center">
    <tr bgcolor="#CCCCFF">
      <td width="95" height="20" bgcolor="#FFFFFF"><div align="center" class="style1 style23"><span class="style24">帳號</span></div></td>
      <td width="89" bgcolor="#FFFFFF"><div align="center" class="style1 style23"><span class="style24">密碼</span></div></td>
      <td width="113" bgcolor="#FFFFFF"><div align="center" class="style1 style23"><span class="style24">姓名</span></div></td>
      <td width="192" bgcolor="#FFFFFF"><div align="center" class="style1 style23"><span class="style24">住址</span></div></td>
      <td width="112" bgcolor="#FFFFFF"><div align="center" class="style1 style23"><span class="style24">電話</span></div></td>
      <td width="120" bgcolor="#FFFFFF"><div align="center" class="style1 style23"><span class="style24">E-MAIL</span></div></td>
      <td width="49" bgcolor="#FFFFFF"><div align="center" class="style1 style23"><span class="style24">ATM</span></div></td>
    </tr>
    <tr>
      <td><div align="center" class="style1"><?php echo $row_RSP['a_account']; ?></div></td>
      <td><div align="center" class="style1"><?php echo $row_RSP['a_pass']; ?></div></td>
      <td><div align="center" class="style1"><?php echo $row_RSP['a_name']; ?></div></td>
      <td><div align="center" class="style1"><?php echo $row_RSP['a_address']; ?></div></td>
      <td><div align="center" class="style1"><?php echo $row_RSP['a_phone']; ?></div></td>
      <td><div align="center" class="style1"><?php echo $row_RSP['a_sogi']; ?></div></td>
      <td><div align="center" class="style1"><?php echo $row_RSP['atm']; ?></div></td>
    </tr>
  </table>
  <table width="484" border="0">
      <tr bgcolor="#CCCCCC">
        <td colspan="3" bgcolor="#FFFFFF"><div align="left"><span class="style1">交易編號:
              <?php echo $row_rs['sale_sn']; ?>
              <input name="id" type="hidden" id="id" value="<?php echo $row_rs['s_id']; ?>">
        </span></div></td>
      </tr>
      <tr bgcolor="#E9FFA4">
        <td colspan="3"><div align="center" class="style1"><strong>購買者: <?php echo $row_rs['a_account']; ?></strong></div></td>
      </tr>
      <tr bgcolor="#E9FFA4">
        <td colspan="3"><div align="center" class="style24"> 購買時間:<?php echo $row_rs['sale_date']; ?></div></td>
      </tr>
      <tr bgcolor="#CCFF33">
        <td width="201"><div align="center" class="style24">產品名稱</div></td>
        <td width="156"><div align="center" class="style24">產品數量</div></td>
        <td width="113"><div align="center" class="style24">產品 單價</div></td>
      </tr>
	  <?php   $arr= split(",",$row_rs['s_product']);
  $arr3= split(",",$row_rs['s_money']);
  $arr2= split(",",$row_rs['sale_num']);
  for ($i=0;$i<=count($arr);$i++){
  //echo $arr[$i] . " " . $arr2[$i] . " " . $arr3[$i] . " " . "<br>";
  echo "<tr><td >". $arr[$i] ."</td><td >". $arr2[$i] ."</td><td >". ($arr3[$i] ) ."</td></tr>";
  
  $sum=$sum + ($arr3[$i] * $arr2[$i]);
  };?>
	  
	  
      
	  
	  
      <tr bgcolor="#E9FFA4">
        <td colspan="2"><div align="center" class="style1"><strong>總金額</strong></div></td>
        <td><span class="style24"><?php echo $sum;?></span></td>
      </tr>
      <tr bgcolor="#CCCC66">
        <td colspan="3"><div align="center" class="style1"><strong>處理情況</strong></div></td>
      </tr>
      <tr bgcolor="#E4E4AF">
        <td colspan="3"><div align="center" class="style24">            
            <div align="center">
              <input name="sale_ps" type="radio" value="1">
              
            處理中
            
            <input name="sale_ps" type="radio" value="3">
            結案
            
            <input name="sale_ps" type="radio" value="5">
            退單
            <input type="submit" name="Submit" value="送出">
              </div>
        </div></td>
	  </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1">
    <table width="576" border="1">
      <tr>
        <td width="129" bgcolor="#003399"><div align="center">寄送位置</div></td>
        <td width="327"><div align="left"><?php echo $row_rs2['se_stud']; ?><?php echo $row_rs2['se_si']; ?><?php echo $row_rs2['si_class']; ?><br>
          ( <?php echo $row_rs2['area']; ?><?php echo $row_rs2['se_address']; ?> <?php echo $row_rs2['se_name']; ?> <?php echo $row_rs2['se_phone']; ?>)</div></td>
      </tr>
    </table>
  </form>
  <a href="s_system.php">回上頁 </a> | <a href="../index.php"> 回首頁</a>
  <hr>
  <p><span class="style3">    <?php 
  //echo $_SESSION['s_product'];
	/*
  $arr= split(",",$_SESSION['s_product']);
  $arr2= split(",",$_SESSION['s_money']);
  $arr3= split(",",$_SESSION['s_number']);
  for ($i=0;$i<=count($arr);$i++){
  echo $arr[$i] . " " . $arr2[$i] . " " . $arr3[$i] . " " . "<br>";
  };
  */

  
  
  ?>
  </span> </p>
  <p><br>
  </p>
</div>
<div align="center">
  <p>
    <?php 		
		//echo "購物完畢 請將金額轉帳到:"."<br>";
		//echo "<font color=red >銀行代號:XXX 帳號:XXXXXXXXXXX 金額為:". $sum ."元</font><br>";
		//echo "物品將在7個工作天內送達 到帳戶內的地址";
		?>
  </p>
  <p>&nbsp;</p>
  <p><span class="style3">
  </span></p>
 

</div>
</body>
</html>
<?php
mysql_free_result($rs);

mysql_free_result($rs2);

mysql_free_result($RSP);
?>
