<?php require_once('Connections/easyshop.php'); ?>
<?php
//initialize the session
session_start();

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
$maxRows_rs1 = 15;
$pageNum_rs1 = 0;
if (isset($_GET['pageNum_rs1'])) {
  $pageNum_rs1 = $_GET['pageNum_rs1'];
}
$startRow_rs1 = $pageNum_rs1 * $maxRows_rs1;

mysql_select_db($database_easyshop, $easyshop);

if ($_GET[so]<>""){
$query_rs1 = "SELECT * FROM s_product where s_product like '%". $_GET[so] ."%' or s_text like '%". $_GET[so] ."%'";  
}else{

if ($_GET[i_sort]==""){
$query_rs1 = "SELECT * FROM s_product ORDER BY RAND()";  //原首頁版
} else{
$query_rs1 = "SELECT * FROM s_product where s_ps='". $_GET[i_sort] ."'";  
};

};



$query_limit_rs1 = sprintf("%s LIMIT %d, %d", $query_rs1, $startRow_rs1, $maxRows_rs1);
$rs1 = mysql_query($query_limit_rs1, $easyshop) or die(mysql_error());
$row_rs1 = mysql_fetch_assoc($rs1);

if (isset($_GET['totalRows_rs1'])) {
  $totalRows_rs1 = $_GET['totalRows_rs1'];
} else {
  $all_rs1 = mysql_query($query_rs1);
  $totalRows_rs1 = mysql_num_rows($all_rs1);
}
$totalPages_rs1 = ceil($totalRows_rs1/$maxRows_rs1)-1;

mysql_select_db($database_easyshop, $easyshop);
$query_rsps = "SELECT * FROM s_product_ps ORDER BY RAND()";
$rsps = mysql_query($query_rsps, $easyshop) or die(mysql_error());
$row_rsps = mysql_fetch_assoc($rsps);
$totalRows_rsps = mysql_num_rows($rsps);

$queryString_rs1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs1") == false && 
        stristr($param, "totalRows_rs1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs1 = sprintf("&totalRows_rs1=%d%s", $totalRows_rs1, $queryString_rs1);

$currentPage = $_SERVER["PHP_SELF"];

$queryString_rs = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs") == false && 
        stristr($param, "totalRows_rs") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs = sprintf("&totalRows_rs=%d%s", $totalRows_rs, $queryString_rs);
?>
<?php
// *** Validate request to login to this site.
session_start();

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($accesscheck)) {
  $GLOBALS['PrevUrl'] = $accesscheck;
  session_register('PrevUrl');
}

