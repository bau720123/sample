<?php require_once('Connections/connection.php'); ?>
<?php require_once('function/function.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PHP</title>
</head>

<body>
<?php
//判斷是否為本機程式送出資料1代表示本機程式,不等於1代表非本機程式
if(isset($_SERVER['HTTP_REFERER']) && substr_count($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"].'/'."上一頁.php") == 1)
{
echo "本機程式路徑";
}
 else
 {
 echo "非本機程式路徑";
 }
?>
<?php
//將目前頁面轉成相關文件格式
if(isset($download))
{
$upload_dir = "../uploads/doc/";
if ($download == 1) { $LocalName = "StorePickup_myfone.pdf"; }
if ($download == 2) { $LocalName = "StorePickup_711.pdf"; }
header('Content-type: application/doc');
header("Content-type: application/vnd.ms-excel");
header('Content-type: application/pdf');
//header('Content-type: application/force-download');
header('Content-Disposition: attachment; filename='. $LocalName);
header("Content-Transfer-Encoding: Binary");
readfile($upload_dir.$LocalName);
}
?>
<?php
//建立資料夾目錄，並且新增一個檔案
if(isset($_GET['account']))
{
$nowSrvPath = str_replace('\\', '/', dirname(__FILE__));
$path = '/'.$_GET['account'];  
$filename = 'index.php';
$truepath = $nowSrvPath.$path;
 if(!is_dir($truepath)) 
 {
 //mkdir($truepath,0777); 
}
//copy("$nowSrvPath/index.php", "$truepath/$filename");
//$fp = fopen("$truepath/$filename", "w+");
//$fp = fwrite($fp, "<meta http-equiv='Refresh' content='0;URL=../group_page.php?account=$_GET[account]' />");
}
?>
<?php
//根據分割符號來從字串中取出相對應的值
$string  = "piece1&piece2&piece3";
$string = explode("&", $string); //設定分割符號
$result_count = count($string); //筆數
echo $string[0];
echo $result_count;
?>
<?php
//連續陣列值，先把表單欄位的名字變更成"member_group_id[]"
if(isset($_POST['member_group_id']))
{
$member_group_id = implode(",",$_POST['member_group_id']); //之後就會類似輸出成1,2,3
}
?>
<?php
/*橫向重複區域
適用於<td></td>標籤

程式碼
<?php do { ?>
的上方加上
<?php $cno=0;?>

程式碼
<?php } while ($row_資料集名稱 = mysql_fetch_assoc($資料集名稱)); ?>
的上方加上
<?php $cno++;if($cno%4==0){echo "</tr><tr>";}?>
*/
?>
<?php
//印出瀏覽器ID
//session_start();
echo session_id();
?>
<?php
//任意精度函數
$a = '1.234';
$b = '5';
bcadd($a,$b); //6，相加後取整數
bcadd($a,$b,4); //6.2340，相加後並保存x位小數點
bcsub($a,$b); //-3，相減後取整數
bcsub($a,$b,4); //-3.7660，相減後並保存x位小數點
bcmul('2','4'); //8，相乘後取整數
bcmul('1.34747474747','35',3); //47.161，相乘後並保存x位小數點
bcdiv('105','6.55957'); //16，相除後取整數
bcdiv('105','6.55957',3); //16.007，相除後後並保存x位小數點
bcmod('2','4'); //2，取餘數的整數
fmod(5.7,1.3); //0.5，取餘數的小數
pow(2,8); //256，x的y次方
bcpow('4.2','3',2); //74.08，x的y次方後並保存z位小數點
sqrt('10'); //3.16227766017，x的開根號
bcsqrt('2','3'); //1.414，x的開根號後並保存y位小數點

//四捨五入函數
ceil(4.3); //5，無條件進位後取最大
floor(4.3); //4，無條件捨去後取最小
round(3.6); //4，四捨五入
round(3.62,1); //4，小數點第x位後四捨五入
round(1241757,-3); //1242000，小數點第-x位後四捨五入

//其它常用數學函數
abs(-4.2); //4.2，不管正負取絕對值
max(1,3,5,6,7); //7，取最大直
min(2,3,1,6,7); //1，取最小值
(int)-5; //-5，不管正負取整數
?>
<?php
//測試MySQL資料庫的連線
/*$connection = mysql_connect('localhost', 'root', '720123bau');
$db_selected = mysql_select_db('littleb1_sample', $connection);
if ($connection) { echo "已建立MySQL資料庫的連線"; } else { echo "無法建立MySQL資料庫的連線"; }
if ($db_selected) { echo "可使用sample資料庫"; } else { echo "無法使用sample資料庫"; }
mysql_close($connection);*/
?>
<?php
//不要快取
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    	        // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  	        // HTTP/1.1
header ("Pragma: no-cache");                          	        // HTTP/1.0
?>
<?php
//搜尋資料庫的第n筆資料，0代表第一筆
//$Recordset1 = mysql_query($query_Recordset1, $connection) or die(mysql_error());
//mysql_data_seek($Recordset1,0);
?>
<?php
if(isset($_GET['keyword']))
{
//自行定義關鍵字出現的位置
$str = "PHP作為全球最普及、應用最廣泛的網際網路開發語言之一，從1994年誕生至今已被2000多萬個動態網站採用，全球知名網際網路公司Google、Yahoo、eBay和中國知名網站新浪、百度、阿里巴巴等均採用PHP技術！";
$start_place = mb_strrpos(strip_tags($str),$_GET['keyword'],"UTF-8"); //去除HTML標籤，先找到關鍵字第一次出現位置，並將字元位置儲存在自訂變數$start_place中
$start_place = $start_place-50; //希望關鍵字出現在商品簡介中央位置，所以起始字元位置-50(因為指定截取100個字元)
$p_content = mb_substr(strip_tags($str),$start_place, 100,"UTF-8"); //去除p_content欄位中，商品介紹文案的HTML及PHP語法標籤後，指定截取出100個字元後，儲存給變數$p_content
//$p_content = eregi_replace($_GET['keyword'],"<font color='#ff0000' style='background:#ffff00'>".$_GET['keyword']."</font>",$p_content);
$keyword = '/'.$_GET['keyword'].'/i'; //沒有i的話就不區分大小寫
$p_content = preg_replace($keyword, "<font color='red' style='background:#ffff00'>".$_GET['keyword']."</font>", $p_content);
 //改用eregi_replace函數為不區分大小寫搜尋結果中的關鍵字內容，替換文字樣式效果，反之str_replace為區分大小寫
//輸出最後效果
echo '</br>'.$p_content.'</br>';
//echo eregi_replace($_GET['keyword'], "<font color='#ff0000' style='background:#ffff00'>".$_GET['keyword']."</font>",$str)."<br>";
echo preg_replace($keyword, "<font color='red' style='background:#ffff00'>".$_GET['keyword']."</font>", $str);
echo '關鍵字出現次數'.mb_substr_count($str,$_GET['keyword']).'</br>';
}
?>
<?php
//計算陣列相減之後剩餘下來的字串結果
$array1 = array ('1','2','3');
$array2 = array ('3','4','5');
$result = array_diff($array1, $array2);
echo "<pre>";
print_r($result); //看看陣列的狀況  
echo "</pre>";
$resultnum = implode(',',$result);
echo $resultnum;
?>
<?php
/*
//MYSQL取得最新的資料編號
$maxid = mysql_insert_id();
$insertGoTo = "adminfix.php?album_id=".$maxid;

//MYSQL取得影響筆數
mysql_affected_rows();

//MSSQL取得最新的資料編號
$sql = "SELECT SCOPE_IDENTITY() AS insert_id";
$query = mssql_query($sql);
$row = mssql_fetch_object($query);
$delivery_nuid = securehtmlspecialchars(getSecureParameter($row->insert_id)); // insert_id 就是最後資料庫使用自動編號插入的號碼

//MSSQL取得影響筆數一
$link = mssql_pconnect($db_host,$db_user,$db_pass);
mssql_select_db($db_name, $link);
$result = mssql_query('Select 1', $link);
$rows = mssql_rows_affected($link);

//MSSQL取得影響筆數二
//UPDATE table1 SET table_name='myname' WHERE table_id in(1,2,3) SELECT @@rowcount AS num from table1
*/
?>
<?php
//直接關閉視窗，不做詢問
echo "<script>window.opener=null;window.close();</script>";
?>
<?php
//簡單的HTTP身份認證
/*header ('Content-type: text/html; charset=utf-8');
if($_SERVER['PHP_AUTH_USER'] != "bau720123" || $_SERVER['PHP_AUTH_PW'] != "720123bau")
{
header("WWW-Authenticate: Basic realm=\"Protected\"");
header("HTTP/1.0 401 Unauthorized");
echo "未經驗證的存取";
}
 else
 {
 header("Location: index.php");
 }*/
?>
<?php
//讓該檔案可以被跨網域存取
header("Access-Control-Allow-Origin: *");
?>
<?php
//sql連接寫法
$sql = "select a.* from tb_sign_process_log a inner join tb_sign_process_event b on b.sp_event_uid = a.sp_event_uid inner join tb_sign_process c on c.sp_uid = b.sp_uid where log_status = '010' and b.event_table  = 'website_marketing' and b.event_column = 'wmkt_uid'";
if(isset($my_act) && $my_act == '1') { $sql = $sql." AND a.log_cat = '$my_id'"; }
if(isset($my_act) && $my_act == '2') { $sql = $sql." AND b.event_uid = '$my_id'"; }
if(isset($my_act) && $my_act == '3') { $sql = $sql." AND c.adm_uid_p01 = '$my_id'"; }
if(isset($my_act) && $my_act == '4') { $sql = $sql." AND c.adm_uid_p99 = '$my_id'"; }
$sql = $sql." order by auto_date desc";
echo $sql;

//json組合字串寫法
$json_data = "{'wmkt_df_status':'10','wmkt_df_price':'3500','wmkt_df_stock':'60'}"; 
$json_data = str_replace ("'",'"',$json_data);
echo $json_data;
//echo $_GET['callback'].'('.$json_data.')'; 
?>
<?php
//for迴圈相關判定
for($i=0;$i<5;$i++)
{
echo $i;
$j = 0;
$j = $j.$i;
}
echo $j;
?>
<?php
//in_array的用法
$a = 100;
define('delivery_true_type',json_encode(array(100,400,510)));
if (in_array($a, json_decode(delivery_true_type))) { echo "有"; } else { echo "沒有"; }
?>
<?php
//數字格式化
/*
1)欲轉換的數字
2)小數位數
3)小數點的顯示字元
4)三位數的顯示字元
*/

/*
SQL查詢
SELECT FORMAT(money, 4) FROM salary;
--輸出結果將會把money的數字資料態轉為xx,xxx,xxx格式，以下為範圍輸出

SELECT FORMAT(12332.123456, 4);
--輸出結果為：12,332.1235

SELECT FORMAT(12332.2,0)
--輸出結果為：12,332

SELECT FORMAT(12332.1,4)
--輸出結果為：12,332.1000
*/
echo number_format('10000', 2, '.' ,',');//輸出結果為：1,234,567,890.32
?>
<?php
//base64加解密功能
$encode = base64_encode('許功蓋');
echo $encode.'</br>';
$decode = base64_decode($encode);
echo $decode.'</br>';
?>
<?php
//url加解密功能
$encode = urlencode('許功蓋');
echo $encode.'</br>';
$decode = urldecode($encode);
echo $decode.'</br>';
?>

<?php
//字串與數字互轉
$str = "123";
echo "轉換前型態為：".gettype($str);
echo "，原字串輸出：".$str;
echo "<br>";
echo "轉換後輸出：".intval($str);
echo "，轉換後型態為：".gettype(intval($str));
echo "<br>";
$int = 123;
echo "轉換前型態為：".gettype($int);
echo "，原字串輸出：".$int;
echo "<br>";
echo "轉換後輸出：".strval($int);
echo "，轉換後型態為：".gettype(strval($int));
echo "<br>";
?>
<?php
//驗證Email
$email = 'bau720123@gmail.com';
if(preg_match("/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/",$email))
{
echo 'Email格式正確';
}
 else
 {
 echo 'Email格式不正確';
 }
echo "<br>";
?>
<?php
//驗證Email
$email = 'bau720123@gmail.com';
if(preg_match("/^[^\s]+@[^\s]+\.[^\s]+$/",$email))
{
echo 'Email格式正確';
}
 else
 {
 echo 'Email格式不正確';
 }
echo "<br>";
?>
<?php
//驗證Email
$email = 'bau720123@gmail.com';
if(preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/",$email))
{
echo 'Email格式正確';
}
 else
 {
 echo 'Email格式不正確';
 }
echo "<br>";
?>
<?php
//驗證手機號碼
$phonenumber = '0920296561';
if(preg_match("/^09[0-9]{8}$/", $phonenumber) && strlen($phonenumber) == 10)
{
echo '手機號碼格式正確';
}
 else
 {
 echo '手機號碼格式不正確';
 }
echo "<br>";
?>
<?php
//偵測是否包含中文
$str = "許功蓋123";
if(preg_match("/[\x{4e00}-\x{9fa5}]/u", $str))
{
echo '包含中文';
}
 else
 {
 echo '沒有包含中文';
 }
echo "<br>";
?>
<?php
//偵測是否是中文
$str = "許功蓋";
if(preg_match("/^[\{u0391}-\u{FFE5}]+$/u", $str))
{
echo '是中文';
}
 else
 {
 echo '不是中文';
 }
echo "<br>";
?>
<?php
//偵測是否是數字
$integer = "123";
if(preg_match("/^[0-9]+$/", $integer))
{
echo '是數字';
}
 else
 {
 echo '不是數字';
 }
echo "<br>";
?>
<?php
//偵測是否是英文字
$english = "abc";
if(preg_match("/^[a-zA-Z]+$/", $english))
{
echo '是英文字';
}
 else
 {
 echo '不是英文字';
 }
echo "<br>";
?>
<?php
//偵測是否是符合限制最小(4)及最大字數(10)
$str = "0123456789";
if(preg_match("/^[^\s]{4,10}$/", $str))
{
echo '符合範圍';
}
 else
 {
 echo '不符合範圍';
 }
echo "<br>";
?>
<?php
//偵測是否內含特定字元
$str = "'"; //'、"、?、/\
if(preg_match("/^[{^\'\"?\/\\}]+$/", $str))
{
echo '含特定字串';
}
 else
 {
 echo '不含特定字串';
 }
echo "<br>";
?>
<?php
//偵測身分證字號是否符合規範
$str = "A123775989";
if(preg_match("/^[A-Z]{1}[0-9]{9}$/", $str))
{
echo '身分證字號符合規範';
}
 else
 {
 echo '身分證字號不符合規範';
 }
echo "<br>";
?>
<?php
//陣列改變
$a = array('1','精細','asd','asd123','asd');
echo "原陣列：";
$a[2] = 'dsa';
print_r($a)."<br>";
array_push($a,'哈哈');
echo "<br>增加元素後的陣列：";
print_r($a);
echo "獲得陣列中最後一個元素是：".array_pop($a);
echo "<br>去除重複項後的陣列為：";
print_r(array_unique($a));
?>
<?php
//隨機陣列
$numbers = array('經濟','a','b','123','asd');
$rand = rand(0,4);
//$rand = array_rand($numbers, 1);
echo "原陣列元素順序為：經濟 a b 123 asd";
srand ((float)microtime()*1000000);
shuffle ($numbers);
echo "<br>經隨機排序後：";
 while(list (, $number) = each ($numbers))
 {
 echo "$number ";
 }

echo "<br>隨機取得陣列的元素是：".$numbers[$rand].'</br>';
?>
<?php
//陣列存在
$array =array("編程"=>"123","soft"=>"你好","456"=>"mingri");
echo "鍵名根值為：";
foreach($array as $key => $value)
{
echo $key."&nbsp;".$value;
}
if(array_key_exists('編程',$array))
{
echo '陣列中存在此元素'.'</br>';
}
 else
 {
 echo '陣列中不存在此元素'.'</br>';
 }
?>
<?php
//日期相關
echo "本月有".date('t')."天，今天是一周的第".date('w')."天,是一年的第".date('z')."天".'</br>';
?>
<form id="form1" name="form1" method="post" action="">
<input type="submit" name="button1" id="button1" value="開始答題" />
<input type="submit" name="button2" id="button2" value="結束答題" />
<?php
if(isset($_POST['button1']))
{
$time = time();
$_SESSION['time'] = $time;
echo '請按下結束答題以利偵測時間';
}
if(isset($_POST['button2']))
{
 if(isset($_SESSION['time']))
 {
 echo "答題結束，您使用".(time()-$_SESSION['time'])."秒答題";
 session_destroy();
 }
  else
  {
  echo '請重新按下開始答題以利偵測時間';
  }
}
?>
</form>

<!--
Paypal
原帳號 bau720123@gmail.com
賣家 bau720123-facilitator@gmail.com
買家 bau720123-buyer@gmail.com
https://www.sandbox.paypal.com/cgi-bin/webscr
https://developer.paypal.com/developer/accounts
paypalBau@
-->
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" name="form1" target="_blank" id="form1" method="post"> <!--測試：www.sandbox.paypal.com、正式：www.paypal.com-->
 <!--必要欄位開始-->
 <input type="hidden" name="cmd" id="cmd" value="_xclick"> <!--立即購買按鈕（_xclick），PayPal 購物車（_cart）-->
 <input type="hidden" name="business" id="business" value="bau720123-facilitator@gmail.com"> <!--賣家帳號-->
 <input type="hidden" name="item_name" id="item_name" value="Order ID：998877"> <!--訂單名稱-->
 <input type="hidden" name="currency_code" id="currency_code" value="USD"> <!--貨幣單位-->
 <input type="hidden" name="amount" id="amount" value="5"> <!--總價-->
 <input type="hidden" name="quantity" id="name" value="1"> <!--數量-->
 <input type="hidden" name="charset" id="charset" value="utf-8"> <!--語系編碼-->
 <!--必要欄位結束-->
 
 <!--選用欄位開始-->
 <input type="hidden" name="item_number" id="item_number"  value="123456"> <!--用於追蹤付款的可選傳遞變數，必須是英數字元，最多為127個字元-->
 <input type="hidden" name="shipping" id="shipping" value="10"> <!--運送物品的費用-->
 <input type="hidden" name="shipping2" id="shipping2" value="20"> <!--運送每一件其他物品的費用-->
 <input type="hidden" name="handling" id="handling" value="30"> <!--處裡的費用-->
 <input type="hidden" name="tax" id="tax" value="40"> <!--根據交易計算的稅值，若設有該值，則此處傳送的值將會覆寫任何個人檔案稅金設定（無論買家的所在位置為何）-->
 <input type="hidden" name="no_shipping" id="no_shipping" value="0"> <!--運送地址，如果設為1，則不會要求你的客戶提供運送地址，該變數可選填，如果省略或設為0，系統將提示你的客戶輸入運送地址-->
 <input type="hidden" name="cn" id="cn" value="附註欄位"> <!--選填標籤，會顯示在附註欄位（最多40個字元）上方-->
 <input type="hidden" name="no_note" id="no_note" value="0"> <!--在付款中加上附註，如果設為1，則不會提示你的客戶輸入附註，該變數可選填，如果省略或設為0，系統將提示你的客戶輸入附註-->
 <input type="hidden" name="notify_url" id="notify_url" value="http://www.songker.com/back.php"> <!--僅與交易狀態更新（IPN）一起使用。發送IPN表格發佈的網際網路URL-->
 <input type="hidden" name="return" id="return" value="http://en.x-trm.com.tw/customers/orders/?recordId=XXXX"> <!--付款成功後跳轉位址-->
 <input type="hidden" name="cancel_return" id="cancel_return" value="http://en.x-trm.com.tw/customers/orders/?recordId=XXXX"> <!--取消付款後跳轉位址-->
 <!--選用欄位結束-->
 <input type="submit" value="Click me to payment" /> <!--付款按鈕或是圖片-->
</form>

<?php
//偵測某字串是否涵蓋在特定字串裡
$a = "Hello World !!";
$b = "World";
if(stristr($a, $b) != "")
{
echo "文字存在指定子字串";
}
 else
 {
 echo "文字不存在指定子字串";
 }
echo "<br>";
?>
<?php
//複製一份資料的SQL語法
//insert into Basic(A ,B ,C)
//select A ,B ,C where sn='13'
?>
<?php
//傳統MAIL的發送，支援中文
$mailToname="小叮噹書店"; //收件者
$mailTo="css@acd.idv.tw"; //收件者
$mailfromname="張秀山"; //寄件者姓名
$mailfrom="css6666@yahoo.com.tw"; //寄件者電子郵件
$mailSubject="郵件主旨"; //主旨
$mailContent = "郵件內容" ; //內容

//以下內容不要改
$mailTo="=?UTF-8?B?".base64_encode($mailToname)."?= <" . $mailTo . ">";
$mailfrom="=?UTF-8?B?" . base64_encode($mailfromname) . "?= <" . $mailfrom . ">";
$mailSubject = "=?UTF-8?B?".base64_encode($mailSubject)."?=";  //主旨編碼成UTF-8
//mail($mailTo,$mailSubject,$mailContent,"Mime-Version: 1.0\nFrom:" . $mailfrom . "\nContent-Type: text/html ; charset=UTF-8");
?>
<?php
//call_user_func
$a = 1;
  
call_user_func(function()
{
$a = 2;
echo $a; //2
});
  
echo $a; //1
echo '<br>';
?>
<?php
require_once('function/YouTubeDownloader.php');
require_once('function/VimeoDownloader.php');
require_once('function/LinkHandler.php');

$url = "https://www.youtube.com/watch?v=gPyW6ZvMbCg";
//$url = "https://vimeo.com/91379208";
$handler = new LinkHandler();
$downloader = $handler->getDownloader($url);
$downloader->setUrl($url);
if($downloader->hasVideo())
{
/*echo '<pre>';
print_r($downloader->getVideoDownloadLink());
echo '</pre>';*/
}
?>
<?php
//印出資料庫結構說明
require_once('function/phpdbdoc.php');

/*$doc = new phpdbdoc();
$doc->setUserdb("root");
$doc->setLinkdb('localhost');
$doc->setPassword('720123bau');
$doc->setDataBase('littleb1_sample');
$doc->DBConnect();
$doc->getDoc();*/
?>
<?php
//印出檔案結構
echo '<pre>';
print_r(glob('*'));
echo '</pre>';
echo '<pre>';
print_r(scandir('..'));
echo '</pre>';
?>
<?php
/*
在使用之前，我們先大致了解一下glob有什麼特別的參數可以使用。
GLOB_MARK     - 若檔案為資料夾，在回傳檔案路徑的最後面加上斜線"\"
GLOB_NOSORT   - 保持檔案路徑在原資料夾的出現順序(不重新排序)。※筆者在Win環境看不出差異
GLOB_NOCHECK  - 若找不到匹配的檔案路徑，回傳匹配的條件字串
GLOB_NOESCAPE - 不要將反斜線視為跳脫字元(※筆者在Win環境下看不出差異)
GLOB_BRACE    - 將 {a,b,c} 視為搜尋 'a', 'b', 或 'c'
GLOB_ONLYDIR  - 只列出資料夾路徑
GLOB_ERR      - 發生讀取錯誤時停止動作(像是無法讀取的資料夾)，預設是「忽略錯誤」
*/

//搜尋 path 資料夾中，所以資料夾的路徑，並在最後加上斜線 "\"
$dirs = array_filter(glob('/path/*',GLOB_MARK), 'is_dir'); 

//同上的結果(所以資料夾的路徑)，而且此方法比較標準效能也較快
// (※不同這邊要注意的是，GLOB_ONLYDIR 僅適用於非使用 GUN C library 的系統
// 所以當不支援的時候，可以改用第一種方法)
$dirs = glob('/path/*',GLOB_ONLYDIR | GLOB_MARK); 

//搜尋path資料夾中，所有的檔案的路徑
// (※筆者很好奇，=3=既然都有 GLOB_ONLYDIR 了，為什麼不多個 GLOB_ONLYFILE )
$files = array_filter(glob('/path/*'), 'is_file'); 

//搜尋 path 資料夾中所有檔名字串結尾為 .gif、.jpg、.png 檔案路徑
//(※這邊要注意，若副檔名大小寫不一樣，會搜尋不到，像 .GIF 、 .gIf 或 .giF 都會被忽略掉)
$images = glob("/path/{*.gif,*.jpg,*.png}", GLOB_BRACE);

//搜尋 path 資料夾中所有檔名字串結尾非 "_s.jpg" 檔案路徑
$filter = array_filter(glob('img/*'), function($ele){return !stristr($ele,'_s.jpg');});

//搜尋 path 中所有含有 views 資料夾的資料夾
$dirs = glob('/path/*/views', GLOB_ONLYDIR);
?>
<?php
//獲得路徑檔案相關資訊
$path_parts = pathinfo(dirname(__FILE__) . '\index.php');
echo $path_parts['dirname'] . '</br>';
echo $path_parts['basename'] . '</br>';
echo $path_parts['extension'] . '</br>';
echo $path_parts['filename'] . '</br>'; //從PHP 5.2.0開始有
?>
</body>
</html>
