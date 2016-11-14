<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['member_usernamelogin'])) {
  $loginUsername=$_POST['member_usernamelogin'];
  $password=$_POST['member_passwordlogin'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php?data=mymix";
  $MM_redirectLoginFailed = "login.php?logout=0";
  $MM_redirecttoReferrer = false;
  if ($_POST['rememberme'] == '1') 
  {
  setcookie("member_usernamelogin", $_POST['member_usernamelogin'], time()+86400*30); //設定使用者名稱的 Cookie 值
  setcookie("member_passwordlogin", $_POST['member_passwordlogin'], time()+86400*30); //設定密碼的 Cookie 值
  }
  if ($_POST['rememberme'] != '1') 
  {
  setcookie("member_usernamelogin", '', time()); //去除使用者名稱的 Cookie 值
  setcookie("member_passwordlogin", '', time()); //去除密碼的 Cookie 值
  }
  mysql_select_db($database_connection, $connection);
  
  $LoginRS__query=sprintf("SELECT member_username, member_password, member_id FROM member WHERE member_username=%s AND member_password=%s AND member_ok= '1'",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connection) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
	 $loginMemberId  = mysql_result($LoginRS,0,'member_id');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	$_SESSION['MM_memberId'] = $loginMemberId;

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
	echo "<script>alert('帳號密碼登入錯誤，請重新再嘗試一次！');location.href='$MM_redirectLoginFailed';</script>";
    //header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  $_SESSION['MM_memberId'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['MM_memberId']);
	
  $logoutGoTo = "login.php?logout=0";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<script type="text/javascript"><!--
function VF_formlogin(){ //v2.0
<!--start_of_saved_settings-->
<!--type,text,name,member_password,required,true,errMsg,密碼必須填寫-->
<!--type,text,name,member_username,required,true,errMsg,帳號必須填寫-->
<!--end_of_saved_settings-->
	var theForm = document.formlogin;
	var errMsg = "";
	var setfocus = "";

	if (theForm['member_passwordlogin'].value == ""){
		errMsg = "密碼必須填寫";
		setfocus = "['member_password']";
	}
	if (theForm['member_usernamelogin'].value == ""){
		errMsg = "帳號必須填寫";
		setfocus = "['member_username']";
	}
	if (errMsg != ""){
		alert(errMsg);
		eval("theForm" + setfocus + ".focus()");
	}
	else theForm.submit();
}//-->
</script>

<? $myfile = basename($_SERVER["PHP_SELF"]);
$mystring = $_SERVER['QUERY_STRING'];
$mystring2 = explode("&", $_SERVER['QUERY_STRING']);?><tr>
    <td height="99">
      <table width="987" height="99" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="209" align="center" valign="bottom">&nbsp;</td>
          <td width="125" valign="bottom">
            <table width="125" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                  <table width="125" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="32">&nbsp;</td>
                      <td width="32"></td>
                      <td width="32"></td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="15" class="fix">
                  
                </td>
              </tr>
            </table>
          </td>
          <td width="300" valign="bottom">
            <table width="310" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="32">&nbsp;</td>
              </tr>
              <tr>
                <td height="15" class="fix">&nbsp;</td>
              </tr>
            </table>
          </td>
          <td>&nbsp;</td>
          <td width="350" valign="bottom">
            <div id="mytabsmenu" class="tabsmenuclass">
            <table width="320" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                  <form id="formlogin" name="formlogin" method="post" action="<?php echo $loginFormAction; ?>">
                  <table width="320" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>
                        <table width="320" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="155"><?php if(empty($_SESSION['MM_Username'])) { ?><img src="image/id.png" width="42" height="16" /><? } ?></td>
                            <td><?php if(empty($_SESSION['MM_Username'])) { ?><img src="image/pw.png" width="37" height="16" /><? } ?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <table width="350" border="0" cellspacing="0" cellpadding="0">
                          <?php if ($myfile != 'contact.php' || $myfile != 'login.php') { ?><tr>
                            <td width="150"><?php if(empty($_SESSION['MM_Username'])) { ?><span class="title1">
                              <input name="member_usernamelogin" type="text" id="member_usernamelogin" value="<?php if(isset($_COOKIE['member_usernamelogin'])) echo $_COOKIE['member_usernamelogin']; ?>" size="20" />
                            </span><? } ?></td>
                            <td width="143"><?php if(empty($_SESSION['MM_Username'])) { ?><span class="title1">
                              <input name="member_passwordlogin" type="password" id="textfield8" value="<?php if(isset($_COOKIE['member_passwordlogin'])) echo $_COOKIE['member_passwordlogin']; ?>" size="18" />
                            </span><? } ?></td>
                            <td><?php if(empty($_SESSION['MM_Username'])) { ?><img src="image/login_button.png" width="59" height="24" border="0" onclick="javascript:{VF_formlogin();return false;document.formlogin.submit();}" style="cursor:pointer" /><? } ?>
                              <?php if(isset($_SESSION['MM_Username'])) { ?><a href="<?php echo $logoutAction ?>"><img src="image/logout_button.png" width="59" height="24" border="0" /></a><? } ?></td>
                          </tr><? } ?>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td height="28">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="6" class="fix">&nbsp;</td>
                            <td width="15"><img src="image/forget_pw.png" width="15" height="15" /></td>
                            <td width="80" class="infor"><a href="forget.php?logout=0" class="gray2" id="forget_pw" rel="subcontent2">忘記密碼</a></td>
                            <td width="16"><img src="image/reg.png" width="16" height="16" /></td>
                            <td width="80" class="infor"><a href="login.php?logout=0" class="gray2">我要註冊</a></td>
                            <td width="80"><?php if ($myfile != 'login.php') { ?><a href="index.php" class="gray2">回首頁</a><? } ?>
                            </td>
                            <td width="23" class="infor"><?php if(empty($_SESSION['MM_memberId'])) { ?><input name="rememberme" type="checkbox" id="rememberme" style="border-style:hidden; background-color:inherit" value="1" checked="checked" /><? } ?></td>
                            <td width="97" class="infor"><?php if(empty($_SESSION['MM_memberId'])) { ?><a href="#" class="gray2">自動登入帳號</a><? } ?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  </form>
                </td>
              </tr>
            </table>
          </div></td>
        </tr>
      </table>
    </td>
  </tr>