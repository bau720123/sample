<?php require_once('../Connections/connection.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username1'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username1'], $_SESSION['MM_UserGroup1'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$colname_class1 = "-1";
if (isset($_GET['class1_id'])) {
  $colname_class1 = $_GET['class1_id'];
}
mysql_select_db($database_connection, $connection);
$query_class1 = sprintf("SELECT class1_id FROM class1 WHERE class1_id = %s", GetSQLValueString($colname_class1, "int"));
$class1 = mysql_query($query_class1, $connection) or die(mysql_error());
$row_class1 = mysql_fetch_assoc($class1);
$totalRows_class1 = mysql_num_rows($class1);

$colname_class2 = "-1";
if (isset($_GET['class2_id'])) {
  $colname_class2 = $_GET['class2_id'];
}
mysql_select_db($database_connection, $connection);
$query_class2 = sprintf("SELECT class2_id, class1_id FROM class2 WHERE class2_id = %s", GetSQLValueString($colname_class2, "int"));
$class2 = mysql_query($query_class2, $connection) or die(mysql_error());
$row_class2 = mysql_fetch_assoc($class2);
$totalRows_class2 = mysql_num_rows($class2);

$colname_class3 = "-1";
if (isset($_GET['class3_id'])) {
  $colname_class3 = $_GET['class3_id'];
}
mysql_select_db($database_connection, $connection);
$query_class3 = sprintf("SELECT class3_id, class2_id, class1_id, photo, photo_thum , photo1, photo1_thum, photo2, photo2_thum, photo3, photo3_thum, photo4, photo4_thum, photo5 FROM class3 WHERE class3_id = %s", GetSQLValueString($colname_class3, "int"));
$class3 = mysql_query($query_class3, $connection) or die(mysql_error());
$row_class3 = mysql_fetch_assoc($class3);
$totalRows_class3 = mysql_num_rows($class3);

$colname_class1_3 = "-1";
if (isset($_GET['class1_id'])) {
  $colname_class1_3 = $_GET['class1_id'];
}
mysql_select_db($database_connection, $connection);
$query_class1_3 = sprintf("SELECT photo,photo_thum, photo1, photo1_thum, photo2, photo2_thum, photo3, photo3_thum, photo4, photo4_thum, photo5 FROM class3 WHERE class1_id = %s", GetSQLValueString($colname_class1_3, "int"));
$class1_3 = mysql_query($query_class1_3, $connection) or die(mysql_error());
$row_class1_3 = mysql_fetch_assoc($class1_3);
$totalRows_class1_3 = mysql_num_rows($class1_3);

$colname_class2_3 = "-1";
if (isset($_GET['class2_id'])) {
  $colname_class2_3 = $_GET['class2_id'];
}
mysql_select_db($database_connection, $connection);
$query_class2_3 = sprintf("SELECT photo,photo_thum, photo1, photo1_thum, photo2, photo2_thum, photo3, photo3_thum, photo4, photo4_thum, photo5 FROM class3 WHERE class2_id = %s", GetSQLValueString($colname_class2_3, "int"));
$class2_3 = mysql_query($query_class2_3, $connection) or die(mysql_error());
$row_class2_3 = mysql_fetch_assoc($class2_3);
$totalRows_class2_3 = mysql_num_rows($class2_3);

$colname_activity_soon_detail = "-1";
if (isset($_GET['activity_soon_id'])) {
  $colname_activity_soon_detail = $_GET['activity_soon_id'];
}
mysql_select_db($database_connection, $connection);
$query_activity_soon_detail = sprintf("SELECT * FROM activity_soon WHERE activity_soon_id = %s", GetSQLValueString($colname_activity_soon_detail, "int"));
$activity_soon_detail = mysql_query($query_activity_soon_detail, $connection) or die(mysql_error());
$row_activity_soon_detail = mysql_fetch_assoc($activity_soon_detail);
$totalRows_activity_soon_detail = mysql_num_rows($activity_soon_detail);

$colname_activity_soon_detail_year = "-1";
if (isset($_GET['year_id'])) {
  $colname_activity_soon_detail_year = $_GET['year_id'];
}
mysql_select_db($database_connection, $connection);
$query_activity_soon_detail_year = sprintf("SELECT * FROM activity_soon WHERE year_id = %s", GetSQLValueString($colname_activity_soon_detail_year, "int"));
$activity_soon_detail_year = mysql_query($query_activity_soon_detail_year, $connection) or die(mysql_error());
$row_activity_soon_detail_year = mysql_fetch_assoc($activity_soon_detail_year);
$totalRows_activity_soon_detail_year = mysql_num_rows($activity_soon_detail_year);

$colname_member_detail = "-1";
if (isset($_GET['member_id'])) {
  $colname_member_detail = $_GET['member_id'];
}
mysql_select_db($database_connection, $connection);
$query_member_detail = sprintf("SELECT member_id FROM member WHERE member_id = %s", GetSQLValueString($colname_member_detail, "int"));
$member_detail = mysql_query($query_member_detail, $connection) or die(mysql_error());
$row_member_detail = mysql_fetch_assoc($member_detail);
$totalRows_member_detail = mysql_num_rows($member_detail);

//管理者刪除(年度資訊+最新消息+上傳檔案)資料開始
if ((isset($_GET['year_id'])) && ($_GET['year_id'] != "")) {
  
  $deleteSQL = sprintf("DELETE FROM year WHERE year_id=%s",GetSQLValueString($_GET['year_id'], "int"));
  $deleteSQL2 = sprintf("DELETE FROM activity_soon WHERE year_id=%s",GetSQLValueString($_GET['year_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  $Result2 = mysql_query($deleteSQL2, $connection) or die(mysql_error());
  $file=iconv("utf-8", "big5", ''.$row_activity_soon_detail_detail['photo']);
  @unlink($file); //可在之前加上@符號-已利不出現錯誤訊息
  
  $deleteGoTo = "year.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(年度資訊+最新消息+上傳檔案)資料結束

//管理者刪除(最新消息+上傳檔案)資料開始
if ((isset($_GET['activity_soon_id'])) && ($_GET['activity_soon_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM activity_soon WHERE activity_soon_id=%s",GetSQLValueString($_GET['activity_soon_id'], "int"));
  
  $activity_soon_detail_file=iconv("utf-8", "big5", ''.$row_activity_soon_detail['photo']);
  $activity_soon_detail_thum_file=iconv("utf-8", "big5", ''.$row_activity_soon_detail['photo_thum']);
  @unlink($activity_soon_detail_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($activity_soon_detail_thum_file); //可在之前加上@符號-已利不出現錯誤

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  
  $deleteGoTo = "activity_soon.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(最新消息+上傳檔案)資料結束

//管理者刪除(常見問題)資料開始
if ((isset($_GET['qa_id'])) && ($_GET['qa_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM qa WHERE qa_id=%s",GetSQLValueString($_GET['qa_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  
  $deleteGoTo = "qa.php?qa_typeid=$_GET[qa_typeid]";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(常見問題)資料結束

//管理者刪除(留言板)資料開始
if ((isset($_GET['board_id'])) && ($_GET['board_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM board WHERE board_id=%s",GetSQLValueString($_GET['board_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  
  $deleteGoTo = "board.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(留言板)資料結束

//管理者刪除(會員+回應主題)相關資料開始
if ((isset($_GET['member_id'])) && ($_GET['member_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM member WHERE member_id=%s",
                       GetSQLValueString($_GET['member_id'], "int"));
  $deleteSQL2 = sprintf("DELETE FROM forum_re WHERE member_id=%s",
                       GetSQLValueString($_GET['member_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  $Result2 = mysql_query($deleteSQL2, $connection) or die(mysql_error());

  $deleteGoTo = "member_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(會員+回應主題)相關資料結束

//管理者刪除(討論主題+回應主題)資料開始
if ((isset($_GET['forum_id'])) && ($_GET['forum_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM forum WHERE forum_id=%s",
                       GetSQLValueString($_GET['forum_id'], "int"));
  $deleteSQL2 = sprintf("DELETE FROM forum_re WHERE forum_id=%s",
                       GetSQLValueString($_GET['forum_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  $Result2 = mysql_query($deleteSQL2, $connection) or die(mysql_error());

  $deleteGoTo = "forum.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(討論主題+回應主題)資料結束

//管理者刪除(回應主題)資料開始
if ((isset($_GET['forum_re_id'])) && ($_GET['forum_re_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM forum_re WHERE forum_re_id=%s",
                       GetSQLValueString($_GET['forum_re_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());

  $deleteGoTo = "forum_re.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $deleteGoTo));
  echo "<script>javascript:history.go(-1);</script>";
}
//管理者刪除(回應主題)資料結束

//管理者刪除(大分類+中分類+小分類+上傳檔案)資料開始
if ((isset($_GET['class1_id'])) && ($_GET['class2_id'] == "") && ($_GET['class3_id'] == "")) {
  
  $deleteSQL = sprintf("DELETE FROM class1 WHERE class1_id=%s",GetSQLValueString($_GET['class1_id'], "int"));
  
  $deleteSQL2 = sprintf("DELETE FROM class2 WHERE class1_id=%s",GetSQLValueString($_GET['class1_id'], "int"));
  
  $deleteSQL3 = sprintf("DELETE FROM class3 WHERE class1_id=%s",GetSQLValueString($_GET['class1_id'], "int"));
  
  $class3_file=iconv("utf-8", "big5", ''.$row_class1_3['photo']);
  @unlink($class3_file); //可在之前加上@符號-已利不出現錯誤
  $class3_thum_file=iconv("utf-8", "big5", 'upload/'.$row_class1_3['photo_thum']);
  @unlink($class3_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class31_file=iconv("utf-8", "big5", ''.$row_class1_3['photo1']);
  @unlink($class31_file); //可在之前加上@符號-已利不出現錯誤
  $class31_thum_file=iconv("utf-8", "big5", 'upload/'.$row_class1_3['photo1_thum']);
  @unlink($class31_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class32_file=iconv("utf-8", "big5", ''.$row_class1_3['photo2']);
  @unlink($class32_file); //可在之前加上@符號-已利不出現錯誤
  $class32_thum_file=iconv("utf-8", "big5", 'upload/'.$row_class1_3['photo2_thum']);
  @unlink($class32_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class33_file=iconv("utf-8", "big5", ''.$row_class1_3['photo3']);
  @unlink($class33_file); //可在之前加上@符號-已利不出現錯誤
  $class33_thum_file=iconv("utf-8", "big5", 'upload/'.$row_class1_3['photo3_thum']);
  @unlink($class33_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class34_file=iconv("utf-8", "big5", ''.$row_class1_3['photo4']);
  @unlink($class34_file); //可在之前加上@符號-已利不出現錯誤
  $class34_thum_file=iconv("utf-8", "big5", 'upload/'.$row_class1_3['photo4_thum']);
  @unlink($class34_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class35_file=iconv("utf-8", "big5", ''.$row_class1_3['photo5']);
  @unlink($class35_file); //可在之前加上@符號-已利不出現錯誤

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  $Result2 = mysql_query($deleteSQL2, $connection) or die(mysql_error());
  $Result3 = mysql_query($deleteSQL3, $connection) or die(mysql_error());
  
  $deleteGoTo = "class1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(大分類+中分類+小分類+上傳檔案)資料結束

//管理者刪除(中分類+小分類+上傳檔案)資料開始
if ((isset($_GET['class2_id'])) && ($_GET['class2_id'] != "") && ($_GET['class3_id'] == "")) {
    
  $deleteSQL2 = sprintf("DELETE FROM class2 WHERE class2_id=%s",GetSQLValueString($_GET['class2_id'], "int"));
  
  $deleteSQL3 = sprintf("DELETE FROM class3 WHERE class2_id=%s",GetSQLValueString($_GET['class2_id'], "int"));
  
  $class3_file=iconv("utf-8", "big5", ''.$row_class2_3['photo']);
  @unlink($class3_file); //可在之前加上@符號-已利不出現錯誤
  $class3_thum_file=iconv("utf-8", "big5", ''.$row_class2_3['photo_thum']);
  @unlink($class3_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class31_file=iconv("utf-8", "big5", ''.$row_class2_3['photo1']);
  @unlink($class31_file); //可在之前加上@符號-已利不出現錯誤
  $class31_thum_file=iconv("utf-8", "big5", ''.$row_class2_3['photo1_thum']);
  @unlink($class31_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class32_file=iconv("utf-8", "big5", ''.$row_class2_3['photo2']);
  @unlink($class32_file); //可在之前加上@符號-已利不出現錯誤
  $class32_thum_file=iconv("utf-8", "big5", ''.$row_class2_3['photo2_thum']);
  @unlink($class32_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class33_file=iconv("utf-8", "big5", ''.$row_class2_3['photo3']);
  @unlink($class33_file); //可在之前加上@符號-已利不出現錯誤
  $class33_thum_file=iconv("utf-8", "big5", ''.$row_class2_3['photo3_thum']);
  @unlink($class33_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class34_file=iconv("utf-8", "big5", ''.$row_class2_3['photo4']);
  @unlink($class34_file); //可在之前加上@符號-已利不出現錯誤
  $class34_thum_file=iconv("utf-8", "big5", ''.$row_class2_3['photo4_thum']);
  @unlink($class34_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class35_file=iconv("utf-8", "big5", ''.$row_class2_3['photo5']);
  @unlink($class35_file); //可在之前加上@符號-已利不出現錯誤
  
  mysql_select_db($database_connection, $connection);
  $Result2 = mysql_query($deleteSQL2, $connection) or die(mysql_error());
  $Result3 = mysql_query($deleteSQL3, $connection) or die(mysql_error());
  
  $deleteGoTo = "class2.php?class1_id=$_GET[class1_id]";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(中分類+小分類+上傳檔案)資料結束

//管理者刪除(小分類+上傳檔案)資料開始
if ((isset($_GET['class3_id'])) && ($_GET['class1_id'] != "") && ($_GET['class2_id'] != "")) {
  
  $deleteSQL3 = sprintf("DELETE FROM class3 WHERE class3_id=%s",GetSQLValueString($_GET['class3_id'], "int"));
  
  $class3_file=iconv("utf-8", "big5", ''.$row_class3['photo']);
  $class3_thum_file=iconv("utf-8", "big5", ''.$row_class3['photo_thum']);
  @unlink($class3_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($class3_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class31_file=iconv("utf-8", "big5", ''.$row_class3['photo1']);
  $class31_thum_file=iconv("utf-8", "big5", ''.$row_class3['photo1_thum']);
  @unlink($class31_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($class31_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class32_file=iconv("utf-8", "big5", ''.$row_class3['photo2']);
  $class32_thum_file=iconv("utf-8", "big5", ''.$row_class3['photo2_thum']);
  @unlink($class32_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($class32_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class33_file=iconv("utf-8", "big5", ''.$row_class3['photo3']);
  $class33_thum_file=iconv("utf-8", "big5", ''.$row_class3['photo3_thum']);
  @unlink($class33_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($class33_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class34_file=iconv("utf-8", "big5", ''.$row_class3['photo4']);
  $class34_thum_file=iconv("utf-8", "big5", ''.$row_class3['photo4_thum']);
  @unlink($class34_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($class34_thum_file); //可在之前加上@符號-已利不出現錯誤
  
  $class35_file=iconv("utf-8", "big5", ''.$row_class3['photo5']);
  @unlink($class35_file); //可在之前加上@符號-已利不出現錯誤
  
  mysql_select_db($database_connection, $connection);
  $Result3 = mysql_query($deleteSQL3, $connection) or die(mysql_error());
  
  $deleteGoTo = "class3.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(小分類+上傳檔案)資料結束

//管理者刪除(接案狀況分析)資料開始
if ((isset($_GET['case_id'])) && ($_GET['case_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM case_data WHERE case_id=%s",GetSQLValueString($_GET['case_id'], "int"));
  
  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  
  $deleteGoTo = "case.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(接案狀況分析)資料結束


//管理者刪除(專案經驗分享)資料開始
if ((isset($_GET['experience_id'])) && ($_GET['experience_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM experience WHERE experience_id=%s",GetSQLValueString($_GET['experience_id'], "int"));
  
  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  
  $deleteGoTo = "experience.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
//管理者刪除(專案經驗分享)資料結束

mysql_free_result($class1);
mysql_free_result($class2);
mysql_free_result($class3);
mysql_free_result($class1_3);
mysql_free_result($class2_3);
mysql_free_result($activity_soon_detail);
mysql_free_result($activity_soon_detail_year);
mysql_free_result($member_detail);
?>