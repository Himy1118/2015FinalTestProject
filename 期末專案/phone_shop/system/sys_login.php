<?php require_once('../Connections/easyshop.php'); ?>
<?php
// *** Validate request to login to this site.
session_start();

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($accesscheck)) {
  $GLOBALS['PrevUrl'] = $accesscheck;
  session_register('PrevUrl');
}

if (isset($_POST['account'])) {
  $loginUsername=$_POST['account'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "system.php";
  $MM_redirectLoginFailed = "sys_login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_easyshop, $easyshop);
  
  $LoginRS__query=sprintf("SELECT sys_account, sys_pass FROM system_account WHERE sys_account='%s' AND sys_pass='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $easyshop) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $GLOBALS['MM_Username'] = $loginUsername;
    $GLOBALS['MM_UserGroup'] = $loginStrGroup;	      

    //register the session variables
    session_register("MM_Username");
    session_register("MM_UserGroup");

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>系統管理登入</title>
<style type="text/css">
<!--
body {
	background-image: url(../images/1111.jpg);
}
.style1 {color: #FF6D06}
.style2 {color: #000000}
-->
</style></head>

<body>
<div align="center"></div>
<div align="center">系統管理登入
</div>
<hr>
<form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  <div align="center">
    <table width="251" border="1">
      <tr>
        <td bgcolor="#FFFFFF"><div align="left" class="style2">帳號</div></td>
        <td bgcolor="#FFE8A8"><div align="left" class="style1">
          <input name="account" type="text" id="account">
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><div align="left" class="style2">密碼</div></td>
        <td bgcolor="#FFE8A8"><div align="left" class="style1">
          <input name="pass" type="password" id="pass">
        </div></td>
      </tr>
    </table>  
    <input type="submit" name="Submit" value="送出">
  </div>
</form>
<div align="center"><a href="../index.php">回首頁</a><br>
</div>
<p>&nbsp;</p>
</body>
</html>
