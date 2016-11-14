<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body onload="javascript:alert(<?php if ($_GET['typeid'] == '1') { ?>'線上刷卡成功！'<? } ?><?php if ($_GET['typeid'] == '2') { ?>'刷卡失敗了，請洽服務人員詢問進一步詳細狀況！'<? } ?>);location.href='index.php';">
</body>
</html>