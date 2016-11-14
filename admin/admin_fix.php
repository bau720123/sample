<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))
{
$UpdateQuery = new WA_MySQLi_Query($connection);
$UpdateQuery->Action = "update";
$UpdateQuery->Table = "member";
$UpdateQuery->bindColumn("member_password", "s", "".((isset($_POST["member_password"]))?md5($_POST["member_password"]):"")  ."", "WA_DEFAULT");
$UpdateQuery->addFilter("member_id", "=", "i", "".($_SESSION['admin_member_id'])  ."");

$UpdateQuery->execute();
$UpdateGoTo = basename($_SERVER['REQUEST_URI']);
if(function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
$UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
$admin_member = new WA_MySQLi_RS("admin_member",$connection,1);
$admin_member->setQuery("SELECT member_password FROM member WHERE member_id = ?");
$admin_member->bindParam("i", "".(isset($_SESSION['admin_member_id'])?$_SESSION['admin_member_id']:"")  ."", "-1");
$admin_member->execute();
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
var errMsg = "";
var setfocus = "";

 if(theForm['member_password2'].value == "" || (theForm['member_password2'].value != theForm['member_password'].value))
 {
 errMsg = "兩次密碼輸入不一致";
 setfocus = "['member_password2']";
 }
 if(theForm['member_password'].value == "")
 {
 errMsg = "管理者密碼必須填寫";
 setfocus = "['member_password']";
 }
 if(errMsg != "")
 {
 alert(errMsg);
 eval("theForm" + setfocus + ".focus()");
 }
  else
  {
  theForm.button.disabled = true;
  theForm.button.value = "新增中，請稍後！";
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
     <form method="post" name="form1" id="form1" onSubmit="VF_form1();return false;">
     <div class="titleB">
      <div class="titleBText"><input type="submit" name="button" id="button" value="修改資料" />
      </div>
     </div>
   <table border="0" cellpadding="0" cellspacing="0" id="tableB">
    <tr>
     <td align="left" class="tdlight"><font color="#FF0000">*</font> 密碼</td>
     <td align="left" class="tddark"><input name="member_password" type="password" class="inputwidth" id="member_password" value="<?php echo($admin_member->getColumnVal("member_password")); ?>">
     </td>
    </tr>
    <tr>
     <td align="left" class="tdlight"><font color="#FF0000">*</font>再輸入一次密碼</td>
     <td align="left" class="tddark"><input name="member_password2" type="password" class="inputwidth" id="member_password2"></td>
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