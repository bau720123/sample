<?php require_once('Connections/connection.php'); ?>
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
  $MM_redirectLoginSuccess = "$_GET[accesscheck]";
  $MM_redirectLoginFailed = "login.php?logout=0";
  $MM_redirecttoReferrer = true;
  /*if ($_POST['rememberme'] == '1') 
  {
  setcookie("member_usernamelogin", $_POST['member_usernamelogin'], time()+86400*30); //設定使用者名稱的 Cookie 值
  setcookie("member_passwordlogin", $_POST['member_passwordlogin'], time()+86400*30); //設定密碼的 Cookie 值
  }
  if ($_POST['rememberme'] != '1') 
  {
  setcookie("member_usernamelogin", '', time()); //去除使用者名稱的 Cookie 值
  setcookie("member_passwordlogin", '', time()); //去除密碼的 Cookie 值
  }*/
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

    if (isset($_SESSION['PrevUrl']) && true) {
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
	
  $logoutGoTo = "index.php?data=mymix";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row_seo_detail['seo_title']; ?>-自動登入中</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-自動登入中" />
<?php require_once("seo.php")?>
<?php require_once("css.php")?>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body <?php if($_GET['logout'] == '1' && isset($_GET['logout'])) { ?>onLoad="MM_callJS('document.formlogin.submit();')"<? } ?>>
<form id="formlogin" name="formlogin" method="post" action="<?php echo $loginFormAction; ?>">
                  <input name="member_usernamelogin" type="hidden" id="member_usernamelogin" value="<?php if(isset($_COOKIE['member_usernamelogin'])) echo $_COOKIE['member_usernamelogin']; ?>" /><input name="member_passwordlogin" type="hidden" id="member_passwordlogin" value="<?php if(isset($_COOKIE['member_passwordlogin'])) echo $_COOKIE['member_passwordlogin']; ?>" /></form>
</body>
</html>