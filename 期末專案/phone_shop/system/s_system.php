<?php require_once('../Connections/easyshop.php'); ?>
<?php
mysql_select_db($database_easyshop, $easyshop);
$query_rs = "SELECT * FROM sale_product ORDER BY s_id DESC";
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ʶR����</title>
<style type="text/css">
<!--
.style3 {color: #000000; font-weight: bold; }
.style4 {font-size: small}
.style6 {font-size: small; color: #FFFFFF; font-weight: bold; }
body {
	background-image: url(../user/image/thumb_1185020785.jpg);
}
.style9 {color: #000000}
.style10 {font-size: small; color: #000000; font-weight: bold; }
.style11 {font-size: small; color: #000000; }
-->
</style>
</head>

<body>
<div align="center"><span class="style3">[�d���ʶR�O��]</span>
  <span class="style9">
  <?php require_once('system_top.php'); ?>
  </span>
<table width="706" border="1">
  <tr>
    <td width="275" bgcolor="#FFFFFF"><div align="center" class="style6 style9">�ʶR���</div></td>
    <td width="234" bgcolor="#FFFFFF"><div align="center" class="style10">�B�z���p</div></td>
    <td width="175" bgcolor="#FFFFFF"><div align="center"><span class="style4"><span class="style9"></span></span></div></td>
  </tr>
  <?php do { ?>
  <tr>
      <td height="37" bgcolor="#FFFFFF"><div align="center" class="style11"><?php echo $row_rs['sale_date']; ?></div></td>
      <td bgcolor="#FFFFFF"><div align="center" class="style11"><?php 
	  switch($row_rs['sale_ps']){
	  case "1":
	  echo "�B�z��";  
	  break;
	   case "2":
	  echo "�B�e��";
	  break;
	   case "3":
	  echo "����";
	  break;
	   case "4":
	  echo "�ʳf";
	  break;
	   case "5":
	  echo "�h��";
	  break;
	         
	  }
	 
	  
	  ?></div></td>
      <td bgcolor="#FFFFFF"><div align="center" class="style11"><a href="sys_sale_log2.php?id=<?php echo $row_rs['s_id']; ?>">�Բ��ʶR���</a></div></td>
  </tr>
  <?php } while ($row_rs = mysql_fetch_assoc($rs));  ?>
</table>
</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
