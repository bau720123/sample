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

$colname1_orders = "-1";
if (isset($_GET['orders_id'])) {
  $colname1_orders = $_GET['orders_id'];
}
mysql_select_db($database_connection, $connection);
$query_orders = sprintf("SELECT * FROM orders WHERE orders_id = %s", GetSQLValueString($colname1_orders, "int"));
$orders = mysql_query($query_orders, $connection) or die(mysql_error());
$row_orders = mysql_fetch_assoc($orders);
$totalRows_orders = mysql_num_rows($orders);

$colname_member_detail = "-1";
if (isset($row_orders['member_id'])) {
  $colname_member_detail = $row_orders['member_id'];
}
mysql_select_db($database_connection, $connection);
$query_member_detail = sprintf("SELECT member_id, member_name, member.city_id, member.area_id, member_address, member_code, member_tel, member_phone, city_name, area_name FROM member, city, area WHERE member_id = %s AND member.city_id = city.city_id AND member.area_id = area.area_id", GetSQLValueString($colname_member_detail, "int"));
$member_detail = mysql_query($query_member_detail, $connection) or die(mysql_error());
$row_member_detail = mysql_fetch_assoc($member_detail);
$totalRows_member_detail = mysql_num_rows($member_detail);

$colname_ordersdetail = "-1";
if (isset($_GET['orders_id'])) {
  $colname_ordersdetail = $_GET['orders_id'];
}
mysql_select_db($database_connection, $connection);
$query_ordersdetail = sprintf("SELECT * FROM ordersdetail WHERE orders_id = %s", GetSQLValueString($colname_ordersdetail, "int"));
$ordersdetail = mysql_query($query_ordersdetail, $connection) or die(mysql_error());
$row_ordersdetail = mysql_fetch_assoc($ordersdetail);
$totalRows_ordersdetail = mysql_num_rows($ordersdetail);
?>
<?php
header("Content-type:application/vnd.ms-excel");
//header("Content-Disposition:filename=$row_orders[orders_uid].xls");
header("Content-Disposition:attachment;filename=$row_orders[orders_uid].xls");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script type="text/javascript" src="../javascript/jquery.min.js"></script>
<script type="text/javascript" src="../javascript/javascript.js"></script>
</head>

<body>
<?php if ($totalRows_orders > 0) { // Show if recordset not empty ?>
  <div id="right"><span class="font13"><span class="color1"><strong>訂單詳細資料</strong></span></span>
    <div class="divgray">
    <strong>訂購人姓名：<?php echo $row_member_detail['member_name']; ?><br />
訂購人電話：<?php echo $row_member_detail['member_tel']; ?><br />
訂購人手機： <?php echo $row_member_detail['member_phone']; ?><br />
    訂購人地址：(<?php echo $row_member_detail['member_code']; ?>)<?php echo $row_member_detail['city_name']; ?><?php echo $row_member_detail['area_name']; ?><?php echo $row_member_detail['member_address']; ?><br />
    <br />
發票種類︰<?php if($row_orders['ticket_type'] == '1') { ?>二聯式發票<? } ?><?php if($row_orders['ticket_type'] == '2') { ?>三聯式發票<? } ?>
                  <?php /*start db_input script*/ if(isset($row_orders['ticket_no'])) { ?>
                    <br />
                    統編︰<?php echo $row_orders['ticket_no']; ?>
  <?php } /*end db_input script*/ ?>
                  <?php /*start db_input script*/ if(isset($row_orders['ticket_title'])) { ?>
                    <br />
                    抬頭︰<?php echo $row_orders['ticket_title']; ?>
                    <?php } /*end db_input script*/ ?>
                    <br />
                    收件人姓名：<?php echo $row_orders['orders_customerName']; ?><br />
收件人電話： <?php echo $row_orders['orders_customerTel']; ?><br />
收件人手機：<?php echo $row_orders['orders_customerPhone']; ?><br />
收件人地址 (<?php echo $row_orders['orders_customerCode']; ?>)<?php echo $row_orders['orders_customerAddress']; ?><br />
<br />
    交易狀態：</strong><?php if($row_orders['orders_ok'] == '1') { ?>尚未付款<? } ?><?php if($row_orders['orders_ok'] == '2') { ?>已付款未出貨<? } ?><?php if($row_orders['orders_ok'] == '3') { ?>已出貨<? } ?>
      <strong><br />
      購買日期：</strong><?php echo $row_orders['orders_datetime']; ?><br />
      <strong>訂單編號：</strong><?php echo $row_orders['orders_uid']; ?><br />
      <strong>付款方式：</strong><?php if($row_orders['orders_paytype'] == '1') { ?>線上刷卡<? } ?><?php if($row_orders['orders_paytype'] == '2') { ?>貨到付款<? } ?><?php if($row_orders['orders_paytype'] == '3') { ?>ATM轉帳<? } ?><?php if($row_orders['orders_paytype'] == '4') { ?>臨櫃匯款<? } ?>
      <br />
    <strong>點數折抵：</strong><?php echo $row_orders['orders_point']; ?>PT <br />
    <strong>備註：</strong><?php echo nl2br(htmlspecialchars($row_orders['orders_bak'])); ?></div>
    <br>
    
    <table border="1" cellpadding="0" cellspacing="0" class="divpink4table">
      
      <tr>
        <th>規格</th>
        <th>名稱</th>
        <th>單價</th>
        <th>數量</th>
        <th>價格</th>                 
      </tr>
      <?php do { ?>
        <tr>
          <td align="center"><?php echo $row_ordersdetail['class3_standard']; ?></td>
          <td align="center"><?php echo $row_ordersdetail['class3_name']; ?></td>
          <td align="center"><?php echo $row_ordersdetail['class3_price']; ?></td>
          <td align="center"><?php echo $row_ordersdetail['class3_count']; ?></td>
          <td align="right">$<?php echo $row_ordersdetail['class3_price']*$row_ordersdetail['class3_count']; ?></td>
        </tr>
        <?php } while ($row_ordersdetail = mysql_fetch_assoc($ordersdetail)); ?>
      <tr>
        <th colspan="4" align="right">合計</th>
        <td align="right">$<?php echo $row_orders['orders_grandtotal']; ?></td>
      </tr>
      <tr>
        <th colspan="4" align="right">運費</th>
        <td align="right">$<?php echo $row_orders['orders_shipping']; ?></td>
      </tr>
    </table>
    
    
    
  </div>
  <?php } // Show if recordset not empty ?>
</body>
</html>
<?php
mysql_free_result($orders);

mysql_free_result($member_detail);

mysql_free_result($ordersdetail);
?>