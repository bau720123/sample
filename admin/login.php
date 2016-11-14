<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../webassist/mysqli/authentication.php'); ?>
<?php
//驗證碼功能
include_once dirname(__FILE__) . '/../3rd/securimage/securimage.php';
$securimage = new Securimage();

if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST) && $securimage->check($_POST['captchacheck']) == true)
{
 //如果有勾選記住我，存到cookie
 if ($_POST['rememberme'] == '1') 
 {
 setcookie("member_username", $_POST['member_username'], time()+86400*30); //設定使用者名稱的 Cookie 值
 setcookie("member_password", $_POST['member_password'], time()+86400*30); //設定密碼的 Cookie 值
 }
 //如果沒有勾選記住我，清空cookie
 if ($_POST['rememberme'] != '1') 
 {
 setcookie("member_username", '', time()); //去除使用者名稱的 Cookie 值
 setcookie("member_password", '', time()); //去除密碼的 Cookie 值
 }
 
$Authenticate = new WA_MySQLi_Auth($connection);
$Authenticate->Action = "authenticate";
$Authenticate->Name = "formadmin";
$Authenticate->Table = "member";
$Authenticate->addFilter("member_level", "=", "i", "1");
$Authenticate->addFilter("member_username", "=", "s", "".((isset($_POST["member_username"]))?$_POST["member_username"]:"")  ."");
$Authenticate->addFilter("member_password", "=", "s", "".((isset($_POST["member_password"]))?md5($_POST["member_password"]):"")  ."");
$Authenticate->storeResult("member_id", "admin_member_id");
$Authenticate->storeResult("member_level", "admin_member_level");
$Authenticate->AutoReturn = true;
$SuccessRedirect = "admin_fix.php";
$FailedRedirect = "login_fail.php?code=1";
if(function_exists("rel2abs")) $SuccessRedirect = $SuccessRedirect?rel2abs($SuccessRedirect,dirname(__FILE__)):"";
if(function_exists("rel2abs")) $FailedRedirect = $FailedRedirect?rel2abs($FailedRedirect,dirname(__FILE__)):"";
$Authenticate->SuccessRedirect = $SuccessRedirect;
$Authenticate->FailRedirect = $FailedRedirect;
$Authenticate->execute();
}

//如果驗證碼錯誤
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST) && $securimage->check($_POST['captchacheck']) == false)
{
echo "<script>location.href='login_fail.php?code=2';</script>";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="admin.css" />
<style type="text/css">
body { margin: 0; padding: 0; background-color: #24333e; }
#main { width: 100%; height: 532px; background: url(images/login_main_bg.jpg) repeat-x; }
.inputwidth { width: 150px; }
.button { margin-left: 140px; }
#bottom { width: 100%; height: 29px; background: url(images/login_main_bottom.jpg) repeat-x; text-align: center; padding-top: 6px; }
#bottom a { color: #b6bec8; text-decoration: none; }
#bottom a:hover { text-decoration: underline; }
</style>
<script type="text/javascript">
function VF_formadmin()
{
var theForm = document.formadmin;
var errMsg = "";
var setfocus = "";

 if(theForm['captchacheck'].value == "")
 {
 errMsg = "驗證碼必須填寫";
 setfocus = "['captchacheck']";
 }
 if(theForm['member_password'].value == "")
 {
 errMsg = "管理者密碼必須填寫";
 setfocus = "['member_password']";
 }
 if(theForm['member_username'].value == "")
 {
 errMsg = "管理者帳號必須填寫";
 setfocus = "['member_username']";
 }
 if(errMsg != "")
 {
 alert(errMsg);
 eval("theForm" + setfocus + ".focus()");
 }
 
else theForm.submit();
}
</script>
</head>

<body>
<?php if(isset($_SESSION['admin_member_id'])) { ?><?php require_once("admin_top.php")?><? } ?>
<div id="main" align="center">
  <form action="" method="POST" name="formadmin" id="formadmin" onSubmit="VF_formadmin();return false;">
  <table border="0" cellpadding="0" cellspacing="0" width="1000" height="532">
    <tr>
      <td width="446" valign="middle" align="right">
        <img src="images/test.png" width="320" /> <!--客戶公司LOGO-->
      </td>
      <td width="108">
        <img src="images/login_main_line.jpg" />
      </td>
      <td width="446" valign="middle" align="left">
        <p><font size="3" color="#536577"><strong><!-- 客戶公司名稱 -->後台管理系統</strong></font></p>
        <?php if(isset($_SESSION['admin_member_id'])) { ?>您已登入過，請勿重複登入<? } ?><?php if(empty($_SESSION['admin_member_id'])) { ?><p><font size="2">帳號</font> <input name="member_username" type="text" class="inputwidth" id="member_username" value="<?php if(isset($_COOKIE['member_username'])) echo $_COOKIE['member_username']; ?>">
        </p>
        <p><font size="2">密碼</font> <input name="member_password" type="password"  class="inputwidth" id="member_password" value="<?php if(isset($_COOKIE['member_password'])) echo $_COOKIE['member_password']; ?>">
        </p>
        <p><input name="rememberme" type="checkbox" id="rememberme" style="border-style:hidden; background-color:inherit" value="1" checked="checked" />
        記住帳號密碼，並且每次都進行自動登錄</p>
        <p><font size="2">驗證碼</font> 
          <input type="text" name="captchacheck"  class="inputwidth" id="captchacheck"><object type="application/x-shockwave-flash" data="../3rd/securimage/securimage_play.swf?audio_file=../3rd/securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="20" width="20">
    <param name="movie" value="../3rd/securimage/securimage_play.swf?audio_file=securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
    <param name="wmode" value="transparent" />
          </object>
<br />
        </p>        <img src="../3rd/securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" name="captcha" id="captcha" border="0"><br />
        <a onClick="javascript:captcha_refresh();" style="cursor:pointer">點我刷新驗證圖片</a>
        <p><input name="submit" type="submit" class="button" id="submit" value="登入"></p><? } ?>
      </td>
    </tr>
  </table>
  </form>
</div>
<div id="bottom">
  <font size="1" color="#b6bec8">系統建置 by <a href="http://www.littlebau.com" target="_blank">小包直覺設計</a></font>
</div>
<script type="text/javascript">
function captcha_refresh()
{
var ran = Math.floor(Math.random()*10);
var path = document.getElementById("captcha").src;
document.getElementById("captcha").src = path + "?rand=" + ran;
}
</script>
</body>
</html>