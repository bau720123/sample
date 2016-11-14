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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE member SET member_uid=%s, member_level=%s, member_uid2=%s, member_username=%s, member_password=%s, member_name=%s, member_nick=%s, city_id=%s, area_id=%s, member_address=%s, member_code=%s, member_birthday=%s, member_tel=%s, member_phone=%s, member_email=%s, member_sex=%s, member_occupation=%s, member_how=%s, member_point=%s, member_hash=%s, member_ok=%s WHERE member_id=%s",
                       GetSQLValueString($_POST['member_uid'], "text"),
					   GetSQLValueString($_POST['member_level'], "int"),
                       GetSQLValueString($_POST['member_uid2'], "text"),
                       GetSQLValueString($_POST['member_username'], "text"),
                       GetSQLValueString($_POST['member_password'], "text"),
                       GetSQLValueString($_POST['member_name'], "text"),
                       GetSQLValueString($_POST['member_nick'], "text"),
                       GetSQLValueString($_POST['city_id'], "int"),
                       GetSQLValueString($_POST['area_id'], "int"),
                       GetSQLValueString($_POST['member_address'], "text"),
                       GetSQLValueString($_POST['member_code'], "text"),
                       GetSQLValueString($_POST['member_birthday'], "date"),
                       GetSQLValueString($_POST['member_tel'], "text"),
                       GetSQLValueString($_POST['member_phone'], "text"),
                       GetSQLValueString($_POST['member_email'], "text"),
                       GetSQLValueString($_POST['member_sex'], "text"),
                       GetSQLValueString($_POST['member_occupation'], "text"),
                       GetSQLValueString($_POST['member_how'], "text"),
                       GetSQLValueString($_POST['member_point'], "int"),
                       GetSQLValueString('X', "text"),
                       GetSQLValueString($_POST['member_ok'], "int"),
                       GetSQLValueString($_POST['member_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "member_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_member_detail = "-1";
if (isset($_GET['member_id'])) {
  $colname_member_detail = $_GET['member_id'];
}
mysql_select_db($database_connection, $connection);
$query_member_detail = sprintf("SELECT * FROM member WHERE member_id = %s", GetSQLValueString($colname_member_detail, "int"));
$member_detail = mysql_query($query_member_detail, $connection) or die(mysql_error());
$row_member_detail = mysql_fetch_assoc($member_detail);
$totalRows_member_detail = mysql_num_rows($member_detail);

mysql_select_db($database_connection, $connection);
$query_city = "SELECT * FROM city ORDER BY city_id ASC";
$city = mysql_query($query_city, $connection) or die(mysql_error());
$row_city = mysql_fetch_assoc($city);
$totalRows_city = mysql_num_rows($city);

$colname_area = "-1";
if (isset($row_member_detail['city_id'])) {
  $colname_area = $row_member_detail['city_id'];
}
mysql_select_db($database_connection, $connection);
$query_area = sprintf("SELECT * FROM area WHERE city_id = %s", GetSQLValueString($colname_area, "int"));
$area = mysql_query($query_area, $connection) or die(mysql_error());
$row_area = mysql_fetch_assoc($area);
$totalRows_area = mysql_num_rows($area);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="admin.css" />
<script type="text/javascript">
function VF_form1(){
	var theForm = document.form1;
	var emailRE = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	var errMsg = "";
	var setfocus = "";

	if (!emailRE.test(theForm['member_email'].value)){
		errMsg = "EMAIL必須填寫";
		setfocus = "['member_email']";
	}
	if (theForm['member_address'].value == ""){
		errMsg = "地址必須填寫";
		setfocus = "['member_address']";
	}
	if (theForm['member_uid2'].value == ""){
		errMsg = "會員編號必須填寫";
		setfocus = "['member_uid2']";
	}
	if (theForm['member_uid'].value == ""){
		errMsg = "身分證字號必須填寫";
		setfocus = "['member_uid']";
	}
	if (theForm['member_name'].value == ""){
		errMsg = "姓名必須填寫";
		setfocus = "['member_name']";
	}
	if (theForm['member_password'].value == ""){
		errMsg = "密碼必須填寫";
		setfocus = "['member_password']";
	}
	if (theForm['member_username'].value == ""){
		errMsg = "帳號必須填寫";
		setfocus = "['member_username']";
	}
	if (errMsg != ""){
		alert(errMsg);
		eval("theForm" + setfocus + ".focus()");
	}
	else { theForm.button.disabled=true;theForm.submit(); }
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onSubmit="VF_form1();return false;">
            <div class="titleB">
              <div class="titleBText"><input value="修改資料" name="button" type="submit" />
                <input name="member_level" type="hidden" id="member_level" value="<?php echo $row_member_detail['member_level']?>" />
              </div>
            </div><table border="0" cellpadding="0" cellspacing="0" id="tableB">
              <tr align="left">
                <td width="30%" class="tdlight">目前點數</td>
                <td class="tdlight"><input name="member_point" type="text" id="member_point" value="<?php echo $row_member_detail['member_point']; ?>"></td>
              </tr>
              <tr align="left">
                <td class="tdlight"><font color="#FF0000">*</font> 帳號</td>
<td width="75%" class="tdlight"><input name="member_username" type="text" id="member_username" value="<?php echo $row_member_detail['member_username']; ?>" />
  </td>
              </tr>
              
              <tr align="left">
                <td class="tddark"><font color="#FF0000">*</font>密碼</td>
                <td class="tddark"><input name="member_password" type="text" id="member_password" value="<?php echo $row_member_detail['member_password']; ?>"></td>
              </tr>
              <tr align="left">
                <td class="tddark"><font color="#FF0000">*</font>姓名</td>
                <td class="tddark"><input name="member_name" type="text" id="member_name" value="<?php echo $row_member_detail['member_name']; ?>" />
                  </td>
              </tr>
              <tr align="left">
                <td class="tddark">暱稱</td>
                <td class="tddark"><input name="member_nick" type="text" id="member_nick" value="<?php echo $row_member_detail['member_nick']; ?>" />
                  </td>
              </tr>
              <tr align="left">
                <td class="tddark"><font color="#FF0000">*</font>身分證字號</td>
                <td class="tddark"><input name="member_uid" type="text" id="member_uid" value="<?php echo $row_member_detail['member_uid']; ?>" />
                  </td>
              </tr>
              <tr align="left">
                <td class="tddark"><font color="#FF0000">*</font>會員編號</td>
                <td class="tddark"><input name="member_uid2" type="text" id="member_uid2" value="<?php echo $row_member_detail['member_uid2']; ?>" />
                  </td>
              </tr>
              <tr align="left">
                <td class="tddark"><font color="#FF0000">*</font>縣市</td>
                <td class="tddark"><select name="city_id" id="city_id" onChange="Buildkey1(document.getElementById('city_id').value);">
                  <?php
do {  
?>
                  <option value="<?php echo $row_city['city_id']?>"<?php if (!(strcmp($row_city['city_id'], $row_member_detail['city_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_city['city_name']?></option>
                    <?php
} while ($row_city = mysql_fetch_assoc($city));
  $rows = mysql_num_rows($city);
  if($rows > 0) {
      mysql_data_seek($city, 0);
	  $row_city = mysql_fetch_assoc($city);
  }
?>
                </select></td>
              </tr>
              <tr align="left">
                <td class="tddark"><font color="#FF0000">*</font>區域</td>
                <td class="tddark"><span id="idbau1"><select name="area_id" id="area_id">
                  <?php
do {  
?>
                  <option value="<?php echo $row_area['area_id']?>"<?php if (!(strcmp($row_area['area_id'], $row_member_detail['area_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_area['area_name']?></option>
                  <?php
} while ($row_area = mysql_fetch_assoc($area));
  $rows = mysql_num_rows($area);
  if($rows > 0) {
      mysql_data_seek($area, 0);
	  $row_area = mysql_fetch_assoc($area);
  }
?>
            </select>
                </span></td>
              </tr>
              <tr align="left">
                <td class="tddark"><font color="#FF0000">*</font>地址</td>
                <td class="tddark"><input name="member_address" type="text" id="member_address" value="<?php echo $row_member_detail['member_address']; ?>" size="30"></td>
              </tr>
              <tr align="left">
                <td class="tddark">郵遞區號</td>
                <td class="tddark"><input name="member_code" type="text" id="member_code" value="<?php echo $row_member_detail['member_code']; ?>"></td>
              </tr>
              <tr align="left">
                <td class="tddark">生日</td>
                <td class="tddark"><input name="member_birthday" type="text" id="member_birthday" value="<?php echo $row_member_detail['member_birthday']; ?>" size="9" maxlength="10"></td>
              </tr>
              <tr align="left">
                <td class="tddark">市內電話</td>
                <td class="tddark"><input name="member_tel" type="text" id="member_tel" value="<?php echo $row_member_detail['member_tel']; ?>"></td>
              </tr>
              
              <tr align="left">
                <td class="tddark">手機</td>
                <td class="tddark"><input name="member_phone" type="text" id="member_phone" value="<?php echo $row_member_detail['member_phone']; ?>"></td>
              </tr>
              
              <tr align="left">
                <td class="tddark"><font color="#FF0000">*</font>EMAIL</td>
                <td class="tddark"><input name="member_email" type="text" id="member_email" value="<?php echo $row_member_detail['member_email']; ?>" size="30"></td>
              </tr>
              <tr align="left">
                <td class="tddark">性別</td>
                <td class="tddark"><select name="member_sex" id="member_sex">
                  <option value="男" selected="selected" <?php if (!(strcmp("男", $row_member_detail['member_sex']))) {echo "selected=\"selected\"";} ?>>男生</option>
                  <option value="女" <?php if (!(strcmp("女", $row_member_detail['member_sex']))) {echo "selected=\"selected\"";} ?>>女生</option>
                </select></td>
              </tr>
              <tr align="left">
                <td class="tddark">職業</td>
                <td class="tddark"><select name="member_occupation" id="member_occupation">
                  <option value="資訊/軟體" <?php if (!(strcmp("資訊/軟體", $row_member_detail['member_occupation']))) {echo "selected=\"selected\"";} ?>>資訊/軟體</option>
                  <option value="網際網路" <?php if (!(strcmp("網際網路", $row_member_detail['member_occupation']))) {echo "selected=\"selected\"";} ?>>網際網路</option>
                  <option value="電子業" <?php if (!(strcmp("電子業", $row_member_detail['member_occupation']))) {echo "selected=\"selected\"";} ?>>電子業</option>
                  <option value="製造業" <?php if (!(strcmp("製造業", $row_member_detail['member_occupation']))) {echo "selected=\"selected\"";} ?>>製造業</option>
                  <option value="美容/美髮" <?php if (!(strcmp("美容/美髮", $row_member_detail['member_occupation']))) {echo "selected=\"selected\"";} ?>>美容/美髮</option>
                  <option value="軍公教" <?php if (!(strcmp("軍公教", $row_member_detail['member_occupation']))) {echo "selected=\"selected\"";} ?>>軍公教</option>
                  <option value="金融業" <?php if (!(strcmp("金融業", $row_member_detail['member_occupation']))) {echo "selected=\"selected\"";} ?>>金融業</option>
                  <option value="服務業" <?php if (!(strcmp("服務業", $row_member_detail['member_occupation']))) {echo "selected=\"selected\"";} ?>>服務業</option>
                  <option value="自由業" <?php if (!(strcmp("自由業", $row_member_detail['member_occupation']))) {echo "selected=\"selected\"";} ?>>自由業</option>
                  <option value="其他" <?php if (!(strcmp("其他", $row_member_detail['member_occupation']))) {echo "selected=\"selected\"";} ?>>其他</option>
                    </select></td>
              </tr>
              <tr align="left">
                <td class="tddark">如何發現我們</td>
                <td class="tddark"><select name="member_how" id="member_how">
                  <option value="朋友" <?php if (!(strcmp("朋友", $row_member_detail['member_how']))) {echo "selected=\"selected\"";} ?>>朋友</option>
                  <option value="宣傳DM" <?php if (!(strcmp("宣傳DM", $row_member_detail['member_how']))) {echo "selected=\"selected\"";} ?>>宣傳DM</option>
                  <option value="說明會/座談會" <?php if (!(strcmp("說明會/座談會", $row_member_detail['member_how']))) {echo "selected=\"selected\"";} ?>>說明會/座談會</option>
                  <option value="其他" <?php if (!(strcmp("其他", $row_member_detail['member_how']))) {echo "selected=\"selected\"";} ?>>其他</option>
                    </select></td>
              </tr>
              
              <tr align="left">
                <td class="tddark">認證狀態</td>
                <td class="tddark"><select name="member_ok" id="member_ok">
                  <option value="0" <?php if (!(strcmp(0, $row_member_detail['member_ok']))) {echo "selected=\"selected\"";} ?>>未認證</option>
                  <option value="1" <?php if (!(strcmp(1, $row_member_detail['member_ok']))) {echo "selected=\"selected\"";} ?>>已認證</option>
                  <option value="2" <?php if (!(strcmp(2, $row_member_detail['member_ok']))) {echo "selected=\"selected\"";} ?>>黑名單</option>
                </select></td>
              </tr>
              <tr align="left">
                <td class="tddark">加入本站時間</td>
                <td class="tddark"><?php echo $row_member_detail['nowtime']; ?>
                  <input name="member_id" type="hidden" id="member_id" value="<?php echo $row_member_detail['member_id']; ?>" />
                  <input type="hidden" name="MM_update" value="form1" />
                </td>
              </tr>
            </table>
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

<script type="text/javascript" src="../javascript/jquery.min.js"></script>
</body>
</html>
<?php
mysql_free_result($member_detail);

mysql_free_result($city);

mysql_free_result($area);
?>