<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php
$perpage = 10; //每頁顯示幾筆
$Recordset1 = new WA_MySQLi_RS("Recordset1",$connection,$perpage);

//having設定開始
if(isset($_GET['class3_id']))
{
 if($_GET['qa_typeid'] == '8')
 {
 $morehaving = "AND class3_id = $_GET[class3_id]";
 }
}
//having設定結束

//排序方式開始
//首頁輪播廣告、常見問題、產品種類、產品特性
if($_GET['qa_typeid'] == '1' || $_GET['qa_typeid'] == '3' || $_GET['qa_typeid'] == '7')
{
$orderby = "ORDER BY sort ASC";
}
//最新消息、聯絡我們、電子報、會員資料、訂單資料
if($_GET['qa_typeid'] == '2' || $_GET['qa_typeid'] == '5' || $_GET['qa_typeid'] == '6' || $_GET['datasource'] == 'member' || $_GET['datasource'] == 'orders')
{
$orderby = "ORDER BY nowtime DESC";
}
//討論區
if($_GET['qa_typeid'] == '4' && empty($_GET['qa_id']))
{
$orderby = "ORDER BY qa_count DESC";
}
//討論區回應內容
if($_GET['qa_typeid'] == '4' && isset($_GET['qa_id']))
{
$orderby = "ORDER BY nowtime DESC";
}
//排序方式結束

