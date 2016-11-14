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

$maxRows_Recordset1 = 20;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_connection, $connection);
if(isset($_POST['orders_uid'])) { $orders_uid = $_POST['orders_uid']; } else { $orders_uid = '-1'; }
if(isset($_POST['orders_date'])) { $orders_date = $_POST['orders_date']; } else { $orders_date = '-1'; }
if(isset($_POST['orders_customerName'])) { $orders_customerName = $_POST['orders_customerName']; } else { $orders_customerName = '-1'; }
if(isset($_POST['orders_customerEmail'])) { $orders_customerEmail = $_POST['orders_customerEmail']; } else { $orders_customerEmail = '-1'; }
if(isset($_POST['orders_customerPhone'])) { $orders_customerPhone = $_POST['orders_customerPhone']; } else { $orders_customerPhone = '-1'; }
if(empty($_POST['searchtype'])) { $query_Recordset1 = "SELECT orders_id, orders_uid, orders_grandtotal, orders_customerName, orders_customerEmail, orders_customerPhone, orders_paytype, orders_ok, orders_datetime FROM orders ORDER BY orders_datetime DESC"; }
if ($_POST['searchtype'] == '1') { $query_Recordset1 = "SELECT orders_id, orders_uid, orders_grandtotal, orders_customerName, orders_customerEmail, orders_customerPhone, orders_paytype, orders_ok, orders_datetime FROM orders WHERE orders_uid = '$orders_uid'"; }
if ($_POST['searchtype'] == '2') { $query_Recordset1 = "SELECT orders_id, orders_uid, orders_grandtotal, orders_customerName, orders_customerEmail, orders_customerPhone, orders_paytype, orders_ok, orders_datetime FROM orders WHERE orders_datetime >= '$orders_date' AND orders_datetime <= '$orders_date2' ORDER BY orders_datetime DESC"; }
if ($_POST['searchtype'] == '3') { $query_Recordset1 = "SELECT orders_id, orders_uid, orders_grandtotal, orders_customerName, orders_customerEmail, orders_customerPhone, orders_paytype, orders_ok, orders_datetime FROM orders WHERE orders_customerName = '$orders_customerName' ORDER BY orders_datetime DESC"; }
if ($_POST['searchtype'] == '4') { $query_Recordset1 = "SELECT orders_id, orders_uid, orders_grandtotal, orders_customerName, orders_customerEmail, orders_customerPhone, orders_paytype, orders_ok, orders_datetime FROM orders WHERE orders_customerEmail = '$orders_customerEmail' ORDER BY orders_datetime DESC"; }
if ($_POST['searchtype'] == '5') { $query_Recordset1 = "SELECT orders_id, orders_uid, orders_grandtotal, orders_customerName, orders_customerEmail, orders_customerPhone, orders_paytype, orders_ok, orders_datetime FROM orders WHERE orders_customerPhone = '$orders_customerPhone' ORDER BY orders_datetime DESC"; }
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
  $updateSQL = sprintf("UPDATE orders SET orders_customerName=%s, orders_customerEmail=%s, orders_customerPhone=%s WHERE orders_id=%s",
                       GetSQLValueString($_POST['orders_customerName'.$i], "text"),
					   GetSQLValueString($_POST['orders_customerEmail'.$i], "text"),
					   GetSQLValueString($_POST['orders_customerPhone'.$i], "text"),
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
 $deleteSQL = sprintf("DELETE FROM orders WHERE orders_id=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
					   
 $deleteSQL1 = sprintf("DELETE FROM ordersdetail WHERE orders_id=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
 $optimize = sprintf("OPTIMIZE TABLE orders");
 $optimize1 = sprintf("OPTIMIZE TABLE ordersdetail");
 
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
      </table><form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
      <table border="0" cellpadding="0" cellspacing="0" id="content">
        <tr>
          <td><div class="titleB">
            <div class="titleBText">
              
              <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?><input type="submit" name="button" id="button" value="批次更新" onmouseover="document.form1.action.value='fix'" onclick="tmt_confirm('確定更新當下頁面上的所有最新狀況嗎');return document.MM_returnValue;" /><input type="submit" name="button3" id="button3" value="批次刪除" onmouseover="document.form1.action.value='delete'" onclick="tmt_confirm('確定刪除所打勾的這些資料嗎');return document.MM_returnValue" /><input name="selectall" type="button" id="selectall" onClick="selAll();" value="全選"><input name="selectnone" type="button" id="selectnone" onClick="unselAll();" value="全取消"><input name="selectreverse" type="button" id="selectreverse" onClick="usel();" value="反向選取"><select name="jumpMenu2" id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)">
<?
$max_links = $totalPages_Recordset1+1; 
for ($page=1;$page<=$max_links;$page++) { 
$truepage = $page-1;
?> 
      <option value="<?php echo $PHP_SELF;?>?pageNum_Recordset1=<?php echo $truepage;?><?php echo $queryString_Recordset1;?>" <?php if (!(strcmp($truepage, $_GET['pageNum_Recordset1']))) {echo "selected=\"selected\"";} ?>>第<?php echo $page;?>頁</option>
<? } ?>
</select><input type="submit" name="button4" id="button4" value="送出查詢" onmouseover="document.form1.action.value='search'" /> <span id="Table1" style="display:<?php if($_POST['searchtype'] == 1) { ?>inline<? } else { ?>none<? } ?>"><input name="orders_uid" type="text" id="orders_uid" value="<?php echo $_POST['orders_uid'];?>" /></span><span id="Table2" style="display:<?php if($_POST['searchtype'] == 2) { ?>inline<? } else { ?>none<? } ?>">開始時間：<input name="orders_date" type="text" id="orders_date" value="<?php if(isset($_POST['orders_date'])) { echo $_POST['orders_date']; } else { ?><? echo date('Y-m-d H:i:s'); } ?>" /> 結束時間：<input name="orders_date2" type="text" id="orders_date2" value="<?php if(isset($_POST['orders_date2'])) { echo $_POST['orders_date2']; } else { ?><? echo date('Y-m-d H:i:s'); } ?>" /></span><span id="Table3" style="display:<?php if($_POST['searchtype'] == 3) { ?>inline<? } else { ?>none<? } ?>"><input name="orders_customerName" type="text" id="orders_customerName" value="<?php echo $_POST['orders_customerName'];?>" /></span><span id="Table4" style="display:<?php if($_POST['searchtype'] == 4) { ?>inline<? } else { ?>none<? } ?>"><input name="orders_customerEmail" type="text" id="orders_customerEmail" value="<?php echo $_POST['orders_customerEmail'];?>" /></span><span id="Table5" style="display:<?php if($_POST['searchtype'] == 5) { ?>inline<? } else { ?>none<? } ?>"><input name="orders_customerPhone" type="text" id="orders_customerPhone" value="<?php echo $_POST['orders_customerPhone'];?>" /></span><br />
              <input name="radiobutton" type="radio" id="radio3" onClick="maxjop(this);document.form1.searchtype.value='1'" value="maxjop" <?php if($_POST['searchtype'] == 1) { ?>checked="checked"<? } ?> />
              使用訂單編號搜尋
              <input name="radiobutton" type="radio" id="radio" onclick="maxjop(this);document.form1.searchtype.value='2'" value="maxjop2" <?php if($_POST['searchtype'] == 2) { ?>checked="checked"<? } ?> />
              使用訂購日期期範圍區間搜尋
              <input name="radiobutton" type="radio" id="radio" onclick="maxjop(this);document.form1.searchtype.value='3'" value="maxjop3" <?php if($_POST['searchtype'] == 3) { ?>checked="checked"<? } ?> />
              使用收件人名字搜尋
              <input name="radiobutton" type="radio" id="radio" onclick="maxjop(this);document.form1.searchtype.value='4'" value="maxjop4" <?php if($_POST['searchtype'] == 4) { ?>checked="checked"<? } ?> />
              使用EMAIL搜尋
              <input name="radiobutton" type="radio" id="radio" onclick="maxjop(this);document.form1.searchtype.value='5'" value="maxjop5" <?php if($_POST['searchtype'] == 5) { ?>checked="checked"<? } ?> />
              使用手機號碼搜尋<? } ?>
</div>
</div>
  <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?><table border="0" cellpadding="0" cellspacing="2" id="tableA">
    <tr>
      <th>訂單編號</th>
      <th>總金額</th>
      <th>收件人</th>
      <th>付款方式</th>
      <th>交易狀況</th>
      <th>EMAIL</th>
      <th>電話</th>
      <th>匯出</th>
      <th>修改</th>
      <th>刪除</th>
    </tr>
	<?php do { ?><?php
$startRow_startRow = $startRow_startRow+1;
$i = isset($startRow_startRow) ? $startRow_startRow : 0;	
?>
        <tr>
        <td align="center"><?php echo $row_Recordset1['orders_uid']; ?></td>
        <td align="center"><?php echo $row_Recordset1['orders_grandtotal']; ?></td>
        <td align="center"><input name="orders_customerName<?php echo $i; ?>" type="text" id="orders_customerName<?php echo $i; ?>" value="<?php echo $row_Recordset1['orders_customerName']; ?>" size="8" maxlength="4" /></td>
        <td align="center"><?php if($row_Recordset1['orders_paytype'] == '1') { ?>線上刷卡<? } ?><?php if($row_Recordset1['orders_paytype'] == '2') { ?>貨到付款<? } ?><?php if($row_Recordset1['orders_paytype'] == '3') { ?>ATM轉帳<? } ?><?php if($row_Recordset1['orders_paytype'] == '4') { ?>臨櫃匯款<? } ?></td>
        <td align="center"><?php if($row_Recordset1['orders_ok'] == '1') { ?>尚未付款<? } ?><?php if($row_Recordset1['orders_ok'] == '2') { ?>已付款未出貨<? } ?><?php if($row_Recordset1['orders_ok'] == '3') { ?>已出貨<? } ?></td>
        <td align="center"><input name="orders_customerEmail<?php echo $i; ?>" type="text" id="orders_customerEmail<?php echo $i; ?>" value="<?php echo $row_Recordset1['orders_customerEmail']; ?>" size="17" /></td>
        <td align="center"><input name="orders_customerPhone<?php echo $i; ?>" type="text" id="orders_customerPhone<?php echo $i; ?>" value="<?php echo $row_Recordset1['orders_customerPhone']; ?>" size="9" maxlength="10" /></td>
        <td align="center"><a href="excel.php?orders_id=<?php echo $row_Recordset1['orders_id']; ?>"><img src="images/icon_fix2.gif" width="16" height="16" border="0" /></a></td>
        <td align="center"><a href="orders_fix.php?orders_id=<?php echo $row_Recordset1['orders_id']; ?>"><img src="images/icon_fix.jpg" border="0" /></a></td>
        <td align="center"><input name="data_id<?php echo $i; ?>" type="hidden" id="data_id<?php echo $i; ?>" value="<?php echo $row_Recordset1['orders_id']; ?>" /><input name="mixdel<?php echo $i; ?>" type="checkbox" id="selecttype" value="<?php echo $row_Recordset1['orders_id']; ?>" /></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table><?php } // Show if recordset not empty ?>
  <input type="hidden" name="MM_update" value="form1" /><input type="hidden" name="action" id="action" /><input name="searchtype" type="hidden" id="searchtype" value="<?php echo $_POST['searchtype']; ?>" /></td>
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