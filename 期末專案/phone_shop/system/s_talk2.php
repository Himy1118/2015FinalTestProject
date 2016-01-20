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
  $updateSQL = sprintf("UPDATE t_talk SET t_re=%s WHERE t_id=%s",
                       GetSQLValueString($_POST['t_re'], "text"),
                       GetSQLValueString($_POST['t_id'], "int"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($updateSQL, $easyshop) or die(mysql_error());

  $updateGoTo = "s_talk.php";
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
$query_rs = sprintf("SELECT * FROM t_talk WHERE t_id = %s", $colname_rs);
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);

$colname_rs2 = "-1";
if (isset($_GET['id'])) {
  $colname_rs2 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs2 = sprintf("SELECT * FROM re_talk WHERE t_id = '%s'", $colname_rs2);
$rs2 = mysql_query($query_rs2, $easyshop) or die(mysql_error());
$row_rs2 = mysql_fetch_assoc($rs2);
$totalRows_rs2 = mysql_num_rows($rs2);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理留言 </title>
<style type="text/css">
<!--
.style9 {font-size: small}
body {
	background-image: url(../user/image/thumb_1185022867.gif);
}
.style17 {color: #000000}
.style18 {font-size: small; color: #000000; }
-->
</style>
</head>

<body>
<div align="center" class="style17">管理留言</div>
<hr>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <input name="t_id" type="hidden" id="t_id" value="<?php echo $row_rs['t_id']; ?>">
  <table width="608" border="0" align="center">
    <tr>
      <td bgcolor="#0066FF"><div align="left" class="style17"><span class="style9"><strong>日期</strong></span></div></td>
      <td bgcolor="#FFFFFF"><div align="left"><span class="style9"><?php echo $row_rs['t_date']; ?></span></div></td>
    </tr>
    <tr>
      <td width="134" bgcolor="#0066FF"><div align="left" class="style18">
        <div align="left"><strong>姓名</strong></div>
      </div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style9">
        <div align="left"><?php echo $row_rs['t_name']; ?></div>
      </div>        <div align="left" class="style9"></div>        <div align="left" class="style9"></div></td>
    </tr>
    <tr>
      <td bgcolor="#0066FF"><div align="left" class="style18">
        <div align="left"><strong>內容</strong></div>
      </div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style9">
        <div align="left"><?php echo $row_rs['t_text']; ?></div>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#0066FF"><div align="left" class="style18"><strong>管理者回應</strong></div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style9">
        <input name="t_re" type="text" id="t_re" value="<?php echo $row_rs['t_re']; ?>" size="55">
      </div></td>
    </tr>
    <tr bgcolor="#FFFFCC">
      <td colspan="2" bgcolor="#FFFFFF"><div align="center">
        <input type="submit" name="Submit" value="回應留言">
      </div></td>
    </tr>
  </table>
  <div align="center"></div>
  <input type="hidden" name="MM_update" value="form1">
</form>
<div align="center"></div>
<p align="center">&nbsp;</p>
<p align="center"><a href="Javascript:OnClick=history.back()">回上頁</a></p>
</body>
</html>
<?php
mysql_free_result($rs);

mysql_free_result($rs2);
?>
