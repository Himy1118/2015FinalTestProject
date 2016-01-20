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
  $updateSQL = sprintf("UPDATE a_account SET a_pass=%s, a_name=%s, a_address=%s, a_phone=%s, a_sogi=%s, atm=%s WHERE a_id=%s",
                       GetSQLValueString($_POST['a2'], "text"),
                       GetSQLValueString($_POST['a3'], "text"),
                       GetSQLValueString($_POST['a4'], "text"),
                       GetSQLValueString($_POST['a5'], "text"),
                       GetSQLValueString($_POST['a6'], "text"),
                       GetSQLValueString($_POST['atm'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($updateSQL, $easyshop) or die(mysql_error());

  $updateGoTo = "s_account.php";
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
$query_rs = sprintf("SELECT * FROM a_account WHERE a_id = %s", $colname_rs);
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title>修改會員資料</title>
<style type="text/css">
<!--
body {
	background-image: url(../user/image/thumb_1184398664.gif);
}
.style3 {color: #FF0000}
.style7 {font-size: small; font-family: "標楷體"; }
.style8 {color: #FFFFFF; font-size: small; font-family: "標楷體"; }
-->
</style>
</head>

<body>
<div align="center"><span class="style3">修改會員資料</span><br>
  <hr>
  <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
    <input name="id" type="hidden" id="id" value="<?php echo $row_rs['a_id']; ?>">
    <table width="450" border="1" align="center">
      <tr>
        <td width="80" bgcolor="#003366"><div align="center" class="style8">帳號</div></td>
        <td width="224"><div align="left" class="style7"><?php echo $row_rs['a_account']; ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#003366"><div align="center" class="style8">密碼</div></td>
        <td><div align="left" class="style7">
          <input name="a2" type="text" id="a2" value="<?php echo $row_rs['a_pass']; ?>">
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#003366"><div align="center" class="style8">姓名</div></td>
        <td><div align="left" class="style7">
          <input name="a3" type="text" id="a3" value="<?php echo $row_rs['a_name']; ?>">
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#003366"><div align="center" class="style8">住址</div></td>
        <td><div align="left" class="style7">
          <input name="a4" type="text" id="a4" value="<?php echo $row_rs['a_address']; ?>" size="45">
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#003366"><div align="center" class="style8">電話</div></td>
        <td><div align="left" class="style7">
          <input name="a5" type="text" id="a5" value="<?php echo $row_rs['a_phone']; ?>">
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#003366"><div align="center" class="style8">E-MAIL</div></td>
        <td><div align="left" class="style7">
          <input name="a6" type="text" id="a6" value="<?php echo $row_rs['a_sogi']; ?>">
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#003366"><span class="style8">ATM後6碼</span></td>
        <td><div align="left" class="style7">
          <input name="atm" type="text" id="atm" value="<?php echo $row_rs['atm']; ?>">
        </div></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
            <input type="submit" name="Submit" value="修改">
        </div></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1">
  </form>
  <br>
<a href="Javascript:OnClick=history.back()">回上頁</a></div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
