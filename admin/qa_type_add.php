<?php require_once('../Connections/connection.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "qa_type")) {
  $insertSQL = sprintf("INSERT INTO qa_type (qa_type_name, sort) VALUES (%s, %s)",
                       GetSQLValueString($_POST['qa_type_name'], "text"),
                       GetSQLValueString($_POST['sort'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());

  $insertGoTo = "qa_type.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_connection, $connection);
$query_max = "SELECT count(qa_typeid) as max_count FROM qa_type";
$max = mysql_query($query_max, $connection) or die(mysql_error());
$row_max = mysql_fetch_assoc($max);
$totalRows_max = mysql_num_rows($max);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="admin.css" />

<script type="text/javascript"><!--
function VF_qa_type(){ //v2.0
<!--start_of_saved_settings-->
<!--type,text,name,qa_type_name,required,true,errMsg,標題必須填寫-->
<!--end_of_saved_settings-->
	var theForm = document.qa_type;
	var errMsg = "";
	var setfocus = "";

	if (theForm['qa_type_name'].value == ""){
		errMsg = "標題必須填寫";
		setfocus = "['qa_type_name']";
	}
	if (errMsg != ""){
		alert(errMsg);
		eval("theForm" + setfocus + ".focus()");
	}
	else theForm.submit();
}
</script>
<script type="text/javascript" src="../javascript/jquery.min.js"></script>
<script type="text/javascript" src="../javascript/javascript.js"></script>
</head>

<body>
<?php require_once("admin_top.php")?>
<div id="topshort"></div>
<table border="0" cellpadding="0" cellspacing="10" width="100%">
  <tr>
    <?php require_once("admin_left.php")?>
    <td width="100%" valign="top">
      <table border="0" cellpadding="0" cellspacing="0" width="100%" id="title">
        <tr>
          <td background="images/title_name.jpg" width="139" valign="bottom" style="padding-bottom: 3px;" align="center"><strong>後台管理系統</strong></td>
          <td background="images/title_bg.gif" align="right"><img src="images/title_right.jpg" /></td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" id="content">
        <tr>
          <td>
<form action="<?php echo $editFormAction; ?>" method="post" name="qa_type" id="qa_type" onsubmit="VF_qa_type();return false;">
            <div class="titleB">
              <div class="titleBText">
<input value="新增資料" name="button" type="submit"></div>
            </div><table border="0" cellpadding="0" cellspacing="0" id="tableB">
              <tr>
                <td width="45%" align="left" class="tdlight"><font color="#FF0000">*</font>年度</td>
<td align="left" class="tdlight"><input name="qa_type_name" type="text" class="inputwidth" id="qa_type_name"></td>
              </tr>
              <tr>
                <td align="left" class="tddark"><font color="#FF0000">*</font>自訂排序</td>
                <td align="left" class="tddark"><input name="sort" type="text" class="inputwidth" id="sort" value="<?php echo $row_max['max_count']+1; ?>" /></td>
              </tr>
            </table>
            <input type="hidden" name="MM_insert" value="qa_type" />
</form>
          </td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td width="5" heihgt="7"><img src="images/bottom_left.jpg" /></td>
          <td background="images/bottom_middle.jpg" width="100%"></td>
          <td width="5" heihgt="7"><img src="images/bottom_right.jpg" /></td>         
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($max);
?>