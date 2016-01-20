<?php 
/*
echo $_SESSION['s_product'];
echo "<p>";
echo $_SESSION['s_number'];
echo "<p>";
echo $_SESSION['s_money'];
*/

 $arr= split(",",$_SESSION['s_product']);
 $arr2= split(",",$_SESSION['s_number']);
 $arr3= split(",",$_SESSION['s_money']);
  $_SESSION['s_product']="";//先清空session
  $_SESSION['s_number']="";//先清空session
  $_SESSION['s_money']="";//先清空session
  
  /*
  echo "<p>";
  echo $_GET['r_id']; 
  echo "要刪除的上頁索引值";
  echo "<p>";
  */
  
  for ($i=0;$i<=count($arr);$i++){
  
  if($i == $_GET['r_id']){
  
  
  //$_SESSION['s_product']=$_SESSION['s_product'] . "," . "";
  //$_SESSION['s_number']=$_SESSION['s_number'] . "," . "";
  //$_SESSION['s_money']=$_SESSION['s_money'] . "," . "";
  
    $_SESSION['s_product']=$_SESSION['s_product'] . "," . $arr[$i];
  $_SESSION['s_number']=$_SESSION['s_number'] . "," . $arr2[$i];
  $_SESSION['s_money']=$_SESSION['s_money'] . "," . $arr3[$i];
  
  ?>
  
  
  <p align="center">修改產品數量</p>
  <form id="form1" name="form1" method="GET" action="buy_edit2.php">
  <table width="243" border="1" align="center">
    <tr>
      <td width="120"><div align="left"><span class="style2">產品名稱</span></div></td>
      <td width="193"><div align="left"><?php echo $arr[$_GET['r_id']];?></div></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style2">數量</span></div></td>
      <td>
        
        <div align="left">
         
		  
		  <input name="s_number" type="text" id="mu_long" size="5"  value= <?php echo $arr2[$_GET['r_id']];?> onkeypress="if   (event.keyCode   <   46||event.keyCode   >   57)   event.returnValue   =   false;" />
		  
		  
        </div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
	   <input type="hidden" name="r_id" value=<?php echo $_GET['r_id'];?>>
        <input type="submit" name="Submit" value="修改" />
      </div></td>
    </tr>
  </table>
 
</form>
  
  
  
  
  
  <?php 
  }else{
  
  $_SESSION['s_product']=$_SESSION['s_product'] . "," . $arr[$i];
  $_SESSION['s_number']=$_SESSION['s_number'] . "," . $arr2[$i];
  $_SESSION['s_money']=$_SESSION['s_money'] . "," . $arr3[$i];
  }
  }

echo "<p>";
//echo $_SESSION['s_product'];




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {font-size: small}
-->
</style>
</head>

<body>

<hr />




<p align="center" class="style1"><a href="buy_shop2.php">回上頁</a></p>
</body>
</html>
