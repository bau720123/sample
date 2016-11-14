<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
if ($_SERVER["HTTP_HOST"] == 'localhost:8086')
{
$hostname_connection = "localhost";
$database_connection = "littleb1_sample";
$username_connection = "root";
$password_connection = "720123bau";
}
if ($_SERVER["HTTP_HOST"] != 'localhost:8086')
{
$hostname_connection = "localhost";
$database_connection = "littleb1_sample";
$username_connection = "littleb1_bau";
$password_connection = "V9loCkToAK1n";
}
$connection = mysql_pconnect($hostname_connection, $username_connection, $password_connection) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_query("SET NAMES utf8",$connection);
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Taipei');
error_reporting(0);
$nowtime = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));
$timestamp = time();
?>
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
?>
<?php
//登入功能
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl1'] = $_GET['accesscheck'];
}

include_once dirname(__FILE__) . '/../admin/securimage/securimage.php';
$securimage = new Securimage();

if (isset($_POST['member_username']) && isset($_POST['member_password']) && $securimage->check($_POST['captchacheck']) == true) {
  $loginUsername=$_POST['member_username'];
  $password=$_POST['member_password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "admin_fix.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = true;
  if ($_POST['rememberme'] == '1') 
  {
  setcookie("member_username", $_POST['member_username'], time()+86400*30); //設定使用者名稱的 Cookie 值
  setcookie("member_password", $_POST['member_password'], time()+86400*30); //設定密碼的 Cookie 值
  }
  if ($_POST['rememberme'] != '1') 
  {
  setcookie("member_username", '', time()); //去除使用者名稱的 Cookie 值
  setcookie("member_password", '', time()); //去除密碼的 Cookie 值
  }
  mysql_select_db($database_connection, $connection);
  
  $LoginRS__query=sprintf("SELECT member_username, member_password FROM member WHERE member_username=%s AND member_password=%s AND member_level != 0",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connection) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //宣告兩個Session變數
    $_SESSION['MM_Username1'] = $loginUsername;
    $_SESSION['MM_UserGroup1'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl1']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl1'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}

mysql_select_db($database_connection, $connection);
$query_seo_detail = "SELECT * FROM seo WHERE seo_id = 1";
$seo_detail = mysql_query($query_seo_detail, $connection) or die(mysql_error());
$row_seo_detail = mysql_fetch_assoc($seo_detail);
$totalRows_seo_detail = mysql_num_rows($seo_detail);

mysql_select_db($database_connection, $connection);
$query_data_detail = "SELECT * FROM `data` WHERE data_id = 1";
$data_detail = mysql_query($query_data_detail, $connection) or die(mysql_error());
$row_data_detail = mysql_fetch_assoc($data_detail);
$totalRows_data_detail = mysql_num_rows($data_detail);

mysql_select_db($database_connection, $connection);
$query_abouts_detail = "SELECT * FROM aboutus WHERE aboutus_id = 1";
$abouts_detail = mysql_query($query_abouts_detail, $connection) or die(mysql_error());
$row_abouts_detail = mysql_fetch_assoc($abouts_detail);
$totalRows_abouts_detail = mysql_num_rows($abouts_detail);

mysql_select_db($database_connection, $connection);
$query_smtp_detail = "SELECT * FROM smtp WHERE smtp_id = 1";
$smtp_detail = mysql_query($query_smtp_detail, $connection) or die(mysql_error());
$row_smtp_detail = mysql_fetch_assoc($smtp_detail);
$totalRows_smtp_detail = mysql_num_rows($smtp_detail);
?>
<?php
mysql_free_result($seo_detail);
mysql_free_result($data_detail);
mysql_free_result($abouts_detail);
mysql_free_result($smtp_detail);
?>
<?php
//現在時間往後加多少時間
function add_date($start_time, $year,$month, $day)
{ 
$start_time = strtotime($start_time); 
$result = date("Y-m-d H:i:s", mktime(date('H',$start_time), date('i',$start_time), date('s',$start_time), date('m',$start_time)+$month, date('d',$start_time)+$day, date('Y',$start_time)+$year));
return $result; 
}
//echo add_date('你所指定的變數時間', '多少年', '多少月', '多少日');
//date("Y-m-d H:i:s",(time()+3600));
?>
<?php
//計算相差時間
function minus_date($start_time, $end_time, $type)
{
//計算相差幾天
if ($type == 1) { $result = (strtotime($end_time) - strtotime($start_time))/86400; }
//計算相差幾小時 
if ($type == 2) { $result = (strtotime($end_time) - strtotime($start_time))/3600; } 
//計算相差幾秒
if ($type == 3) { $result = strtotime($end_time) - strtotime($start_time); }
return $result;
}
//echo minus_date('開始時間', '結束時間', '要取得何種資料');
?>
<?php
//多圖檔上傳+縮圖功能
function imagesResize($src, $dest, $destW, $destH) 
{ 
 //確認檔案存在，並且定義了圖檔儲存路徑後，才進行下述動作
 if (file_exists($src)  && isset($dest)) 
 { 
 //取得檔案資訊
 $srcSize   = getimagesize($src); //變數$srcSize取得來源圖片資料陣列值
 $srcExtension = $srcSize[2]; //利用變數$srcSize的陣列索引值2取得圖片檔案格式，儲存在變數$srcExtension中
 //圖寬$srcSize[0]圖高$srcSize[1]
 $srcRatio  = $srcSize[0] / $srcSize[1]; 
  //依長寬比判斷長寬像素
  if ($srcRatio > 1)
  {
  $destH = $destW / $srcRatio;
  }
   else
   {
   $destH = $destW; 
   $destW = $destW * $srcRatio;  
   }
 } 
  $destImage = imagecreatetruecolor($destW,$destH); //依據判片後縮圖尺寸，產生出一個準備要放置縮圖的彩色空白圖像
   //依據$srcExtension取得之檔案格式，1=GIF、2=JPG、3=PNG，不同格式使用對應函數讀取圖檔
   switch ($srcExtension) 
   { 
   case 1: $srcImage = imagecreatefromgif($src); break; 
   case 2: $srcImage = imagecreatefromjpeg($src); break; 
   case 3: $srcImage = imagecreatefrompng($src); break; 
   }
   //利用下面2個函數保留PNG圖檔透明效果
   imagealphablending($destImage,false);
   imagesavealpha($destImage,true);
   
   imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0,$destW,$destH,imagesx($srcImage), imagesy($srcImage)); //重新採樣並調整大小後拷貝圖像到另一個圖像中，也就是開始縮圖

   //不同格式圖檔將使用對應的函數輸出圖檔，接著儲存縮圖到指定位置，數值100為圖檔品質，可自行調整 
   switch ($srcExtension) 
   { 
   case 1: imagegif($destImage,$dest); break; 
   case 2: imagejpeg($destImage,$dest,85); break;
   case 3: imagepng($destImage,$dest); break;
   imagedestroy($destImage); //釋放和圖形關聯的記憶體
   } 	
}
?>
<?php
//數字分頁功能
function buildNavigation($pageNum_Recordset1, $totalPages_Recordset1, $prev_Recordset1, $next_Recordset1, $separator=" | ", $max_links=10, $show_page=true)
{
GLOBAL $maxRows_Recordset1,$totalRows_Recordset1;
$pagesArray = ""; $firstArray = ""; $lastArray = "";
if ($max_links<2)$max_links=2;

 if ($pageNum_Recordset1<=$totalPages_Recordset1 && $pageNum_Recordset1>=0)
 {
  if ($pageNum_Recordset1 > ceil($max_links/1))
  {
  $fgp = $pageNum_Recordset1 - ceil($max_links/1) > 0 ? $pageNum_Recordset1 - ceil($max_links/1) : 1;
  $egp = $pageNum_Recordset1 + ceil($max_links/1);
   if ($egp >= $totalPages_Recordset1)
   {
   $egp = $totalPages_Recordset1+1;
   $fgp = $totalPages_Recordset1 - ($max_links-1) > 0 ? $totalPages_Recordset1  - ($max_links-1) : 1;
   }
  }
    else 
	{
	$fgp = 0;
	$egp = $totalPages_Recordset1 >= $max_links ? $max_links : $totalPages_Recordset1+1;
    }
	 if($totalPages_Recordset1 >= 1) 
     {
	 $_get_vars = '';			
	  if(!empty($_GET) || !empty($HTTP_GET_VARS))
	  {
	  $_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
	   foreach ($_GET as $_get_name => $_get_value) 
	   {
	    if ($_get_name != "pageNum_Recordset1") 
	    {
	    $_get_vars .= "&$_get_name=$_get_value";
	    }
	   }
	  }
	$successivo = $pageNum_Recordset1+1;
	$precedente = $pageNum_Recordset1-1;
	$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_class=$precedente$_get_vars\">$prev_Recordset1</a>" :  "$prev_Recordset1";
	
	 for($a = $fgp+1; $a <= $egp; $a++)
	 {
	 $theNext = $a-1;
      
	  if($show_page) { $textLink = $a; } 
	  else 
	  {
      $min_l = (($a-1)*$maxRows_Recordset1) + 1;
      $max_l = ($a*$maxRows_Recordset1 >= $totalRows_Recordset1) ? $totalRows_Recordset1 : ($a*$maxRows_Recordset1);
      $textLink = "$min_l - $max_l";
      }

      $_ss_k = floor($theNext/26);
      if ($theNext != $pageNum_Recordset1)
      {
	  $pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_Recordset1=$theNext$_get_vars\">";
      $pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
	  } 
	  
	   else { $pagesArray .= "<span class='red'>$textLink</span>"  . ($theNext < $egp-1 ? $separator : ""); }

     }

     $theNext = $pageNum_Recordset1+1;
	 $offset_end = $totalPages_Recordset1;
	 $lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_Recordset1=$successivo$_get_vars\">$next_Recordset1</a>" : "$next_Recordset1";
     }
	
 }

return array($firstArray,$pagesArray,$lastArray);
}

//數字分頁
/*
<?php if ($totalRows_Recordset1 > 0) { ?>
<table border="0" class="infor_content1">
<tr>
 <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">第一頁</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">上一頁</a>
          <?php } // Show if not first page ?></td>
<td>
<?php 
# variable declaration
$prev_Recordset1 = "";
$next_Recordset1 = "";
$separator = " | ";
$max_links = $totalPages_Recordset1+1;
$pages_navigation_Recordset1 = buildNavigation($pageNum_Recordset1,$totalPages_Recordset1,$prev_Recordset1,$next_Recordset1,$separator,$max_links,true); 
print $pages_navigation_Recordset1[0]; 
?>
<?php print $pages_navigation_Recordset1[1]; ?><?php print $pages_navigation_Recordset1[2]; ?>
</td>
<td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">下一頁</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">最後一頁</a>
          <?php } // Show if not last page ?></td>
</tr>
</table>
<? } ?>
*/

//下拉式選單分頁
/*
<select name="jumppage" id="jumppage" onchange="MM_jumpMenu('parent',this,0)">
<? 
for ($page=1;$page<=$max_links;$page++) { 
$truepage = $page-1;
?> 
  <option value="<?php echo $PHP_SELF;?>?pageNum_Recordset1=<?php echo $truepage;?><?php echo $queryString_Recordset1;?>" <?php if (!(strcmp($truepage, $_GET['pageNum_Recordset1']))) {echo "selected=\"selected\"";} ?>>第<?php echo $page;?>頁</option>
<? } ?>
</select>
*/
?>
<?php
//隨機產生密碼
function generatorPassword($password, $password_len)
{
$word = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789';
$len = strlen($word);
 for ($i = 0; $i < $password_len; $i++) 
 {
 $password .= $word[rand() % $len];
 }
return $password;
}
//echo generatorPassword('密碼前置詞', '密碼的長度');
?>
<?php
//當伺服器的API是ASAPI（IIS）的時候，getenv函數是不起作用的，這種情況下，如果用getenv來取得客戶端ip的話，得到的將是錯誤的IP位址
function GetIP()
{
if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
$ip = getenv("HTTP_CLIENT_IP");
else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
$ip = getenv("REMOTE_ADDR");
else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
$ip = $_SERVER['REMOTE_ADDR'];
else
$ip = "unknown";
return $ip;
}
//echo GetIP();
?>
<?php
//自動補0
function autozero($median, $string)
{
$result = sprintf($median,$string);
return $result;
}
//echo autozero('%08d', '要使用的數字字串');
?>
<?php 
//大於X位的UTF-8字元之後，剩下的用YYY來取代
function autosymbol($string, $length, $symbol)
{
$string_1 = mb_substr($string,0,$length,'UTF-8');
 if(mb_strlen($string,'UTF-8') > $length)
 {
  for($i=0;$i<mb_strlen($string,'UTF-8')-$length;$i++)
  {
  $symbol_count = $symbol_count.$symbol;
  }
 $result = $string_1.$symbol_count;
 }
if(mb_strlen($string,'UTF-8') <= $length) { $result = $string_1; }
return $result;
}
//echo autosymbol('要使用的數字字串', '取幾位數', '超過位數時要用什麼符號來替代');
?>
<?php
//取得生日對應的星座名稱
function getStarSignsName($month, $day) 
{
mb_internal_encoding("UTF-8");
$list=
array(
array('name'=>"摩羯座",'min'=>'12-22','max'=>'01-19'),  
array('name'=>"水瓶座",'min'=>'01-20','max'=>'02-18'),
array('name'=>"雙魚座",'min'=>'02-19','max'=>'03-20'),
array('name'=>"牡羊座",'min'=>'03-21','max'=>'04-19'),
array('name'=>"金牛座",'min'=>'04-20','max'=>'05-20'),
array('name'=>"雙子座",'min'=>'05-21','max'=>'06-21'),
array('name'=>"巨蟹座",'min'=>'06-22','max'=>'07-22'),
array('name'=>"獅子座",'min'=>'07-23','max'=>'08-22'),
array('name'=>"處女座",'min'=>'08-23','max'=>'09-22'),
array('name'=>"天秤座",'min'=>'09-23','max'=>'10-23'),
array('name'=>"天蠍座",'min'=>'10-24','max'=>'11-22'),
array('name'=>"射手座",'min'=>'11-23','max'=>'12-21'),
); 
 $time=strtotime("1970-$month-$day");
 foreach ($list as $row)
 {
 $min=strtotime("1970-".$row['min']);
 $max=strtotime("1970-".$row['max']);
  if ($min<=$time && $time<=$max)
  {
  return $row['name'];
  }
 }
$result = iconv("big5","UTF-8",$list[0]['name']);
return $result;
}
//echo getStarSignsName('出生月', '出生日')
?>
<?php
//字串變化
function string_mix($string, $type)
{
if ($type == 1) { $result = strtoupper($string); } //全部轉大寫
if ($type == 2) { $result = strtolower($string); } // 全部轉小寫
if ($type == 3) { $result = ucfirst($string); } //段落中的第一個區段的字轉大寫
if ($type == 4) { $result = ucwords($string); } //段落中的每個區段的第一個字轉大寫
if ($type == 5) { $result = strrev($string); } //反轉字串
if ($type == 6) { $result = stripslashes($string); } //去除反斜線
return $result;
}
//echo string_mix('welcome to Taiwan!\\', '1');
?>
<?php
//用於列表頁
$filename_list = 'http://'.$_SERVER["HTTP_HOST"].'/';
$filename_list = urlencode($baupath);

//用於詳細內容頁
$filename_detail = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];
$filename_detail = urlencode($baupath1);

