<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php require_once('smtp.php'); ?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))
{
$UpdateQuery = new WA_MySQLi_Query($connection);
$UpdateQuery->Action = "update";
$UpdateQuery->Table = "smtp";
$UpdateQuery->bindColumn("smtp_tls", "i", "".((isset($_POST["smtp_tls"]))?$_POST["smtp_tls"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("smtp_address", "s", "".((isset($_POST["smtp_address"]))?$_POST["smtp_address"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("smtp_port", "i", "".((isset($_POST["smtp_port"]))?$_POST["smtp_port"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("smtp_safe", "s", "".((isset($_POST["smtp_safe"]))?$_POST["smtp_safe"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("smtp_username", "s", "".((isset($_POST["smtp_username"]))?$_POST["smtp_username"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("smtp_password", "s", "".((isset($_POST["smtp_password"]))?$_POST["smtp_password"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("smtp_email", "s", "".((isset($_POST["smtp_email"]))?$_POST["smtp_email"]:"")."", "WA_DEFAULT");
$UpdateQuery->addFilter("smtp_id", "=", "i", "".($_POST['smtp_id'])."");
$UpdateQuery->execute();
$UpdateGoTo = basename($_SERVER['REQUEST_URI']);
if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
$UpdateQuery->redirect($UpdateGoTo);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="admin.css" />
<script type="text/javascript">
function VF_form1()
{
var theForm = document.form1;
var numRE = /^\d+$/;
var emailRE = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
var rFlg_smtp_safe = false;
var rFlg_smtp_tls = false;
var errMsg = "";
var setfocus = "";

for(var r3=0;r3<theForm['smtp_safe'].length;r3++) { if(theForm['smtp_safe'][r3].checked)rFlg_smtp_safe=true; }
for(var r0=0;r0<theForm['smtp_tls'].length;r0++) { if(theForm['smtp_tls'][r0].checked)rFlg_smtp_tls=true; }

 if(!emailRE.test(theForm['smtp_email'].value))
 {
 errMsg = "寄件人電子信箱必須填寫";
 setfocus = "['smtp_email']";
 }
 if(theForm['smtp_password'].value == "")
 {
 errMsg = "密碼必須填寫";
 setfocus = "['smtp_password']";
 }
 if(theForm['smtp_username'].value == "")
 {
 errMsg = "帳號必須填寫";
 setfocus = "['smtp_username']";
 }
 if(!rFlg_smtp_safe)
 {
 errMsg = "是否使用安全驗證尚未勾選";
 setfocus = "['smtp_safe'][0]";
 }
 if(!numRE.test(theForm['smtp_port'].value))
 {
 errMsg = "通訊埠必須填寫";
 setfocus = "['smtp_port']";
 }
 if(theForm['smtp_address'].value == "")
 {
 errMsg = "郵件伺服器必須填寫";
 setfocus = "['smtp_address']";
 }
 if(!rFlg_smtp_tls)
 {
 errMsg = "是否使用TLS尚未勾選";
 setfocus = "['smtp_tls'][0]";
 }
 if (errMsg != "")
 {
 alert(errMsg);
 eval("theForm" + setfocus + ".focus()");
 }
  else
  {
  theForm.button.disabled = true;
  theForm.button.value = "修改中，請稍後！";
  theForm.submit();
  }
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
   <table border="0" cellpadding="0" cellspacing="0" id="content">
    <tr>
     <td>
     <form method="post" name="form1" id="form1" onsubmit="VF_form1();return false;">
     <div class="titleB">
      <div class="titleBText"><input type="submit" name="button" id="button" value="修改資料" /><input name="smtp_id" type="hidden" id="smtp_id" value="<?php echo($smtp->getColumnVal("smtp_id")); ?>" />
     </div>
     </div>
   <table border="0" cellpadding="0" cellspacing="0" id="tableB">
    <tr>
     <td align="left" class="tdlight">推薦設定</td>
     <td align="left" class="tddark">
     <input type="radio" name="smtp_like" id="smtp_like1" onClick="smtp(this);" value="google" />使用GOOGLE<br />
     <input type="radio" name="smtp_like" id="smtp_like2" onclick="smtp(this);" value="yahoo" />
使用YAHOO<br />
     <input type="radio" name="smtp_like" id="smtp_like3" onclick="smtp(this);" value="pchome" />
使用PCHOME <br />
     <input type="radio" name="smtp_like" id="smtp_like4" onclick="smtp(this);" value="other" />
自行設定
     </td>
    </tr>
    <tr>
     <td align="left" class="tdlight">是否使用TLS</td>
     <td align="left" class="tddark">
     <input  <?php if (!(strcmp(($smtp->getColumnVal("smtp_tls")),"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="smtp_tls" id="smtp_tls1" value="1" />使用
     <input  <?php if (!(strcmp(($smtp->getColumnVal("smtp_tls")),"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="smtp_tls" id="smtp_tls2" value="0" />不使用
     </td>
    </tr>
    <tr>
     <td align="left" class="tdlight">郵件伺服器位址</td>
     <td align="left" class="tddark"><input name="smtp_address" type="text" id="smtp_address" value="<?php echo($smtp->getColumnVal("smtp_address")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">通訊埠<br>
       必須於主機上開通</td>
     <td align="left" class="tddark"><input name="smtp_port" type="text" id="smtp_port" value="<?php echo($smtp->getColumnVal("smtp_port")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">是否使用安全驗證</td>
     <td align="left" class="tddark">
     <input  <?php if (!(strcmp(($smtp->getColumnVal("smtp_safe")),"true"))) {echo "checked=\"checked\"";} ?> type="radio" name="smtp_safe" id="smtp_safe1" value="true" />使用
     <input  <?php if (!(strcmp(($smtp->getColumnVal("smtp_safe")),"false"))) {echo "checked=\"checked\"";} ?> type="radio" name="smtp_safe" id="smtp_safe2" value="false" />不使用</td>
    </tr>
    <tr>
     <td align="left" class="tdlight">帳號</td>
     <td align="left" class="tddark"><input name="smtp_username" type="text" id="smtp_username" value="<?php echo($smtp->getColumnVal("smtp_username")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">密碼</td>
     <td align="left" class="tddark"><input name="smtp_password" type="password" id="smtp_password" value="<?php echo($smtp->getColumnVal("smtp_password")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">寄件人電子信箱</td>
     <td align="left" class="tddark"><input name="smtp_email" type="text" id="smtp_email" value="<?php echo($smtp->getColumnVal("smtp_email")); ?>" /></td>
    </tr>
   </table>
     </form>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
</body>
</html>