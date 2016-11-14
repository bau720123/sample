<?php require_once('../Connections/connection.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
require_once("../3rd/PHPQRCode/phpqrcode.php");
	
	//先判斷上傳至網站的暫存目錄是否有錯誤
   if($_FILES['photo']['error'] > 0)
   {
   echo "上傳圖檔1：".$_FILES['photo']['name']."<br>";
    switch($_FILES['photo']['error'])
    {
	case 1 : die("ErrCode: 1 檔案大小超出 php.ini:upload_max_filesize 限制"); break;
	case 2 : die("ErrCode: 2 檔案大小超出 max_file_size 限制"); break;
    case 3 : die("ErrCode: 3 檔案僅被部份上傳,上傳不完整");	 break;		
	case 4 : die("ErrCode: 4 檔案未被上傳");   break;
	case 6 : die("ErrCode: 6 暫存目錄不存在"); break;
	case 7 : die("ErrCode: 7 無法寫入到檔案"); break;
	case 8 : die("ErrCode: 8 上傳停止");	 break;
    }
   }
   
   /*
   if($_FILES['photo1']['error'] > 0)
   {
   echo "上傳圖檔2：".$_FILES['photo1']['name']."<br>";
    switch($_FILES['photo1']['error'])
    {
	case 1 : die("ErrCode: 1 檔案大小超出 php.ini:upload_max_filesize 限制"); break;
	case 2 : die("ErrCode: 2 檔案大小超出 max_file_size 限制"); break;
    case 3 : die("ErrCode: 3 檔案僅被部份上傳,上傳不完整");	 break;		
	case 4 : die("ErrCode: 4 檔案未被上傳");   break;
	case 6 : die("ErrCode: 6 暫存目錄不存在"); break;
	case 7 : die("ErrCode: 7 無法寫入到檔案"); break;
	case 8 : die("ErrCode: 8 上傳停止");	 break;
    }
   }
   
   if($_FILES['photo2']['error'] > 0)
   {
   echo "上傳圖檔3：".$_FILES['photo2']['name']."<br>";
    switch($_FILES['photo2']['error'])
    {
	case 1 : die("ErrCode: 1 檔案大小超出 php.ini:upload_max_filesize 限制"); break;
	case 2 : die("ErrCode: 2 檔案大小超出 max_file_size 限制"); break;
    case 3 : die("ErrCode: 3 檔案僅被部份上傳,上傳不完整");	 break;		
	case 4 : die("ErrCode: 4 檔案未被上傳");   break;
	case 6 : die("ErrCode: 6 暫存目錄不存在"); break;
	case 7 : die("ErrCode: 7 無法寫入到檔案"); break;
	case 8 : die("ErrCode: 8 上傳停止");	 break;
    }
   }
   
   if($_FILES['photo3']['error'] > 0)
   {
   echo "上傳圖檔4：".$_FILES['photo3']['name']."<br>";
    switch($_FILES['photo3']['error'])
    {
	case 1 : die("ErrCode: 1 檔案大小超出 php.ini:upload_max_filesize 限制"); break;
	case 2 : die("ErrCode: 2 檔案大小超出 max_file_size 限制"); break;
    case 3 : die("ErrCode: 3 檔案僅被部份上傳,上傳不完整");	 break;		
	case 4 : die("ErrCode: 4 檔案未被上傳");   break;
	case 6 : die("ErrCode: 6 暫存目錄不存在"); break;
	case 7 : die("ErrCode: 7 無法寫入到檔案"); break;
	case 8 : die("ErrCode: 8 上傳停止");	 break;
    }
   }
   
   if($_FILES['photo4']['error'] > 0)
   {
   echo "上傳圖檔5：".$_FILES['photo4']['name']."<br>";
    switch($_FILES['photo4']['error'])
    {
	case 1 : die("ErrCode: 1 檔案大小超出 php.ini:upload_max_filesize 限制"); break;
	case 2 : die("ErrCode: 2 檔案大小超出 max_file_size 限制"); break;
    case 3 : die("ErrCode: 3 檔案僅被部份上傳,上傳不完整");	 break;		
	case 4 : die("ErrCode: 4 檔案未被上傳");   break;
	case 6 : die("ErrCode: 6 暫存目錄不存在"); break;
	case 7 : die("ErrCode: 7 無法寫入到檔案"); break;
	case 8 : die("ErrCode: 8 上傳停止");	 break;
    }
   }
   */
	
	$destDir = "../upload/";
	if(!is_dir($destDir) || !is_writeable($destDir))
	die("目錄不存在或無法寫入");
	
	//檔案命名
	$Name = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo']['name'],-3);
	$Name1 = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo1']['name'],-3);
	$Name2 = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo2']['name'],-3);
	$Name3 = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo3']['name'],-3);
	$Name4 = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo4']['name'],-3);
	
	//複製暫存檔
	copy($_FILES['photo']['tmp_name'] , $destDir . "/" . $Name );
	copy($_FILES['photo1']['tmp_name'] , $destDir . "/" . $Name1 );
	copy($_FILES['photo2']['tmp_name'] , $destDir . "/" . $Name2 );
	copy($_FILES['photo3']['tmp_name'] , $destDir . "/" . $Name3 );
	copy($_FILES['photo4']['tmp_name'] , $destDir . "/" . $Name4 );
			
	//預覽圖
	$src  = $destDir . "" . $Name;
	$dest = $destDir . "" . "thum_" . $Name;
	$destW = 150;
	$destH = 150;
	imagesResize($src,$dest,$destW,$destH);

	if(isset($_FILES['photo1']['name']))
	{
	$src1  = $destDir . "" . $Name1;
	$dest1 = $destDir . "" . "thum_" . $Name1;
	$destW1 = 150;
	$destH1 = 150;
	imagesResize($src1,$dest1,$destW1,$destH1);
	}
	
	if(isset($_FILES['photo2']['name']))
    {
	$src2  = $destDir . "" . $Name2;
	$dest2 = $destDir . "" . "thum_" . $Name2;
	$destW2 = 150;
	$destH2 = 150;
	imagesResize($src2,$dest2,$destW2,$destH2);
	}
	
	if(isset($_FILES['photo3']['name']))
    {
	$src3  = $destDir . "" . $Name3;
	$dest3 = $destDir . "" . "thum_" . $Name3;
	$destW3 = 150;
	$destH3 = 150;
	imagesResize($src3,$dest3,$destW3,$destH3);
	}
	
	if(isset($_FILES['photo4']['name']))
    {
	$src4  = $destDir . "" . $Name4;
	$dest4 = $destDir . "" . "thum_" . $Name4;
	$destW4 = 150;
	$destH4 = 150;
	imagesResize($src4,$dest4,$destW4,$destH4);
	}
	
  $insertSQL = sprintf("INSERT INTO class3 (qa_re_id, qa_id, ready, class3_name, class3_ename, class3_price, class3_price2, class3_point, class3_inventory, class3_safe_inventory, class3_brief, class3_plus, class3_content, photo, photo_thum, qrcode, photo1, photo1_thum,  photo2, photo2_thum, photo3, photo3_thum, photo4, photo4_thum, ontime, offtime, nowtime, sort) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['qa_re_id'], "int"),
                       GetSQLValueString($_POST['qa_id'], "int"),
                       GetSQLValueString($_POST['ready'], "int"),
                       GetSQLValueString($_POST['class3_name'], "text"),
                       GetSQLValueString($_POST['class3_ename'], "text"),
                       GetSQLValueString($_POST['class3_price'], "int"),
                       GetSQLValueString($_POST['class3_price2'], "int"),
                       GetSQLValueString($_POST['class3_point'], "int"),
					   GetSQLValueString($_POST['class3_inventory'], "int"),
					   GetSQLValueString($_POST['class3_safe_inventory'], "int"),
                       GetSQLValueString($_POST['class3_brief'], "text"),
					   GetSQLValueString($_POST['class3_plus'], "text"),
                       GetSQLValueString($_POST['class3_content'], "text"),
                       GetSQLValueString($src, "text"),
					   GetSQLValueString($dest, "text"),
					   GetSQLValueString(0, "text"),
                       GetSQLValueString($src1, "text"),
					   GetSQLValueString($dest1, "text"),
                       GetSQLValueString($src2, "text"),
					   GetSQLValueString($dest2, "text"),
                       GetSQLValueString($src3, "text"),
					   GetSQLValueString($dest3, "text"),
                       GetSQLValueString($src4, "text"),
					   GetSQLValueString($dest4, "text"),
					   GetSQLValueString($_POST['ontime'], "date"),
					   GetSQLValueString($_POST['offtime'], "date"),
                       GetSQLValueString($nowtime, "date"),
                       GetSQLValueString($_POST['sort'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
  
  //QRcode的生成
  /*$maxid = mysql_insert_id();
  $qrcontent = 'http://'.$_SERVER["HTTP_HOST"].'/product_detail.php?class3_id='.$maxid.'&qa_re_id='.$_POST['qa_re_id'].'&qa_id='.$_POST['qa_id'];
  $qrsrc = substr(md5(uniqid(rand())),0,5);
  QRcode::png($qrcontent, $destDir . "qr_" . $qrsrc . '.png');
  $qrcode  = $destDir . "" . "qr_" . $qrsrc . '.png';
  
  $updateSQL = sprintf("UPDATE class3 SET qrcode=%s WHERE class3_id=%s",
                       GetSQLValueString($qrcode, "text"),
                       GetSQLValueString($maxid, "int"));
  $Result2 = mysql_query($updateSQL, $connection) or die(mysql_error());*/

  $insertGoTo = "class3.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }  
  header(sprintf("Location: %s", $insertGoTo));
}

$colname2_max = "-1";
if (isset($_GET['qa_id'])) {
  $colname2_max = $_GET['qa_id'];
}
$colname3_max = "-1";
if (isset($_GET['qa_re_id'])) {
  $colname3_max = $_GET['qa_re_id'];
}
mysql_select_db($database_connection, $connection);
$query_max = sprintf("SELECT count(class3_id) as max_count FROM class3 WHERE qa_id = %s AND qa_re_id = %s", GetSQLValueString($colname2_max, "int"),GetSQLValueString($colname3_max, "int"));
$max = mysql_query($query_max, $connection) or die(mysql_error());
$row_max = mysql_fetch_assoc($max);
$totalRows_max = mysql_num_rows($max);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="admin.css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
function VF_form1(){
	var theForm = document.form1;
	var numRE = /^\d+$/;
	var errMsg = "";
	var setfocus = "";

	if (theForm['photo'].value == ""){
		errMsg = "圖檔沒有上傳";
		setfocus = "['photo']";
	}
	if (theForm['class3_inventory'].value < theForm['class3_safe_inventory'].value){
		errMsg = "庫存不能小於安全庫存";
		setfocus = "['class3_inventory']";
	}
	/*if (!numRE.test(theForm['class3_safe_inventory'].value)){
		errMsg = "安全庫存必須填寫";
		setfocus = "['class3_safe_inventory']";
	}
	if (!numRE.test(theForm['class3_inventory'].value)){
		errMsg = "庫存必須填寫";
		setfocus = "['class3_inventory']";
	}*/
	if (theForm['class3_name'].value == ""){
		errMsg = "標題必須填寫";
		setfocus = "['class3_name']";
	}
	if (errMsg != ""){
		alert(errMsg);
		eval("theForm" + setfocus + ".focus()");
	}
	else { theForm.button.disabled=true;theForm.submit(); }
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
      <table border="0" cellpadding="0" cellspacing="0" width="100%" id="title">
        <tr>
          <td background="images/title_name.jpg" width="139" valign="bottom" style="padding-bottom: 3px;" align="center"><strong>
          後台管理系統</strong></td>
          <td background="images/title_bg.gif" align="right"><img src="images/title_right.jpg" /></td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" id="content">
        <tr>
          <td>
<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="VF_form1();return false;">
            <div class="titleB">
              <div class="titleBText">
              <input value="新增資料" name="button" type="submit" /><input name="qa_id" type="hidden" id="qa_id" value="<?php echo $_GET['qa_id'];?>" /><input name="qa_re_id" type="hidden" id="qa_re_id" value="<?php echo $_GET['qa_re_id'];?>" /><input name="class3_inventory" type="hidden" id="class3_inventory" value="99" /><input name="class3_safe_inventory" type="hidden" id="class3_safe_inventory" value="10" /><input type="hidden" name="MM_insert" value="form1" /></div>
            </div><table border="0" cellpadding="0" cellspacing="0" id="tableB">
              <tr>
                <td colspan="2" align="left" class="tdlight"><input name="ready" type="checkbox" id="ready" value="1" checked="checked" />
發佈到前台</td>
                </tr>
                <tr>
                  <td align="left" class="tddark">上架時間</td>
                  <td align="left" class="tddark"><input name="ontime" type="text" id="ontime" value="<?php echo $nowtime;?>" size="16" maxlength="19" /></td>
                </tr>
                <tr>
                  <td align="left" class="tddark">下架時間</td>
                  <td align="left" class="tddark"><input name="offtime" type="text" id="offtime" value="<?php echo $nowtime2;?>" size="16" maxlength="19" /></td>
                </tr>
              <tr>
                <td align="left" class="tdlight"><font color="#FF0000">*</font>標題</td>
<td align="left" class="tdlight">
  <input name="class3_name" type="text" id="class3_name" value="" />
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight">英文標題</td>
<td align="left" class="tdlight">
  <input name="class3_ename" type="text" id="class3_ename">
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight">售價</td>
<td align="left" class="tdlight">
  <input name="class3_price" type="text" id="class3_price">
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight">原價</td>
<td align="left" class="tdlight">
  <input name="class3_price2" type="text" id="class3_price2">
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight">紅利點數</td>
<td align="left" class="tdlight">
  <input name="class3_point" type="text" id="class3_point"></td>
              </tr>
              <tr>
                <td align="left" class="tddark"><font color="#FF0000">*</font>圖檔上傳</td>
                <td align="left" class="tddark"><input name="photo" type="file" id="photo" /></td>
              </tr>
              <!--<tr>
                <td align="left" class="tddark">上傳圖檔2</td>
                <td align="left" class="tddark"><input name="photo1" type="file" id="photo1" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">上傳圖檔3</td>
                <td align="left" class="tddark"><input name="photo2" type="file" id="photo2" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">上傳圖檔4</td>
                <td align="left" class="tddark"><input name="photo3" type="file" id="photo3" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">上傳圖檔5</td>
                <td align="left" class="tddark"><input name="photo4" type="file" id="photo4" /></td>
              </tr>-->
              <tr>
                <td align="left" class="tdlight">簡介</td>
<td align="left" class="tdlight">
  <textarea name="class3_brief" rows="5" id="class3_brief"></textarea>
   </td>
              </tr>
              <tr>
                <td align="left" class="tdlight">關聯產品</td>
<td align="left" class="tdlight">
  <textarea name="class3_plus" rows="5" id="class3_plus">'產品名稱一','產品名稱二'</textarea></td>
              </tr>
              <tr>
                <td align="left" class="tddark"><font color="#FF0000">*</font>自訂排序</td>
                <td align="left" class="tddark"><input name="sort" type="text" id="sort" value="<?php echo $row_max['max_count']+1; ?>" /></td>
              </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" id="tableB">
              <tr>
                <td colspan="2" align="left" class="tddark">內容</td>
                </tr>
              <tr>
                <td colspan="2" align="left" class="tddark"><textarea name="class3_content" id="class3_content" rows="5"></textarea><script type="text/javascript">
CKEDITOR.replace( 'class3_content');
</script></td>
                </tr>
            </table>
</form>
          </td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td width="5" heihgt="7"><img src="images/bottom_left.jpg" /></td>
          <td background="images/bottom_middle.jpg" width="100%"></td>
          <td width="5" heihgt="7"><img src="images/bottom_right.jpg" /></td>         
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($max);
?>