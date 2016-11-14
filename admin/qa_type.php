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

mysql_select_db($database_connection, $connection);
$query_qa_type = "SELECT * FROM qa_type ORDER BY sort ASC";
$qa_type = mysql_query($query_qa_type, $connection) or die(mysql_error());
$row_qa_type = mysql_fetch_assoc($qa_type);
$totalRows_qa_type = mysql_num_rows($qa_type);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

for( $i=1 ; $i<=$totalRows_qa_type ; $i++ )
{ 
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1") && ($_POST["action"] == "fix")) {
  $updateSQL = sprintf("UPDATE qa_type SET qa_type_name=%s, sort=%s WHERE qa_typeid=%s",
                       GetSQLValueString($_POST['qa_type_name'.$i], "text"),
                       GetSQLValueString($_POST['sort'.$i], "int"),
                       GetSQLValueString($_POST['data_id'.$i], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1") && ($_POST["action"] == "delete")) {
 $deleteSQL = sprintf("DELETE FROM qa_type WHERE qa_typeid=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
					   
 $deleteSQL1 = sprintf("DELETE FROM qa WHERE qa_typeid=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
					   					   
$colname_activity_soon = "-1";
if (isset($_POST['mixdel'.$i])) {
  $colname_activity_soon = $_POST['mixdel'.$i];
}

  do
  {
   if(isset($_POST['mixdel'.$i]))
   {  
   $file1=iconv("utf-8", "big5", ''.$row_activity_soon['photo']);
   $file1_thum=iconv("utf-8", "big5", ''.$row_activity_soon['photo_thum']);
   @unlink($file1); //可在之前加上@符號-已利不出現錯誤
   @unlink($file1_thum); //可在之前加上@符號-已利不出現錯誤
   }
  } while ($row_activity_soon = mysql_fetch_assoc($activity_soon));
					       
  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  $Result2 = mysql_query($deleteSQL1, $connection) or die(mysql_error());

  $deleteGoTo = "";
  if (isset($_SERVER['QUERY_STRING'])) {
   $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
   $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
 header(sprintf("Location: %s", $deleteGoTo));
 }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="admin.css" />
<script type="text/javascript">
function tmt_confirm(msg){
	document.MM_returnValue=(confirm(unescape(msg)));
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
              <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>"><div class="titleB">
    <div class="titleBText">
      <input name="selectall" type="button" id="selectall" onclick="location.href='qa_type_add.php'" value="新增一筆資料"><?php if ($totalRows_qa_type > 0) { // Show if recordset not empty ?><input type="submit" name="button" id="button" value="批次更新" onmouseover="document.form1.action.value='fix'" onclick="tmt_confirm('確定更新當下頁面上的所有最新狀況嗎');return document.MM_returnValue" /><input type="submit" name="button3" id="button3" value="批次刪除" onmouseover="document.form1.action.value='delete'" onclick="tmt_confirm('確定刪除所打勾的這些資料嗎');return document.MM_returnValue" /><input name="selectall" type="button" id="selectall" onClick="selAll

();" value="全選"><input name="selectnone" type="button" id="selectnone" onClick="unselAll

();" value="全取消"><input name="selectreverse" type="button" id="selectreverse" 

onClick="usel();" value="反向選取"><? } ?>
    </div>
  </div>
      <?php if ($totalRows_qa_type > 0) { // Show if recordset not empty ?><table border="0" cellpadding="0" cellspacing="3" id="tableA">
        <tr>
      <th>自訂排序</th>
      <th>標題</th>
      <th>修改</th>
      <th>刪除</th>
      </tr>
	  <?php do { 
$startRow_startRow = $startRow_startRow+1;
$i = isset($startRow_startRow) ? $startRow_startRow : 0;	
	?>
      <tr>
        <td align="center" width="22%"><input name="data_id<?php echo $i; ?>" type="hidden" id="data_id<?php echo $i; ?>" value="<?php echo $row_qa_type['qa_typeid']; ?>" />
          <input name="sort<?php echo $i; ?>" type="text" id="sort<?php echo $i; ?>" value="<?php echo $row_qa_type['sort']; ?>" maxlength="5" /></td>

        <td align="center"><input name="qa_type_name<?php echo $i; ?>" type="text" id="qa_type_name<?php echo $i; ?>" value="<?php echo $row_qa_type['qa_type_name']; ?>" />
          </td>
        <td align="center" width="19%"><a href="qa_type_fix.php?qa_typeid=<?php echo $row_qa_type['qa_typeid']; ?>"><img src="images/icon_fix.jpg" border="0" /></a></td>
        <td align="center" width="22%"><input name="mixdel<?php echo $i; ?>" type="checkbox" id="selecttype" value="<?php echo $row_qa_type['qa_typeid']; ?>" /></td>
      </tr>
      <?php } while ($row_qa_type = mysql_fetch_assoc($qa_type)); ?>
</table><?php } // Show if recordset not empty ?>
      <input type="hidden" name="MM_update" value="form1" />
              <input type="hidden" name="action" id="action" />
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
mysql_free_result($qa_type);
?>