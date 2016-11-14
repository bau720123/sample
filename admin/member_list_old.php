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

$colname_Recordset1 = "-1";
if (isset($_GET['member_level'])) {
  $colname_Recordset1 = $_GET['member_level'];
}
mysql_select_db($database_connection, $connection);
if(isset($_POST['member_username'])) { $member_username = $_POST['member_username']; } else { $member_username = '-1'; }
if(isset($_POST['member_name'])) { $member_name = $_POST['member_name']; } else { $member_name = '-1'; }
if(isset($_POST['member_uid'])) { $member_uid = $_POST['member_uid']; } else { $member_uid = '-1'; }
if(isset($_POST['member_email'])) { $member_email = $_POST['member_email']; } else { $member_email = '-1'; }
if(isset($_POST['member_phone'])) { $member_phone = $_POST['member_phone']; } else { $member_phone = '-1'; }
if(empty($_POST['searchtype'])) 
{ 
$query_Recordset1 = sprintf("SELECT member_uid, member_level, member_id, member_username, member_name, member_phone, member_email, member_sex, member_ok, nowtime FROM member WHERE member_level =%s ORDER BY nowtime DESC", GetSQLValueString($colname_Recordset1, "int"));
}
if ($_POST['searchtype'] == '1') 
{ 
$query_Recordset1 = sprintf("SELECT member_uid, member_level, member_id, member_username, member_name, member_phone, member_email, member_sex, member_ok, nowtime FROM member WHERE member_username = '$member_username' AND member_level = %s ORDER BY nowtime DESC", GetSQLValueString($colname_Recordset1, "int"));
}
if ($_POST['searchtype'] == '2') 
{ 
$query_Recordset1 = sprintf("SELECT member_uid, member_level, member_id, member_username, member_name, member_phone, member_email, member_sex, member_ok, nowtime FROM member WHERE member_name = '$member_name' AND member_level = %s ORDER BY nowtime DESC", GetSQLValueString($colname_Recordset1, "int"));
}
if ($_POST['searchtype'] == '3') 
{ 
$query_Recordset1 = sprintf("SELECT member_uid,member_level, member_id, member_username, member_name, member_phone, member_email, member_sex, member_ok, nowtime FROM member WHERE member_uid = '$member_uid' AND member_level = %s ORDER BY nowtime DESC", GetSQLValueString($colname_Recordset1, "int"));
}
if ($_POST['searchtype'] == '4') 
{ 
$query_Recordset1 = sprintf("SELECT member_uid, member_level, member_id, member_username, member_name, member_phone, member_email, member_sex, member_ok, nowtime FROM member WHERE member_email = '$member_email' AND member_level = %s ORDER BY nowtime DESC", GetSQLValueString($colname_Recordset1, "int"));
}
if ($_POST['searchtype'] == '5') 
{ 
$query_Recordset1 = sprintf("SELECT member_uid, member_level, member_id, member_username, member_name, member_phone, member_email, member_sex, member_ok, nowtime FROM member WHERE member_phone = '$member_phone' AND member_level = %s ORDER BY nowtime DESC", GetSQLValueString($colname_Recordset1, "int"));
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
  $updateSQL = sprintf("UPDATE member SET member_ok=%s, member_username=%s, member_uid=%s,member_name=%s, member_phone=%s, member_email=%s, member_sex=%s WHERE member_id=%s",
                       GetSQLValueString($_POST['member_ok'.$i], "int"),
					   GetSQLValueString($_POST['member_username'.$i], "text"),
					   GetSQLValueString($_POST['member_uid'.$i], "text"),
					   GetSQLValueString($_POST['member_name'.$i], "text"),
					   GetSQLValueString($_POST['member_phone'.$i], "text"),
					   GetSQLValueString($_POST['member_email'.$i], "text"),
					   GetSQLValueString($_POST['member_sex'.$i], "text"),
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
 $deleteSQL = sprintf("DELETE FROM member WHERE member_id=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
					   
 $deleteSQL1 = sprintf("DELETE FROM qa WHERE member_id=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
					   
 $deleteSQL2 = sprintf("DELETE FROM qa_re WHERE member_id=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
					   
 $deleteSQL3 = sprintf("DELETE FROM orders WHERE member_id=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
					   
 $deleteSQL4 = sprintf("DELETE FROM ordersdetail WHERE member_id=%s",
                       GetSQLValueString($_POST['mixdel'.$i], "int"));
					   
  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
  $Result2 = mysql_query($deleteSQL1, $connection) or die(mysql_error());
  $Result3 = mysql_query($deleteSQL2, $connection) or die(mysql_error());
  $Result4 = mysql_query($deleteSQL3, $connection) or die(mysql_error());
  $Result5 = mysql_query($deleteSQL4, $connection) or die(mysql_error());

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
              
              <input name="selectall" type="button" id="selectall" onclick="this.disabled=true;location.href='member_add.php?member_level=<?php echo $_GET['member_level']?>'" value="新增一筆資料" /><?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?><input type="submit" name="button" id="button" value="批次更新" onmouseover="document.form1.action.value='fix'" onclick="tmt_confirm('確定更新當下頁面上的所有最新狀況嗎');return document.MM_returnValue;" /><input type="submit" name="button3" id="button3" value="批次刪除" onmouseover="document.form1.action.value='delete'" onclick="tmt_confirm('確定刪除所打勾的這些資料嗎');return document.MM_returnValue" /><input name="selectall" type="button" id="selectall" onClick="selAll

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
</select><input type="submit" name="button4" id="button4" value="送出查詢" onmouseover="document.form1.action.value='search'" /> <span id="Table1" style="display:<?php if($_POST['searchtype'] == 1) { ?>inline<? } else { ?>none<? } ?>"><input name="member_username" type="text" id="member_username" value="<?php echo $_POST['member_username'];?>" /></span><span id="Table2" style="display:<?php if($_POST['searchtype'] == 2) { ?>inline<? } else { ?>none<? } ?>"><input name="member_name" type="text" id="member_name" value="<?php echo $_POST['member_name'];?>" /></span><span id="Table3" style="display:<?php if($_POST['searchtype'] == 3) { ?>inline<? } else { ?>none<? } ?>"><input name="member_uid" type="text" id="member_uid" value="<?php echo $_POST['member_uid'];?>" /></span><span id="Table4" style="display:<?php if($_POST['searchtype'] == 4) { ?>inline<? } else { ?>none<? } ?>"><input name="member_email" type="text" id="member_email" value="<?php echo $_POST['member_email'];?>" /></span><span id="Table5" style="display:<?php if($_POST['searchtype'] == 5) { ?>inline<? } else { ?>none<? } ?>"><input name="member_phone" type="text" id="member_phone" value="<?php echo $_POST['member_phone'];?>" /></span><br />
              <input name="radiobutton" type="radio" id="radio" onClick="maxjop(this);document.form1.searchtype.value='1'" value="maxjop" <?php if($_POST['searchtype'] == 1) { ?>checked="checked"<? } ?> />
              使用帳號搜尋
              <input name="radiobutton" type="radio" id="radio" onclick="maxjop(this);document.form1.searchtype.value='2'" value="maxjop2" <?php if($_POST['searchtype'] == 2) { ?>checked="checked"<? } ?> />
              使用姓名搜尋
              <input name="radiobutton" type="radio" id="radio" onclick="maxjop(this);document.form1.searchtype.value='3'" value="maxjop3" <?php if($_POST['searchtype'] == 3) { ?>checked="checked"<? } ?> />
              使用身分證字號搜尋
              <input name="radiobutton" type="radio" id="radio" onclick="maxjop(this);document.form1.searchtype.value='4'" value="maxjop4" <?php if($_POST['searchtype'] == 4) { ?>checked="checked"<? } ?> />
              使用EMAIL搜尋
              <input name="radiobutton" type="radio" id="radio" onclick="maxjop(this);document.form1.searchtype.value='5'" value="maxjop5" <?php if($_POST['searchtype'] == 5) { ?>checked="checked"<? } ?> />
使用手機號碼搜尋<? } ?>
</div>
          </div><?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?><table border="0" cellpadding="0" cellspacing="2" id="tableA">
    <tr>
      <th>認證狀態</th>
      <th>帳號</th>
      <th>身分證字號</th>
      <th>姓名</th>
      <th>手機號碼</th>
      <th>EMAIL</th>
      <th>性別</th>
      <th>修改</th>
      <th>刪除</th>
    </tr>
    <?php do { ?><?php
$startRow_startRow = $startRow_startRow+1;
$i = isset($startRow_startRow) ? $startRow_startRow : 0;	
?>
        <tr>
        <td align="center"><select name="member_ok<?php echo $i; ?>" id="member_ok<?php echo $i; ?>">
                  <option value="0" <?php if (!(strcmp(0, $row_Recordset1['member_ok']))) {echo "selected=\"selected\"";} ?>>未認證</option>
                  <option value="1" <?php if (!(strcmp(1, $row_Recordset1['member_ok']))) {echo "selected=\"selected\"";} ?>>已認證</option>
                  <option value="2" <?php if (!(strcmp(2, $row_Recordset1['member_ok']))) {echo "selected=\"selected\"";} ?>>黑名單</option>
                </select></td>
        <td align="center"><input name="member_username<?php echo $i; ?>" type="text" id="member_username<?php echo $i; ?>" value="<?php echo $row_Recordset1['member_username']; ?>" size="10" maxlength="10"></td>
        <td align="center"><input name="member_uid<?php echo $i; ?>" type="text" id="member_uid<?php echo $i; ?>" value="<?php echo $row_Recordset1['member_uid']; ?>" size="10" maxlength="10"></td>
        <td align="center"><input name="member_name<?php echo $i; ?>" type="text" id="member_name<?php echo $i; ?>" value="<?php echo $row_Recordset1['member_name']; ?>" size="8" maxlength="4"></td>
        <td align="center"><input name="member_phone<?php echo $i; ?>" type="text" id="member_phone<?php echo $i; ?>" value="<?php echo $row_Recordset1['member_phone']; ?>" size="9" maxlength="10"></td>
        <td align="center"><input name="member_email<?php echo $i; ?>" type="text" id="member_email<?php echo $i; ?>" value="<?php echo $row_Recordset1['member_email']; ?>" size="17"></td>
        <td align="center"><select name="member_sex<?php echo $i; ?>" id="member_sex<?php echo $i; ?>">
                  <option value="男" selected="selected" <?php if (!(strcmp("男", $row_Recordset1['member_sex']))) {echo "selected=\"selected\"";} ?>>男生</option>
                  <option value="女" <?php if (!(strcmp("女", $row_Recordset1['member_sex']))) {echo "selected=\"selected\"";} ?>>女生</option>
                </select></td>
        <td align="center"><a href="member_fix.php?member_id=<?php echo $row_Recordset1['member_id']; ?>&member_level=<?php echo $row_Recordset1['member_level']; ?>"><img src="images/icon_fix.jpg" border="0" /></a></td>
        <td align="center"><input name="data_id<?php echo $i; ?>" type="hidden" id="data_id<?php echo $i; ?>" value="<?php echo $row_Recordset1['member_id']; ?>" /><input name="mixdel<?php echo $i; ?>" type="checkbox" id="selecttype" value="<?php echo $row_Recordset1['member_id']; ?>" /></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table><?php } // Show if recordset not empty ?>
  <input type="hidden" name="MM_update" value="form1" /><input type="hidden" name="action" id="action" /><input name="searchtype" type="hidden" id="searchtype" value="<?php echo $_POST['searchtype']; ?>" />
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