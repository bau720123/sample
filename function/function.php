<?php
//現在時間
$nowtime = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));
$timestamp = time();

//現在時間往後加多少時間
//echo add_date('你所指定的變數時間', '多少年', '多少月', '多少日');
//echo date("Y-m-d H:i:s",(time()+3600));
function add_date($start_time, $year,$month, $day)
{ 
$start_time = strtotime($start_time); 
$result = date("Y-m-d H:i:s", mktime(date('H',$start_time), date('i',$start_time), date('s',$start_time), date('m',$start_time)+$month, date('d',$start_time)+$day, date('Y',$start_time)+$year));
return $result; 
}

//計算相差時間
//echo minus_date('開始時間', '結束時間', '要取得何種資料');
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

//多圖檔上傳+縮圖功能
function imagesResize($src, $dest, $destW, $destH) 
{ 
 //確認檔案存在，並且定義了圖檔儲存路徑後，才進行下述動作
 if(file_exists($src) && isset($dest)) 
 { 
 //取得檔案資訊
 $srcSize = getimagesize($src); //變數$srcSize取得來源圖片資料陣列值
 $srcExtension = $srcSize[2]; //利用變數$srcSize的陣列索引值2取得圖片檔案格式，儲存在變數$srcExtension中
 //圖寬$srcSize[0]圖高$srcSize[1]
 $srcRatio = $srcSize[0] / $srcSize[1]; 
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

//數字分頁功能
function buildNavigation($pageNum_Recordset1, $totalPages_Recordset1, $prev_Recordset1, $next_Recordset1, $separator, $max_links, $show_page=true)
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
	  
	   else { $pagesArray .= "<font color=#FF0000>$textLink</font>"  . ($theNext < $egp-1 ? $separator : ""); }

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
 if ($totalRows_Recordset1 > 0) { 
<table border="0" class="infor_content1">
<tr>
 <td> if ($pageNum_Recordset1 > 0) { // Show if not first page 
          <a href=" printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ">第一頁</a>
           } // Show if not first page </td>
      <td> if ($pageNum_Recordset1 > 0) { // Show if not first page 
          <a href=" printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ">上一頁</a>
           } // Show if not first page </td>
<td>
 
# variable declaration
$prev_Recordset1 = "";
$next_Recordset1 = "";
$separator = " | ";
$max_links = $totalPages_Recordset1+1;
$pages_navigation_Recordset1 = buildNavigation($pageNum_Recordset1,$totalPages_Recordset1,$prev_Recordset1,$next_Recordset1,$separator,$max_links,true); 
print $pages_navigation_Recordset1[0]; 

 print $pages_navigation_Recordset1[1];  print $pages_navigation_Recordset1[2]; 
</td>
<td> if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page 
          <a href=" printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ">下一頁</a>
           } // Show if not last page </td>
      <td> if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page 
          <a href=" printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ">最後一頁</a>
           } // Show if not last page </td>
</tr>
</table>
<? } 
*/

//下拉式選單分頁
/*
<select name="jumppage" id="jumppage" onchange="MM_jumpMenu('parent',this,0)">
<?
$max_links = $totalPages_Recordset1+1; 
for ($page=1;$page<=$max_links;$page++) { 
$truepage = $page-1;
?> 
      <option value="<?php echo $_SERVER['PHP_SELF'];?>?pageNum_Recordset1=<?php echo $truepage;?><?php echo $queryString_Recordset1;?>" <?php if (!(strcmp($truepage, $_GET['pageNum_Recordset1']))) {echo "selected=\"selected\"";} ?>>第<?php echo $page;?>頁</option>
<? } ?>
</select>
*/

//隨機產生密碼
//echo generatorPassword('密碼前置詞', '密碼的長度');
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

//當伺服器的API是ASAPI（IIS）的時候，getenv函數是不起作用的，這種情況下，如果用getenv來取得客戶端ip的話，得到的將是錯誤的IP位址
//echo GetIP();
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

