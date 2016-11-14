<?php
//加入購物車Class的宣告
require_once('cart/EDcart.php');
session_start();
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart();
?>
<?php
//購物車為空時重新導向指定頁
if ($cart->itemcount == 0){header("Location:index.php");}
?>
<?php require_once('Connections/connection.php'); ?>
<?php //require_once('priority.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO orders (member_id, orders_point, orders_uid, orders_subtotal, orders_shipping, orders_grandtotal, orders_customerName, orders_customerCode, orders_customerEmail, orders_customerSex, orders_customerAddress, orders_customerPhone, orders_customerTel, orders_paytype, orders_bak, ticket_type, ticket_no, ticket_title, orders_datetime) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['member_id'], "int"),
                       GetSQLValueString($_POST['orders_point'], "int"),
                       GetSQLValueString(date("YmdHis", mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))), "int"),
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
					   GetSQLValueString($_POST['orders_bak'], "text"),
                       GetSQLValueString($_POST['ticket_type'], "int"),
                       GetSQLValueString($_POST['ticket_no'], "int"),
                       GetSQLValueString($_POST['ticket_title'], "text"),
                       GetSQLValueString($nowtime, "date"));
					   
  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
  
  //取得最新的訂單編號
  $max_id = mysql_insert_id();
  $_SESSION['OrderID'] = $max_id; //將編號存入Session值中
  
  //將購物車的詳細內容一筆筆寫入資料表
  if($cart->itemcount > 0) {
    	foreach($cart->get_contents() as $item) {
	  	$insertSQL = sprintf("INSERT INTO ordersdetail (orders_id, class3_id, class3_standard, class3_size, class3_name, class3_price, class3_point, class3_count) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
    	                   GetSQLValueString($max_id, "int"),
        	               GetSQLValueString($item['id'], "int"),
        	               GetSQLValueString($item['standard'], "text"),
						   GetSQLValueString($item['size'], "text"),
						   GetSQLValueString($item['info'], "text"),				   
            	           GetSQLValueString($item['price'], "int"),
						   GetSQLValueString($item['point'], "int"),
                	       GetSQLValueString($item['qty'], "int")); 
		mysql_select_db($database_connection, $connection);
		$Result1 = mysql_query($insertSQL, $connection) or die(mysql_error()); 
		}
  }
  
  $updateSQL = sprintf("UPDATE member SET member_point=member_point-%s WHERE member_id=%s",
                       GetSQLValueString($_POST['orders_point'], "int"),
                       GetSQLValueString($_POST['member_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
  
  $updateSQL = sprintf("UPDATE member SET member_point=member_point+%s WHERE member_id=%s",
                       GetSQLValueString($_POST['orders_point1'], "int"),
                       GetSQLValueString($_POST['member_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $insertGoTo = "cart/addtocart.php?type=finish&orders_paytype=$_POST[orders_paytype]";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_member_detail = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_member_detail = $_SESSION['MM_Username'];
}
mysql_select_db($database_connection, $connection);
$query_member_detail = sprintf("SELECT member_id, member_username FROM member WHERE member_username = %s", GetSQLValueString($colname_member_detail, "text"));
$member_detail = mysql_query($query_member_detail, $connection) or die(mysql_error());
$row_member_detail = mysql_fetch_assoc($member_detail);
$totalRows_member_detail = mysql_num_rows($member_detail);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row_seo_detail['seo_title']; ?>-確認訂單內容</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-確認訂單內容" />
<?php require_once("seo.php")?>
<?php require_once("css.php")?>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body>
<div id="mainBg">
  <div id="main">
    <?php require_once('header.php'); ?>    
    <div id="contenttop"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="851">
      <tr>      
        <td width="236" valign="top">        
          <div id="leftOut"><div id="leftC">
            <img src="images/title_cart.jpg" title="神戶TRANSPARENT 我的購物車" alt="神戶TRANSPARENT 我的購物車" /><br />
            <img src="images/decpic7.jpg" vspace="8" />
            <div class="button01">點數折抵</div>
            <div class="button01">選擇收件地址</div>
            <div class="button01">指定付款方式</div>
            <div class="button01b">確認訂購資訊</div>
            <div class="button01">訂購完成</div>
          </div></div>
        </td>
        <td width="615" valign="top"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
            <div id="right" style="line-height: 2em;">
            <img src="images/banner_g.jpg" style="margin-bottom: 10px;" />
            <br />
            <img src="images/icon_2.jpg" align="absmiddle" hspace="8" /><span class="font13"><span class="color1"><strong>確認訂單內容</strong></span></span>
            <input name="member_id" type="hidden" id="member_id" value="<?php echo $row_member_detail['member_id']; ?>" />
            <input name="orders_customerName" type="hidden" id="orders_customerName" value="<?php echo $_POST['member_name']; ?>" />
                  <input type="hidden" name="orders_customerCode" id="orders_customerCode" value="<?php echo $_POST['member_code']; ?>" />
                  <input type="hidden" name="orders_customerAddress" id="orders_customerAddress" value="<?php echo $_POST['member_address']; ?>" />
                  <input type="hidden" name="orders_customerPhone" id="orders_customerPhone" value="<?php echo $_POST['member_phone']; ?>" />
                  <input type="hidden" name="orders_customerTel" id="orders_customerTel" value="<?php echo $_POST['member_tel']; ?>" />
                  <input type="hidden" name="orders_customerEmail" id="orders_customerEmail" value="<?php echo $_POST['member_email']; ?>" />
                  <input type="hidden" name="orders_customerSex" id="orders_customerSex" value="<?php echo $_POST['member_sex']; ?>" />
                  <input type="hidden" name="ticket_type" id="ticket_type" value="<?php echo $_POST['ticket_type']; ?>" />
                  <input type="hidden" name="ticket_no" id="ticket_no" value="<?php echo $_POST['ticket_no']; ?>" />
                  <input type="hidden" name="ticket_title" id="ticket_title" value="<?php echo $_POST['ticket_title']; ?>" />
            <table border="0" cellpadding="0" cellspacing="0" class="divpink4table">
              <tr>
                <th>商品圖片</th>
                <th>規格</th>
                <th>商品名稱</th>
                <th>單價</th>
                <th>單紅利</th>
                <th>數量</th>
                <th>價格</th>                 
              </tr>
              <?php
if($cart->itemcount > 0) {
	foreach($cart->get_contents() as $item) {
?>
<tr>
                <td class="tdpic" align="center"><img src="<?php echo $item['pic'];?>" title="產品圖" alt="產品圖" /></td>
                <td align="center"><img src="upload/<?php echo $item['standardpic'];?>" title="產品圖" alt="產品圖" /><br />                   <?php echo $item['standard'];?></td>
                <td align="center"><input name="itemid[]" type="hidden" id="itemid[]" value="<?php echo $item['id'];?>">
              <?php echo $item['info'];?></td>
                <td align="center">$<?php echo $item['price'];?></td>
                <td align="center"><?php echo $item['point'];?></td>
                <td align="center"><?php echo $item['qty'];?></td>
                <td align="right">$<?php echo $item['subtotal'];?><br />
                  (紅利點數<?php echo $item['subtotalpoint'];?>)</td>
              </tr>
<?php
	}
}
?>
              <tr>
                <th colspan="7" align="right"><input type="hidden" name="orders_point" id="orders_point" value="<?php echo $_POST['usepointcoda']; ?>" />
                  小計</th>
                <td align="right">$<?php echo $cart->total;?>
                  <input name="orders_subtotal" type="hidden" id="orders_subtotal" value="<?php echo $cart->total;?>" /></td>
              </tr>
              <?php if(isset($_POST['usepointcoda'])) { ?><tr>
                <th height="37" colspan="7" align="right">本次折抵點數</th>
                <td align="right"><?php echo $_POST['usepointcoda'];?>pt</td>
              </tr><? } ?>
              <tr>
                <th colspan="7" align="right" class="color3">運費</th>
                <td align="right">$<?php 
				$bauprice = $cart->total;
				if($bauprice-$_POST['usepointcoda'] >= $row_data_detail['data_7']) { $ship = 0; }
				if($bauprice-$_POST['usepointcoda'] < $row_data_detail['data_7']) { $ship = $row_data_detail['data_8']; }
				echo $ship
				?>
                  <input name="orders_shipping" type="hidden" id="orders_shipping" value="<?php 
				$bauprice = $cart->total;
				if($bauprice-$_POST['usepointcoda'] >= $row_data_detail['data_7']){$ship = 0;}
				if($bauprice-$_POST['usepointcoda'] < $row_data_detail['data_7']){$ship = $row_data_detail['data_8'];}
				echo $ship
				?>" /></td>
              </tr>
              <tr>
                <th colspan="7" align="right">打折前合計</th>
                <td align="right">$<?php echo $cart->total+$ship-$_POST['usepointcoda'];?></td>
              </tr>
              <tr>
                <th colspan="7" align="right">打折後合計（滿<?php echo $row_data_detail['data_9'];?>打<?php echo $row_data_detail['data_10']*100;?>折）</th>
                <td align="right">$<?php 
$totalprice = $cart->total+$ship-$_POST['usepointcoda'];
if($totalprice >= $row_data_detail['data_9']) { $totalprice = $totalprice*$row_data_detail['data_10']; }
if($totalprice < $row_data_detail['data_9']) { $totalprice = $totalprice; }
echo $totalprice;
?>
                  <input name="orders_grandtotal" type="hidden" id="orders_grandtotal" value="<?php 
$totalprice = $cart->total+$ship-$_POST['usepointcoda'];
if($totalprice >= $row_data_detail['data_9']) { $totalprice = $totalprice*$row_data_detail['data_10']; }
if($totalprice < $row_data_detail['data_9']) { $totalprice = $totalprice; }
echo $totalprice;
?>" /></td>
              </tr>
              <tr>
                <th colspan="7" align="right"><input type="hidden" name="orders_date" id="orders_date" />
                  <input type="hidden" name="orders_datetime" id="orders_datetime" />
<input name="orders_paytype" type="hidden" id="orders_paytype" value="<?php echo $_POST['orders_paytype']; ?>" />
                  本次新增點數</th>
                <td align="right"><?php echo $cart->grandtotalpoint;?>
                  <input name="orders_point1" type="hidden" id="orders_point1" value="<?php echo $cart->grandtotalpoint;?>" />
                  pt</td>
              </tr>
            </table>
            <br />
            <img src="images/icon_2.jpg" align="absmiddle" hspace="8" /><span class="font13"><span class="color1"><strong>備註欄<br />
            <textarea name="orders_bak" id="orders_bak" cols="70" rows="10"></textarea>
            </strong></span></span>
            <div align="right" style="height: 30px; margin: 15px 20px 20px 0;">                                             
               <a onclick="javascript:{document.form1.submit();}" class="buttonb">我要結帳</a>
               <a href="cart_pt.php" class="buttonb">修改紅利點數</a>
               <a href="cart.php" class="buttonb">修改購物車內容</a>
               <a href="product.php?class2_id=2" class="buttonb">繼續購物</a>
             </div>
          </div>
            <input type="hidden" name="MM_insert" value="form1" />
        </form>
        </td>        
      </tr>
    </table>
  </div>
  <?php require_once('footer.php'); ?>
</div>
</body>
</html>
<?php
mysql_free_result($member_detail);
?>