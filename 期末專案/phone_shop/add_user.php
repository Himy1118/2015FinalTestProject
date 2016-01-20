<?php require_once('Connections/easyshop.php'); ?>
<? //include "u_include.php" ?>
<?php
session_start();
// *** Redirect if username exists
if($_SESSION['MM_Username']<>"admin"){
exit;
};
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="add_user2.php?id=2";
  $loginUsername = $_POST['a1'];
  $LoginRS__query = "SELECT a_account FROM a_account2 WHERE a_account='" . $loginUsername . "'";
  mysql_select_db($database_easyshop, $easyshop);
  $LoginRS=mysql_query($LoginRS__query, $easyshop) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

//$_SESSION['MM_Username']=$_POST['a1'];
  $insertSQL = sprintf("INSERT INTO a_account2 (of_time,of_about,a_account, a_pass, a_name, a_address, a_phone, of_name, of_fax, of_num, of_title, of_text, of_item, of_prodtext, of_ps1, of_ps2, of_ps3) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['of_time'], "text"),
                       GetSQLValueString(nl2br($_POST['of_about']), "text"),
					   GetSQLValueString($_POST['a1'], "text"),
                       GetSQLValueString($_POST['a2'], "text"),
                       GetSQLValueString($_POST['a3'], "text"),
                       GetSQLValueString($_POST['a4'], "text"),
                       GetSQLValueString($_POST['a5'], "text"),
                       GetSQLValueString($_POST['of_name'], "text"),
                       GetSQLValueString($_POST['of_fax'], "text"),
                       GetSQLValueString($_POST['of_num'], "int"),
                       GetSQLValueString(nl2br($_POST['of_title']), "text"),
                       GetSQLValueString(nl2br($_POST['of_text']), "text"),
                       GetSQLValueString(nl2br($_POST['of_item']), "text"),
                       GetSQLValueString(nl2br($_POST['of_prodtext']), "text"),
                       GetSQLValueString(nl2br($_POST['of_ps1']), "text"),
                       GetSQLValueString(nl2br($_POST['of_ps2']), "text"),
                       GetSQLValueString(nl2br($_POST['of_ps3']), "text"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($insertSQL, $easyshop) or die(mysql_error());

  $insertGoTo = "add_user2.php?id=1&nn=".$_POST['a1'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sazoon</title>
<script type="text/JavaScript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
<style type="text/css">
<!--
.style2 {color: #000000; font-weight: bold; }
.style3 {
	font-size: xx-large;
	font-weight: bold;
	color: #006600;
}
.style4 {font-size: small}
.style8 {font-size: small; color: #000000;}
-->
</style>
</head>

<body>
<div align="center">
  <p class="style3">加入會員</p>
  <p>&nbsp;</p>
</div>
<hr>
<br>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" onSubmit="return aaa( );">
  <table width="780" border="1" align="center">
    <tr>
      <td width="115"><div align="left" class="style8">
        <div align="left">帳號</div>
      </div></td>
      <td width="614" bgcolor="#FFFFFF"><div align="left" class="style2">
        <input name="a1" type="text" id="a1">
      </div>        <div align="left" class="style2"></div>      <div align="left" class="style2"></div></td>
    </tr>
    <tr>
      <td><div align="left" class="style8">
        <div align="left">密碼</div>
      </div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style2">
        <input name="a2" type="text" id="a2">
      </div>        <div align="left" class="style2"></div>      <div align="left" class="style2"></div></td>
    </tr>
    <tr>
      <td><div align="left" class="style8">
        <div align="left">公司名稱</div>
      </div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style2">
        <input name="of_name" type="text" id="of_name">
      </div>        <div align="left" class="style2"></div>        <div align="left" class="style2"></div></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style8">公司住址</span></div></td>
      <td><span class="style2">
        <input name="a4" type="text" id="a4" size="50">
      </span></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style8">公司電話</span></div></td>
      <td><span class="style2">
        <input name="a5" type="text" id="a5" >
      </span></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style4">公司傳真</span></div></td>
      <td><span class="style2">
        <input name="of_fax" type="text" id="of_fax">
      </span></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style4">公司統編</span></div></td>
      <td><span class="style2">
        <input name="of_num" type="text" id="of_num">
      </span></td>
    </tr>
	<tr>
      <td><div align="left"><span class="style4">營業時間</span></div></td>
      <td><span class="style2">
        <input name="of_time" type="text" id="of_time">
      ex:0800~1900</span></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style8">連絡人姓名</span></div></td>
      <td><span class="style2">
        <input name="a3" type="text" id="a3">
      </span></td>
    <tr>
      <td><div align="left"><span class="style4">公司簡介</span></div></td>
      <td><span class="style2">
        <textarea name="of_about" cols="80" rows="6" wrap="virtual" id="of_about"></textarea>
      </span></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style4">公司主旨</span></div></td>
      <td><span class="style2">
        <textarea name="of_title" cols="80" rows="6" wrap="virtual" id="of_title"></textarea>
      </span></td>
    </tr>
   
   	  <tr>
      <td><div align="left"><span class="style4">營運方針</span></div></td>
      <td><span class="style2">
        <textarea name="of_text" cols="80" rows="6" wrap="virtual" id="of_text"></textarea>
      </span></td>
    </tr>
		  <tr>
      <td><div align="left"><span class="style4">營業項目</span></div></td>
      <td><span class="style2">
        <textarea name="of_item" cols="80" rows="6" wrap="virtual" id="of_item"></textarea>
      </span></td>
    </tr>
		  <tr>
      <td><div align="left"><span class="style4">主要產品說明</span></div></td>
      <td><span class="style2">
        <textarea name="of_prodtext" cols="80" rows="6" wrap="virtual" id="of_prodtext"></textarea>
      </span></td>
    </tr>
		  <tr>
      <td><div align="left"><span class="style4">備註一</span></div></td>
      <td><span class="style2">
        <textarea name="of_ps1" cols="80" rows="6" wrap="virtual" id="of_ps1"></textarea>
      </span></td>
    </tr>
		  <tr>
      <td><div align="left"><span class="style4">備註二</span></div></td>
      <td><span class="style2">
        <textarea name="of_ps2" cols="80" rows="6" wrap="virtual" id="of_ps2"></textarea>
      </span></td>
    </tr>
		  <tr>
      <td><div align="left"><span class="style4">備註三</span></div></td>
      <td><span class="style2">
        <textarea name="of_ps3" cols="80" rows="6" wrap="virtual" id="of_ps3"></textarea>
      </span></td>
    </tr>
    <tr>
      <td colspan="2">
        
        <div align="center">
          <input type="submit" name="Submit" value="加入會員">
        </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<div align="center"></div>
<hr>
<p align="center"><a href="index.php"></a></p>
</body>
</html>
<script language="javascript">
function aaa(){
if(document.form1.a1.value==""){
alert ("帳號要填唷!")
return false
}else if (document.form1.a2.value==""){
alert ("密碼要填唷!")
return false
}
}
</script>