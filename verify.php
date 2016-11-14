<?php require_once('Connections/connection.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
}

$colname_member_hash = "-1";
if (isset($_GET['member_hash'])) {
  $colname_member_hash = $_GET['member_hash'];
}
mysql_select_db($database_connection, $connection);
$query_member_hash = sprintf("SELECT member_hash, member_username FROM member WHERE member_hash = %s", GetSQLValueString($colname_member_hash, "text"));
$member_hash = mysql_query($query_member_hash, $connection) or die(mysql_error());
$row_member_hash = mysql_fetch_assoc($member_hash);
$totalRows_member_hash = mysql_num_rows($member_hash);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>認證開通中...</title>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body>
<?php
if ($totalRows_member_hash > 0)
{
//引入文件
require_once('phpmailer/class.phpmailer.php');
require_once('admin/smtp.php');

//寄件人名稱
$mail->FromName = "$row_seo_detail[seo_title] | 認證開通";

//設定收件人的另一種格式("Email","收件人名稱")
$mail->AddAddress($row_smtp_detail['smtp_email'],$row_seo_detail['seo_title']);

//設定密件副本
//$mail->AddBCC("","");

//回信Email及名稱
$mail->AddReplyTo($row_smtp_detail['smtp_email'], "$row_seo_detail[seo_title] | 認證開通");

//傳送附檔
//$mail->AddAttachment("download.gif");
//傳送附檔的另一種格式，可替附檔重新命名
//$mail->AddAttachment("download.gif", "newname.gif");

//郵件標題
$mail->Subject="$row_seo_detail[seo_title] | 認證開通";

//郵件內容
$mail->Body =
"
<html>
<head>
</head>
<body>
您好，我們是浩茗設計 <br>
請盡速幫該會員做最後開通動作 <br>
他的會員帳號是 $row_member_hash[member_username]<br>
</body>
</html>
"
;

//附加內容
$mail->AltBody = '這是附加的信件內容';

//寄送郵件
if(!$mail->Send())
{
echo "郵件無法順利寄出!";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}


mysql_select_db($database_connection, $connection);
$updateCommand="UPDATE member SET member_ok  = '1' where member_hash = '$row_member_hash[member_hash]' ";
mysql_query($updateCommand,$connection);
$updateGoTo = "detail.php?main_id=";  //設定更新後前往的頁面
//header(sprintf("Location: %s", $updateGoTo));
echo "<script>alert('您已認證成功，請等待管理員做最後開通的動作！');location.href='login.php';</script>";
}
?>
</body>
</html>
<?php
mysql_free_result($member_hash);
?>