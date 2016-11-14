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

$colname_photo = "-1";
if (isset($_GET['photo_id'])) {
  $colname_photo = $_GET['photo_id'];
}
$colname1_photo = "-1";
if (isset($_SESSION['MM_memberId'])) {
  $colname1_photo = $_SESSION['MM_memberId'];
}
mysql_select_db($database_connection, $connection);
$query_photo = sprintf("SELECT photo_id, member_id, photo, photo_thum, photo1, photo1_thum, photo2, photo2_thum, photo3, photo3_thum, photo4, photo4_thum, photo5, photo5_thum, photo6, photo6_thum, photo7, photo7_thum, photo8, photo8_thum, photo9, photo9_thum FROM photo WHERE photo_id = %s AND member_id = %s", GetSQLValueString($colname_photo, "int"),GetSQLValueString($colname1_photo, "int"));
$photo = mysql_query($query_photo, $connection) or die(mysql_error());
$row_photo = mysql_fetch_assoc($photo);
$totalRows_photo = mysql_num_rows($photo);

if ((isset($_GET['qa_question_id'])) && ($_GET['qa_question_id'] != "")) 
{
$deleteSQL = sprintf("DELETE FROM qa_question WHERE qa_question_id=%s AND member_id2=$_SESSION[MM_memberId]",GetSQLValueString($_GET['qa_question_id'], "int"));
$deleteSQL2 = sprintf("DELETE FROM qa_answer WHERE qa_question_id=%s",GetSQLValueString($_GET['qa_question_id'], "int"));
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
$Result2 = mysql_query($deleteSQL2, $connection) or die(mysql_error());
$deleteGoTo = "";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $deleteGoTo .= $_SERVER['QUERY_STRING'];
 }
  //header(sprintf("Location: %s", $deleteGoTo));
 echo "<script>alert('資料刪除完畢');history.back(-1);</script>";

}

if ((isset($_GET['qa_answer_id'])) && ($_GET['qa_answer_id'] != "")) 
{

 if ((empty($_GET['myself'])) && ($_GET['myself'] == "")) 
 {
 $deleteSQL = sprintf("DELETE FROM qa_answer WHERE qa_answer_id=%s",GetSQLValueString($_GET['qa_answer_id'], "int"));
 }
 if ((isset($_GET['myself'])) && ($_GET['myself'] == "myself")) 
 {
 $deleteSQL = sprintf("DELETE FROM qa_answer WHERE qa_answer_id=%s AND member_id=$_SESSION[MM_memberId]",GetSQLValueString($_GET['qa_answer_id'], "int"));
 }
 
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
$deleteGoTo = "";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $deleteGoTo .= $_SERVER['QUERY_STRING'];
 }
  //header(sprintf("Location: %s", $deleteGoTo));
 echo "<script>alert('資料刪除完畢');history.back(-1);</script>";

}

