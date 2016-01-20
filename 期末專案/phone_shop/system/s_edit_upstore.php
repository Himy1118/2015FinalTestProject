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

if($_FILES['myfile2']['name'] <> ""){
$uploaddir2 = '';
$uploadfile2 = $uploaddir2.basename($_FILES['myfile2']['name']);
(move_uploaded_file($_FILES['myfile2']['tmp_name'], "store_photo/".$uploadfile2));
}



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {


if(( $_FILES['myfile2']['name'] =="")){ 
  $updateSQL = sprintf("UPDATE s_product SET s_product=%s, s_ps=%s, s_money_old=%s, s_money=%s, s_text=%s WHERE pro_id=%s",
                       GetSQLValueString($_POST['s_product'], "text"),
                       GetSQLValueString($_POST['s_ps'], "text"),
                       GetSQLValueString($_POST['s_money_old'], "text"),
                       GetSQLValueString($_POST['s_money'], "text"),
                       GetSQLValueString(nl2br($_POST['s_text']), "text"),
                       GetSQLValueString($_POST['id'], "int"));
}else{
  $updateSQL = sprintf("UPDATE s_product SET s_product=%s, s_file =%s,s_ps=%s, s_money_old=%s, s_money=%s, s_text=%s WHERE pro_id=%s",
                      
					   GetSQLValueString($_POST['s_product'], "text"),
					    GetSQLValueString($_FILES['myfile2']['name'], "text"),
                       GetSQLValueString($_POST['s_ps'], "text"),
                       GetSQLValueString($_POST['s_money_old'], "text"),
                       GetSQLValueString($_POST['s_money'], "text"),
                       GetSQLValueString(nl2br($_POST['s_text']), "text"),
                       GetSQLValueString($_POST['id'], "int"));

}



  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($updateSQL, $easyshop) or die(mysql_error());

  $updateGoTo = "s_upstore_del.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs = "-1";
if (isset($_GET['id'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = sprintf("SELECT * FROM s_product WHERE pro_id = %s", $colname_rs);
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);

mysql_select_db($database_easyshop, $easyshop);
$query_rsps = "SELECT * FROM s_product_ps ORDER BY s_product_ps_id ASC";
$rsps = mysql_query($query_rsps, $easyshop) or die(mysql_error());
$row_rsps = mysql_fetch_assoc($rsps);
$totalRows_rsps = mysql_num_rows($rsps);
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
<!--
body {
	background-image: url(../user/image/thumb_1185021456.jpg);
}
.style3 {font-size: small; font-family: "標楷體"; }
.style4 {
	font-family: "標楷體";
	font-weight: bold;
}
-->
</style></head>

<body>
<div align="center" class="style4"></div>
<br />
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
  <table width="1030" border="1" align="center">
    <tr bgcolor="#F8F8FE">
      <td colspan="3"><div align="center"><span class="style4">修改手機商品 </span></div></td>
    </tr>
    <tr>
      <td width="245" rowspan="3" bgcolor="#FFFFFF"><a href="photo.php?p=<?php echo $row_rs['s_file']; ?>" target="_blank">
        <input name="myfile2" type="file" id="myfile2">
      <img src="store_photo/<?php echo $row_rs['s_file']; ?>" width="318" height="230" border="0" /></a></td>
      <td width="109" bgcolor="#FFFFFF"><span class="style3">手機名稱</span></td>
      <td width="467" bgcolor="#FFFFFF"><span class="style3">
        <input name="s_product" type="text" id="s_product" value="<?php echo $row_rs['s_product']; ?>" />
        <input name="id" type="hidden" id="id" value="<?php echo $row_rs['pro_id']; ?>" />
      </span></td>
    </tr>
    
    <tr>
      <td bgcolor="#FFFFFF"><span class="style3">特價</span></td>
      <td bgcolor="#FFFFFF"><input name="s_money" type="text" id="s_money" value="<?php echo $row_rs['s_money']; ?>" /></td>
    </tr>
    
    <tr>
      <td bgcolor="#FFFFFF"><span class="style3">解說</span></td>
      <td bgcolor="#FFFFFF"><span class="style3">
        <textarea name="s_text" cols="60" rows="5" wrap="virtual" id="s_text"><?php 
		
		//echo $row_rs['s_text'];
		echo  str_replace("<br />"," ",$row_rs['s_text'])
		 ?></textarea>
      </span></td>
    </tr>
    <tr bgcolor="#F8F8FE">
      <td colspan="3"><div align="center">
        <input type="submit" name="Submit" value="送出" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
</form>
<p align="center"><a href="Javascript:OnClick=history.back()">回上頁</a></p>
<p align="center">&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs);

mysql_free_result($rsps);
?>