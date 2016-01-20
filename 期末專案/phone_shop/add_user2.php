<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>加入會員</title>
</head>

<body>

<p>&nbsp;</p>
<p>&nbsp;</p>
<hr>
<p align="center"><?
$a=$_SESSION['MM_Username'];
 session_unset();
 $_SESSION['MM_Username']=$a;
//switch ($_GET['id']) {}
switch ($_GET['id']){
case "1":
 	echo "加入會員完畢" ;
	@mkdir($_GET['nn']);
	@mkdir($_GET['nn']."/images");
	copy("demo/edit_account.php", "./". $_GET['nn'] ."/edit_account.php");
	copy("demo/index.php", "./". $_GET['nn'] ."/index.php");
	copy("demo/images/top.gif", "./". $_GET['nn'] ."/images/top.gif");
	copy("demo/acc_login.php", "./". $_GET['nn'] ."/acc_login.php");
copy("demo/images/bnk.gif", "./". $_GET['nn'] ."/images/bnk.gif");
	break;
	case "2":
 	echo "帳號重複哦請回上頁重選" ;
	break;
	case "3":
 	echo "登入失敗請重新回上頁登入" ;
	break;
	
}
 ?></p>
<hr>
<p align="center">

<a href="Javascript:OnClick=history.back()">回上頁</a> <a href="acc_index.php"></a></p>
<p>&nbsp;</p>
</body>
</html>
