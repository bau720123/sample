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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  
  if($_FILES['photo']['name'] != NULL)
  {
  //先殺掉以前舊的圖檔
  unlink($_POST['photodel']);
  unlink($_POST['photodel_thum']);
  	  
  //先判斷上傳至網站的暫存目錄是否有錯誤
   if($_FILES['photo']['error'] > 0)
   {
   echo "檔案：".$_FILES['photo']['name']."<br>";
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
	
	$destDir = "../upload/";
	if(!is_dir($destDir) || !is_writeable($destDir))
	die("目錄不存在或無法寫入");
	
	//檔案命名
	$Name = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo']['name'],-3);
	
	//複製暫存檔
	copy($_FILES['photo']['tmp_name'] , $destDir . "/" . $Name );
			
	//預覽圖
	$src  = $destDir . "" . $Name;
	$dest = $destDir . "" . "thum_" . $Name;
	$destW = 150;
	$destH = 150;
	imagesResize($src,$dest,$destW,$destH);
	
  $updateSQL = sprintf("UPDATE class3 SET photo=%s, photo_thum=%s WHERE class3_id=%s",
                       GetSQLValueString($src, "text"),
					   GetSQLValueString($dest, "text"),
                       GetSQLValueString($_POST['class3_id'], "int"));
  }
  
  if($_FILES['photo1']['name'] != NULL)
  {
  //先殺掉以前舊的圖檔
  @unlink($_POST['photodel1']);
  @unlink($_POST['photodel1_thum']);
  
  //先判斷上傳至網站的暫存目錄是否有錯誤
   if($_FILES['photo1']['error'] > 0)
   {
   echo "檔案：".$_FILES['photo1']['name']."<br>";
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
	
	$destDir = "../upload/";
	if(!is_dir($destDir) || !is_writeable($destDir))
	die("目錄不存在或無法寫入");
	
	//檔案命名
	$Name1 = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo1']['name'],-3);
	
	//複製暫存檔
	copy($_FILES['photo1']['tmp_name'] , $destDir . "/" . $Name1 );
			
	//預覽圖
	$src1  = $destDir . "" . $Name1;
	$dest1 = $destDir . "" . "thum_" . $Name1;
	$destW1 = 150;
	$destH1 = 150;
	imagesResize($src1,$dest1,$destW1,$destH1);
	
  $updateSQL1 = sprintf("UPDATE class3 SET photo1=%s, photo1_thum=%s WHERE class3_id=%s",
                       GetSQLValueString($src1, "text"),
					   GetSQLValueString($dest1, "text"),
                       GetSQLValueString($_POST['class3_id'], "int"));
  }
  
  if($_FILES['photo2']['name'] != NULL)
  {
  //先殺掉以前舊的圖檔
  @unlink($_POST['photodel2']);
  @unlink($_POST['photodel2_thum']);
  
  //先判斷上傳至網站的暫存目錄是否有錯誤
   if($_FILES['photo2']['error'] > 0)
   {
   echo "檔案：".$_FILES['photo2']['name']."<br>";
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
	
	$destDir = "../upload/";
	if(!is_dir($destDir) || !is_writeable($destDir))
	die("目錄不存在或無法寫入");
	
	//檔案命名
	$Name2 = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo2']['name'],-3);
	
	//複製暫存檔
	copy($_FILES['photo2']['tmp_name'] , $destDir . "/" . $Name2 );
			
	//預覽圖
	$src  = $destDir . "" . $Name2;
	$dest = $destDir . "" . "thum_" . $Name2;
	$destW = 150;
	$destH = 150;
	imagesResize($src,$dest,$destW,$destH);
	
  $updateSQL2 = sprintf("UPDATE class3 SET photo2=%s, photo2_thum=%s WHERE class3_id=%s",
                       GetSQLValueString($src, "text"),
					   GetSQLValueString($dest, "text"),
                       GetSQLValueString($_POST['class3_id'], "int"));
  }
  
  if($_FILES['photo3']['name'] != NULL)
  {
  //先殺掉以前舊的圖檔
  @unlink($_POST['photodel3']);
  @unlink($_POST['photodel3_thum']);
  
  //先判斷上傳至網站的暫存目錄是否有錯誤
   if($_FILES['photo3']['error'] > 0)
   {
   echo "檔案：".$_FILES['photo3']['name']."<br>";
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
	
	$destDir = "../upload/";
	if(!is_dir($destDir) || !is_writeable($destDir))
	die("目錄不存在或無法寫入");
	
	//檔案命名
	$Name3 = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo3']['name'],-3);
	
	//複製暫存檔
	copy($_FILES['photo3']['tmp_name'] , $destDir . "/" . $Name3 );
			
	//預覽圖
	$src  = $destDir . "" . $Name3;
	$dest = $destDir . "" . "thum_" . $Name3;
	$destW = 150;
	$destH = 150;
	imagesResize($src,$dest,$destW,$destH);
	
  $updateSQL3 = sprintf("UPDATE class3 SET photo3=%s, photo3_thum=%s WHERE class3_id=%s",
                       GetSQLValueString($src, "text"),
					   GetSQLValueString($dest, "text"),
                       GetSQLValueString($_POST['class3_id'], "int"));
  }
  
  if($_FILES['photo4']['name'] != NULL)
  {
  //先殺掉以前舊的圖檔
  @unlink($_POST['photodel4']);
  @unlink($_POST['photodel4_thum']);
  
  //先判斷上傳至網站的暫存目錄是否有錯誤
   if($_FILES['photo4']['error'] > 0)
   {
   echo "檔案：".$_FILES['photo4']['name']."<br>";
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
	
	$destDir = "../upload/";
	if(!is_dir($destDir) || !is_writeable($destDir))
	die("目錄不存在或無法寫入");
	
	//檔案命名
	$Name4 = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo4']['name'],-3);
	
	//複製暫存檔
	copy($_FILES['photo4']['tmp_name'] , $destDir . "/" . $Name4 );
			
	//預覽圖
	$src  = $destDir . "" . $Name4;
	$dest = $destDir . "" . "thum_" . $Name4;
	$destW = 150;
	$destH = 150;
	imagesResize($src,$dest,$destW,$destH);
	
  $updateSQL4 = sprintf("UPDATE class3 SET photo4=%s, photo4_thum=%s WHERE class3_id=%s",
                       GetSQLValueString($src, "text"),
					   GetSQLValueString($dest, "text"),
                       GetSQLValueString($_POST['class3_id'], "int"));
  }
    
  $updateSQLother = sprintf("UPDATE class3 SET qa_re_id=%s, qa_id=%s, ready=%s, class3_name=%s, class3_ename=%s, class3_price=%s, class3_price2=%s, class3_point=%s, class3_inventory=%s, class3_safe_inventory=%s, class3_brief=%s, class3_plus=%s, class3_content=%s, ontime=%s, offtime=%s,sort=%s WHERE class3_id=%s",
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
					   GetSQLValueString($_POST['ontime'], "date"),
					   GetSQLValueString($_POST['offtime'], "date"),
                       GetSQLValueString($_POST['sort'], "int"),
                       GetSQLValueString($_POST['class3_id'], "int"));

  mysql_select_db($database_connection, $connection);
  if($_FILES['photo']['name'] != NULL)
  {	
  $Result = mysql_query($updateSQL, $connection) or die(mysql_error());
  }
  if($_FILES['photo1']['name'] != NULL)
  {	
  $Result1 = mysql_query($updateSQL1, $connection) or die(mysql_error());
  }
  if($_FILES['photo2']['name'] != NULL)
  {	
  $Result2 = mysql_query($updateSQL2, $connection) or die(mysql_error());
  }
  if($_FILES['photo3']['name'] != NULL)
  {	
  $Result3 = mysql_query($updateSQL3, $connection) or die(mysql_error());
  }
  if($_FILES['photo4']['name'] != NULL)
  {	
  $Result4 = mysql_query($updateSQL4, $connection) or die(mysql_error());
  }
  
  $Resultother = mysql_query($updateSQLother, $connection) or die(mysql_error());
  
  $updateGoTo = "class3.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_class3_detail = "-1";
if (isset($_GET['class3_id'])) {
  $colname_class3_detail = $_GET['class3_id'];
}
mysql_select_db($database_connection, $connection);
$query_class3_detail = sprintf("SELECT * FROM class3 WHERE class3_id = %s", GetSQLValueString($colname_class3_detail, "int"));
$class3_detail = mysql_query($query_class3_detail, $connection) or die(mysql_error());
$row_class3_detail = mysql_fetch_assoc($class3_detail);
$totalRows_class3_detail = mysql_num_rows($class3_detail);

mysql_select_db($database_connection, $connection);
$query_class1 = "SELECT qa_id, qa_question, sort FROM qa WHERE qa_typeid = 7 ORDER BY sort ASC";
$class1 = mysql_query($query_class1, $connection) or die(mysql_error());
$row_class1 = mysql_fetch_assoc($class1);
$totalRows_class1 = mysql_num_rows($class1);

$colname_class2 = "-1";
if (isset($_GET['qa_id'])) {
  $colname_class2 = $_GET['qa_id'];
}
mysql_select_db($database_connection, $connection);
$query_class2 = sprintf("SELECT qa_re_id, qa_id, qa_re_question, sort FROM qa_re WHERE qa_id = %s ORDER BY sort ASC", GetSQLValueString($colname_class2, "int"));
$class2 = mysql_query($query_class2, $connection) or die(mysql_error());
$row_class2 = mysql_fetch_assoc($class2);
$totalRows_class2 = mysql_num_rows($class2);
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
              <div class="titleBText"><input value="修改資料" name="button" type="submit" /><input name="class3_id" type="hidden" id="class3_id" value="<?php echo $row_class3_detail['class3_id']; ?>" /><input name="class3_inventory" type="hidden" id="class3_inventory" value="<?php echo $row_class3_detail['class3_inventory']; ?>"><input name="class3_safe_inventory" type="hidden" id="class3_safe_inventory" value="<?php echo $row_class3_detail['class3_safe_inventory']; ?>"><input type="hidden" name="MM_update" value="form1" /></div>
            </div><table border="0" cellpadding="0" cellspacing="0" id="tableB">
<tr>
                <td colspan="2" align="left" class="tdlight"><input <?php if (!(strcmp($row_class3_detail['ready'],1))) {echo "checked=\"checked\"";} ?> name="ready" type="checkbox" id="ready" value="1" />
發佈到前台</td>
                </tr>
                <tr>
                  <td align="left" class="tddark">上架時間</td>
                  <td align="left" class="tddark"><input name="ontime" type="text" id="ontime" value="<?php echo $row_class3_detail['ontime']; ?>" size="16" maxlength="19" /></td>
                </tr>
                <tr>
                  <td align="left" class="tddark">下架時間</td>
                  <td align="left" class="tddark"><input name="offtime" type="text" id="offtime" value="<?php echo $row_class3_detail['offtime']; ?>" size="16" maxlength="19" /></td>
                </tr>
              <tr>
                <td align="left" class="tdlight"><font color="#FF0000">*</font>產品種類</td>
                <td align="left" class="tdlight"><select name="qa_id" id="qa_id" onChange="Buildkey2(document.getElementById('qa_id').value);">
        <?php
do {  
?>
        <option value="<?php echo $row_class1['qa_id']?>"<?php if (!(strcmp($row_class1['qa_id'], $_GET['qa_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_class1['qa_question']?></option>
        <?php
} while ($row_class1 = mysql_fetch_assoc($class1));
  $rows = mysql_num_rows($class1);
  if($rows > 0) {
      mysql_data_seek($class1, 0);
	  $row_class1 = mysql_fetch_assoc($class1);
  }
?>
        </select></td>
              </tr>
              <tr>
                <td align="left" class="tdlight"><font color="#FF0000">*</font>產品特性</td>
                <td align="left" class="tdlight"><span id="idbau1"><select name="qa_re_id" id="qa_re_id">
				  <?php
do {  
?>
                  <option value="<?php echo $row_class2['qa_re_id']?>"<?php if (!(strcmp($row_class2['qa_re_id'], $_GET['qa_re_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_class2['qa_re_question']?></option>
                    <?php
} while ($row_class2 = mysql_fetch_assoc($class2));
  $rows = mysql_num_rows($class2);
  if($rows > 0) {
      mysql_data_seek($class2, 0);
	  $row_class2 = mysql_fetch_assoc($class2);
  }
?>
                </select></span></td>
              </tr>
              <tr>
                <td align="left" class="tdlight"><font color="#FF0000">*</font>標題</td>
<td align="left" class="tdlight">
  <input name="class3_name" type="text" id="class3_name" value="<?php echo $row_class3_detail['class3_name']; ?>" />
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight">英文標題</td>
<td align="left" class="tdlight">
  <input name="class3_ename" type="text" id="class3_ename" value="<?php echo $row_class3_detail['class3_ename']; ?>">
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight">售價</td>
<td align="left" class="tdlight">
  <input name="class3_price" type="text" id="class3_price" value="<?php echo $row_class3_detail['class3_price']; ?>">
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight">原價</td>
<td align="left" class="tdlight">
  <input name="class3_price2" type="text" id="class3_price2" value="<?php echo $row_class3_detail['class3_price2']; ?>">
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight">紅利點數</td>
<td align="left" class="tdlight">
  <input name="class3_point" type="text" id="class3_point" value="<?php echo $row_class3_detail['class3_point']; ?>">
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight"><font color="#FF0000">*</font>庫存</td>
<td align="left" class="tdlight">
  
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight"><font color="#FF0000">*</font>安全庫存</td>
<td align="left" class="tdlight">
  
</td>
              </tr>
              <tr>
                <td align="left" class="tddark">&nbsp;</td>
                <td align="left" class="tddark">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" class="tddark">&nbsp;</td>
                <td align="left" class="tddark">下方相關上傳設定若維持原樣請留白即可</td>
              </tr>
              <tr>
                <td align="left" class="tddark"><font color="#FF0000">*</font>圖檔上傳</td>
                <td align="left" class="tddark">
                  <input name="photo" type="file" id="photo" />
                  <input name="photodel" type="hidden" id="photodel" value="<?php echo $row_class3_detail['photo']; ?>" />
                  <input name="photodel_thum" type="hidden" id="photodel_thum" value="<?php echo $row_class3_detail['photo_thum']; ?>" />
                </td>
              </tr>
              <!--<tr>
                <td align="left" class="tddark">上傳圖檔2</td>
                <td align="left" class="tddark">
                  <input name="photo1" type="file" id="photo1" />
                  <input name="photodel1" type="hidden" id="photodel1" value="<?php echo $row_class3_detail['photo1']; ?>" />
                  <input name="photodel1_thum" type="hidden" id="photodel1_thum" value="<?php echo $row_class3_detail['photo1_thum']; ?>" />
                </td>
              </tr>
              <tr>
                <td align="left" class="tddark">上傳圖檔3</td>
                <td align="left" class="tddark">
                  <input name="photo2" type="file" id="photo2" />
                  <input name="photodel2" type="hidden" id="photodel2" value="<?php echo $row_class3_detail['photo2']; ?>" />
                  <input name="photodel2_thum" type="hidden" id="photodel2_thum" value="<?php echo $row_class3_detail['photo2_thum']; ?>" />
                </td>
              </tr>
              <tr>
                <td align="left" class="tddark">上傳圖檔4</td>
                <td align="left" class="tddark">
                  <input name="photo3" type="file" id="photo3" />
                  <input name="photodel3" type="hidden" id="photodel3" value="<?php echo $row_class3_detail['photo3']; ?>" />
                  <input name="photodel3_thum" type="hidden" id="photodel3_thum" value="<?php echo $row_class3_detail['photo3_thum']; ?>" />
                </td>
              </tr>
              <tr>
                <td align="left" class="tddark">上傳圖檔5</td>
                <td align="left" class="tddark">
                  <input name="photo4" type="file" id="photo4" />
                  <input name="photodel4" type="hidden" id="photodel4" value="<?php echo $row_class3_detail['photo4']; ?>" />
                  <input name="photodel4_thum" type="hidden" id="photodel4_thum" value="<?php echo $row_class3_detail['photo4_thum']; ?>" />
                </td>
              </tr>-->
              <tr>
                <td align="left" class="tdlight">簡介</td>
<td align="left" class="tdlight">
  <textarea name="class3_brief" rows="5" id="class3_brief"><?php echo $row_class3_detail['class3_brief']; ?></textarea>
</td>
              </tr>
              <tr>
                <td align="left" class="tdlight">關聯產品</td>
<td align="left" class="tdlight">
  <textarea name="class3_plus" rows="5" id="class3_plus"><?php echo $row_class3_detail['class3_plus']; ?></textarea>
</td>
              </tr>
              <tr>
                <td align="left" class="tddark"><font color="#FF0000">*</font>自訂排序</td>
                <td align="left" class="tddark"><input name="sort" type="text" id="sort" value="<?php echo $row_class3_detail['sort']; ?>" /></td>
              </tr>
              <tr>
                <td align="left" class="tddark">建立時間</td>
                <td align="left" class="tddark"><?php echo $row_class3_detail['nowtime']; ?></td>
              </tr>
              </table>
              <table border="0" cellpadding="0" cellspacing="0" id="tableB">
              <tr>
                <td colspan="2" align="left" class="tddark">內容</td>
                </tr>
              <tr>
                <td colspan="2" align="left" class="tddark"><textarea name="class3_content" id="class3_content" rows="5"><?php echo $row_class3_detail['class3_content']; ?></textarea><script type="text/javascript">
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
mysql_free_result($class3_detail);

mysql_free_result($class1);

mysql_free_result($class2);
?>