//查詢IP位址的相關資訊
//echo getIPinformation('API第三方網址', '用什麼方式傳輸', 'post查詢時的關聯欄位', 'IP位址');
//echo getIPinformation('http://dir.twseo.org/ip-query3.php', 'post', 'inputip', $_SERVER['REMOTE_ADDR']);
//echo getIPinformation('http://ipinfo.io/' . $_SERVER['REMOTE_ADDR'] . '/json', 'get', '', '');
//echo getIPinformation('http://www.geoplugin.net/json.gp?ip=' . $_SERVER['REMOTE_ADDR'], 'get', '', '');
//echo getIPinformation('http://ip.taobao.com/service/getIpInfo.php?ip=' . $_SERVER['REMOTE_ADDR'], 'get', '', '');
//echo getIPinformation('http://www.ipmango.com/index.php/welcome/get_location', 'get', '', '');
//echo getIPinformation('http://api.ipinfodb.com/v3/ip-city/?key=1699d563ff6ce9daa3dceecf7eb51e08202caf591f4cb4e5d8624298d250fc0c&ip=' . $_SERVER['REMOTE_ADDR'] . '&format=json', 'get', '', '');
function getIPinformation($url, $post_method, $column, $ip)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 if($post_method == 'post')
 {
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array($column => $ip))); 
 }
$output = curl_exec($ch);
if($url == 'http://dir.twseo.org/ip-query3.php') { $output = str_replace("images/", "http://dir.twseo.org/images/", $output); }
return $output;
curl_close($ch);
}

//自動補0
//echo autozero('%08d', '要使用的數字字串');
function autozero($median, $string)
{
$result = sprintf($median,$string);
return $result;
}
 
//大於X位的UTF-8字元之後，剩下的用YYY來取代
//echo autosymbol('要使用的數字字串', '取幾位數', '超過位數時要用什麼符號來替代');
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

//取得生日對應的星座名稱
//echo getStarSignsName('出生月', '出生日')
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
 $time = strtotime("1970-$month-$day");
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

//字串變化
//echo string_mix('welcome to Taiwan!\\', '1');
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

//用於列表頁
$filename_list = 'http://'.$_SERVER["HTTP_HOST"].'/';
$filename_list = urlencode($filename_list);

//用於詳細內容頁
$filename_detail = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];
$filename_detail = urlencode($filename_detail);

//目前檔名
$filename = basename($_SERVER["PHP_SELF"]);

//頁面索引
$string_index = explode(".", $filename);

//使用Google服務來編譯成短網址
//echo shortenGoogleUrl('http://www.littlebau.com');
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

//使用Google服務來解譯成長網址
//echo expandGoogleUrl('http://goo.gl/QdsG8');
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

//隨機亂數
//echo randInt('幾位數');
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

//mcrypt加密
//echo string2secret("許功蓋"); //顯示亂碼
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

//mcrypt解密
//echo secret2string(string2secret("許功蓋")); //顯示結果為"許功蓋"
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

//判斷為何種瀏覽器
//echo whichBrowser();
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

//計算頁面執行時間，並顯示於右上角
//echo '<div style="color:#fff;background:#000;position:absolute;top:0px;right:0px;padding:3px 6px;">本次執行時間：', (pageLoad()), '秒</div>';
//echo pageLoad();
function pageLoad()
{
$time_start = microtime(true); //開始時間
//usleep(10000000); //延遲十秒鐘，以微秒計算的暫停時間，1秒等於1000毫秒，1毫秒等於1000微秒
$time_end = microtime(true); //結束時間

if(empty($_SERVER['REQUEST_TIME_FLOAT']))
{
$result = $time_end - $time_start; //頁面最終執行時間，PHP5.4版本以下支援
}
 else
 {
 $result = $time_end - $_SERVER['REQUEST_TIME_FLOAT']; //頁面最終執行時間，PHP5.4版本含以上支援
 }
return $result;
}

//偵測目前星期幾
//echo what_day();
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

//偵測智慧型平台的版本資訊
//echo check_smart_version('哪種平台');
function check_smart_version($action)
{
 if($action == 'android')
 {
 $rss_url = 'https://play.google.com/store/apps/details?id=com.littlebau.phonegap';
 }
 if($action == 'ios')
 {
 $rss_url = 'https://itunes.apple.com/tw/app/phonegap-with-jquery-mobile/id864908959?mt=8';
 }
 if($action == 'winphone')
 {
 $rss_url = 'http://www.windowsphone.com/zh-tw/store/app/phonegap-with-jquery-mobile/ab7bc038-ee4c-44f2-bbff-613a61fc9493';
 }

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $rss_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//禁止直接顯示獲取的內容
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$rss_content = curl_exec($ch);//賦予值

 if($action == 'android')
 {
 preg_match('/<div[^>]*itemprop="softwareVersion"[^>]*>(.*?) <\/div>/is', $rss_content, $version);
 }
 if($action == 'ios')
 {
 preg_match('/<li[^>]*><span[^>]*class="label"[^>]*>Version: <\/span>(.*?)<\/li>/is', $rss_content, $version);
 }
 if($action == 'winphone')
 {
 preg_match('/<span[^>]*itemprop="softwareVersion"[^>]*>(.*?)<\/span>/is', $rss_content, $version);
 }

$result = trim($version[1]);
if($action == 'winphone')
{
$result = mb_substr($result, 0 ,6 ,"UTF-8");
}
return $result;
curl_close($ch);
}