//目前檔名
$filename = basename($_SERVER["PHP_SELF"]);
?>
<?php
//使用Google服務來編譯成短網址
function shortenGoogleUrl($long_url)
{
$apiKey = 'AIzaSyB77mM4iXl19V38-c-rPWNfCFTI1Suv8Zg'; //可以從下列網址得到apiKey：http://code.google.com/apis/console/
$postData = array('longUrl' => $long_url, 'key' => $apiKey);
$jsonData = json_encode($postData);
$curlObj = curl_init();
curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curlObj, CURLOPT_HEADER, 0);
curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
curl_setopt($curlObj, CURLOPT_POST, 1);
curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
$response = curl_exec($curlObj);
curl_close($curlObj);
$json = json_decode($response);
return $json->id;
}
//echo shortenGoogleUrl('http://www.littlebau.com');

//使用Google服務來解譯成長網址
function expandGoogleUrl($short_url)
{
$curlObj = curl_init();
curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?shortUrl='.$short_url);
curl_setopt($curlObj, CURLOPT_HEADER, 0);
curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($curlObj);
$http_code = curl_getinfo($curlObj, CURLINFO_HTTP_CODE);
curl_close($curlObj);
$json = json_decode($response);
return $json->longUrl;
}
//echo expandGoogleUrl('http://goo.gl/QdsG8');
?>
<?php
//隨機亂數
function randInt($length)
{
//FOR回圈以$random為判斷執行次數
for ($i=1;$i<=$length;$i=$i+1)
{
$rand_range = rand(1,3); //亂數$c設定三種亂數資料格式大寫、小寫、數字，隨機產生
if($rand_range==1) { $rand_type = rand(97,122); $rand = chr($rand_type); } //在$c為1的情況下，設定$a亂數取值為97-122之間，並用chr()將數值轉變為對應英文，儲存在$b
if($rand_range==2) { $rand_type = rand(65,90); $rand = chr($rand_type); } //在$c為2的情況下，設定$a亂數取值為65-90之間，並用chr()將數值轉變為對應英文，儲存在$b
if($rand_range==3) { $rand = rand(0,9); } //在$c為3的情況下，設定$b亂數取值為0-9之間的數字
$result = $result.$rand;
}
return $result;
}
//echo randInt('幾位數');
?>
<?php
//加密  
function string2secret($str)  
{  
$key = "123"; //令牌配置
$td = mcrypt_module_open(MCRYPT_DES,'','ecb','');  
$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);  
$ks = mcrypt_enc_get_key_size($td);  
  
