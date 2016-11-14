<?php require_once('../Connections/connection.php'); ?>
<?php
//自動登入功能
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl1'] = $_GET['accesscheck'];
}

if(isset($_COOKIE['member_username']) && isset($_COOKIE['member_password'])) {
  $loginUsername=$_COOKIE['member_username'];
  $password=$_COOKIE['member_password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "$_GET[accesscheck]";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = true;
  setcookie("member_username", $_COOKIE['member_username'], time()+86400*30); //設定使用者名稱的 Cookie 值
  setcookie("member_password", $_COOKIE['member_password'], time()+86400*30); //設定密碼的 Cookie 值
  mysql_select_db($database_connection, $connection);
  
  $LoginRS__query=sprintf("SELECT member_username, member_password FROM member WHERE member_username=%s AND member_password=%s AND member_level != 0",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text"));
   
  $LoginRS = mysql_query($LoginRS__query, $connection) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
	 $loginMemberId  = mysql_result($LoginRS,0,'member_id');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //宣告兩個Session變數
    $_SESSION['MM_Username1'] = $loginUsername;
    $_SESSION['MM_UserGroup1'] = $loginStrGroup;

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>