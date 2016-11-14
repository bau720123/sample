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

$currentPage = $_SERVER["PHP_SELF"];

if (isset($_GET['qa_typeid'])) {
  $colname_qa = $_GET['qa_typeid'];
}
mysql_select_db($database_connection, $connection);
$query_qa = sprintf("SELECT qa_id, qa_typeid, qa_question, sort FROM qa WHERE qa_typeid = %s ORDER BY sort ASC", GetSQLValueString($colname_qa, "int"));
$qa = mysql_query($query_qa, $connection) or die(mysql_error());
$row_qa = mysql_fetch_assoc($qa);
$totalRows_qa = mysql_num_rows($qa);

if ($_GET['qa_typeid'] == 2) { $maxRows_Recordset1 = $row_data_detail['data_1']; }
if ($_GET['qa_typeid'] == 3) { $maxRows_Recordset1 = $row_data_detail['data_2']; }
if ($_GET['qa_typeid'] == 4) { $maxRows_Recordset1 = $row_data_detail['data_5']; }
if ($_GET['qa_typeid'] == 7) { $maxRows_Recordset1 = 20; }
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['qa_id'])) {
  $colname_Recordset1 = $_GET['qa_id'];
}
mysql_select_db($database_connection, $connection);
if($_GET['qa_typeid'] == '4')
{
$query_Recordset1 = sprintf("SELECT qa_re.*, member_name FROM qa_re LEFT JOIN member ON qa_re.member_id = member.member_id GROUP BY qa_re_id HAVING qa_id = %s ORDER BY nowtime DESC", GetSQLValueString($colname_Recordset1, "int"));
}
if($_GET['qa_typeid'] == '2' || $_GET['qa_typeid'] == '3' || $_GET['qa_typeid'] == '7')
{
$query_Recordset1 = sprintf("SELECT qa_re.*, member_name FROM qa_re LEFT JOIN member ON qa_re.member_id = member.member_id GROUP BY qa_re_id HAVING qa_id = %s ORDER BY sort ASC", GetSQLValueString($colname_Recordset1, "int"));
}
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

