<?php
require_once('../3rd/PHPMailer/class.phpmailer.php');

$smtp = new WA_MySQLi_RS("smtp",$connection,1);
$smtp->setQuery("SELECT * FROM smtp WHERE smtp_id = 1");
$smtp->execute();

$mail = new PHPMailer(); //宣告一個PHPMailer物件
//$mail->SMTPDebug = 2;
$mail->IsSMTP(); //設定使用SMTP發送
if(!(strcmp(($smtp->getColumnVal("smtp_tls")),"1"))) { $mail->SMTPSecure = "tls"; } //設定是否需要使用TLS連線
$mail->Host = $smtp->getColumnVal("smtp_address"); //SMTP的服務器位址
$mail->Port = $smtp->getColumnVal("smtp_port"); //SMTP主機的POST
$mail->SMTPAuth = $smtp->getColumnVal("smtp_safe"); //設定為安全驗證方式
$mail->Username = $smtp->getColumnVal("smtp_username"); //SMTP的帳號
$mail->Password = $smtp->getColumnVal("smtp_password"); //SMTP的密碼
$mail->From = $smtp->getColumnVal("smtp_email"); //寄件人Email
$mail->CharSet = "utf-8"; //設定信件字元編碼
$mail->Encoding = "base64"; //設定信件編碼，大部分郵件工具都支援此編碼方式
$mail->IsHTML(true); //設置郵件格式為HTML
$mail->WordWrap = 50; //每50字斷行
$mail->setLanguage('zh'); //設定語系
?>