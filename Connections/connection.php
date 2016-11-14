<?php
# FileName="WADYN_MYSQLI_CONN.htm"
# Type="MYSQL"
# HTTP="true"
if ($_SERVER["HTTP_HOST"] == 'localhost:8086')
{
$hostname_connection = "localhost";
$database_connection = "littleb1_sample";
$username_connection = "root";
$password_connection = "720123bau";
}
if ($_SERVER["HTTP_HOST"] != 'localhost:8086')
{
$hostname_connection = "localhost";
$database_connection = "littleb1_sample";
$username_connection = "littleb1_bau";
$password_connection = "V9loCkToAK1n";
}
@session_start();

$connection = new mysqli($hostname_connection, $username_connection, $password_connection, $database_connection);
$connection->set_charset('utf8');

mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Taipei');
error_reporting(0);
?>