<?php require_once('../Connections/easyshop.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

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
  $insertSQL = sprintf("INSERT INTO t_talk (t_name, t_text, t_date) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['t_name'], "text"),
                       GetSQLValueString(nl2br($_POST['t_text']), "text"),
                       GetSQLValueString($_POST['t_date'], "text"));

  mysql_select_db($database_easyshop, $easyshop);
  $Result1 = mysql_query($insertSQL, $easyshop) or die(mysql_error());
}

$maxRows_rs = 25;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysql_select_db($database_easyshop, $easyshop);
$query_rs = "SELECT * FROM t_talk ORDER BY t_id DESC";
$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysql_query($query_limit_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);

if (isset($_GET['totalRows_rs'])) {
  $totalRows_rs = $_GET['totalRows_rs'];
} else {
  $all_rs = mysql_query($query_rs);
  $totalRows_rs = mysql_num_rows($all_rs);
}
$totalPages_rs = ceil($totalRows_rs/$maxRows_rs)-1;

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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言版</title>
<style type="text/css">
<!--
body {
	background-image: url();
}
.style1 {
	color: #0066CC;
	font-size: medium;
	font-weight: bold;
	font-family: "標楷體";
}
.style2 {
	color: #666666;
	font-weight: bold;
	font-size: small;
	font-family: "標楷體";
}
.style9 {font-size: small}
.style23 {font-size: small; color: #006699; font-family: "標楷體"; }
.style24 {
	color: #000000;
	font-weight: bold;
}
.style29 {color: #000000; font-size: small; font-family: "標楷體"; font-weight: bold; }
.style36 {color: #FFFFFF}
.style38 {color: #000000}
.style39 {font-family: "標楷體"; font-weight: bold; font-size: small;}
.style40 {font-size: small; color: #000000; font-family: "標楷體"; }
-->
</style></head>

<body>
<div align="center" class="style1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td bgcolor="#333333"><div align="center" class="style36">[留言版]</div></td>
    </tr>
  </table>
</div>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <div align="center"></div>
  <div align="center"></div>
  <table width="594" border="1" align="center">
    <tr bgcolor="#FFF9DF">
      <td colspan="2" bgcolor="#FFFFFF"><div align="center" class="style2 style9 style24">
        <div align="center">新留言 </div>
      </div></td>
    </tr>
    <tr bgcolor="#FFF9DF">
      <td bgcolor="#FFFFFF"><div align="left" class="style38"><span class="style39">日期</span></div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style38"><span class="style39">
        <input name="t_date" type="hidden" id="t_date" value="<?php echo date("Y-m-d");?>  ">
      <?php echo date("Y-m-d");?>  </span></div></td>
    </tr>
    <tr bgcolor="#FFF9DF">
      <td width="58" bgcolor="#FFFFFF"><div align="left" class="style38"><span class="style39">姓名</span></div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style38">
        <input name="t_name" type="text" id="t_name">
      </div></td>
    </tr>
    <tr bgcolor="#FFF9DF">
      <td bgcolor="#FFFFFF"><div align="left" class="style38"><span class="style39">內容</span></div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style38">
        <textarea name="t_text" cols="60" rows="5" id="t_text"></textarea>
      </div></td>
    </tr>
    <tr bgcolor="#FFF9DF">
      <td colspan="2" bgcolor="#FFFFFF"><div align="center" class="style29">
        <div align="left">
            <input type="submit" name="Submit" value="送出">
            <input type="reset" name="Submit2" value="重填">
        </div>
      </div></td>
    </tr>
  </table>
    <input type="hidden" name="MM_insert" value="form1">
</form>
<hr>
<form name="form2" method="post" action="">
  <?php do { ?>
  <table width="608" border="0" align="center">
    <tr>
      <td bgcolor="#FFFFFF"><span class="style23 style38"><strong>日期</strong></span></td>
      <td width="466" bgcolor="#FFFFFF"><span class="style40"><?php echo $row_rs['t_date']; ?></span></td>
      </tr>
    <tr>
      <td width="124" bgcolor="#FFFFFF" class="style29">姓名</td>
      <td bgcolor="#FFFFFF"><div align="left" class="style40"><?php echo $row_rs['t_name']; ?></div>        <div align="left" class="style40"></div>        <div align="left" class="style40"></div></td>
      </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="left" class="style23 style38"><strong>內容</strong></div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style40"><?php echo $row_rs['t_text']; ?></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="left" class="style23 style38"><strong>管理者回應</strong></div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style40"><?php echo $row_rs['t_re']; ?></div></td>
    </tr>
    <tr bgcolor="#FFFFCC">
      <td colspan="2" bgcolor="#FFFFFF"><span class="style38"></span></td>
    </tr>
    </table>
  <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
</form>
<div align="center"><a href="../index.php">
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center">
        <?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, 0, $queryString_rs); ?>">第一頁</a>
        <?php } // Show if not first page ?>
      </td>
      <td width="31%" align="center">
        <?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); ?>">上一頁</a>
        <?php } // Show if not first page ?>
      </td>
      <td width="23%" align="center">
        <?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs); ?>">下一頁</a>
        <?php } // Show if not last page ?>
      </td>
      <td width="23%" align="center">
        <?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, $totalPages_rs, $queryString_rs); ?>">最後一頁</a>
        <?php } // Show if not last page ?>
      </td>
    </tr>
  </table>
  
  <span class="style9">記錄 <?php echo ($startRow_rs + 1) ?> 到 <?php echo min($startRow_rs + $maxRows_rs, $totalRows_rs) ?> 共 <?php echo $totalRows_rs ?> 筆 </span><br>
</a><a href="../index.php" target="_top">回首頁</a></div>

</body>
</html>
<?php
mysql_free_result($rs);
?>