if (isset($_POST['a'])) {
  $loginUsername=$_POST['a'];
  $password=$_POST['b'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_easyshop, $easyshop);
  
  $LoginRS__query=sprintf("SELECT a_account, a_pass FROM a_account WHERE a_account='%s' AND a_pass='%s'",
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>手機販賣平台</title>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-size: xx-large;
	font-weight: bold;
}
.style2 {
	font-size: small;
	font-weight: bold;
}
body {
	background-color: #000000;
	background-image: url(images/fdsfdsg.jpg);
}
.style4 {color: #FFFFFF}
.style5 {font-size: small}
.style18 {color: #FFFFFF; font-weight: bold; }
.style19 {color: #99CC33}
.style30 {font-size: small; color: #FFFFFF; }
.style31 {color: #333333}
.style32 {font-size: small; color: #333333; }
.style39 {
	color: #000000;
	font-weight: bold;
	font-family: "標楷體";
	font-size: x-large;
}
.style40 {color: #000000}
.style47 {font-size: 14px; color: #000000; }
.style48 {font-size: 14px}
-->
</style>
</head>

<body>
 
<div align="center">
  <table width="100%" border="0" bordercolor="#2E0E01">
    <tr>
      <td bgcolor="#FFFFFF"><div align="center" class="style39">手機販賣平台</div></td>
    </tr>
  </table>
  <table width="760" height="292" border="1">
    <tr>
      <td width="288" height="85" rowspan="2" bgcolor="#FFFFFF"><div align="center" class="style39"><img src="mmm/wu.jpg" width="246" height="188"></div>      </td>
      <td width="370" bgcolor="#FFFFFF"><form action="<?php echo $loginFormAction; ?>" method="POST" name="form3" target="_top" class="style4">
        <span class="style32">
      <? if ($_SESSION['MM_Username'] ==""){  ?>
      會員登入 帳號</span>
        <span class="style31">
        <input name="a" type="text" id="a" size="10">
        <span class="style5">密碼</span></span>
        <span class="style31">
      <input name="b" type="password" id="b" size="10">
      <input type="submit" name="Submit2" value="登入"></br>
      <?php }else{
	  echo "登入成功";
	  }?>
      <span class="style5"> <a href="user/add_user.php"><br>
      </a></span></span>
      </form>        <form action="right.php" enctype="application/x-www-form-urlencoded" name="form1" class="style5">
          <div align="center"></div>
        </form></td>
      <td width="102" background="user/image/bg158_gif.gif" bgcolor="#9393FF"><div align="center" class="style30"><a href="<?php echo $logoutAction ?>" target="_top">登出</a></div>        <div align="center" class="style18"></div></td>
    </tr>
    
    <tr>
      <td height="21" colspan="2" bgcolor="#FFFFFF"><div align="center" class="style2"><span class="style39"><a href="user/talk.php">商品留言版</a></span></div></td>
    </tr>
    <?php do { ?>
        <tr bgcolor="#FFFFFF">
          <td rowspan="4" bgcolor="#FFFFFF"><div align="center" class="style47"><img src="system/store_photo/<?php echo $row_rs1['s_file']; ?>" width="176" height="157"></div></td>
          <td colspan="2" bgcolor="#FFFFFF"><div align="left" class="style47"><br>
          </div>            <div align="left" class="style47">產品名稱:<?php echo $row_rs1['s_product']; ?></div></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
          <td colspan="2" bgcolor="#FFFFFF"><div align="left" class="style47">特價: <?php echo $row_rs1['s_money']; ?></div></td>
        </tr>
        
      <tr bgcolor="#FFFFFF">
      <td height="17" colspan="2" bgcolor="#FFFFFF"><div align="left" class="style32 style40 style48">
        <div align="left">產品資訊:<br>
          <?php echo $row_rs1['s_text']; ?></div>
      </div></td>
      </tr>
    <tr bgcolor="#FFFFFF">
      <td height="18" colspan="2" valign="top" bgcolor="#FFFFFF"><div align="left" class="style32 style40 style48">
        <div align="left"><a href="shop/buy_shop.php?id=<?php echo $row_rs1['pro_id']; ?>">
			<?php if($_SESSION['MM_Username']<>""){?>
		我要購買
	

<?php }?>
		</a></div>
      </div></td>
      </tr>
    <?php } while ($row_rs1 = mysql_fetch_assoc($rs1)); ?>
<tr bgcolor="#FFFFFF">
      <td height="17" colspan="3">        <div align="center">記錄<?php echo ($startRow_rs1 + 1) ?> 到 <?php echo min($startRow_rs1 + $maxRows_rs1, $totalRows_rs1) ?> 共 <?php echo $totalRows_rs1 ?> 筆<br>
            <table border="0" width="50%" align="center">
              <tr>
                <td width="23%" align="center">
                  <?php if ($pageNum_rs1 > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, 0, $queryString_rs1); ?>">第一頁</a>
                  <?php } // Show if not first page ?>                </td>
                <td width="31%" align="center">
                  <?php if ($pageNum_rs1 > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, max(0, $pageNum_rs1 - 1), $queryString_rs1); ?>">上一頁</a>
                  <?php } // Show if not first page ?>                </td>
                <td width="23%" align="center">
                  <?php if ($pageNum_rs1 < $totalPages_rs1) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, min($totalPages_rs1, $pageNum_rs1 + 1), $queryString_rs1); ?>">下一頁</a>
                  <?php } // Show if not last page ?>                </td>
                <td width="23%" align="center">
                  <?php if ($pageNum_rs1 < $totalPages_rs1) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_rs1=%d%s", $currentPage, $totalPages_rs1, $queryString_rs1); ?>">最後一頁</a>
                  <?php } // Show if not last page ?>                </td>
              </tr>
            </table>
          <br>
        </div>
        <div align="center" class="style19">        </div></td>
    </tr>
  </table>
</div>
<div align="center"><br>
<a href="system/sys_login.php" target="_blank">系統管理</a></div>
<p align="center"><span class="style4"></span></p>
<div align="center"><br>
</div>
</body>
</html>
 