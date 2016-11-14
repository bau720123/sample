<?php require_once('Connections/connection.php'); ?>
<?php require_once('priority.php'); ?>
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

$colname_member_detail = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_member_detail = $_SESSION['MM_Username'];
}
mysql_select_db($database_connection, $connection);
$query_member_detail = sprintf("SELECT member_id, member_username, member_name, member_sex, member_point, member_ok FROM member WHERE member_username = %s AND member_ok= '1'", GetSQLValueString($colname_member_detail, "text"));
$member_detail = mysql_query($query_member_detail, $connection) or die(mysql_error());
$row_member_detail = mysql_fetch_assoc($member_detail);
$totalRows_member_detail = mysql_num_rows($member_detail);
?>
<?php require_once('priority.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row_seo_detail['seo_title']; ?>-點數折抵</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-點數折抵" />
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
            <div class="button01b">點數折抵</div>
            <div class="button01">選擇收件地址</div>
            <div class="button01">指定付款方式</div>
            <div class="button01">確認訂購資訊</div>
            <div class="button01">訂購完成</div>
          </div></div>
        </td>
        <td width="615" valign="top"><form id="form1" name="form1" method="post" action="checkpoint.php">
          <div id="right" style="line-height: 2em;">
            <img src="images/banner_g.jpg" style="margin-bottom: 10px;" />
            <br />
            <img src="images/icon_2.jpg" align="absmiddle" hspace="9" /><span class="font13"><span class="color1"><strong>神戶TRANSP'ARENT點數使用1點同等1元現金折抵，最高折抵無上限<br />
            　　點數使用只限於網路購物，不可將點數轉換成現金</strong></span></span>
            <div class="divpink2">
              <span class="font13"><strong><?php echo $row_member_detail['member_name']; ?> <?php echo $row_member_detail['member_sex']; ?>您好，您目前持有點數 <?php echo $row_member_detail['member_point']; ?>PT
              <input name="member_id" type="hidden" id="member_id" value="<?php echo $row_member_detail['member_id']; ?>" />
<br />今日購買總金額 <?php echo $cart->total;?>元</strong></span><br />
              <span class="color3">* 此次消費'將會累積點數<strong><?php echo $cart->grandtotalpoint;?>點</strong></span>
              <p><input name="usepoint" type="radio" id="" value="1" checked="checked" /> <strong>選擇折抵點數</strong><br />　　<input name="usepointcoda" type="text" id="usepointcoda" value="0" /> <strong>折抵點數</strong></p>
              <p><input name="usepoint" type="radio" id="" value="0" /> <strong>今天不使用點數折抵</strong></p>
            </div>
            <div align="right" style="height: 30px; margin: 15px 10px 20px 0;">                                             
               <a onclick="javascript:{document.form1.submit();}" class="buttonb">下一步</a>
               <a href="cart.php" class="buttonb">修改購物車</a>
               <a href="product.php?class2_id=2" class="buttonb">繼續購物</a>
            </div>
          </div>
        </form></td>        
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