<?php require_once('../webassist/mysqli/authentication.php'); ?>
<?php
if ("" == "")
{
$LogOut = new WA_MySQLi_Auth();
$LogOut->Action = "logout";
$LogOut->Name = "formadmin";
$LogOut->execute();
echo "<script>location.href='login.php';</script>";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登出中</title>
</head>

<body>
</body>
</html>