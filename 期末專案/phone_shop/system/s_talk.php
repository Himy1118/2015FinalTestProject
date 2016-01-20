<?php require_once('../Connections/easyshop.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs = 55;
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
<!--
.style1 {font-size: small}
body {
	background-image: url(../user/image/thumb_1185021456.jpg);
}
.style6 {color: #000000}
.style7 {font-size: small; color: #000000; }
-->
</style>
</head>

<body>
<div align="center">[查看留言版
  ]
  <hr>
  <table width="1014" border="1">
    <tr>
      <td width="32" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="35" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="88" bgcolor="#FFFFFF"><div align="left" class="style6"><span class="style1">留言者</span></div></td>
      <td width="111" bgcolor="#FFFFFF"><div align="left" class="style6"><span class="style1">日期</span></div></td>
      <td width="224" bgcolor="#FFFFFF"><div align="left" class="style6"><span class="style1">詢問問題</span></div></td>
      <td width="240" bgcolor="#FFFFFF"><span class="style7">系統管理者回應</span></td>
    </tr>
    <?php do { ?>
    <tr>
      <td bgcolor="#FFFFFF"><div align="center" class="style7"><a href="s_talkdel.php?id=<?php echo $row_rs['t_id']; ?>">刪除</a></div></td>
      <td bgcolor="#FFFFFF"><div align="center" class="style6"><span class="style1"><a href="s_talk2.php?id=<?php echo $row_rs['t_id']; ?>">查看</a></span></div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style6"><span class="style1"><?php echo $row_rs['t_name']; ?></span></div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style6"><?php echo $row_rs['t_date']; ?></div></td>
      <td bgcolor="#FFFFFF"><span class="style7"><?php echo $row_rs['t_text']; ?></span></td>
      <td bgcolor="#FFFFFF"><div align="left" class="style7"><?php echo $row_rs['t_re']; ?></div></td>
    </tr>
    <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
  </table>
  <p class="style1"> 記錄 <?php echo ($startRow_rs + 1) ?> 到 <?php echo min($startRow_rs + $maxRows_rs, $totalRows_rs) ?> 共 <?php echo $totalRows_rs ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center">
        <?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, 0, $queryString_rs); ?>">第一頁</a>
      <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center">
        <?php if ($pageNum_rs > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); ?>">上一頁</a>
      <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center">
        <?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs); ?>">下一頁</a>
      <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center">
        <?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, $totalPages_rs, $queryString_rs); ?>">最後一頁</a>
      <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
  </p>
</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
