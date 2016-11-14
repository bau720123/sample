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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formorders")) {
  $updateSQL = sprintf("UPDATE orders SET orders_point=%s, orders_subtotal=%s, orders_shipping=%s, orders_grandtotal=%s, orders_customerName=%s, orders_customerCode=%s, orders_customerEmail=%s, orders_customerSex=%s, orders_customerAddress=%s, orders_customerPhone=%s, orders_customerTel=%s, orders_paytype=%s, orders_ok=%s, orders_bak=%s, ticket_type=%s, ticket_no=%s, ticket_title=%s WHERE orders_id=%s",
                       GetSQLValueString($_POST['orders_point'], "int"),
                       GetSQLValueString($_POST['orders_subtotal'], "int"),
                       GetSQLValueString($_POST['orders_shipping'], "int"),
                       GetSQLValueString($_POST['orders_grandtotal'], "int"),
                       GetSQLValueString($_POST['orders_customerName'], "text"),
                       GetSQLValueString($_POST['orders_customerCode'], "text"),
                       GetSQLValueString($_POST['orders_customerEmail'], "text"),
                       GetSQLValueString($_POST['orders_customerSex'], "text"),
                       GetSQLValueString($_POST['orders_customerAddress'], "text"),
                       GetSQLValueString($_POST['orders_customerPhone'], "text"),
                       GetSQLValueString($_POST['orders_customerTel'], "text"),
                       GetSQLValueString($_POST['orders_paytype'], "text"),
                       GetSQLValueString($_POST['orders_ok'], "int"),
                       GetSQLValueString($_POST['orders_bak'], "text"),
                       GetSQLValueString($_POST['ticket_type'], "int"),
                       GetSQLValueString($_POST['ticket_no'], "int"),
                       GetSQLValueString($_POST['ticket_title'], "text"),
                       GetSQLValueString($_POST['orders_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "orders.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }

if($_POST['orders_paytype2'] != $_POST['orders_paytype'])
{
//引入文件
require_once('../3rd/PHPMailer/class.phpmailer.php');
require_once('smtp.php');

//寄件人名稱
$mail->FromName = "$row_seo_detail[seo_title] | 留言訊息回覆";

//設定收件人的另一種格式("Email","收件人名稱")
$mail->AddAddress($_POST['qa_email'],$_POST['qa_question']);

//設定密件副本
//$mail->AddBCC("","");

//回信Email及名稱
$mail->AddReplyTo($row_smtp_detail['smtp_email'], "$row_seo_detail[seo_title] | 留言訊息回覆");

//傳送附檔
//$mail->AddAttachment("download.gif");
//傳送附檔的另一種格式，可替附檔重新命名
//$mail->AddAttachment("download.gif", "newname.gif");

//郵件標題
$mail->Subject="$row_seo_detail[seo_title] | 會員付款方式變更";

if($_POST['orders_paytype'] == '1')
{
//郵件內容
$mail->Body =
"
<html>
<head>
</head>
<body>
親愛的".$_POST['orders_customerName']." 您好 <br>
我們是$row_seo_detail[seo_title] <br>
您的付款方式已經變更為線上刷卡，請至會員管理界面重新進行線上刷卡動作 <br>
謝謝
</body>
</html>
"
;
}

if($_POST['orders_paytype'] == '2')
{
//郵件內容
$mail->Body =
"
<html>
<head>
</head>
<body>
親愛的".$_POST['orders_customerName']." 您好 <br>
我們是$row_seo_detail[seo_title] <br>
您的付款方式已經變更為貨到付款，請耐心等待，您的貨品將到3-7天內送達 <br>
謝謝
</body>
</html>
"
;
}


if($_POST['orders_paytype'] == '3')
{
//郵件內容
$mail->Body =
"
<html>
<head>
</head>
<body>
親愛的".$_POST['orders_customerName']." 您好 <br>
我們是$row_seo_detail[seo_title] <br>
您的付款方式已經變更為ATM轉帳，請匯款到 <br>
銀行代號︰ <br>
匯款帳號︰ <br>
金額為".$_POST['orders_grandtotal']."︰ <br>
謝謝
</body>
</html>
"
;
}

if($_POST['orders_paytype'] == '4')
{
//郵件內容
$mail->Body =
"
<html>
<head>
</head>
<body>
親愛的".$_POST['orders_customerName']." 您好 <br>
我們是$row_seo_detail[seo_title] <br>
您的付款方式已經變更為臨櫃匯款，請至郵局匯款 <br>
銀行代號︰ <br>
匯款帳號︰ <br>
金額為".$_POST['orders_grandtotal']."︰ <br>
謝謝
</body>
</html>
"
;
}

//附加內容
$mail->AltBody = '這是附加的信件內容';

//寄送郵件
if(!$mail->Send())
{
echo "郵件無法順利寄出!";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}
}

if($_POST['orders_ok2'] != $_POST['orders_ok'] && $_POST['orders_ok'] !=1)
{
//引入文件
require_once('../3rd/PHPMailer/class.phpmailer.php');
require_once('smtp.php');

//寄件人名稱
$mail->FromName = "$row_seo_detail[seo_title] | 目前訂單狀況";

//設定收件人的另一種格式("Email","收件人名稱")
$mail->AddAddress($_POST['orders_customerEmail'],$_POST['orders_customerName']);

//設定密件副本
//$mail->AddBCC("","");

//回信Email及名稱
$mail->AddReplyTo($row_smtp_detail['smtp_email'], "$row_seo_detail[seo_title] | 目前訂單狀況");

//傳送附檔
//$mail->AddAttachment("download.gif");
//傳送附檔的另一種格式，可替附檔重新命名
//$mail->AddAttachment("download.gif", "newname.gif");

//郵件標題
$mail->Subject="$row_seo_detail[seo_title] | 目前訂單狀況";

if($_POST['orders_ok'] == '2')
{
//郵件內容
$mail->Body =
"
<html>
<head>
</head>
<body>
親愛的".$_POST['orders_customerName']." 您好 <br>
我們是$row_seo_detail[seo_title] <br>
您的目前訂單狀況為已付款未出貨，我們正在準備出貨相關事宜，請耐心等待 <br>
謝謝
</body>
</html>
"
;
}

if($_POST['orders_ok'] == '3')
{
//郵件內容
$mail->Body =
"
<html>
<head>
</head>
<body>
親愛的".$_POST['orders_customerName']." 您好 <br>
我們是$row_seo_detail[seo_title] <br>
您的目前訂單狀況為已出貨，請耐心等待，您的貨品將到3-7天內送達 <br>
謝謝
</body>
</html>
"
;
}

if($_POST['orders_ok'] == '4')
{
//郵件內容
$mail->Body =
"
<html>
<head>
</head>
<body>
親愛的".$_POST['orders_customerName']." 您好 <br>
我們是$row_seo_detail[seo_title] <br>
您的訂單編號 ".$_POST['orders_uid']." 已經經由我們客服人員取消了，若有任何問題請再與我們連絡<br>
謝謝
</body>
</html>
"
;
}

//附加內容
$mail->AltBody = '這是附加的信件內容';

//寄送郵件
if(!$mail->Send())
{
echo "郵件無法順利寄出!";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}
}
  
header(sprintf("Location: %s", $updateGoTo));  
}

$colname_orders = "-1";
if (isset($_GET['orders_id'])) {
  $colname_orders = $_GET['orders_id'];
}
mysql_select_db($database_connection, $connection);
$query_orders = sprintf("SELECT * FROM orders WHERE orders_id = %s", GetSQLValueString($colname_orders, "int"));
$orders = mysql_query($query_orders, $connection) or die(mysql_error());
$row_orders = mysql_fetch_assoc($orders);
$totalRows_orders = mysql_num_rows($orders);

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
          <td background="images/title_name.jpg" width="139" valign="bottom" style="padding-bottom: 3px;" align="center"><strong>
          後台管理系統</strong></td>
          <td background="images/title_bg.gif" align="right"><img src="images/title_right.jpg" /></td>
        </tr>
      </table>
      <table border="0">
        <tr>
          <td rowspan="2"><table border="0" align="left" cellpadding="0" cellspacing="0" id="content">
        <tr>
          <td>
<form action="<?php echo $editFormAction; ?>" method="post" name="formorders" id="formorders">
            <div class="titleB">
              <div class="titleBText"><input value="修改資料" name="button" type="submit"></div>
            </div><table border="0" cellpadding="0" cellspacing="0" id="tableB">

              <tr>
                <td align="left" class="tdlight">訂單編號</td>
                <td colspan="2" align="left" class="tdlight"><?php echo $row_orders['orders_uid']; ?>
                  <input name="orders_uid" type="hidden" id="orders_uid" value="<?php echo $row_orders['orders_uid']; ?>" />
                  <br />
                  <?php if($row_orders['orders_paytype'] == '1') { ?>線上刷卡：<?php echo $row_orders['orders_paytypedetail1']; ?>
                  <? } ?><?php if($row_orders['orders_paytype'] == '2') { ?>戶名資訊：<?php echo $row_orders['orders_paytypedetail2']; ?>
<? } ?><?php if($row_orders['orders_paytype'] == '3') { ?>轉帳後五碼：<?php echo $row_orders['orders_paytypedetail3']; ?>
<? } ?><?php if($row_orders['orders_paytype'] == '4') { ?>戶名資訊：<?php echo $row_orders['orders_paytypedetail4']; ?><? } ?></td>
              </tr>
              <tr>
                <td align="left" class="tdlight">發票資訊</td>
                <td colspan="2" align="left" class="tdlight"><input <?php if (!(strcmp($row_orders['ticket_type'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="ticket_type" id="radio" value="1" />
                  二聯式發票
<input <?php if (!(strcmp($row_orders['ticket_type'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="ticket_type" id="radio2" value="2" />
三聯式發票<br />
                    統編︰
                    <input name="ticket_no" type="text" id="ticket_no" value="<?php echo $row_orders['ticket_no']; ?>" />
                    
                    <br />
                    抬頭︰
                    <input name="ticket_title" type="text" id="ticket_title" value="<?php echo $row_orders['ticket_title']; ?>" />
                    
              </tr>
              <tr>
                <td align="left" class="tdlight">使用點數</td>
                <td colspan="2" align="left" class="tdlight">
                  <input name="orders_point" type="text" id="orders_point" value="<?php echo $row_orders['orders_point']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tdlight">總金額</td>
                <td colspan="2" align="left" class="tdlight">
                  <input name="orders_subtotal" type="text" id="orders_subtotal" value="<?php echo $row_orders['orders_subtotal']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">運費</td>
<td width="75%" colspan="2" align="left" class="tdlight">
  <input name="orders_shipping" type="text" id="orders_shipping" value="<?php echo $row_orders['orders_shipping']; ?>" /></td>
              </tr>
              
              <tr>
                <td align="left" class="tddark">總金額+運費</td>
<td width="75%" colspan="2" align="left" class="tdlight"><input name="orders_grandtotal" type="text" id="orders_grandtotal" value="<?php echo $row_orders['orders_grandtotal']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">收件者</td>
                <td colspan="2" align="left" class="tddark"><input name="orders_customerName" type="text" id="orders_customerName" value="<?php echo $row_orders['orders_customerName']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">性別</td>
                <td colspan="2" align="left" class="tddark">
                  <input <?php if (!(strcmp($row_orders['orders_customerSex'],"先生"))) {echo "checked=\"checked\"";} ?> type="radio" name="orders_customerSex" id="radio3" value="先生" />
                  先生
                  <input <?php if (!(strcmp($row_orders['orders_customerSex'],"小姐"))) {echo "checked=\"checked\"";} ?> type="radio" name="orders_customerSex" id="radio4" value="小姐" />
                  小姐</td>
              </tr>
              <tr>
                <td align="left" class="tddark">郵遞區號</td>
                <td colspan="2" align="left" class="tddark">
                  <input name="orders_customerCode" type="text" id="orders_customerCode" value="<?php echo $row_orders['orders_customerCode']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">EMAIL</td>
                <td colspan="2" align="left" class="tddark"><input name="orders_customerEmail" type="text" id="orders_customerEmail" value="<?php echo $row_orders['orders_customerEmail']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">地址</td>
                <td colspan="2" align="left" class="tddark">
                  <input name="orders_customerAddress" type="text" id="orders_customerAddress" value="<?php echo $row_orders['orders_customerAddress']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">手機</td>
                <td colspan="2" align="left" class="tddark">
                  <input name="orders_customerPhone" type="text" id="orders_customerPhone" value="<?php echo $row_orders['orders_customerPhone']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">電話</td>
                <td colspan="2" align="left" class="tddark">
                  <input name="orders_customerTel" type="text" id="orders_customerTel" value="<?php echo $row_orders['orders_customerTel']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">付款方式</td>
                <td colspan="2" align="left" class="tddark"><select name="orders_paytype" id="orders_paytype">
                  <option value="1" <?php if (!(strcmp(1, $row_orders['orders_paytype']))) {echo "selected=\"selected\"";} ?>>線上刷卡</option>
                  <option value="2" <?php if (!(strcmp(2, $row_orders['orders_paytype']))) {echo "selected=\"selected\"";} ?>>貨到付款</option>
                  <option value="3" <?php if (!(strcmp(3, $row_orders['orders_paytype']))) {echo "selected=\"selected\"";} ?>>ATM轉帳</option>
                  <option value="4" <?php if (!(strcmp(4, $row_orders['orders_paytype']))) {echo "selected=\"selected\"";} ?>>臨櫃匯款</option>
                </select>
                  <input name="orders_paytype2" type="hidden" id="orders_paytype2" value="<?php echo $row_orders['orders_paytype']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">交易狀況</td>
                <td colspan="2" align="left" class="tddark"><select name="orders_ok" id="orders_ok">
                  <option value="1" <?php if (!(strcmp(1, $row_orders['orders_ok']))) {echo "selected=\"selected\"";} ?>>尚未付款</option>
                  <option value="2" <?php if (!(strcmp(2, $row_orders['orders_ok']))) {echo "selected=\"selected\"";} ?>>已付款未出貨</option>
                  <option value="3" <?php if (!(strcmp(3, $row_orders['orders_ok']))) {echo "selected=\"selected\"";} ?>>已出貨</option>
                  <option value="4" <?php if (!(strcmp(4, $row_orders['orders_ok']))) {echo "selected=\"selected\"";} ?>>交易取消</option>
                </select>
                  <input name="orders_ok2" type="hidden" id="orders_ok2" value="<?php echo $row_orders['orders_ok']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">下單時間</td>
                <td colspan="2" align="left" class="tddark"><?php echo $row_orders['orders_datetime']; ?></td>
              </tr>
              <tr>
                <td align="left" class="tddark">備註</td>
                <td colspan="2" align="left" class="tddark"><textarea name="orders_bak" id="orders_bak" rows="5"><?php echo $row_orders['orders_bak']; ?></textarea>
                  <span class="tdbutton">
                  <input name="orders_id" type="hidden" id="orders_id" value="<?php echo $row_orders['orders_id']; ?>" /><input type="hidden" name="MM_update" value="formorders" /></span></td>
              </tr>
            </table>
</form>
          </td>
        </tr>
      </table></td>
          <td align="left" valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" id="content">
      <tr>
          <td valign="top">
            <div class="titleB">
              <div class="titleBText"><input value="購買明細" name="button" type="button"></div>
            </div>
<form action="<?php echo $editFormAction; ?>" method="post" id="form1" name="form1" >
<table border="1" cellpadding="0" cellspacing="0" class="divpink4table">
      
      <tr>
        <th>規格</th>
        <th>名稱</th>
        <th>單價</th>
        <th>單紅利</th>
        <th>數量</th>
        <th>價格</th>
        <th>紅利點數</th>                 
      </tr>
      <?php do { ?>
        <tr>
          <td align="center"><?php echo $row_ordersdetail['class3_standard']; ?></td>
          <td align="center"><?php echo $row_ordersdetail['class3_name']; ?></td>
          <td align="center"><?php echo $row_ordersdetail['class3_price']; ?></td>
          <td align="center"><?php echo $row_ordersdetail['class3_point']; ?></td>
          <td align="center"><?php echo $row_ordersdetail['class3_count']; ?></td>
          <td align="right">$<?php echo $row_ordersdetail['class3_price']*$row_ordersdetail['class3_count']; ?></td>
          <td align="right"><?php echo $row_ordersdetail['class3_point']*$row_ordersdetail['class3_count']; ?></td>
        </tr>
        <?php } while ($row_ordersdetail = mysql_fetch_assoc($ordersdetail)); ?>
    </table>
</form>
          </td>
        </tr>
      </table></td>
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
mysql_free_result($orders);

mysql_free_result($ordersdetail);
?>