//黑白名單功能
//echo black_str('即將被偵測的字串');
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

//Google 地圖
//echo google_map_address('44200 Christy St.Fremont ,CA 94538,U.S.A');
//echo google_map_address('No.242, Bo Ai St., Shulin City.Taipei County, 238,Taipei,Taiwan, R.O.C.');
//echo google_map_address('台北市萬大路277巷37弄5號')['results'][0]['address_components'][1]['long_name']; //地址
//echo google_map_address('台北市萬大路277巷37弄5號')['results'][0]['address_components'][2]['long_name']; //鄉里
//echo google_map_address('台北市萬大路277巷37弄5號')['results'][0]['address_components'][3]['long_name']; //區域
//echo google_map_address('台北市萬大路277巷37弄5號')['results'][0]['address_components'][4]['long_name']; //縣市
//echo google_map_address('台北市萬大路277巷37弄5號')['results'][0]['address_components'][5]['long_name']; //國家名稱
//echo google_map_address('台北市萬大路277巷37弄5號')['results'][0]['address_components'][5]['short_name']; //國家代碼
//echo google_map_address('台北市萬大路277巷37弄5號')['results'][0]['address_components'][6]['long_name']; //郵遞區號
//echo google_map_address('台北市萬大路277巷37弄5號')['results'][0]['geometry']['location']['lat']; //緯度
//echo google_map_address('台北市萬大路277巷37弄5號')['results'][0]['geometry']['location']['lng']; //經度
function google_map_address($address)
{
$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . $address = urlencode($address) . "&sensor=false&language=zh-TW";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$geoloc = json_decode(curl_exec($ch), true);
return $geoloc;
}

//自定義排序函式
//$array = array_sort($array, array('排序的欄位'));
function array_sort(array $arr, array $sort_by)
{
$GLOBALS["temp_sort_by"] = $sort_by;

 function compare($arr_1 , $arr_2)  
 {  
 $rtn     = 0;
 $changed = false;
 
  foreach ( $GLOBALS["temp_sort_by"] as $sort)
  {
  $V1 = $arr_1[$sort];
  $V2 = $arr_2[$sort];
  $V1 = is_string ( $V1 ) ? strtoupper ( $V1 ) : $V1;
  $V2 = is_string ( $V2 ) ? strtoupper ( $V2 ) : $V2;
  if ( $V1 < $V2 && !$changed ){ $changed = true; $rtn = -1; }
  if ( $V1 > $V2 && !$changed ){ $changed = true; $rtn =  1; }
  }
  return $rtn;
 } 
usort($arr,'compare');
return $arr;
}