if ($totalRows_photo > 0)
{
$deleteSQL = sprintf("DELETE FROM photo WHERE photo_id=%s",GetSQLValueString($row_photo['photo_id'], "int"));
$deleteSQL2 = sprintf("DELETE FROM photo_re WHERE photo_id=%s",GetSQLValueString($row_photo['photo_id'], "int"));

  $file1=iconv("utf-8", "big5", ''.$row_photo['photo']);
  $file1_thum=iconv("utf-8", "big5", ''.$row_photo['photo_thum']);
  @unlink($file1); //可在之前加上@符號-已利不出現錯誤
  @unlink($file1_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file2_file=iconv("utf-8", "big5", ''.$row_photo['photo1']);
  $file2_thum=iconv("utf-8", "big5", ''.$row_photo['photo1_thum']);
  @unlink($file2_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file2_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file3_file=iconv("utf-8", "big5", ''.$row_photo['photo2']);
  $file3_thum=iconv("utf-8", "big5", ''.$row_photo['photo2_thum']);
  @unlink($file3_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file3_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file4_file=iconv("utf-8", "big5", ''.$row_photo['photo3']);
  $file4_thum=iconv("utf-8", "big5", ''.$row_photo['photo3_thum']);
  @unlink($file4_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file4_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file5_file=iconv("utf-8", "big5", ''.$row_photo['photo4']);
  $file5_thum=iconv("utf-8", "big5", ''.$row_photo['photo4_thum']);
  @unlink($file5_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file5_thum); //可在之前加上@符號-已利不出現錯誤
    
  $file6_file=iconv("utf-8", "big5", ''.$row_photo['photo5']);
  $file6_thum=iconv("utf-8", "big5", ''.$row_photo['photo5_thum']);
  @unlink($file6_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file6_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file7_file=iconv("utf-8", "big5", ''.$row_photo['photo6']);
  $file7_thum=iconv("utf-8", "big5", ''.$row_photo['photo6_thum']);
  @unlink($file7_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file7_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file8_file=iconv("utf-8", "big5", ''.$row_photo['photo7']);
  $file8_thum=iconv("utf-8", "big5", ''.$row_photo['photo7_thum']);
  @unlink($file8_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file8_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file9_file=iconv("utf-8", "big5", ''.$row_photo['photo8']);
  $file9_thum=iconv("utf-8", "big5", ''.$row_photo['photo8_thum']);
  @unlink($file9_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file9_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file10_file=iconv("utf-8", "big5", ''.$row_photo['photo9']);
  $file10_thum=iconv("utf-8", "big5", ''.$row_photo['photo9_thum']);
  @unlink($file10_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file10_thum); //可在之前加上@符號-已利不出現錯誤
  
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
$Result2 = mysql_query($deleteSQL2, $connection) or die(mysql_error());
$deleteGoTo = "";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $deleteGoTo .= $_SERVER['QUERY_STRING'];
 }
  //header(sprintf("Location: %s", $deleteGoTo));
 echo "<script>alert('資料刪除完畢');history.back(-1);</script>";

}

if ((isset($_GET['photo_re_id'])) && ($_GET['photo_re_id'] != "")) 
{

 if ((empty($_GET['myself'])) && ($_GET['myself'] == "")) 
 {
 $deleteSQL = sprintf("DELETE FROM photo_re WHERE photo_re_id=%s",GetSQLValueString($_GET['photo_re_id'], "int"));
 }
 if ((isset($_GET['myself'])) && ($_GET['myself'] == "myself")) 
 {
 $deleteSQL = sprintf("DELETE FROM photo_re WHERE photo_re_id=%s AND member_id=$_SESSION[MM_memberId]",GetSQLValueString($_GET['photo_re_id'], "int"));
 }
 
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
$deleteGoTo = "";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $deleteGoTo .= $_SERVER['QUERY_STRING'];
 }
  //header(sprintf("Location: %s", $deleteGoTo));
 echo "<script>alert('資料刪除完畢');history.back(-1);</script>";

}

if ((isset($_GET['member_group_id'])) && ($_GET['member_group_id'] != "")) 
{
$deleteSQL = sprintf("DELETE FROM member_group WHERE member_group_id=%s AND member_id=$_SESSION[MM_memberId]",GetSQLValueString($_GET['member_group_id'], "int"));

$updateSQL = sprintf("UPDATE member_friend SET member_group_id=0 WHERE member_id=$_SESSION[MM_memberId] AND member_group_id=%s",GetSQLValueString($_GET['member_group_id'], "int"));
mysql_select_db($database_connection, $connection);
$Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
$Result2 = mysql_query($updateSQL, $connection) or die(mysql_error());
$deleteGoTo = "";

 if (isset($_SERVER['QUERY_STRING'])) 
 {
 $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
 $deleteGoTo .= $_SERVER['QUERY_STRING'];
 }
  //header(sprintf("Location: %s", $deleteGoTo));
 echo "<script>alert('資料刪除完畢');history.back(-1);</script>";

}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>資料訊息刪除中...</title>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body>

</body>
</html>
<?php
mysql_free_result($photo);
?>
