<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_lyudao = "127.0.0.1";
$database_lyudao = "phone_shop_db";
$username_lyudao = "root";
$password_lyudao = "root";
$lyudao = mysql_pconnect($hostname_lyudao, $username_lyudao, $password_lyudao) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET UTF8");
?>