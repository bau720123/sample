<?php require_once('../Connections/connection.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>自動登入中</title>
<meta http-equiv="Refresh" content="0;URL=<?php if(isset($_SESSION['admin_member_id'])) { ?>admin_fix.php<? } ?><?php if(empty($_SESSION['admin_member_id'])) { ?>login.php<? } ?>" />
</head>

<body>
</body>
</html>