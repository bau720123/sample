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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	  
  $updateSQL = sprintf("UPDATE qa_re SET ready=%s, qa_re_question=%s, qa_re_content=%s, ontime=%s, offtime=%s, sort=%s WHERE qa_re_id=%s",
                       GetSQLValueString($_POST['ready'], "int"),
					   GetSQLValueString($_POST['qa_re_question'], "text"),
					   GetSQLValueString($_POST['qa_re_content'], "text"),
					   GetSQLValueString($_POST['ontime'], "date"),
					   GetSQLValueString($_POST['offtime'], "date"),
					   GetSQLValueString($_POST['sort'], "int"),
                       GetSQLValueString($_POST['qa_re_id'], "int"));
  
  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "qa_re.php?qa_id=$_POST[qa_id]";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }

header(sprintf("Location: %s", $updateGoTo));
}

$colname_qa_re_detail = "-1";
if (isset($_GET['qa_re_id'])) {
  $colname_qa_re_detail = $_GET['qa_re_id'];
}
mysql_select_db($database_connection, $connection);
$query_qa_re_detail = sprintf("SELECT * FROM qa_re WHERE qa_re_id = %s", GetSQLValueString($colname_qa_re_detail, "int"));
$qa_re_detail = mysql_query($query_qa_re_detail, $connection) or die(mysql_error());
$row_qa_re_detail = mysql_fetch_assoc($qa_re_detail);
$totalRows_qa_re_detail = mysql_num_rows($qa_re_detail);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="admin.css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
function VF_form1(){
	var theForm = document.form1;
	var errMsg = "";
	var setfocus = "";

	if (theForm['qa_re_question'].value == ""){
		errMsg = "標題必須填寫";
		setfocus = "['qa_re_question']";
	}
	if (errMsg != ""){
		alert(errMsg);
		eval("theForm" + setfocus + ".focus()");
	}
	else { theForm.button.disabled=true;theForm.submit(); }
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
<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="VF_form1();return false;">
            <div class="titleB">
            
              <div class="titleBText">
              <input value="修改資料" name="button" type="submit" /><input name="qa_re_id" type="hidden" id="qa_re_id" value="<?php echo $row_qa_re_detail['qa_re_id']; ?>" /><input name="qa_id" type="hidden" id="qa_id" value="<?php echo $row_qa_re_detail['qa_id'];?>" /><input type="hidden" name="MM_update" value="form1" /></div>
              
            </div><table border="0" cellpadding="0" cellspacing="0" id="tableB">
            <tr>
                <td colspan="2" align="left" class="tdlight"><input <?php if (!(strcmp($row_qa_re_detail['ready'],1))) {echo "checked=\"checked\"";} ?> name="ready" type="checkbox" id="ready" value="1" />
                  發佈到前台</td>
                </tr>
                <tr>
                  <td align="left" class="tddark">上架時間</td>
                  <td align="left" class="tddark"><input name="ontime" type="text" id="ontime" value="<?php echo $row_qa_re_detail['ontime']; ?>" size="16" maxlength="19" /></td>
                </tr>
                <tr>
                  <td align="left" class="tddark">下架時間</td>
                  <td align="left" class="tddark"><input name="offtime" type="text" id="offtime" value="<?php echo $row_qa_re_detail['offtime']; ?>" size="16" maxlength="19" /></td>
                </tr>
            <tr>
                <td align="left" class="tdlight"><font color="#FF0000">*</font>標題</td>
<td align="left" class="tdlight"><input name="qa_re_question" type="text" id="qa_re_question" value="<?php echo $row_qa_re_detail['qa_re_question']; ?>"></td>
              </tr>
                <?php if($_GET['qa_typeid'] == '7') { ?><tr>
                <td align="left" class="tddark"><font color="#FF0000">*</font>自訂排序</td>
                <td align="left" class="tddark"><input name="sort" type="text" id="sort" value="<?php echo $row_qa_re_detail['sort']; ?>" /></td>
              </tr><? } ?>
              <tr>
                  <td align="left" class="tddark">建立時間</td>
                  <td align="left" class="tddark"><?php echo $row_qa_re_detail['nowtime']; ?></td>
                </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" id="tableB">
              <tr>
                <td align="left" class="tdlight">內容</td>
                </tr>
              <tr>
                <td align="left" class="tdlight"><textarea name="qa_re_content" id="qa_re_content"><?php echo $row_qa_re_detail['qa_re_content']; ?></textarea>
  <script type="text/javascript">
CKEDITOR.replace( 'qa_re_content');
</script>                </td>
                </tr>
            </table>
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
mysql_free_result($qa_re_detail);
?>