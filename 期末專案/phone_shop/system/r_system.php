<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<? include "s_include.php" ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>無標題文件</title>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
	background-image: url();
}
-->
</style></head>

<body>

<p>&nbsp;</p>
<table width="98%" height="206" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#F0F0F0"><a href="s_system.php" target="mainFrame">查詢手機銷售</a></td>
  </tr>
  <tr>
    <td bgcolor="#F0F0F0"><a href="s_upstore.php" target="mainFrame">手機商品上架</a></td>
  </tr>
  <tr>
    <td bgcolor="#F0F0F0"><a href="s_upstore_del.php" target="mainFrame">手機商品管理</a></td>
  </tr>
  <tr>
    <td bgcolor="#F0F0F0"><a href="s_talk" target="mainFrame">留言版管理</a></td>
  </tr>
  <tr>
    <td bgcolor="#F0F0F0"><a href="<?php echo $logoutAction ?>" target="_top">登出</a></td>
  </tr>
</table>
</body>
</html>
