<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?
$_SESSION['s_product']=$_POST['s_product']; 
$_SESSION['s_ps']=$_POST['s_ps']; 
$_SESSION['s_money_old']=$_POST['s_money_old']; 
$_SESSION['s_money']=$_POST['s_money']; 
$_SESSION['s_text']=$_POST['s_text']; 


?>
<html>
<script language=javascript>
setTimeout("location.href='s_upstore3.php'",2000);
</script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品上架</title>
<style type="text/css">
<!--
.style2 {color: #666666}
-->
</style>
</head>

<body>
<? 

copy($uploadedfile, "./store_photo/$uploadedfile_name");
$_SESSION['s_file']=$uploadedfile_name

 ?>
<span class="style2">上架中......
</span>
</body>
</html>
