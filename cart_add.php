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

$colname_member_detail = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_member_detail = $_SESSION['MM_Username'];
}
mysql_select_db($database_connection, $connection);
$query_member_detail = sprintf("SELECT member_id, member_username, member_name, member.city_id, member.area_id, member_address, member_code, member_phone, member_tel, member_email, member_sex, member_point, city_name, area_name, member_ok FROM member, city, area WHERE member_username = %s AND member_ok= '1' AND member.city_id = city.city_id AND member.area_id = area.area_id", GetSQLValueString($colname_member_detail, "text"));
$member_detail = mysql_query($query_member_detail, $connection) or die(mysql_error());
$row_member_detail = mysql_fetch_assoc($member_detail);
$totalRows_member_detail = mysql_num_rows($member_detail);
?>
<?php require_once('priority.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row_seo_detail['seo_title']; ?>-收件者資料</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-收件者資料" />
<?php require_once("seo.php")?>
<?php require_once("css.php")?>
<script type="text/javascript">
function VF_form1(){
	var theForm = document.form1;
	var emailRE = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	var errMsg = "";
	var setfocus = "";

	if (theForm['member_sex'].value == ""){
		errMsg = "收件者性別必須填寫";
		setfocus = "['member_sex']";
	}
	if (!emailRE.test(theForm['member_email'].value)){
		errMsg = "收件者EMAIL位址必須填寫";
		setfocus = "['member_email']";
	}
	if (theForm['member_tel'].value == ""){
		errMsg = "收件者連絡電話必須填寫";
		setfocus = "['member_tel']";
	}
	if (theForm['member_phone'].value == ""){
		errMsg = "收件者手機必須填寫";
		setfocus = "['member_phone']";
	}
	if (theForm['member_address'].value == ""){
		errMsg = "收件者地址必須填寫";
		setfocus = "['member_address']";
	}
	if (theForm['member_code'].value == ""){
		errMsg = "收件者郵遞區號必須填寫";
		setfocus = "['member_code']";
	}
	if (theForm['member_name'].value == ""){
		errMsg = "收件者姓名必須填寫";
		setfocus = "['member_name']";
	}
	if (errMsg != ""){
		alert(errMsg);
		eval("theForm" + setfocus + ".focus()");
	}
	else theForm.submit();
}
</script>
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
            <div class="button01b">選擇收件地址</div>
            <div class="button01">指定付款方式</div>
            <div class="button01">確認訂購資訊</div>
            <div class="button01">訂購完成</div>
          </div></div>
        </td>
        <td width="615" valign="top"><form action="cart_pay.php" method="post" name="form1" id="form1" onsubmit="VF_form1();return false;">
            <div id="right" style="line-height: 2em;">
            <img src="images/banner_g.jpg" style="margin-bottom: 10px;" />
            <br />
            <img src="images/icon_2.jpg" align="absmiddle" hspace="8" /><span class="font13"><span class="color1"><strong>訂購者資料</strong></span></span>
            <table border="0" cellpadding="0" cellspacing="1" width="560" class="divpink2table">
              <tr>
                <td width="82">訂購者姓名</td>
                <td width="395"><?php echo $row_member_detail['member_name']; ?><input name="member_name1" type="hidden" id="member_name1" value="<?php echo $row_member_detail['member_name']; ?>" /></td>
              </tr>
              <tr>
                <td>郵遞區號</td>
                <td><?php echo $row_member_detail['member_code']; ?><input name="member_code1" type="hidden" id="member_code1" value="<?php echo $row_member_detail['member_code']; ?>" /></td>
              </tr>
              <tr>
                <td>地址</td>
                <td><?php echo $row_member_detail['city_name']; ?><?php echo $row_member_detail['area_name']; ?><?php echo $row_member_detail['member_address']; ?><input name="member_address1" type="hidden" id="member_address1" value="<?php echo $row_member_detail['city_name']; ?><?php echo $row_member_detail['area_name']; ?><?php echo $row_member_detail['member_address']; ?>" /></td>
              </tr>
              <tr>
                <td>手機</td>
                <td><?php echo $row_member_detail['member_phone']; ?><input name="member_phone1" type="hidden" id="member_phone1" value="<?php echo $row_member_detail['member_phone']; ?>" /></td>
              </tr>
              <tr>
                <td>連絡電話</td>
                <td><?php echo $row_member_detail['member_tel']; ?><input name="member_tel1" type="hidden" id="member_tel1" value="<?php echo $row_member_detail['member_tel']; ?>" /></td>
              </tr>
              <tr>
                <td>E-MAIL</td>
                <td><?php echo $row_member_detail['member_email']; ?><input name="member_email1" type="hidden" id="member_email1" value="<?php echo $row_member_detail['member_email']; ?>" /></td>
              </tr>
              <tr>
                <td>性別</td>
                <td><?php echo $row_member_detail['member_sex']; ?><input name="member_sex1" type="hidden" id="member_sex1" value="<?php echo $row_member_detail['member_sex']; ?>" /></td>
              </tr>
            </table>
            <img src="images/icon_2.jpg" align="absmiddle" hspace="8" /><span class="font13"><span class="color1"><strong>收件者資料</strong></span>　
            <input name="pay_thesame" type="checkbox" id="pay_thesame" onClick="sameaspay(this.form);" value="on" /> <span class="color6">同訂購者</span></span>
            <table border="0" cellpadding="0" cellspacing="1" width="560" class="divpink2table">
              <tr>
                <td width="82">收件者姓名</td>
                <td width="395"><input name="member_name" type="text" id="member_name" /></td>
              </tr>
              <tr>
                <td>郵遞區號</td>
                <td><input name="member_code" type="text" id="member_code" size="5" /></td>
              </tr>
              <tr>
                <td>地址</td>
                <td><input name="member_address" type="text" id="member_address" size="45" /></td>
              </tr>
              <tr>
                <td>手機</td>
                <td><input name="member_phone" type="text" id="member_phone" /></td>
              </tr>
              <tr>
                <td>連絡電話</td>
                <td><input name="member_tel" type="text" id="member_tel" /></td>
              </tr>
              <tr>
                <td>E-MAIL</td>
                <td><input name="member_email" type="text" id="member_email" size="45" /></td>
              </tr>
              <tr>
                <td>性別</td>
                <td><input name="member_sex" type="text" id="member_sex" size="5" />
                  <input name="usepointcoda" type="hidden" id="usepointcoda" value="<?php if($_POST['usepoint'] ==1) { ?><?php echo $_POST['usepointcoda']; ?><? } ?><?php if($_POST['usepoint'] ==0) { ?><?php echo '0'; ?><? } ?>" /></td>
              </tr>
              <tr>
                <td>發票明細</td>
                <td><p>
                  <label>
                    <input name="ticket_type" type="radio" id="RadioGroup1_0" value="1" checked="checked" />
                    二聯式發票
                  </label>
                  <br />
                  <label>
                    <input type="radio" name="ticket_type" value="2" id="RadioGroup1_1" />
                    三聯式發票</label>
                  <br />
                  統編
<input name="ticket_no" type="text" id="ticket_no" size="10" />
                  <br />
                  抬頭
<input name="ticket_title" type="text" id="ticket_title" size="25" /></p></td>
              </tr>
            </table>
            <div align="right" style="height: 30px; margin: 15px 20px 20px 0;">                                             
               <a onclick="javascript:{VF_form1();return false;document.form1.submit();}" class="buttonb">下一步</a>
               <a href="cart_pt.php" class="buttonb">修改紅利點數</a>
               <a href="cart.php" class="buttonb">修改購物車內容</a>
               <a href="product.php?class2_id=2" class="buttonb">繼續購物</a>
             </div>
          </div>
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