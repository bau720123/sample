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

//訊息
if ((isset($_GET['qa_question_id'])) && ($_GET['qa_question_id'] != "") && ($_GET['qa_type_id'] == "4")) 
{
$updateSQL = sprintf("UPDATE member_message SET member_click=1 WHERE member_id2=$_SESSION[MM_memberId] AND qa_question_id=%s",GetSQLValueString($_GET['qa_question_id'], "int"));
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
$updateGoTo = "message_content.php";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $updateGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $updateGoTo .= $_SERVER['QUERY_STRING'];
 }
  header(sprintf("Location: %s", $updateGoTo));

}

//塗鴉牆
if ((isset($_GET['qa_question_id'])) && ($_GET['qa_question_id'] != "") && ($_GET['qa_type_id'] == "1")) 
{
$updateSQL = sprintf("UPDATE member_message SET member_click=1 WHERE member_id2=$_SESSION[MM_memberId] AND member_id=$_GET[member_id] AND qa_question_id=%s",GetSQLValueString($_GET['qa_question_id'], "int"));
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
$updateGoTo = "index_others.php";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $updateGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $updateGoTo .= $_SERVER['QUERY_STRING'];
 }
  header(sprintf("Location: %s", $updateGoTo));

}

//照片日記
if ((isset($_GET['photo_id'])) && ($_GET['photo_id'] != "") && ($_GET['qa_type_id'] == "9")) 
{
$updateSQL = sprintf("UPDATE member_message SET member_click=1 WHERE member_id2=$_SESSION[MM_memberId] AND member_id=$_GET[member_id] ANDqa_question_id=%s",GetSQLValueString($_GET['photo_id'], "int"));
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
$updateGoTo = "index_photo_f_others.php";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $updateGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $updateGoTo .= $_SERVER['QUERY_STRING'];
 }
  header(sprintf("Location: %s", $updateGoTo));

}

//問與答
if ((isset($_GET['qa_question_id'])) && ($_GET['qa_question_id'] != "") && ($_GET['qa_type_id'] == "3")) 
{
$updateSQL = sprintf("UPDATE member_message SET member_click=1 WHERE member_id2=$_SESSION[MM_memberId] AND qa_question_id=%s",GetSQLValueString($_GET['qa_question_id'], "int"));
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
$updateGoTo = "index_qa_f_others.php";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $updateGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $updateGoTo .= $_SERVER['QUERY_STRING'];
 }
  header(sprintf("Location: %s", $updateGoTo));

}

//交友邀請
if ((isset($_GET['qa_question_id'])) && ($_GET['qa_question_id'] != "") && ($_GET['qa_type_id'] == "8")) 
{
$updateSQL = sprintf("UPDATE member_message SET member_click=1 WHERE member_id2=$_SESSION[MM_memberId] AND member_id=$_GET[member_id] AND qa_question_id=%s",GetSQLValueString($_GET['qa_question_id'], "int"));
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
$updateGoTo = "index.php";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $updateGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $updateGoTo .= $_SERVER['QUERY_STRING'];
 }
  header(sprintf("Location: %s", $updateGoTo));

}

if ((isset($_GET['photo_id2'])) && ($_GET['photo_id2'] != "") && ($_GET['photo_type_id2'] != "")) 
{
$updateSQL = sprintf("UPDATE photo SET photo_type_id2=$_GET[photo_type_id2] WHERE photo_id=$_GET[photo_id2] AND member_id=$_SESSION[MM_memberId]",GetSQLValueString($_GET['photo_id'], "int"));
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
$updateGoTo = "";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $updateGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $updateGoTo .= $_SERVER['QUERY_STRING'];
 }
  //header(sprintf("Location: %s", $updateGoTo));
  echo "<script>history.back(-1);</script>";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>頁面行進中...</title>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body>

</body>
</html>