for( $i=1 ; $i<=$totalRows_Recordset1 ; $i++ )
{
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1") && ($_POST["action"] == "fix")) {
  $updateSQL = sprintf("UPDATE qa_re SET ready=%s, qa_re_question=%s, ontime=%s, offtime=%s, sort=%s WHERE qa_re_id=%s",
                       GetSQLValueString($_POST['ready'.$i], "text"),
					   GetSQLValueString($_POST['qa_re_question'.$i], "text"),
					   GetSQLValueString($_POST['ontime'.$i], "date"),
					   GetSQLValueString($_POST['offtime'.$i], "date"),
                       GetSQLValueString($_POST['sort'.$i], "int"),
                       GetSQLValueString($_POST['data_id'.$i], "int"));

  mysql_select_db($database_connection, $connection);
  $update1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
 
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1") && ($_POST["action"] == "delete")) {
 $deleteSQL = sprintf("DELETE FROM qa_re WHERE qa_re_id=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
 $deleteSQL1 = sprintf("DELETE FROM class3 WHERE qa_re_id=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
 $optimize = sprintf("OPTIMIZE TABLE qa_re");
 $optimize1 = sprintf("OPTIMIZE TABLE class3");
 
 if(isset($_POST['mixdel'.$i]))
  {  
//把所有的產品資料的圖片也予以刪除
$colname_class3_photo = "-1";
if (isset($_POST['mixdel'.$i])) {
$colname_class3_photo = $_POST['mixdel'.$i];
}
mysql_select_db($database_connection, $connection);
$query_class3_photo = sprintf("SELECT qa_id, photo, photo_thum, qrcode FROM class3 WHERE qa_re_id = %s ORDER BY class3_id ASC", GetSQLValueString($colname_class3_photo, "int"));
$class3_photo = mysql_query($query_class3_photo, $connection) or die(mysql_error());
$row_class3_photo = mysql_fetch_assoc($class3_photo);
$totalRows_class3_photo = mysql_num_rows($class3_photo);

do 
{
$file_photo=iconv("utf-8", "big5", ''.$row_class3_photo['photo']);
$file_photo_thum=iconv("utf-8", "big5", ''.$row_class3_photo['photo_thum']);
$file_qrcode=iconv("utf-8", "big5", ''.$row_class3_photo['qrcode']);
@unlink($file_photo); //可在之前加上@符號-已利不出現錯誤
@unlink($file_photo_thum); //可在之前加上@符號-已利不出現錯誤
@unlink($file_qrcode); //可在之前加上@符號-已利不出現錯誤
} while ($row_class3_photo = mysql_fetch_assoc($class3_photo));
mysql_free_result($class3_photo);
  }
					   					       
  mysql_select_db($database_connection, $connection);
  $delete1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  $delete2 = mysql_query($deleteSQL1, $connection) or die(mysql_error());
  $opt1 = mysql_query($optimize, $connection) or die(mysql_error());
  $opt2 = mysql_query($optimize1, $connection) or die(mysql_error());
  
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
  <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table border="0" cellpadding="0" cellspacing="0" id="content">
    <tr>
      <td>
        <div class="titleB">
    <div class="titleBText">
      <?php if(isset($_GET['qa_id'])) { ?><input name="selectall" type="button" id="selectall" onclick="this.disabled=true;location.href='qa_re_add.php?qa_id=<?php echo $_REQUEST['qa_id'];?>&qa_typeid=<?php echo $_REQUEST['qa_typeid'];?>'" value="新增一筆資料" /><? } ?><?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?><input type="submit" name="button" id="button" value="批次更新" onmouseover="document.form1.action.value='fix'" onclick="tmt_confirm('確定更新當下頁面上的所有最新狀況嗎');return document.MM_returnValue" /><input type="submit" name="button3" id="button3" value="批次刪除" onmouseover="document.form1.action.value='delete'" onclick="tmt_confirm('確定刪除所打勾的這些資料嗎');return document.MM_returnValue" /><input name="selectall" type="button" id="selectall" onClick="selAll

();" value="全選"><input name="selectnone" type="button" id="selectnone" onClick="unselAll

();" value="全取消"><input name="selectreverse" type="button" id="selectreverse" 

onClick="usel();" value="反向選取"><select name="jumpMenu2" id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)">
<?
$max_links = $totalPages_Recordset1+1; 
for ($page=1;$page<=$max_links;$page++) { 
$truepage = $page-1;
?> 
      <option value="<?php echo $PHP_SELF;?>?pageNum_Recordset1=<?php echo $truepage;?><?php echo $queryString_Recordset1;?>" <?php if (!(strcmp($truepage, $_GET['pageNum_Recordset1']))) {echo "selected=\"selected\"";} ?>>第<?php echo $page;?>頁</option>
<? } ?>
</select><? } ?><select name="qa_id" id="qa_id" onchange="MM_jumpMenu('parent',this,0)">
        <option value="" selected="selected">請選取<?php if($_GET['qa_typeid'] == '4') { ?>討論主題<? } ?><?php if($_GET['qa_typeid'] == '7') { ?>產品種類<? } ?></option>
        <?php
do {  
?>
        <option value="?qa_id=<?php echo $row_qa['qa_id']?>&qa_typeid=<?php echo $row_qa['qa_typeid']?>"<?php if (!(strcmp($row_qa['qa_id'], $_GET['qa_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_qa['qa_question']?></option>
<?php
} while ($row_qa = mysql_fetch_assoc($qa));
  $rows = mysql_num_rows($qa);
  if($rows > 0) {
      mysql_data_seek($qa, 0);
	  $row_qa = mysql_fetch_assoc($qa);
  }
?>
      </select>
      <input name="qa_id" type="hidden" id="qa_id" value="<?php echo $_REQUEST['qa_id']; ?>" />
      </div>
  </div><?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?><table border="0" cellpadding="0" cellspacing="2" id="tableA">
          <tr>
            <th>發佈人</th>
            <?php if($_GET['qa_typeid'] == '7') { ?><th>自訂排序</th><? } ?>
            <th>標題</th>
            <th>上架時間</th>
            <th>下架時間</th>
            <th>發佈</th>
            <th>修改</th>
            <th>刪除</th>
          </tr>
          <?php do { ?><?php
$startRow_startRow = $startRow_startRow+1;
$i = isset($startRow_startRow) ? $startRow_startRow : 0;	
?>
              <tr>
              <td align="center"><?php if($row_Recordset1['member_id'] == '0') { ?>系統管理者<? } else { ?><?php echo $row_Recordset1['member_name']; ?><? } ?></td>
              <?php if($_GET['qa_typeid'] == '7') { ?><td align="center">                <input name="sort<?php echo $i; ?>" type="text" id="sort<?php echo $i; ?>" value="<?php echo $row_Recordset1['sort']; ?>" size="4" /></td><? } ?>
              <td align="center"><input name="qa_re_question<?php echo $i; ?>" type="text" id="qa_re_question<?php echo $i; ?>" value="<?php echo $row_Recordset1['qa_re_question']; ?>" size="14" /></td>
              <td align="center"><input name="ontime<?php echo $i; ?>" type="text" id="ontime<?php echo $i; ?>" value="<?php echo $row_Recordset1['ontime']; ?>" size="16" maxlength="19" /></td>
              <td align="center"><input name="offtime<?php echo $i; ?>" type="text" id="offtime<?php echo $i; ?>" value="<?php echo $row_Recordset1['offtime']; ?>" size="16" maxlength="19" /></td>
              <td align="center"><input <?php if (!(strcmp($row_Recordset1['ready'],1))) {echo "checked=\"checked\"";} ?> name="ready<?php echo $i; ?>" type="checkbox" id="ready<?php echo $i; ?>" value="1" /></td>
              <td align="center"><a href="qa_re_fix.php?qa_re_id=<?php echo $row_Recordset1['qa_re_id']; ?>&qa_typeid=<?php echo $_GET['qa_typeid']; ?>"><img src="images/icon_fix.jpg" border="0" /></a></td>
              <td align="center"><input name="data_id<?php echo $i; ?>" type="hidden" id="data_id<?php echo $i; ?>" value="<?php echo $row_Recordset1['qa_re_id']; ?>" /><input name="mixdel<?php echo $i; ?>" type="checkbox" id="selecttype" value="<?php echo $row_Recordset1['qa_re_id']; ?>" /></td>
            </tr>
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        </table><?php } // Show if recordset not empty ?>
<input type="hidden" name="MM_update" 
value="form1" /><input type="hidden" name="action" id="action" /></td>
    </tr>
  </table>
      </form>
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
mysql_free_result($qa);

mysql_free_result($Recordset1);
?>