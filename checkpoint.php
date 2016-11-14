<?php require_once('Connections/connection.php'); ?>
<?php require_once('priority.php'); ?>
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

$colname_member_detail = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_member_detail = $_SESSION['MM_Username'];
}
mysql_select_db($database_connection, $connection);
$query_member_detail = sprintf("SELECT member_id, member_username, member_name, member_sex, member_point, member_ok FROM member WHERE member_username = %s AND member_ok= '1'", GetSQLValueString($colname_member_detail, "text"));
$member_detail = mysql_query($query_member_detail, $connection) or die(mysql_error());
$row_member_detail = mysql_fetch_assoc($member_detail);
$totalRows_member_detail = mysql_num_rows($member_detail);
?>
<?php if ($_POST['usepoint'] == '1' && $_POST['usepointcoda'] > $row_member_detail['member_point'] && substr_count($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"].'/'."cart_pt.php") == 1) { echo "<script>alert('使用點數不可大於帳戶目前點數');location.href='cart_pt.php';</script>"; } ?>
<?php if ($_POST['usepoint'] == '0' && substr_count($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"].'/'."cart_pt.php") == 1) { echo "<script>location.href='cart_add.php';</script>"; } ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row_seo_detail['seo_title']; ?>-確認點數使用狀況</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-確認點數使用狀況" />
<?php require_once("seo.php")?>
<?php require_once("css.php")?>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body <?php if ($_POST['usepoint'] == '1' && $_POST['usepointcoda'] <= $row_member_detail['member_point'] && substr_count($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"].'/'."cart_pt.php") == 1) { ?>onLoad="MM_callJS('document.form1.submit();')"<? } ?>>
<form action="cart_add.php" method="post" id="form1" name="form1">
  <input name="usepoint" type="hidden" id="usepoint" value="<?php echo $_POST['usepoint']; ?>" />
  <input name="usepointcoda" type="hidden" id="usepointcoda" value="<?php echo $_POST['usepointcoda']; ?>" />
</form>
</body>
</html>
<?php
mysql_free_result($member_detail);
?>