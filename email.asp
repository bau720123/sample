<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<%
Randomize()       
getnum = fix(Rnd()*100000 +1 )
randcode = getnum

Set objMail = CreateObject("CDO.Message")
objmail.HTMLBody = strBody  
objMail.HTMLBodyPart.Charset = "utf-8"  
objMail.HTMLBodyPart.ContentTransferEncoding = "quoted-printable" 
objMail.Subject      = "【台中世聯會，會員註冊驗證信】"               '發信主題
objMail.From         = "tuapa9@gmail.com"    '發信者電子信箱
objMail.To           = TRIM(REQUEST("mail"))      '收件者電子信箱
objMail.HTMLBody = "<a href=http://www.tuapa.org.tw/member_login.asp?randcode="& randcode &">請點選我以完成驗證</a>"

objMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/sendusing")=2
'SMTP 伺服器位址
objMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpserver")="smtp.gmail.com"
'SMTP 伺服器連線 Port
objMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpserverport")=465
'是否使用 SSL 連線 (False or True)
objMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpusessl") = True
'連線伺服器逾時時間
objMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpconnectiontimeout") = 30
'SMTP 伺服器是否需要驗證
objMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpauthenticate") = 1
'SMTP 伺服器使用者名稱
objMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/sendusername") = "tuapa9@gmail.com"
'SMTP 伺服器使用者密碼
objMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/sendpassword") = "lovedog999"

objMail.Configuration.Fields.Update

objMail.Send
set objMail=nothing
%>
</body>
</html>
