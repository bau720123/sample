<?php
require 'facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '197653916921532',
  'secret' => 'b402c3c55490a24c48b9126db576012d',
  'cookie' => true,
));

//$session = $facebook->getSession();
$session = $facebook->getUser();

$me = null;
// Session based API call.
if ($session) {
  try {
    $uid = $facebook->getUser();
    $me = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
  }
}

if ($me) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  //$loginUrl = $facebook->getLoginUrl();
  $loginUrl = $facebook->getLoginUrl(array(
    'scope' => 'email,user_birthday,user_friends', 
	'auth_type' => 'reauthenticate',
	'fbconnect' => 1,
    'canvas' => 0,
	'req_perms' => 'email,publish_stream',
    'next' => 'http://www.littlebau.com/index.php',
    'redirect_uri' => 'http://www.littlebau.com/index1.php',
));
}
$home = explode(", ", $me['hometown']['name']);

// 取得登入使用者 ID
$user = $facebook->getUser();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html 
xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId   : '<?php echo $facebook->getAppId(); ?>',
          session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it
          status  : true, // check login status
          cookie  : true, // enable cookies to allow the server to access the session
          xfbml   : true // parse XFBML
        });

        // whenever the user logs in, we refresh the page
        FB.Event.subscribe('auth.login', function() {
          window.location.reload();
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/zh_TW/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script><?php if ($me['verified'] =='') { ?><fb:login-button>登入</fb:login-button>
    <?php } ?><?php if ($me['verified'] =='1') { ?>
    <a href="<?php echo $facebook->getLogoutUrl(); ?>">登出</a><? } ?><br/>

大頭貼：<img src="https://graph.facebook.com/<?php echo $uid; ?>/picture" /><br />
會員編號：<?php print_r($session); ?> || <?php echo $me['id']; ?><br />
生日：<?php echo $me['birthday']; ?><br />
EMAIL：<?php echo $me['email']; ?><br />
名：<?php echo $me['first_name']; ?><br /> 
性別：<?php echo $me['gender']; ?><br />
姓：<?php echo $me['last_name']; ?><br />
短網址：<?php echo $me['link']; ?><br />
地理：<?php echo $me['locale']; ?><br />
姓名：<?php echo $me['name']; ?><br />
自我介紹：<?php echo $me['bio']; ?> <br />
時區：<?php echo $me['timezone']; ?><br />
最新一次更新自己狀態時間：<?php echo $me['updated_time']; ?><br />
認證狀態：<?php echo $me['verified']; ?><br />
好友名單:<br />
<?php
if ($user) {
    //$user_profile = $facebook->api('/me');
	
	$friends = $facebook->api('/me/friends');
    
	echo '<pre>';
	print_r($friends);
	echo '</pre>';
	/*echo '<ul>';
    foreach ($friends["data"] as $value) {
        echo '<li>';
        echo '<div class="pic">';
        echo '<img src="https://graph.facebook.com/' . $value["id"] . '/picture"/>';
        echo '</div>';
        echo '<div class="picName">'.$value["name"].'</div>'; 
        echo '</li>';
    }
    echo '</ul>';*/
}
?>
</body>
</html>