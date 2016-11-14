<?php
//引用方式範例開始
$process_time = $_POST['process_time']; //處理時間
$gwsr = $_POST['gwsr']; //授權單號
$amount = $_POST['amount']; //交易金額
$spcheck = $_POST['spcheck']; //綠界那邊計算好的檢查碼
$check_sum='92346635'; //這就是登入後台所看到的檢查碼

//檢核函式
$incom_check = gwSpcheck($process_time,$gwsr,$amount,$spcheck,$check_sum);
function gwSpcheck($process_time,$gwsr,$amount,$spcheck,$check_sum) 
{    
$T = $process_time+$gwsr+$amount; //算出認證用的字串
$a = substr($T,0,1).substr($T,2,1).substr($T,4,1); //取出檢查碼的跳字組合 1,3,5 字元
$b = substr($T,1,1).substr($T,3,1).substr($T,5,1); //取出檢查碼的跳字組合 2,4,6 字元
$c = ( $check_sum % $T ) + $check_sum + $a + $b; //取餘數 + 檢查碼 + 奇位跳字組合 + 偶位跳字組合

 if($spcheck != $c && $_POST['succ'] == '2') 
 {
 echo "<script>location.href='card_end.php?typeid=2';</script>";
 }
 
 if($spcheck == $c && $_POST['succ'] == '1') 
 {
 $_SESSION['ok']= '1';
 }

}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formcard")) {
  $updateSQL = sprintf("UPDATE orders SET orders_ok=%s WHERE orders_uid=%s",
                       GetSQLValueString($_POST['orders_ok'], "int"),
                       GetSQLValueString($_POST['orders_uid'], "bigint"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "mypage_history.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $updateGoTo));
  echo "<script>location.href='card_end.php?typeid=1';</script>";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row_seo_detail['seo_title']; ?>-刷卡確認中</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-刷卡確認中" />
<?php require_once("seo.php")?>
<?php require_once("css.php")?>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body <?php if($_SESSION['ok'] == '1') { ?>onLoad="MM_callJS('document.formcard.submit();')"<? } ?>>
<form id="formcard" name="formcard" method="POST" action="<?php echo $editFormAction; ?>">
  <?php echo $rule;?><input name="orders_ok" type="hidden" id="orders_ok" value="2" />
  <input name="orders_uid" type="hidden" id="orders_uid" value="<?php echo $_POST['od_sob'];?>" />
  <input type="hidden" name="MM_update" value="formcard" />
</form>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>
</body>
</html>