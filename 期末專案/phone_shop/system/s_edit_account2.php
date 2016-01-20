<?php require_once('../Connections/easyshop.php'); ?>
<?php
session_start();
// *** Redirect if username exists
if($_SESSION['MM_Username']<>"admin"){
exit;
};
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
  $updateSQL = sprintf("UPDATE a_account2 SET of_time=%s, of_about=%s,a_pass=%s, a_name=%s, a_address=%s, a_phone=%s, of_name=%s, of_fax=%s, of_num=%s, of_title=%s, of_text=%s, of_item=%s, of_prodtext=%s, of_ps1=%s, of_ps2=%s, of_ps3=%s WHERE a_id=%s",
    GetSQLValueString($_POST['of_time'], "text"),
                       GetSQLValueString(nl2br($_POST['of_about']), "text"),
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
                       GetSQLValueString(nl2br($_POST['of_ps3']), "text"),
					   
					   
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($updateSQL, $easyshop) or die(mysql_error());

  $updateGoTo = "s_edit_account2.php";
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
$query_rs = sprintf("SELECT * FROM a_account2 WHERE a_id = %s", $colname_rs);
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
.style2 {color: #000000; }
.style4 {color: #000000; font-weight: bold; }
.style8 {font-size: small; color: #000000;}
.style9 {font-size: small}
-->
</style>
</head>

<body>
<div align="center">修改會員資料<br>
  <hr>
  <form name="form1" method="POST" action="<?php echo $editFormAction; ?>" onSubmit="return aaa( );">
    <input name="id" type="hidden" id="id" value="<?php echo $row_rs['a_id']; ?>">
    <input type="hidden" name="MM_update" value="form1">
    <table width="780" border="1" align="center">
      <tr>
        <td width="115"><div align="left" class="style8">
            <div align="left">帳號
              <input name="id2" type="hidden" id="id2" value="<?php echo $row_rs['a_id']; ?>" />
            </div>
        </div></td>
        <td width="614" bgcolor="#FFFFFF"><div align="left" class="style4">
          <div align="left"><?php echo $row_rs['a_account']; ?></div>
        </div>
            <div align="left" class="style4"></div>
          <div align="left" class="style4"></div></td>
      </tr>
      <tr>
        <td><div align="left" class="style8">
            <div align="left">密碼</div>
        </div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style4">
            <div align="left">
              <input name="a2" type="text" id="a2" value="<?php echo $row_rs['a_pass']; ?>" />
              </div>
        </div>
            <div align="left" class="style4"></div>
          <div align="left" class="style4"></div></td>
      </tr>
      <tr>
        <td><div align="left" class="style8">
            <div align="left">公司名稱</div>
        </div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style4">
            <div align="left">
              <input name="of_name" type="text" id="of_name" value="<?php echo $row_rs['of_name']; ?>" />
              </div>
        </div>
            <div align="left" class="style4"></div>
          <div align="left" class="style4"></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style8">公司住址</span></div></td>
        <td><div align="left"><span class="style4">
          <input name="a4" type="text" id="a4" value="<?php echo $row_rs['a_address']; ?>" size="50" />
        </span></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style8">公司電話</span></div></td>
        <td><div align="left"><span class="style4">
          <input name="a5" type="text" id="a5" value="<?php echo $row_rs['a_phone']; ?>">
        </span></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style9">公司傳真</span></div></td>
        <td><div align="left"><span class="style4">
          <input name="of_fax" type="text" id="of_fax" value="<?php echo $row_rs['of_fax']; ?>" />
        </span></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style9">公司統編</span></div></td>
        <td><div align="left"><span class="style4">
          <input name="of_num" type="text" id="of_num" value="<?php echo $row_rs['of_num']; ?>" />
        </span></div></td>
      </tr>
	  
	  <tr>
        <td><div align="left"><span class="style9">營業</span>時間</div></td>
        <td><div align="left"><span class="style4">
          <input name="of_time" type="text" id="of_time" value="<?php echo $row_rs['of_time']; ?>" />
        </span></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style8">連絡人姓名</span></div></td>
        <td><div align="left"><span class="style4">
          <input name="a3" type="text" id="a3" value="<?php echo $row_rs['a_name']; ?>" />
        </span></div></td>
      </tr>
	  
	  <tr>
        <td><div align="left"><span class="style9">公司簡介</span></div></td>
        <td><div align="left"><span class="style4">
          <textarea name="of_about" cols="80" rows="6" wrap="virtual" id="of_about"><?php
		  
		    echo  str_replace("<br />"," ",$row_rs['of_about']);
		    ?></textarea>
        </span></div></td>
      </tr>
	  
      <tr>
        <td><div align="left"><span class="style9">公司主旨</span></div></td>
        <td><div align="left"><span class="style4">
          <textarea name="of_title" cols="80" rows="6" wrap="virtual" id="of_title"><?php
		  
		    echo  str_replace("<br />"," ",$row_rs['of_title']);
		    ?></textarea>
        </span></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style9">營運方針</span></div></td>
        <td><div align="left"><span class="style4">
          <textarea name="of_text" cols="80" rows="6" wrap="virtual" id="of_text"><?php
		   
		   echo  str_replace("<br />"," ",$row_rs['of_text']);
		   ?></textarea>
        </span></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style9">營業項目</span></div></td>
        <td><div align="left"><span class="style4">
          <textarea name="of_item" cols="80" rows="6" wrap="virtual" id="of_item"><?php 
		
		    echo  str_replace("<br />"," ",$row_rs['of_item']);
		   ?></textarea>
        </span></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style9">主要產品說明</span></div></td>
        <td><div align="left"><span class="style4">
          <textarea name="of_prodtext" cols="80" rows="6" wrap="virtual" id="of_prodtext"><?php
		   echo  str_replace("<br />"," ",$row_rs['of_prodtext']);
		    ?></textarea>
        </span></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style9">備註一</span></div></td>
        <td><div align="left"><span class="style4">
          <textarea name="of_ps1" cols="80" rows="6" wrap="virtual" id="of_ps1"><?php 
		  
		   echo  str_replace("<br />"," ",$row_rs['of_ps1']);
		  
		  ?></textarea>
        </span></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style9">備註二</span></div></td>
        <td><div align="left"><span class="style4">
          <textarea name="of_ps2" cols="80" rows="6" wrap="virtual" id="of_ps2"><?php 
		   echo  str_replace("<br />"," ",$row_rs['of_ps2']);
		  ?></textarea>
        </span></div></td>
      </tr>
      <tr>
        <td><div align="left"><span class="style9">備註三</span></div></td>
        <td><div align="left"><span class="style4">
          <textarea name="of_ps3" cols="80" rows="6" wrap="virtual" id="of_ps3"><?php 
		   echo  str_replace("<br />"," ",$row_rs['of_ps3']);
		  ?></textarea>
        </span></div></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
            <input type="submit" name="Submit2" value="修改" />
        </div></td>
      </tr>
    </table>
  </form>
  <br>
<a href="Javascript:OnClick=history.back()">回上頁</a></div>
</body>
</html>
<?php
mysql_free_result($rs);
?>

<script language="javascript">
function aaa(){
alert("修改完畢");
}
</script>
