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
//�n�J�\��
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
  setcookie("member_username", $_POST['member_username'], time()+86400*30); //�]�w�ϥΪ̦W�٪� Cookie ��
  setcookie("member_password", $_POST['member_password'], time()+86400*30); //�]�w�K�X�� Cookie ��
  }
  if ($_POST['rememberme'] != '1') 
  {
  setcookie("member_username", '', time()); //�h���ϥΪ̦W�٪� Cookie ��
  setcookie("member_password", '', time()); //�h���K�X�� Cookie ��
  }
  mysql_select_db($database_connection, $connection);
  
  $LoginRS__query=sprintf("SELECT member_username, member_password FROM member WHERE member_username=%s AND member_password=%s AND member_level != 0",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connection) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //�ŧi���Session�ܼ�
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
//�{�b�ɶ�����[�h�֮ɶ�
function add_date($start_time, $year,$month, $day)
{ 
$start_time = strtotime($start_time); 
$result = date("Y-m-d H:i:s", mktime(date('H',$start_time), date('i',$start_time), date('s',$start_time), date('m',$start_time)+$month, date('d',$start_time)+$day, date('Y',$start_time)+$year));
return $result; 
}
//echo add_date('�A�ҫ��w���ܼƮɶ�', '�h�֦~', '�h�֤�', '�h�֤�');
//date("Y-m-d H:i:s",(time()+3600));
?>
<?php
//�p��ۮt�ɶ�
function minus_date($start_time, $end_time, $type)
{
//�p��ۮt�X��
if ($type == 1) { $result = (strtotime($end_time) - strtotime($start_time))/86400; }
//�p��ۮt�X�p�� 
if ($type == 2) { $result = (strtotime($end_time) - strtotime($start_time))/3600; } 
//�p��ۮt�X��
if ($type == 3) { $result = strtotime($end_time) - strtotime($start_time); }
return $result;
}
//echo minus_date('�}�l�ɶ�', '�����ɶ�', '�n���o��ظ��');
?>
<?php
//�h���ɤW��+�Y�ϥ\��
function imagesResize($src, $dest, $destW, $destH) 
{ 
 //�T�{�ɮצs�b�A�åB�w�q�F�����x�s���|��A�~�i��U�z�ʧ@
 if (file_exists($src)  && isset($dest)) 
 { 
 //���o�ɮ׸�T
 $srcSize   = getimagesize($src); //�ܼ�$srcSize���o�ӷ��Ϥ���ư}�C��
 $srcExtension = $srcSize[2]; //�Q���ܼ�$srcSize���}�C���ޭ�2���o�Ϥ��ɮ׮榡�A�x�s�b�ܼ�$srcExtension��
 //�ϼe$srcSize[0]�ϰ�$srcSize[1]
 $srcRatio  = $srcSize[0] / $srcSize[1]; 
  //�̪��e��P�_���e����
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
  $destImage = imagecreatetruecolor($destW,$destH); //�̾ڧP�����Y�Ϥؤo�A���ͥX�@�ӷǳƭn��m�Y�Ϫ��m��ťչϹ�
   //�̾�$srcExtension���o���ɮ׮榡�A1=GIF�B2=JPG�B3=PNG�A���P�榡�ϥι������Ū������
   switch ($srcExtension) 
   { 
   case 1: $srcImage = imagecreatefromgif($src); break; 
   case 2: $srcImage = imagecreatefromjpeg($src); break; 
   case 3: $srcImage = imagecreatefrompng($src); break; 
   }
   //�Q�ΤU��2�Ө�ƫO�dPNG���ɳz���ĪG
   imagealphablending($destImage,false);
   imagesavealpha($destImage,true);
   
   imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0,$destW,$destH,imagesx($srcImage), imagesy($srcImage)); //���s�ļ˨ýվ�j�p������Ϲ���t�@�ӹϹ����A�]�N�O�}�l�Y��

   //���P�榡���ɱN�ϥι�������ƿ�X���ɡA�����x�s�Y�Ϩ���w��m�A�ƭ�100�����ɫ~��A�i�ۦ�վ� 
   switch ($srcExtension) 
   { 
   case 1: imagegif($destImage,$dest); break; 
   case 2: imagejpeg($destImage,$dest,85); break;
   case 3: imagepng($destImage,$dest); break;
   imagedestroy($destImage); //����M�ϧ����p���O����
   } 	
}
?>
<?php
//�Ʀr�����\��
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

