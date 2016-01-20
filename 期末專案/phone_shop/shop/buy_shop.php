<?php require_once('../Connections/easyshop.php'); ?>
<?php
$colname_rs = "1";
if (isset($_GET['id'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_rs = sprintf("SELECT * FROM s_product WHERE pro_id = %s", $colname_rs);
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>購買商品</title>
<style type="text/css">
<!--
.style1 {
	color: #669966;
	font-weight: bold;
	font-size: large;
}
body {
	background-color: #FFFFFF;
	background-image: url();
}
.style11 {color: #000000; font-weight: bold; }
.style12 {color: #000000}
.style13 {color: #000000; font-size: small; font-family: "標楷體"; }
-->
</style>
</head>

<body>
<div align="center" class="style1"></div>

<hr>
<form name="form1" method="post" action="buy_shop2.php">
  <table width="556" height="320" border="1" align="center">
    <tr bgcolor="#CC9966">
      <td colspan="3" background="../images/gfdgs.jpg" bgcolor="#999999"><div align="center" class="style11"><img src="../system/store_photo/<?php echo $row_rs['s_file']; ?>" width="403" height="267" /></div>        
      <div align="center" class="style11"></div></td>
    </tr>
    
    <tr bgcolor="#FAD3E3">
      <td width="26" rowspan="4" background="../images/gfdgs.jpg" bgcolor="#FFFF99"><span class="style12"></span></td>
      <td colspan="2" background="../images/gfdgs.jpg" bgcolor="#FFFF99"><span class="style11">
        <?php echo $row_rs['s_ps']; ?>
         <?php
	   	   echo $row_rs['s_product']; 
	  
	   ?>
      
      <input name="s_product" type="hidden" id="s_product" value="<?php echo $row_rs['s_product']; ?>" />
      </span></td>
    </tr>
    <tr bgcolor="#FAD3E3">
      <td width="300" background="../images/gfdgs.jpg" bgcolor="#FFFF99"><div align="center" class="style13">商品資訊</div></td>
      <td width="208" background="../images/gfdgs.jpg" bgcolor="#FFFF99"><div align="left" class="style13"><?php echo $row_rs['s_text']; ?>
      </div></td>
    </tr>
    <tr bgcolor="#FAD3E3">
      <td height="23" background="../images/gfdgs.jpg" bgcolor="#FFFF99"><div align="center" class="style13">售價</div></td>
      <td background="../images/gfdgs.jpg" bgcolor="#FFFF99"><div align="left" class="style13"><?php echo $row_rs['s_money']; ?>
          <input name="s_money" type="hidden" id="s_money" value="<?php echo $row_rs['s_money']; ?>">
      </div></td>
    </tr>
    <tr bgcolor="#FAD3E3">
      <td background="../images/gfdgs.jpg" bgcolor="#FFFF99"><div align="center" class="style13">購買數量</div></td>
      <td background="../images/gfdgs.jpg" bgcolor="#FFFF99"><div align="left" class="style13">
        <select name="s_number" id="s_number">
           <?php 
	 for ($i=1;$i<=20;$i++){
	if ($i==1){
	 echo  "<option value=" . $i ." selected>" . $i . "</option>" ;
	 }else{
	  echo  "<option value=" . $i .">" . $i . "</option>" ;
	};
	 };
	  
	   ?>
        </select>
</div></td>
    </tr>
    <tr>
      <td colspan="3" background="../images/gfdgs.jpg" bgcolor="#DCF5FA"><div align="center" class="style12">
        <input type="submit" name="Submit" value="送出">
      </div></td>
    </tr>
  </table>
</form>
<br>
<hr>
<p align="center"><a href="../index.php">回首頁</a></p>
</body>
</html>
<?php
mysql_free_result($rs);
?>
