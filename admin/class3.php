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

$maxRows_Recordset1 = $row_data_detail['data_6'];
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['qa_re_id'])) {
  $colname_Recordset1 = $_GET['qa_re_id'];
}

$colname1_Recordset1 = "-1";
if (isset($_GET['qa_id'])) {
  $colname1_Recordset1 = $_GET['qa_id'];
}

mysql_select_db($database_connection, $connection);
$query_Recordset1 = sprintf("SELECT class3_id, qa_re_id, qa_id, ready, class3_name, class3_price, class3_price2, photo, photo_thum, qrcode , photo1, photo1_thum, photo2, photo2_thum, photo3, photo3_thum, photo4, photo4_thum, ontime, offtime, nowtime, sort FROM class3 WHERE qa_re_id = %s AND qa_id = %s ORDER BY sort ASC", GetSQLValueString($colname_Recordset1, "int"),GetSQLValueString($colname1_Recordset1, "int"));
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
  $updateSQL = sprintf("UPDATE class3 SET ready=%s, class3_name=%s, class3_price=%s, class3_price2=%s, ontime=%s, offtime=%s, sort=%s WHERE class3_id=%s",
                       GetSQLValueString($_POST['ready'.$i], "int"),
                       GetSQLValueString($_POST['class3_name'.$i], "text"),
                       GetSQLValueString($_POST['class3_price'.$i], "int"),
                       GetSQLValueString($_POST['class3_pricee'.$i], "int"),
					   GetSQLValueString($_POST['ontime'.$i], "date"),
					   GetSQLValueString($_POST['offtime'.$i], "date"),                       
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
 $deleteSQL = sprintf("DELETE FROM class3 WHERE class3_id=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
 $optimize = sprintf("OPTIMIZE TABLE class3");
 
  if(isset($_POST['mixdel'.$i]))
  {
  $file1=iconv("utf-8", "big5", ''.$_POST['1photo'.$i]);
  $file1_thum=iconv("utf-8", "big5", ''.$_POST['1photo_thum'.$i]);
  $qrcode=iconv("utf-8", "big5", ''.$_POST['qrcode'.$i]);
  @unlink($file1); //可在之前加上@符號-已利不出現錯誤
  @unlink($file1_thum); //可在之前加上@符號-已利不出現錯誤
  @unlink($qrcode); //可在之前加上@符號-已利不出現錯誤
  
  $file2_file=iconv("utf-8", "big5", ''.$_POST['2photo'.$i]);
  $file2_thum=iconv("utf-8", "big5", ''.$_POST['2photo_thum'.$i]);
  @unlink($file2_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file2_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file3_file=iconv("utf-8", "big5", ''.$_POST['3photo'.$i]);
  $file3_thum=iconv("utf-8", "big5", ''.$_POST['3photo_thum'.$i]);
  @unlink($file3_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file3_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file4_file=iconv("utf-8", "big5", ''.$_POST['4photo'.$i]);
  $file4_thum=iconv("utf-8", "big5", ''.$_POST['4photo_thum'.$i]);
  @unlink($file4_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file4_thum); //可在之前加上@符號-已利不出現錯誤
  
  $file5_file=iconv("utf-8", "big5", ''.$_POST['5photo'.$i]);
  $file5_thum=iconv("utf-8", "big5", ''.$_POST['5photo_thum'.$i]);
  @unlink($file5_file); //可在之前加上@符號-已利不出現錯誤
  @unlink($file5_thum); //可在之前加上@符號-已利不出現錯誤
  }

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  $Result2 = mysql_query($optimize, $connection) or die(mysql_error());

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
          <td background="images/title_name.jpg" width="139" valign="bottom" style="padding-bottom: 3px;" align="center"><strong>後台管理系統 </strong></td>
          <td background="images/title_bg.gif" align="right"><img src="images/title_right.jpg" /></td>
        </tr>
      </table>
      <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
      <table border="0" cellpadding="0" cellspacing="0" id="content">
        <tr>
          <td>
              <div class="titleB">
    <div class="titleBText">
      <input name="selectall" type="button" id="selectall" onclick="this.disabled=true;location.href='class3_add.php?qa_re_id=<?php echo $_REQUEST['qa_re_id'];?>&qa_id=<?php echo $_REQUEST['qa_id'];?>'" value="新增一筆資料" /><input name="insertall" type="button" id="insertall" onclick="window.open('cpg15x/cpg15x.php?qa_re_id=<?php echo $_REQUEST['qa_re_id'];?>&qa_id=<?php echo $_REQUEST['qa_id'];?>')" value=" 批次新增圖片資料" /><?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?><input type="submit" name="button" id="button" value="批次更新" onmouseover="document.form1.action.value='fix'" onclick="tmt_confirm('確定更新當下頁面上的所有最新狀況嗎');return document.MM_returnValue" /><input type="submit" name="button3" id="button3" value="批次刪除" onmouseover="document.form1.action.value='delete'" onclick="tmt_confirm('確定刪除所打勾的這些資料嗎');return document.MM_returnValue" /><input name="selectall" type="button" id="selectall" onClick="selAll();" value="全選"><input name="selectnone" type="button" id="selectnone" onClick="unselAll();" value="全取消"><input name="selectreverse" type="button" id="selectreverse" onClick="usel();" value="反向選取"><select name="jumpMenu2" id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)">
<?
$max_links = $totalPages_Recordset1+1; 
for ($page=1;$page<=$max_links;$page++) { 
$truepage = $page-1;
?> 
      <option value="<?php echo $PHP_SELF;?>?pageNum_Recordset1=<?php echo $truepage;?><?php echo $queryString_Recordset1;?>" <?php if (!(strcmp($truepage, $_GET['pageNum_Recordset1']))) {echo "selected=\"selected\"";} ?>>第<?php echo $page;?>頁</option>
<? } ?>
</select><? } ?></div>
</div><?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?><table border="0" cellpadding="0" cellspacing="2" id="tableA">
                <tr>
                  <th colspan="2">圖片</th>
                  <th>自訂排序</th>
                  <th>標題</th>
                  <th>售價</th>
                  <th>原價</th>
                  <th>上架時間</th>
                  <th>下架時間</th>
                  <th>規格</th>
                  <th>發佈</th>
                  <th>修改</th>
                  <th>刪除</th>
                </tr>
				  <?php do { ?><?php
$startRow_startRow = $startRow_startRow+1;
$i = isset($startRow_startRow) ? $startRow_startRow : 0;	
?>
                  <tr>
                    <td colspan="2" align="center"><input name="1photo<?php echo $i; ?>" type="hidden" id="1photo<?php echo $i; ?>" value="<?php echo $row_Recordset1['photo']; ?>" />
                      <input name="1photo_thum<?php echo $i; ?>" type="hidden" id="1photo_thum<?php echo $i; ?>" value="<?php echo $row_Recordset1['photo_thum']; ?>" />
                      <input name="qrcode<?php echo $i; ?>" type="hidden" id="qrcode<?php echo $i; ?>" value="<?php echo $row_Recordset1['qrcode']; ?>" />                      
                    <img src="<?php echo $row_Recordset1['photo_thum']; ?>" width="46" /><!--<img src="https://chart.googleapis.com/chart?cht=qr&chs=120x120&choe=UTF-8&chld=L|1&chl=http://<?php echo $_SERVER["HTTP_HOST"]; ?>/product_detail.php?class3_id=<?php echo $row_Recordset1['class3_id']; ?>%26qa_re_id=<?php echo $row_Recordset1['qa_re_id']; ?>%26qa_id=<?php echo $row_Recordset1['qa_id']; ?>" />--><input name="2photo<?php echo $i; ?>" type="hidden" id="2photo<?php echo $i; ?>" value="<?php echo $row_Recordset1['photo1']; ?>" />
                    <input name="2photo_thum<?php echo $i; ?>" type="hidden" id="2photo_thum<?php echo $i; ?>" value="<?php echo $row_Recordset1['photo1_thum']; ?>" />
                    <input name="3photo<?php echo $i; ?>" type="hidden" id="3photo<?php echo $i; ?>" value="<?php echo $row_Recordset1['photo2']; ?>" />
                    <input name="3photo_thum<?php echo $i; ?>" type="hidden" id="3photo_thum<?php echo $i; ?>" value="<?php echo $row_Recordset1['photo2_thum']; ?>" />
                    <input name="4photo<?php echo $i; ?>" type="hidden" id="4photo<?php echo $i; ?>" value="<?php echo $row_Recordset1['photo3']; ?>" />
                    <input name="4photo_thum<?php echo $i; ?>" type="hidden" id="4photo_thum<?php echo $i; ?>" value="<?php echo $row_Recordset1['photo3_thum']; ?>" />
                    <input name="5photo<?php echo $i; ?>" type="hidden" id="5photo<?php echo $i; ?>" value="<?php echo $row_Recordset1['photo4']; ?>" />
                    <input name="5photo_thum<?php echo $i; ?>" type="hidden" id="5photo_thum<?php echo $i; ?>" value="<?php echo $row_Recordset1['photo4_thum']; ?>" /></td>
                    <td align="center">                      <input name="sort<?php echo $i; ?>" type="text" id="sort<?php echo $i; ?>" value="<?php echo $row_Recordset1['sort']; ?>" size="4" />
                    </td>
                    <td align="center"><input name="class3_name<?php echo $i; ?>" type="text" id="class3_name<?php echo $i; ?>" value="<?php echo $row_Recordset1['class3_name']; ?>" size="14" /></td>
                    <td align="center"><input name="class3_price<?php echo $i; ?>" type="text" id="class3_price<?php echo $i; ?>" value="<?php echo $row_Recordset1['class3_price']; ?>" size="4"></td>
                    <td align="center"><input name="class3_pricee<?php echo $i; ?>" type="text" id="class3_pricee<?php echo $i; ?>" value="<?php echo $row_Recordset1['class3_price2']; ?>" size="4"></td>
                    <td align="center"><input name="ontime<?php echo $i; ?>" type="text" id="ontime<?php echo $i; ?>" value="<?php echo $row_Recordset1['ontime']; ?>" size="16" maxlength="19" /></td>
              <td align="center"><input name="offtime<?php echo $i; ?>" type="text" id="offtime<?php echo $i; ?>" value="<?php echo $row_Recordset1['offtime']; ?>" size="16" maxlength="19" /></td>
              <td align="center"><a href="qa.php?class3_id=<?php echo $row_Recordset1['class3_id']; ?>&qa_typeid=8"><img src="images/icon_fix2.gif" width="16" height="16" border="0" /></a></td>
                <td align="center"><input <?php if (!(strcmp($row_Recordset1['ready'],1))) {echo "checked=\"checked\"";} ?> name="ready<?php echo $i; ?>" type="checkbox" id="ready<?php echo $i; ?>" value="1" /></td>
                <td align="center"><a href="class3_fix.php?class3_id=<?php echo $row_Recordset1['class3_id']; ?>&qa_re_id=<?php echo $row_Recordset1['qa_re_id']; ?>&qa_id=<?php echo $row_Recordset1['qa_id']; ?>"><img src="images/icon_fix.jpg" /></a></td>
                    <td align="center"><input name="data_id<?php echo $i; ?>" type="hidden" id="data_id<?php echo $i; ?>" value="<?php echo $row_Recordset1['class3_id']; ?>" /><input name="mixdel<?php echo $i; ?>" type="checkbox" id="selecttype" value="<?php echo $row_Recordset1['class3_id']; ?>" /></td>
                  </tr>
                  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
              </table><?php } // Show if recordset not empty ?>
              <input type="hidden" name="action" id="action" /><input type="hidden" name="MM_update" value="form1" />
              </td>
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
mysql_free_result($Recordset1);
?>