<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>帳號密碼</title>
</head>

<body>
<?php
$tryagain = '請再試一次！';
if(isset($_GET["code"]) && $_GET["code"] == 1)
{
echo "<script>alert('帳號或密碼錯誤！$tryagain');location.href='login.php';</script>";
}
if(isset($_GET["code"]) && $_GET["code"] == 2)
{
echo "<script>alert('驗證碼錯誤！$tryagain');location.href='login.php';</script>";
}
?>
</body>
</html>