//�Ʀr����
/*
<?php if ($totalRows_Recordset1 > 0) { ?>
<table border="0" class="infor_content1">
<tr>
 <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">�Ĥ@��</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">�W�@��</a>
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
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">�U�@��</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">�̫�@��</a>
          <?php } // Show if not last page ?></td>
</tr>
</table>
<? } ?>
*/

//�U�Ԧ�������
/*
<select name="jumppage" id="jumppage" onchange="MM_jumpMenu('parent',this,0)">
<? 
for ($page=1;$page<=$max_links;$page++) { 
$truepage = $page-1;
?> 
  <option value="<?php echo $PHP_SELF;?>?pageNum_Recordset1=<?php echo $truepage;?><?php echo $queryString_Recordset1;?>" <?php if (!(strcmp($truepage, $_GET['pageNum_Recordset1']))) {echo "selected=\"selected\"";} ?>>��<?php echo $page;?>��</option>
<? } ?>
</select>
*/
?>
<?php
//�H�����ͱK�X
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
//echo generatorPassword('�K�X�e�m��', '�K�X������');
?>
<?php
//����A����API�OASAPI�]IIS�^���ɭԡAgetenv��ƬO���_�@�Ϊ��A�o�ر��p�U�A�p�G��getenv�Ө��o�Ȥ��ip���ܡA�o�쪺�N�O���~��IP��}
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
//�۰ʸ�0
function autozero($median, $string)
{
$result = sprintf($median,$string);
return $result;
}
//echo autozero('%08d', '�n�ϥΪ��Ʀr�r��');
?>
<?php 
//�j��X�쪺UTF-8�r������A�ѤU����YYY�Ө��N
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
//echo autosymbol('�n�ϥΪ��Ʀr�r��', '���X���', '�W�L��Ʈɭn�Τ���Ÿ��Ӵ��N');
?>
<?php
//���o�ͤ�������P�y�W��
function getStarSignsName($month, $day) 
{
mb_internal_encoding("UTF-8");
$list=
array(
array('name'=>"���~�y",'min'=>'12-22','max'=>'01-19'),  
array('name'=>"���~�y",'min'=>'01-20','max'=>'02-18'),
array('name'=>"�����y",'min'=>'02-19','max'=>'03-20'),
array('name'=>"�d�Ϯy",'min'=>'03-21','max'=>'04-19'),
array('name'=>"�����y",'min'=>'04-20','max'=>'05-20'),
array('name'=>"���l�y",'min'=>'05-21','max'=>'06-21'),
array('name'=>"���ɮy",'min'=>'06-22','max'=>'07-22'),
array('name'=>"��l�y",'min'=>'07-23','max'=>'08-22'),
array('name'=>"�B�k�y",'min'=>'08-23','max'=>'09-22'),
array('name'=>"�ѯ��y",'min'=>'09-23','max'=>'10-23'),
array('name'=>"���Ȯy",'min'=>'10-24','max'=>'11-22'),
array('name'=>"�g��y",'min'=>'11-23','max'=>'12-21'),
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
//echo getStarSignsName('�X�ͤ�', '�X�ͤ�')
?>
<?php
//�r���ܤ�
function string_mix($string, $type)
{
if ($type == 1) { $result = strtoupper($string); } //������j�g
if ($type == 2) { $result = strtolower($string); } // ������p�g
if ($type == 3) { $result = ucfirst($string); } //�q�������Ĥ@�ӰϬq���r��j�g
if ($type == 4) { $result = ucwords($string); } //�q�������C�ӰϬq���Ĥ@�Ӧr��j�g
if ($type == 5) { $result = strrev($string); } //����r��
if ($type == 6) { $result = stripslashes($string); } //�h���ϱ׽u
return $result;
}
//echo string_mix('welcome to Taiwan!\\', '1');
?>
<?php
//�Ω�C��
$filename_list = 'http://'.$_SERVER["HTTP_HOST"].'/';
$filename_list = urlencode($baupath);

//�Ω�ԲӤ��e��
$filename_detail = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];
$filename_detail = urlencode($baupath1);

//�ثe�ɦW
$filename = basename($_SERVER["PHP_SELF"]);
?>
<?php
//�ϥ�Google�A�ȨӽsĶ���u���}
function shortenGoogleUrl($long_url)
{
$apiKey = 'AIzaSyB77mM4iXl19V38-c-rPWNfCFTI1Suv8Zg'; //�i�H�q�U�C���}�o��apiKey�Ghttp://code.google.com/apis/console/
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

//�ϥ�Google�A�ȨӸ�Ķ�������}
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
//�H���ü�
function randInt($length)
{
//FOR�^��H$random���P�_���榸��
for ($i=1;$i<=$length;$i=$i+1)
{
$rand_range = rand(1,3); //�ü�$c�]�w�T�ضüƸ�Ʈ榡�j�g�B�p�g�B�Ʀr�A�H������
if($rand_range==1) { $rand_type = rand(97,122); $rand = chr($rand_type); } //�b$c��1�����p�U�A�]�w$a�üƨ��Ȭ�97-122�����A�å�chr()�N�ƭ����ܬ������^��A�x�s�b$b
if($rand_range==2) { $rand_type = rand(65,90); $rand = chr($rand_type); } //�b$c��2�����p�U�A�]�w$a�üƨ��Ȭ�65-90�����A�å�chr()�N�ƭ����ܬ������^��A�x�s�b$b
if($rand_range==3) { $rand = rand(0,9); } //�b$c��3�����p�U�A�]�w$b�üƨ��Ȭ�0-9�������Ʀr
$result = $result.$rand;
}
return $result;
}
//echo randInt('�X���');
?>
<?php
//�[�K  
function string2secret($str)  
{  
$key = "123"; //�O�P�t�m
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
//echo string2secret("�\�\�\"); //��ܶýX

//�ѱK
function secret2string($sec)  
{  
$key = "123"; //�O�P�t�m
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
//echo secret2string(string2secret("�\�\�\")); //��ܵ��G��"�\�\�\"
?>
<?php
//�P�_������s����
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
//�p�⭶������ɶ��A����ܩ�k�W��
function pageLoad()
{
$time_start = microtime(true); //�}�l�ɶ�
//usleep(10000000); //����Q�����A�H�L��p�⪺�Ȱ��ɶ��A1����1000�@��A1�@����1000�L��
$time_end = microtime(true); //�����ɶ�

if (empty($_SERVER['REQUEST_TIME_FLOAT']))
{
$result = $time_end - $time_start; //�����̲װ���ɶ��APHP5.4�����H�U�䴩
}
 else
 {
 $result = $time_end - $_SERVER['REQUEST_TIME_FLOAT']; //�����̲װ���ɶ��APHP5.4�����t�H�W�䴩
 }
return $result;
}
//echo '<div style="color:#fff;background:#000;position:absolute;top:0px;right:0px;padding:3px 6px;">��������ɶ��G', (pageLoad()), '��</div>';
//echo pageLoad();
?>
<?php
//�����ثe�P���X
function what_day()
{
$day = date("l");
 switch($day)
 {
 case "Monday";
 $result = "���ѬO�P���@�A�@�P���L�ͬ��}�l�F";
 break;
 case "Tuesday";
 $result = "���ѬO�P���G�A�q���x�U�Ȩ��I�H�᳡����";
 break;
 case "Wednesday";
 $result = "���ѬO�P���T�A�U�Ȧ����y����";
 break;
 case "Thursday";
 $result = "���ѬO�P���|�A�ߤW��NBA������";
 break;
 case "Friday";
 $result = "���ѬO�¦�P�����C�C�C�C�C�C";
 break;
 case "Saturday";
 $result = "���ѬO�P����";
 break;
 case "Sunday";
 $result = "���ѬO�P���ѡA�i�H���W�@���";
 }
return $result;
}
//echo what_day();
?>
<?php
//�������z�����x��������T
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
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//�T��������������e
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$rss_content = curl_exec($ch);//�ᤩ��

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
//echo check_version('���إ��x');
?>
<?php
//�¥զW��\��
function black_str($str)
{
$array = array('�Ϯ�','������','�n��','�s�{����','�s�{','����');
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
//echo black_str('�Y�N�Q�������r��');
?>