//SQL組成與參數設定開始
if(empty($_GET['qa_id']))
{
$sql = "SELECT qa_id, qa_typeid, class3_id, qa.member_id, ready, qa_question, qa_content, qa_email, photo, photo_thum, ontime, offtime, qa.nowtime, sort, member_name FROM qa LEFT JOIN member ON qa.member_id = member.member_id GROUP BY qa_id HAVING qa_typeid = ? $morehaving $orderby";
$bind_type = "i";
$bind = $_GET["qa_typeid"];
$tablename = "qa";
$qa_question = "qa_question";
$qa_content = "qa_content";
$identify = "qa_id";
}
if(isset($_GET['qa_id']))
{
$sql = "SELECT qa_re_id, qa_id, qa_re.member_id, ready, qa_re_question, qa_re_content, ontime, offtime, qa_re.nowtime, sort, member_name FROM qa_re LEFT JOIN member ON qa_re.member_id = member.member_id GROUP BY qa_re_id HAVING qa_id = ? $morehaving $orderby";
$bind_type = "i";
$bind = $_GET["qa_id"];
$tablename = "qa_re";
$qa_question = "qa_re_question";
$qa_content = "qa_re_content";
$identify = "qa_re_id";
}
if($_GET['datasource'] == 'member')
{
$sql = "SELECT member_id, member_uid, member_level, member_uid2, member_username, member_password, member_name, member_nick, city_id, area_id, member_address, member_zipcode, member_birthday, member_tel, member_phone, member_email, member_sex, member_point, member_ok, nowtime FROM member WHERE member_level = 2";
 if(isset($_POST['filter']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '')
 {
 $sql = $sql." AND $_POST[filter] like ?";
 }
$sql = $sql." $morehaving $orderby";
$bind_type = "s";
$bind = '%'.$_POST["filter_value"].'%';
$tablename = "member";
$identify = "member_id";
}
//SQL組成與參數設定結束

//主資料的查詢方式開始
$Recordset1->setQuery($sql);
$Recordset1->bindParam($bind_type, "".((isset($bind))?$bind:"")  ."", "-1");
$Recordset1->execute();
/*echo $Recordset1->Statement.'</br>';
echo $bind;*/
$loop = $Recordset1->LastRow-$Recordset1->StartRow+1; //迴圈數
$totalpage = ceil($Recordset1->TotalRows/$perpage); //總共頁數
//主資料的查詢方式結束

//討論主題與產品種類開始
if($_GET['qa_typeid'] == '4' || $_GET['qa_typeid'] == '7')
{
$Recordset2 = new WA_MySQLi_RS("Recordset2",$connection,0);
$Recordset2->setQuery("SELECT qa_id, qa_typeid, qa_question, sort FROM qa WHERE qa_typeid = ? ORDER BY sort ASC");
$Recordset2->bindParam("i", "".(isset($_GET['qa_typeid'])?$_GET['qa_typeid']:"")  ."", "-1");
$Recordset2->execute();
}
//討論主題與產品種類結束

//當頁表單POST送出開始
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))
{
 //批次修改動作開始
 if($_POST["action"] == "fix")
 {
  for($i=1;$i<=$loop;$i++)
  {
   //如果當下圖片上傳不為空，則先殺掉以前舊的圖檔
   if($_FILES['photo'.$i]['name'] != NULL)
   {
   $photo = iconv("utf-8", "big5", $_POST['photo_del'.$i]);
   @unlink($photo);
   $photo_thum = iconv("utf-8", "big5", $_POST['photo_thum_del'.$i]);
   @unlink($photo_thum);
     
	//判斷上傳至網站的暫存目錄是否有錯誤
    if($_FILES['photo'.$i]['error'] > 0)
    {
    echo "上傳圖檔：".$i.$_FILES['photo'.$i]['name']."<br>";
     switch($_FILES['photo'.$i]['error'])
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

   $Name = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo'.$i]['name'],-3); //檔案命名
   copy($_FILES['photo'.$i]['tmp_name'] , $destDir . "/" . $Name ); //複製暫存檔
			
   //預覽圖
   $photo  = $destDir . "" . $Name;
   $photo_thum = $destDir . "" . "thum_" . $Name;
   $destW = 150;
   $destH = 150;
   imagesResize($photo,$photo_thum,$destW,$destH);
   }
   
  $UpdateQuery = new WA_MySQLi_Query($connection);
  $UpdateQuery->Action = "update";
  $UpdateQuery->Table = $tablename;
   if($tablename == "qa_re")
   {
   $UpdateQuery->bindColumn("qa_id", "i", "".((isset($_POST['qa_id'.$i]))?$_POST['qa_id'.$i]:"")  ."", "WA_DEFAULT");
   }
  $UpdateQuery->bindColumn("ready", "i", "".((isset($_POST['ready'.$i]))?$_POST['ready'.$i]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn($qa_question, "s", "".((isset($_POST['qa_question'.$i]))?$_POST['qa_question'.$i]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn($qa_content, "s", "".((isset($_POST['qa_content'.$i]))?$_POST['qa_content'.$i]:"")  ."", "WA_DEFAULT");
   //若當下圖片上傳不為空，則更新此欄位，反之，則不用更新
   if($_FILES['photo'.$i]['name'] != NULL)
   {
   $UpdateQuery->bindColumn("photo", "s", "".$photo  ."", "WA_DEFAULT");
   $UpdateQuery->bindColumn("photo_thum", "s", "".$photo_thum  ."", "WA_DEFAULT");
   }
  $UpdateQuery->bindColumn("ontime", "t", "".((isset($_POST['ontime'.$i]))?$_POST['ontime'.$i]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("offtime", "t", "".((isset($_POST['offtime'.$i]))?$_POST['offtime'.$i]:"")  ."", "WA_DEFAULT");
   if(isset($_POST['sort'.$i]))
   {
   $UpdateQuery->bindColumn("sort", "i", "".((isset($_POST['sort'.$i]))?$_POST['sort'.$i]:"")  ."", "WA_DEFAULT");
   }
  $UpdateQuery->addFilter($identify, "=", "i", "".($_POST['data_id'.$i])  ."");
  $UpdateQuery->execute();
  }
 }
 //批次修改動作結束
 
 //批次刪除動作開始
 if($_POST["action"] == "delete")
 {
  for($i=1;$i<=$loop;$i++)
  {
   if(isset($_POST['mixdel'.$i]))
   {
    //刪除qa資料表記錄開始
	if($tablename == "qa")
    {
    $DeleteQuery = new WA_MySQLi_Query($connection);
    $DeleteQuery->setQuery("DELETE FROM qa WHERE qa_id = ?");
    $DeleteQuery->bindParam("i","".($_POST['mixdel'.$i])  ."");
    $DeleteQuery->execute();
	}
	//刪除qa資料表記錄結束
  
   //刪除qa_re資料表記錄開始
   $DeleteQuery2 = new WA_MySQLi_Query($connection);
   $DeleteQuery2->setQuery("DELETE FROM qa_re WHERE $identify = ?");
   $DeleteQuery2->bindParam("i","".($_POST['mixdel'.$i])  ."");
   $DeleteQuery2->execute();
   //刪除qa_re資料表記錄結束
   
   //刪除class3資料表相關聯照片開始
   $Recordset1 = new WA_MySQLi_RS("Recordset1",$connection,0);
   $Recordset1->setQuery("SELECT photo, photo_thum, qrcode FROM class3 WHERE $identify = ? ORDER BY class3_id ASC");
   $Recordset1->bindParam("i", "".(isset($_POST['mixdel'.$i])?$_POST['mixdel'.$i]:"")  ."", "-1");
   $Recordset1->execute();
	if($Recordset1->TotalRows > 0)
	{
	 while(!$Recordset1->atEnd())
	 {
     $photo = iconv("utf-8", "big5", $Recordset1->getColumnVal("photo"));
     @unlink($photo);
     $photo_thum = iconv("utf-8", "big5", $Recordset1->getColumnVal("photo_thum"));
     @unlink($photo_thum);
     $qrcode = iconv("utf-8", "big5", $Recordset1->getColumnVal("qrcode"));
     @unlink($qrcode);
	 $Recordset1->moveNext();
	 }
	 $Recordset1->moveFirst();
	}
   //刪除class3資料表相關聯照片結束
	
   //刪除class3資料表關聯紀錄開始
   $DeleteQuery3 = new WA_MySQLi_Query($connection);
   $DeleteQuery3->setQuery("DELETE FROM class3 WHERE $identify = ?");
   $DeleteQuery3->bindParam("i","".($_POST['mixdel'.$i])  ."");
   $DeleteQuery3->execute();
   //刪除class3資料表關聯紀錄結束
	
    //刪除當下頁面上的照片開始
	if(isset($_POST['photo_del'.$i]) && isset($_POST['photo_thum_del'.$i]))
    {
	$photo = iconv("utf-8", "big5", $_POST['photo_del'.$i]);
    @unlink($photo);
    $photo_thum = iconv("utf-8", "big5", $_POST['photo_thum_del'.$i]);
    @unlink($photo_thum);
	}
	//刪除當下頁面上的照片結束
   }
  }
 //資料表優化開始
  if($tablename == "qa")
  {
  $optimize_1 = new WA_MySQLi_Query($connection);
  $optimize_1->setQuery("optimize table qa");
  $optimize_1->execute();
  }
 
 $optimize_2 = new WA_MySQLi_Query($connection);
 $optimize_2->setQuery("optimize table qa_re");
 $optimize_2->execute();
 
 $optimize_3 = new WA_MySQLi_Query($connection);
 $optimize_3->setQuery("optimize table class3");
 $optimize_3->execute();
 //資料表優化結束
 }
 //批次刪除動作結束
  
 //批次發信動作開始
 if($_POST["action"] == "contactus" || $_POST["action"] == "newsletter")
 {
  for($i=1;$i<=$loop;$i++)
  {
   if(isset($_POST['mixdel'.$i]))
   {
   require_once('smtp.php');require_once('seo.php'); //引入文件
    if($_POST['action'] == 'contactus')
    {
    $subject = "留言訊息回覆";
    $address = $_POST['qa_email'.$i];
	$mixdel = $_POST['mixdel'.$i];
	$body = "親愛的 ".$_POST['qa_question'.$i]." 您好 <br> 您的留言已被回覆，<a href='http://$_SERVER[HTTP_HOST]/message_detail.php?board_id=$mixdel' target='_blank'>請點我查看</a>";
    }
    if($_POST['action'] == 'newsletter')
    {
    //統計認證成功的會員EMAIL開始
	$member = new WA_MySQLi_RS("member",$connection,0);
    $member->setQuery("SELECT member_id, member_name, member_email FROM member WHERE member_ok = 1");
    $member->execute();
	//統計認證成功的會員EMAIL結束
    $subject = "電子報發送";
    $address = $seo->getColumnVal("smtp_email");
    $body = stripslashes(str_replace('"',"'",$_POST['qa_content'.$i]));
     if($member->TotalRows > 0)
     {
      //設定密件副本開始
      while(!$member->atEnd())
      {
      $mail->AddBCC($member->getColumnVal("member_email"),$member->getColumnVal("member_name"));
      $member->moveNext();
      }
     $member->moveFirst();
	 //設定密件副本結束
     }
    }
   $mail->FromName = $seo->getColumnVal('seo_title')." | ".$subject." | ".$_POST['qa_question'.$i]; //寄件人名稱
   $mail->AddAddress($address,$_POST['qa_question'.$i]); //設定收件人的另一種格式("Email","收件人名稱") 
   $mail->AddReplyTo($smtp->getColumnVal("smtp_email"), $seo->getColumnVal('seo_title')." | ".$subject." | ".$_POST['qa_question'.$i]); //回信Email及名稱
   //$mail->AddAttachment("download.gif", "newname.gif"); //傳送附檔
   $mail->Subject = $seo->getColumnVal('seo_title')." | ".$subject; //郵件標題
   $mail->Body = "<html><head></head><body>$body</body></html>"; //郵件內容支持HTML
   $mail->AltBody = '您的郵件主機商不支持HTML，請洽該系統管理者'; //郵件內容不支持HTML
   $mail->Send(); //發信
   }
  }
 }
 //批次發信動作結束
  
 //路徑設定開始
 if($_POST['action'] != 'search')
 {
 $goto = basename($_SERVER['REQUEST_URI']);
 header(sprintf("Location: %s", $goto));
 }
 //路徑設定結束
}
//當頁表單POST送出結束
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="admin.css" />
<script type="text/javascript">
function VF_form1()
{
var theForm = document.form1;
var numRE = /^\d+$/;
var emailRE = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
var errMsg = "";
var setfocus = "";
var necessary = "必須填寫";

 //跑迴圈檢查
 for(i=1;i<=<?php echo $Recordset1->TotalRows; ?>;i++)
 {
  //下架時間為空時
  if(theForm['offtime'+i].value == "")
  {
  errMsg = "下架時間" + necessary;
  setfocus = ['offtime'+i];
  }
  
  //上架時間為空時
  if(theForm['ontime'+i].value == "")
  {
  errMsg = "上架時間" + necessary;
  setfocus = ['ontime'+i];
  }
  
  //標題欄位為空時
  if(theForm['qa_question'+i].value == "")
  {
   if(theForm['qa_typeid2'].value == "3")
   {
   errMsg = "問題";
   }
   if(theForm['qa_typeid2'].value == "8")
   {
   errMsg = "規格";
   }
   if(theForm['qa_typeid2'].value != "3" && theForm['qa_typeid2'].value != "8")
   {
   errMsg = "標題";
   }
  errMsg = errMsg + necessary;
  setfocus = ['qa_question'+i];
  }
   
  //首頁輪播廣告、常見問題、產品種類、產品特性
  if(theForm['qa_typeid2'].value == "1" || theForm['qa_typeid2'].value == "3" || theForm['qa_typeid2'].value == "7")
  {
   if(!numRE.test(theForm['sort'+i].value))
   {
   errMsg = "自訂排序" + necessary;
   setfocus = ['sort'+i];
   }
  }
 }
 
 if(errMsg != "")
 {
 alert(errMsg);
 eval("theForm." + setfocus + ".focus()");
 }
  else
  {
   if(confirm(unescape('確定更新頁面上的所有資料？')))
   {
   theForm.batch_update.disabled = true;
   theForm.batch_update.value = "修改中，請稍後！";
   theForm.submit();
   }
  }
}
</script>
<script type="text/javascript">
function ckclick(action)
{
CKEDITOR.replace('qa_content'+action);
}
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
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
   <table border="0" cellpadding="0" cellspacing="0" id="content">
    <tr>
     <td>
     <form method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="VF_form1();return false;">
     <div class="titleB">
      <div class="titleBText"><?php if($_GET['datasource'] == 'member' || $_GET['datasource'] == 'orders') { ?><select name="filter" id="filter">
        <option value="" <?php if($_POST['filter'] == '') { ?>selected<? } ?>>請選擇下列搜尋方式</option>
        <?php if($_GET['datasource'] == 'member') { ?>
        <option value="member_username" <?php if($_POST['filter'] == 'member_username') { ?>selected<? } ?>>使用帳號搜尋</option>
        <option value="member_name" <?php if($_POST['filter'] == 'member_name') { ?>selected<? } ?>>使用姓名搜尋</option>
        <option value="member_uid" <?php if($_POST['filter'] == 'member_uid') { ?>selected<? } ?>>使用身分證字號搜尋</option>
        <option value="member_email" <?php if($_POST['filter'] == 'member_email') { ?>selected<? } ?>>使用EMAIL搜尋</option>
        <option value="member_tel" <?php if($_POST['filter'] == 'member_tel') { ?>selected<? } ?>>使用電話號碼搜尋</option>
        <option value="member_phone" <?php if($_POST['filter'] == 'member_phone') { ?>selected<? } ?>>使用手機號碼搜尋</option>
        <? } ?>
        <?php if($_GET['datasource'] == 'orders') { ?>
        <option value="orders_uid" <?php if($_POST['filter'] == 'orders_uid') { ?>selected<? } ?>>使用訂單編號搜尋</option>
        <option value="orders_datetime" <?php if($_POST['filter'] == 'orders_datetime') { ?>selected<? } ?>>使用下單時間搜尋</option>
        <option value="orders_customerName" <?php if($_POST['filter'] == 'orders_customerName') { ?>selected<? } ?>>使用訂購人姓名搜尋</option>
        <option value="orders_customerEmail" <?php if($_POST['filter'] == 'orders_customerEmail') { ?>selected<? } ?>>使用訂購人EMAIL搜尋</option>
        <option value="orders_customerTel" <?php if($_POST['filter'] == 'orders_customerTel') { ?>selected<? } ?>>使用電話號碼搜尋</option>
        <option value="orders_customerPhone" <?php if($_POST['filter'] == 'orders_customerPhone') { ?>selected<? } ?>>使用手機號碼搜尋</option>
        <? } ?>
</select><input name="filter_value" type="text" id="filter_value" value="<?php echo $_POST['filter_value'];?>" /><input type="button" name="search" id="search" value="查詢" onmouseover="document.form1.action.value='search'" onclick="this.disabled = true;this.value='搜尋中，請稍後！';document.form1.submit();" /><br><? } ?><input name="selectall" type="button" id="selectall" onclick="this.disabled=true;this.value='轉頁中，請稍後！';location.href='qa_action.php?<?php echo $_SERVER['QUERY_STRING']; ?><?php if($_GET['qa_typeid'] == '8' || $_GET['qa_typeid'] == '9') { ?>&class3_id=<?php echo $_GET['class3_id'];?><? } ?>';" value="新增一筆資料" /><?php if ($Recordset1->TotalRows > 0) { ?><input type="submit" name="batch_update" id="batch_update" value="批次更新" onmouseover="document.form1.action.value='fix'" /><input type="submit" name="batch_delete" id="batch_delete" value="批次刪除" onmouseover="document.form1.action.value='delete'" onclick="if(confirm(unescape('確定刪除頁面上的所有資料？'))) { this.disabled = true;this.value='刪除中，請稍後！';document.form1.submit(); } else { return false; }" disabled /><?php if($_GET['qa_typeid'] == 5 || $_GET['qa_typeid'] == 6) { ?><input type="submit" name="batch_email" id="batch_email" value="批次發信" onmouseover="document.form1.action.value='<?php if($_GET['qa_typeid'] == 5) { ?>contactus<? } ?><?php if($_GET['qa_typeid'] == 6) { ?>newsletter<? } ?>'" onclick="if(confirm(unescape('確定發信？'))) { this.disabled = true;this.value='發信中，請稍後！';document.form1.submit(); } else { return false; }" disabled /><? } ?><input name="selectall" type="button" id="selectall" onClick="selAll();" value="全選"><input name="selectnone" type="button" id="selectnone" onClick="unselAll();" value="全取消"><input name="selectreverse" type="button" id="selectreverse" onClick="usel();" value="反向選取"><select name="jumpMenu2" id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)">
<?
for ($page=1;$page<=$totalpage;$page++) { 
$truepage = $page-1;
?> 
      <option value="<?php echo $filename?>?pageNum_Recordset1=<?php echo $truepage;?>&qa_typeid=<?php echo $_GET['qa_typeid'];?>" <?php if (!(strcmp($truepage, $_GET['pageNum_Recordset1']))) {echo "selected=\"selected\"";} ?>>第<?php echo $page;?>頁</option>
<? } ?>
</select><select name="qa_typeid" id="qa_typeid" onchange="MM_jumpMenu('parent',this,0)">
        <?php if($_GET['qa_typeid'] != '8' && $_GET['qa_typeid'] != '9') { ?><option value="?qa_typeid=1" <?php if (!(strcmp(1, $_GET['qa_typeid']))) { echo "selected=\"selected\""; } ?>>首頁輪播廣告</option>
        <option value="?qa_typeid=2" <?php if (!(strcmp(2, $_GET['qa_typeid']))) { echo "selected=\"selected\""; } ?>>最新消息</option>
        <option value="?qa_typeid=3" <?php if (!(strcmp(3, $_GET['qa_typeid']))) { echo "selected=\"selected\""; } ?>>常見問題</option>
        <option value="?qa_typeid=4" <?php if (!(strcmp(4, $_GET['qa_typeid']))) { echo "selected=\"selected\""; } ?>>討論區與回應內容</option>
        <option value="?qa_typeid=5" <?php if (!(strcmp(5, $_GET['qa_typeid']))) { echo "selected=\"selected\""; } ?>>連絡我們</option>
        <option value="?qa_typeid=6" <?php if (!(strcmp(6, $_GET['qa_typeid']))) { echo "selected=\"selected\""; } ?>>電子報</option>
        <option value="?qa_typeid=7" <?php if (!(strcmp(7, $_GET['qa_typeid']))) { echo "selected=\"selected\""; } ?>>產品種類與特性</option>
		<option value="?datasource=member" <?php if (!(strcmp('member', $_GET['datasource']))) { echo "selected=\"selected\""; } ?>>會員資料</option>
        <option value="?datasource=orders" <?php if (!(strcmp('orders', $_GET['datasource']))) { echo "selected=\"selected\""; } ?>>訂單資料</option>
		<? } ?>
		<?php if($_GET['qa_typeid'] == '8') { ?><option value="?class3_id=<?php echo $_GET['class3_id']; ?>&qa_typeid=8" <?php if (!(strcmp(8, $_GET['qa_typeid']))) { echo "selected=\"selected\""; } ?>>產品規格</option><? } ?>
</select><?php if ($Recordset2->TotalRows > 0) { ?><select name="qa_id" id="qa_id" onchange="MM_jumpMenu('parent',this,0)">
        <option value="?qa_typeid=<?php echo $Recordset2->getColumnVal("qa_typeid"); ?>" selected="selected"><?php if(empty($_GET['qa_id'])) { ?>請選擇以下<? } ?><?php if(isset($_GET['qa_id'])) { ?>點我切換回<? } ?><?php if($_GET['qa_typeid'] == '4') { ?>討論主題<? } ?><?php if($_GET['qa_typeid'] == '7') { ?>產品種類<? } ?></option>
        <?php while(!$Recordset2->atEnd()) { ?>
        <option value="?qa_typeid=<?php echo $Recordset2->getColumnVal("qa_typeid"); ?>&qa_id=<?php echo $Recordset2->getColumnVal("qa_id"); ?>"<?php if (!(strcmp($Recordset2->getColumnVal("qa_id"), $_GET['qa_id']))) {echo "selected=\"selected\"";} ?>><?php echo $Recordset2->getColumnVal("qa_question"); ?></option>
<?php $Recordset2->moveNext(); } $Recordset2->moveFirst(); ?>
      </select><? } ?><br><?php if($totalpage > 1) { ?>數字分頁：
   <?php
   $prev_symbol = "";
   $next_symbol = "";
   $separator = " | ";
   $pages_navigation_Recordset1 = buildNavigation($Recordset1->PageNum,$totalpage,$prev_symbol,$next_symbol,$separator,$totalpage,true);
   print $pages_navigation_Recordset1[1];
   ?>
   <br>
   文字分頁：<?php if($Recordset1->PageNum > 0) { ?><a href="<?php echo $Recordset1->getFirstPageLink(); ?>">第一頁</a><?php echo $separator; ?><?php } ?><?php if($Recordset1->PageNum > 0) { ?><a href="<?php echo $Recordset1->getPrevPageLink(); ?>">上一頁</a><?php echo $separator; ?><?php } ?><?php if($Recordset1->PageNum < $Recordset1->TotalPages) { ?><a href="<?php echo $Recordset1->getNextPageLink(); ?>">下一頁</a><?php echo $separator; ?><?php } ?><?php if($Recordset1->PageNum < $Recordset1->TotalPages) { ?><a href="<?php echo $Recordset1->getLastPageLink(); ?>">最後一頁</a><?php echo $separator; ?><?php } ?><br><? } ?>頁數顯示：第<font color="#FF0000"><?php echo $Recordset1->PageNum+1; ?></font>頁，共<font color="#FF0000"><?php echo $totalpage; ?></font>頁，每頁最多顯示<font color="#FF0000"><?php echo $perpage; ?></font>筆<br>
   筆數顯示：第<font color="#FF0000"><?php echo $Recordset1->StartRow; ?></font>筆到第<font color="#FF0000"><?php echo $Recordset1->LastRow; ?></font>筆，共<font color="#FF0000"><?php echo $Recordset1->TotalRows; ?></font>筆資料<br>
   排序方式：<?php if($orderby == 'ORDER BY sort ASC') { echo '自訂排序（遞增）'; } ?><?php if($orderby == 'ORDER BY sort DESC') { echo '自訂排序（遞減）'; } ?><?php if($orderby == 'ORDER BY nowtime ASC') { echo '新增時間（遞增）'; } ?><?php if($orderby == 'ORDER BY nowtime DESC') { echo '新增時間（遞減）'; } ?><?php if($orderby == 'ORDER BY qa_count ASC') { echo '點擊次數（遞增）'; } ?><?php if($orderby == 'ORDER BY qa_count DESC') { echo '點擊次數（遞減）'; } ?>
<? } ?>
<input name="qa_typeid2" type="hidden" id="qa_typeid2" value="<?php echo $_GET['qa_typeid'];?>" /><input type="hidden" name="action" id="action" />
     </div>
     </div>
   <?php if($Recordset1->TotalRows > 0) { ?>
   <?php if(isset($_GET['qa_typeid'])) { require_once('qa_template.php'); } ?>
   <?php if($_GET['datasource'] == 'member') { require_once('member_template.php'); } ?>
   <?php if($_GET['datasource'] == 'orders') { require_once('orders_template.php'); } ?>
   <? } ?>
     </form>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
</body>
</html>