$key = substr(md5($key), 0, $ks);  
mcrypt_generic_init($td, $key, $iv);  
$secret = mcrypt_generic($td, $str);  
mcrypt_generic_deinit($td);  
mcrypt_module_close($td);  
return $secret;  
}  
//echo string2secret("許功蓋"); //顯示亂碼

//解密
function secret2string($sec)  
{  
$key = "123"; //令牌配置
$td = mcrypt_module_open(MCRYPT_DES,'','ecb','');  
$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);  
$ks = mcrypt_enc_get_key_size($td);  
  
$key = substr(md5($key), 0, $ks);  
mcrypt_generic_init($td, $key, $iv);  
$string = mdecrypt_generic($td, $sec);  
mcrypt_generic_deinit($td);  
mcrypt_module_close($td);  
return trim($string);  
}  
//echo secret2string(string2secret("許功蓋")); //顯示結果為"許功蓋"
?>
<?php
//判斷為何種瀏覽器
function whichBrowser()
{
$result = $_SERVER['HTTP_USER_AGENT'];
if(strpos($result,"MSIE")) { $result = "Internet Explorer"; }
if(strpos($result,"Firefox")) { $result = "Firefox"; }
if(strpos($result,"Chrome")) { $result = "Chrome"; }
if(strpos($result,"Safari")) { $result = "Safari"; }
if(strpos($result,"Presto")) { $result = "Opera"; }
return $result; 
}
//echo whichBrowser();
?>
<?php
//計算頁面執行時間，並顯示於右上角
function pageLoad()
{
$time_start = microtime(true); //開始時間
//usleep(10000000); //延遲十秒鐘，以微秒計算的暫停時間，1秒等於1000毫秒，1毫秒等於1000微秒
$time_end = microtime(true); //結束時間

if (empty($_SERVER['REQUEST_TIME_FLOAT']))
{
$result = $time_end - $time_start; //頁面最終執行時間，PHP5.4版本以下支援
}
 else
 {
 $result = $time_end - $_SERVER['REQUEST_TIME_FLOAT']; //頁面最終執行時間，PHP5.4版本含以上支援
 }
return $result;
}
//echo '<div style="color:#fff;background:#000;position:absolute;top:0px;right:0px;padding:3px 6px;">本次執行時間：', (pageLoad()), '秒</div>';
//echo pageLoad();
?>
<?php
//偵測目前星期幾
function what_day()
{
$day = date("l");
 switch($day)
 {
 case "Monday";
 $result = "今天是星期一，一周忙碌生活開始了";
 break;
 case "Tuesday";
 $result = "今天是星期二，電視台下午兩點以後部分休息";
 break;
 case "Wednesday";
 $result = "今天是星期三，下午有乒乓球比賽";
 break;
 case "Thursday";
 $result = "今天是星期四，晚上有NBA的重播";
 break;
 case "Friday";
 $result = "今天是黑色星期五。。。。。。";
 break;
 case "Saturday";
 $result = "今天是星期六";
 break;
 case "Sunday";
 $result = "今天是星期天，可以玩上一整天";
 }
return $result;
}
//echo what_day();
?>
<?php
//偵測智慧型平台的版本資訊
function check_version($action)
{
 if($action == 'ios')
 {
 $rss_url = 'https://itunes.apple.com/tw/app/phonegap-with-jquery-mobile/id864908959?mt=8';
 }
 if($action == 'android')
 {
 $rss_url = 'https://play.google.com/store/apps/details?id=com.littlebau.phonegap';
 }
 if($action == 'winphone')
 {
 $rss_url = 'http://www.windowsphone.com/zh-tw/store/app/phonegap-with-jquery-mobile/ab7bc038-ee4c-44f2-bbff-613a61fc9493';
 }

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$rss_url);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//禁止直接顯示獲取的內容
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$rss_content = curl_exec($ch);//賦予值

 if($action == 'ios')
 {
 preg_match('/<li[^>]*><span[^>]*class="label"[^>]*>Version: <\/span>(.*?)<\/li>/is',$rss_content,$version);
 }
 if($action == 'android')
 {
 preg_match('/<div[^>]*itemprop="softwareVersion"[^>]*>(.*?) <\/div>/is',$rss_content,$version);
 }
 if($action == 'winphone')
 {
 preg_match('/<span[^>]*itemprop="softwareVersion"[^>]*>(.*?)<\/span>/is',$rss_content,$version);
 }

$result = trim($version[1]);
if($action == 'winphone')
{
$result = mb_substr($result,0,6,"UTF-8");
}
return $result;
curl_close($ch);
}
//echo check_version('哪種平台');
?>
<?php
//黑白名單功能
function black_str($str)
{
$array = array('圖書','明日科技','軟件','編程詞典','編程','詞典');
$repstr = implode($array);
 if(preg_match("/$str/",$repstr))
 {
 $result = 'black';
 }
  else
  {
  $result = 'white';
  }
return $result;
}
//echo black_str('即將被偵測的字串');
?>