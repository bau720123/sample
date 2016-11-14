<?php require_once('../../Connections/connection.php'); ?>
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

//$MM_restrictGoTo = "login.php";
if(isset($_COOKIE['admin_username']) && isset($_COOKIE['admin_password'])) { $MM_restrictGoTo = "../headerautologin.php"; }
if(empty($_COOKIE['admin_username']) || empty($_COOKIE['admin_password'])) { $MM_restrictGoTo = "../login.php"; }
if (!((isset($_SESSION['MM_Username1'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username1'], $_SESSION['MM_UserGroup1'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['REQUEST_URI'];
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

$colname_qa_re = "-1";
if (isset($_GET['qa_id'])) {
  $colname_qa_re = $_GET['qa_id'];
}
mysql_select_db($database_connection, $connection);
$query_qa_re = sprintf("SELECT qa_re_id, qa_id, qa_re_question FROM qa_re WHERE qa_id = %s ORDER BY sort ASC", GetSQLValueString($colname_qa_re, "int"));
$qa_re = mysql_query($query_qa_re, $connection) or die(mysql_error());
$row_qa_re = mysql_fetch_assoc($qa_re);
$totalRows_qa_re = mysql_num_rows($qa_re);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<link rel="stylesheet" href="themes/curve/style.css" type="text/css" />
<script type="text/javascript">
<?php 
$originalString = $_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]); 
$newString = str_replace("/","\/",$originalString);     
?>
/* <![CDATA[ */
    var js_vars = {"site_url":"http:\/\/<?php echo $newString;?>","debug":false,"icon_dir":"images\/icons\/","lang_close":"Close","icon_close_path":"images\/icons\/close.png","lang_upload_swf_php":{"browse":"點我批次上傳","cancel_all":"Cancel all uploads","upload_queue":"Upload Queue","files_uploaded":"files uploaded","all_files":"All Files","status_pending":"Pending...","status_uploading":"上傳中...","status_complete":"上傳成功.","status_cancelled":"Cancelled.","status_stopped":"Stopped.","status_failed":"上傳失敗","status_too_big":"File is too big.","status_zero_byte":"Cannot upload Zero Byte files.","status_invalid_type":"Invalid File Type.","status_unhandled":"Unhandled Error","status_upload_error":"Upload Error: ","status_server_error":"Server (IO) Error","status_security_error":"Security Error","status_upload_limit":"Upload limit exceeded.","status_validation_failed":"Failed Validation. Upload skipped.","queue_limit":"You have attempted to queue too many files.","upload_limit_1":"You have reached the upload limit.","upload_limit_2":"You may select up to %s file(s)"},"notify_admin":"0","max_upl_size":"1024","timestamp":1339738610,"user":"YToyOntzOjc6InVzZXJfaWQiO3M6MToiMSI7czo5OiJwYXNzX2hhc2giO3M6MzI6IjFiZDU2OWI3MWE4NDY0YWExMWY5ZjM3NzZhMWQwMzBhIjt9","user_id":"1","allow_guests_enter_file_details":"0"};
/* ]]> */
</script>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/jquery.greybox.js"></script>
<script type="text/javascript" src="js/jquery.elastic.js"></script>
<script type="text/javascript" src="js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload/swfupload.swfobject.js"></script>
<script type="text/javascript" src="js/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="js/swfupload/fileprogress.js"></script>
<script type="text/javascript" src="js/swfupload/handlers.js"></script>
<script type="text/javascript" src="js/setup_swf_upload.js"></script>
<script type="text/javascript" src="js/upload.js"></script>
</head>

<body>
<table align="center" cellspacing="1" cellpadding="0" class="maintable ">
    <tr>
        <td colspan="2" class="tableb tableb_alternate">
                    第一步，選擇要新增的照片分類：
                      <select name="album" class="listbox" id="album">
                        <?php
do {  
?>
                        <option value="<?php echo $row_qa_re['qa_re_id']?>"<?php if (!(strcmp($row_qa_re['qa_re_id'], $_GET['qa_re_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_qa_re['qa_re_question']?></option>
                        <?php
} while ($row_qa_re = mysql_fetch_assoc($qa_re));
  $rows = mysql_num_rows($qa_re);
  if($rows > 0) {
      mysql_data_seek($qa_re, 0);
	  $row_qa_re = mysql_fetch_assoc($qa_re);
  }
?>
                      </select>
                      <br />
                      第二步，按下右方上傳按鈕，並一次選取多張照片，選擇完畢後請按下存檔：
                      <span id="browse_button_place_holder"></span><br />                    
第三步，若上傳過程中發現有不小心上傳錯誤的圖片，請按下右方取消按鈕，則還沒被上傳的圖片則會停止上傳的動作：<button id="button_cancel" onclick="swfu.cancelQueue();" disabled="disabled">
      <img src="images/icons/cancel.png" border="0" alt="" width="16" height="16" class="icon" />
          取消正在上傳的
      </button><br />第四步，上傳完畢後若要重新選則其它照片分類，請按下右方重新選擇連結：<a href="http://<?php echo $_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];?>">重新選擇</a> <span id="upload_status"><span id="upload_count">0</span> 個圖片上傳 </span><br /> 
      </td>
    </tr>
    <tr>
        <td colspan="2" class="tableb"><span class="fieldset flash" id="upload_progress"></span><span id="uploadedThumbnails"></span></td>
    </tr>
</table>
</body>
</html>
<?php
mysql_free_result($qa_re);
?>