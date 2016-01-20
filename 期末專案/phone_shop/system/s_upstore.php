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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
//---------------------------------------

$uploaddir = '';
$uploadfile = $uploaddir.basename($_FILES['myfile']['name']);
(move_uploaded_file($_FILES['myfile']['tmp_name'], "store_photo/".$uploadfile));
//---------------------------------------

  $insertSQL = sprintf("INSERT INTO s_product (s_file,s_product, s_ps, s_money_old, s_money, s_text) VALUES (%s, %s, %s, %s, %s, %s)",
  GetSQLValueString($_FILES['myfile']['name'], "text"),
                       GetSQLValueString($_POST['s_product'], "text"),
                       GetSQLValueString($_POST['s_ps'], "text"),
                       GetSQLValueString($_POST['s_money_old'], "text"),
                       GetSQLValueString($_POST['s_money'], "text"),
                       GetSQLValueString(nl2br($_POST['s_text']), "text"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($insertSQL, $easyshop) or die(mysql_error());

  $insertGoTo = "s_upstore3.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO s_product_ps (s_product_ps) VALUES (%s)",
                       GetSQLValueString($_POST['ps'], "text"));

  mysql_select_db($database_easyshop, $easyshop);

  $Result1 = mysql_query($insertSQL, $easyshop) or die(mysql_error());

  $insertGoTo = "s_upstore.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_easyshop, $easyshop);
$query_rsps = "SELECT * FROM s_product_ps ORDER BY s_product_ps ASC";

$rsps = mysql_query($query_rsps, $easyshop) or die(mysql_error());



$row_rsps = mysql_fetch_assoc($rsps);
$totalRows_rsps = mysql_num_rows($rsps);
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品上架</title>
<style type="text/css">
<!--
body {
	background-image: url(../user/image/thumb_1185020785.jpg);
}
.style3 {font-size: small; font-family: "標楷體"; }
-->
</style></head>

<body>
<div align="center">[手機商品上架 ]
</div>
<?php require_once('system_top.php'); ?>
<br>
<hr>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form2" onSubmit="return aaa();">
  <table width="826" border="1" align="center">
    <tr>
      <td width="137"><span class="style3">手機名稱</span></td>
      <td width="412"><input name="s_product" type="text" id="s_product"></td>
    </tr>
    <tr>
      <td><span class="style3">特價</span></td>
      <td><input name="s_money" type="text" id="s_money" onKeyPress="if   (event.keyCode   <   46||event.keyCode   >   57)   event.returnValue   =   false;"></td>
    </tr>
    <tr>
      <td><span class="style3">手機說明</span></td>
      <td><span class="style3">
        <textarea name="s_text" cols="60" rows="5" wrap="VIRTUAL" id="s_text"></textarea>
      </span></td>
    </tr>
    <tr>
      <td><span class="style3">插入圖檔</span></td>
      <td><input name="myfile" type="file" id="myfile"></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center" class="style3">
        <input type="submit" name="Submit" value="送出">
      </div></td>
    </tr>
  </table>
  <div align="center"></div>
  <input type="hidden" name="MM_insert" value="form2">
</form>
</body>
</html>
<?php
mysql_free_result($rsps);
?>

<script language="javascript">
function aaa(){
if(document.form2.s_product.value==""){
alert ("商品名稱要填唷!")
return false
}else if (document.form2.s_money.value==""){
alert ("商品特價要填唷!")
return false
}else if (document.form2.s_text.value==""){
alert ("內容要填唷!")
return false
}
}
</script>