//全半型互轉
//echo nf_to_wf('ｓｂ１０３０００４',0); //轉半形
//echo nf_to_wf('sb1030004',1); //轉全形
function nf_to_wf($strs, $types)
{
$nft = array("(", ")", "[", "]", "{", "}", ".", ",", ";", ":", "-", "?", "!", "@", "#", "$", "%", "&", "|", "\\", "/", "+", "=", "*", "~", "`", "'", "\"", "<", ">", "^", "_", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", " ");
$wft = array("（", "）", "〔", "〕", "｛", "｝", "﹒", "，", "；", "：", "－", "？", "！", "＠", "＃", "＄", "％", "＆", "｜", "＼", "／", "＋", "＝", "＊", "～", "、", "、", "＂", "＜", "＞", "︿", "＿", "０", "１", "２", "３", "４", "５", "６", "７", "８", "９", "ａ", "ｂ", "ｃ", "ｄ", "ｅ", "ｆ", "ｇ", "ｈ", "ｉ", "ｊ", "ｋ", "ｌ", "ｍ", "ｎ", "ｏ", "ｐ", "ｑ", "ｒ", "ｓ", "ｔ", "ｕ", "ｖ", "ｗ", "ｘ", "ｙ", "ｚ", "Ａ", "Ｂ", "Ｃ", "Ｄ", "Ｅ", "Ｆ", "Ｇ", "Ｈ", "Ｉ", "Ｊ", "Ｋ", "Ｌ", "Ｍ", "Ｎ", "Ｏ", "Ｐ", "Ｑ", "Ｒ", "Ｓ", "Ｔ", "Ｕ", "Ｖ", "Ｗ", "Ｘ", "Ｙ", "Ｚ", "　");
 
 if ($types == '1')
 {
 $strtmp = str_replace($nft, $wft, $strs); //轉全形
 }
  else
  {
  $strtmp = str_replace($wft, $nft, $strs); //轉半形
  }
return $strtmp;
}

//Google翻譯
//echo translate('要翻譯的文字', '翻譯到什麼語系', '從什麼語系', true);
/*
af - Afrikaans
sq - Albanian
ar - Arabic
be - Belarusian
bg - Bulgarian
ca - Catalan
zh-CN - Simplified Chinese
zh-TW - traditional Chinese
hr - Croatian
cs - Czech
da - Danish
nl - Dutch
en - English
et - Estonian
tl - Filipino
fi - Finnish
fr - French
gl - Galician
de - German
el - Greek
iw - Hebrew
hi - Hindi
hu - Hungarian
is - Icelandic
id - Indonesian
ga - Irish
it - Italian
ja - Japanese
ko - Korean
lv - Latvian
lt - Lithuanian
mk - Macedonian
ms - Malay
mt - Maltese
no - Norwegian
fa - Persian
pl - Polish
pt - Portuguese
ro - Romanian
ru - Russian
sr - Serbian
sk - Slovak
sl - Slovenian
es - Spanish
sw - Swahili
sv - Swedish
th - Thai
tr - Turkish
uk - Ukrainian
vi - Vietnamese
cy - Welsh
yi - Yiddish
*/
function parseResponse($str = '')
{
$result = strip_tags($str, '<div>');
$result = explode('<', substr($result, strpos($result, 'class="t0"') + 11, strpos($result, 'class="t0"')));
$result = $result[0];
return $result;
} 
	
function translate($text, $to, $from = '', $cache=false)
{
$url = 'https://translate.google.com/m?ie=UTF-8&prev=_m&hl=en&' . 'sl=' . $from . '&tl=' . $to . '&q=' . urlencode(@$text);
 if(file_exists('cache/' . md5($url) . '.cache') && $cache)
 {
 return file_get_contents('cache/'.md5($url).'.cache');
 }	
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
curl_setopt($ch, CURLOPT_REFERER, 'https://translate.google.com/m');
curl_setopt($ch, CURLOPT_URL, $url);
$translate = parseResponse(curl_exec($ch));
 if(!file_exists('cache'))
 {
 @mkdir('cache');
 }
@file_put_contents('cache/' . md5($url) . '.cache', $translate);		
return $translate;
}

//Alexa的排名
//echo getRank('aparat.com');
function getRank($siteUrl)
{
$xml = simplexml_load_file("http://data.alexa.com/data?cli=10&url=".$siteUrl); //讀取alexa的api 
 if($xml)
 {
 $alexaRank['reach'] = (int)$xml->SD->REACH->attributes()->RANK;
 $alexaRank['w_rank'] = (int)$xml->SD->POPULARITY->attributes()->TEXT; //世界排名
 $alexaRank['local_rank'] = (int)$xml->SD->COUNTRY->attributes()->RANK; //國家排名
 echo '網站的世界排名為︰' .$alexaRank['w_rank']. ' 網站的國家排名為︰'.$alexaRank['local_rank'] . ' ==> '. $siteUrl;
 echo '<br>===========<br>';
 }
  else
  {
  echo '錯誤︰網站︰' . $alexaRank['w_rank']. ' 沒有更新！ ==> ' . $siteUrl;
  echo '<br>===========<br>';
  }
$alexaRank['time'] =  date('Y-m-d',time()); //添加檢測更新時間的時間
return $alexaRank;
}

//echo getMultipleRanks(['aparat.com','cloob.com']);
function getMultipleRanks($sites)
{
 $cnt = 1;
  foreach($sites as $sitename => $site)
  {
  $RankDataArr[$cnt][$site] = getRank($site);
  $cnt++;
  }
return $RankDataArr;
}
?>