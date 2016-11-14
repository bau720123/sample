<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php
//參數設定開始
if(empty($_GET['qa_id']))
{
$where = "qa_typeid";
$tablename = "qa";
$qa_question = "qa_question";
$qa_content = "qa_content";
}
if(isset($_GET['qa_id']))
{
$where = "qa_id";
$tablename = "qa_re";
$qa_question = "qa_re_question";
$qa_content = "qa_re_content";
}
//參數設定結束

//計算目前最大自訂排序數字開始
$max_count = new WA_MySQLi_RS("max_count",$connection,0);
$max_count->setQuery("SELECT count(qa_id) as max_count FROM $tablename WHERE $where = ?");
$max_count->bindParam("i", "".(isset($_GET[$where])?$_GET[$where]:"")  ."", "-1");
$max_count->execute();
//計算目前最大自訂排序數字結束

//當頁表單POST送出開始
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))
{
 //如果當下圖片上傳不為空，才使用圖片上傳功能
 if($_FILES['photo']['name'] != NULL)
 {
  //判斷上傳至網站的暫存目錄是否有錯誤
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
	
 $destDir = "../upload/";
 if(!is_dir($destDir) || !is_writeable($destDir))
 die("目錄不存在或無法寫入");

 $Name = date("Ymd") . "_" . substr(md5(uniqid(rand())),0,5) . "." . substr($_FILES['photo']['name'],-3); //檔案命名
 copy($_FILES['photo']['tmp_name'] , $destDir . "/" . $Name ); //複製暫存檔
			
 //預覽圖
 $photo  = $destDir . "" . $Name;
 $photo_thum = $destDir . "" . "thum_" . $Name;
 $destW = 150;
 $destH = 150;
 imagesResize($photo,$photo_thum,$destW,$destH);
 }

//新增動作開始
$InsertQuery = new WA_MySQLi_Query($connection);
$InsertQuery->Action = "insert";
$InsertQuery->Table = $tablename;
 if($tablename == "qa")
 {
 $InsertQuery->bindColumn("qa_typeid", "i", "".$_POST['qa_typeid']  ."", "WA_DEFAULT");
 $InsertQuery->bindColumn("class3_id", "i", "".$_POST['class3_id']  ."", "WA_DEFAULT");
 $InsertQuery->bindColumn("qa_email", "s", "".$_POST['qa_email']  ."", "WA_DEFAULT");
 }
 if($tablename == "qa_re")
 {
 $InsertQuery->bindColumn("qa_id", "i", "".$_POST['qa_id']  ."", "WA_DEFAULT");
 }
$InsertQuery->bindColumn("ready", "i", "".$_POST['ready']  ."", "WA_DEFAULT");
$InsertQuery->bindColumn($qa_question, "s", "".$_POST['qa_question']  ."", "WA_DEFAULT");
$InsertQuery->bindColumn($qa_content, "s", "".$_POST['qa_content']  ."", "WA_DEFAULT");
 //若當下圖片上傳不為空，則將圖檔路徑做儲存
 if($_FILES['photo']['name'] != NULL)
 {
 $InsertQuery->bindColumn("photo", "s", "".$photo  ."", "WA_DEFAULT");
 $InsertQuery->bindColumn("photo_thum", "s", "".$photo_thum  ."", "WA_DEFAULT");
 }
$InsertQuery->bindColumn("ontime", "t", "".$_POST['ontime']  ."", "WA_DEFAULT");
$InsertQuery->bindColumn("offtime", "t", "".$_POST['offtime']  ."", "WA_DEFAULT");
$InsertQuery->bindColumn("nowtime", "t", "".$nowtime  ."", "WA_DEFAULT");
 if(isset($_POST['sort']))
 {
 $InsertQuery->bindColumn("sort", "i", "".$_POST['sort']  ."", "WA_DEFAULT");
 }
$InsertQuery->saveInSession("insert_id");
$InsertQuery->execute();
//新增動作結束
 
 //如果發信通知有打勾
 if(isset($_POST['checkemail']))
 {
 require_once('smtp.php');require_once('seo.php'); //引入文件
  if($_POST['checkemail'] == '1')
  {
  $subject = "留言訊息回覆";
  $address = $_POST['qa_email'];
  $body = "親愛的 ".$_POST['qa_question']." 您好 <br> 您的留言已被回覆，<a href='http://$_SERVER[HTTP_HOST]/message_detail.php?board_id=$_SESSION[insert_id]' target='_blank'>請點我查看</a>";
  }
  if($_POST['checkemail'] == '2')
  {
  //統計認證成功的會員EMAIL開始
  $member = new WA_MySQLi_RS("member",$connection,0);
  $member->setQuery("SELECT member_id, member_name, member_email FROM member WHERE member_ok = 1");
  $member->execute();
  //統計認證成功的會員EMAIL結束
  $subject = "電子報發送";
  $address = $seo->getColumnVal("smtp_email");
  $body = stripslashes(str_replace('"',"'",$_POST['qa_content']));
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
 
 $mail->FromName = $seo->getColumnVal('seo_title')." | ".$subject." | ".$_POST['qa_question']; //寄件人名稱
 $mail->AddAddress($address,$_POST['qa_question']); //設定收件人的另一種格式("Email","收件人名稱") 
 $mail->AddReplyTo($smtp->getColumnVal("smtp_email"), $seo->getColumnVal('seo_title')." | ".$subject." | ".$_POST['qa_question']); //回信Email及名稱
 //$mail->AddAttachment("download.gif", "newname.gif"); //傳送附檔
 $mail->Subject = $seo->getColumnVal('seo_title')." | ".$subject; //郵件標題
 $mail->Body = "<html><head></head><body>$body</body></html>"; //郵件內容支持HTML
 $mail->AltBody = '您的郵件主機商不支持HTML，請洽該系統管理者'; //郵件內容不支持HTML
 
 //發送成功
 if($mail->Send())
 {
 echo "<script>alert('郵件發送成功');</script>";
 }
  //發送失敗
  else
  {
  echo "<script>alert('郵件寄送失敗，錯誤原因為：$mail->ErrorInfo');</script>";
  }  
 }
//路徑設定開始
$goto = basename($_POST['goto']);
header(sprintf("Location: %s", $goto));
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
var emailRE = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
var errMsg = "";
var setfocus = "";
var necessary = "必須填寫";

 if(theForm['qa_typeid'].value == "1" || theForm['qa_typeid'].value == "3" || theForm['qa_typeid'].value == "7")
 {
  if(theForm['sort'].value == "")
  {
  errMsg = "自訂排序" + necessary;
  setfocus = "['sort']";
  }
 }
 if((theForm['qa_typeid'].value == "5" || theForm['qa_typeid'].value == "6") && theForm['checkemail'].checked)
 {
  if(!emailRE.test(theForm['qa_email'].value))
  {
  errMsg = "電子郵件" + necessary;
  setfocus = "['qa_email']";
  }
 }
 if(theForm['qa_question'].value == "")
 {
  if(theForm['qa_typeid'].value == "3")
  {
  errMsg = "問題";
  }
  if(theForm['qa_typeid'].value == "8")
  {
  errMsg = "規格";
  }
  if(theForm['qa_typeid'].value != "3" && theForm['qa_typeid'].value != "8")
  {
  errMsg = "標題";
  }
 errMsg = errMsg + necessary;
 setfocus = "['qa_question']";
 }
 action = "新增";
 if(errMsg != "")
 {
 alert(errMsg);
 eval("theForm" + setfocus + ".focus()");
 }
  else
  {
  theForm.button.disabled = true;
  theForm.button.value = action + "中，請稍後！";
  theForm.submit();
  }
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
      <div class="titleBText"><input type="submit" name="button" id="button" value="新增資料" /><input name="qa_typeid" type="hidden" id="qa_typeid" value="<?php echo $_GET['qa_typeid'];?>" /><input name="action" type="hidden" id="action" value="<?php echo $_GET['action'];?>" /><input name="class3_id" type="hidden" id="class3_id" value="<?php if(empty($_GET['class3_id'])) { ?>0<? } ?><?php if(isset($_GET['class3_id'])) { ?><?php echo $_GET['class3_id']; ?><? } ?>" /><input name="qa_id" type="hidden" id="qa_id" value="<?php if(empty($_GET['qa_id'])) { ?>0<? } ?><?php if(isset($_GET['qa_id'])) { ?><?php echo $_GET['qa_id']; ?><? } ?>" /><input name="goto" type="hidden" id="goto" value="<?php echo basename($_SERVER['HTTP_REFERER']); ?>" /><?php if($_GET['qa_typeid'] == 5 || $_GET['qa_typeid'] == 6) { ?><br>基於安全考量，瀏覽 HTML 內容的信件時，不執行信件內含的 JavaScript 程式碼 ，也不執行外部連結的頁框（iframe），也不執行控制項（object、embed）。這些限制可防範惡意的程式碼、抑制廣告信的刺探性連結、降低中毒的風險，但同時也失去了額外多媒體機能的發揮，並且為了防堵垃圾郵件與濫用情形，如果您傳送郵件給 500 位以上的收件者，或傳送大量無法遞送的郵件時，Google 將暫時停用您的帳戶。假設您使用 POP 或 IMAP 用戶端 (例如 Microsoft Outlook 或 Apple Mail)，您一次只能傳送郵件給 100 位收件者。一般而言，系統會在 24 小時內重新啟用這類暫時遭停用的帳戶，以上消息來自於GOOGLE。<? } ?>
     </div>
     </div>
   <table border="0" cellpadding="0" cellspacing="0" id="tableB">
    <tr>
     <td colspan="2" align="left" class="tdlight"><?php if($_GET['qa_typeid'] == 5 || $_GET['qa_typeid'] == 6) { ?><input name="checkemail" type="checkbox" id="checkemail" value="<?php if($_GET['qa_typeid'] == 5) { ?>1<? } ?><?php if($_GET['qa_typeid'] == 6) { ?>2<? } ?>" />
                  <?php if($_GET['qa_typeid'] == 5) { ?>發信通知<? } ?><?php if($_GET['qa_typeid'] == 6) { ?>發送電子報<? } ?><? } ?>
     <input name="ready" type="checkbox" id="ready" value="1" checked="checked" />
     發佈到前台</td>
    </tr>
    <tr>
     <td align="left" class="tddark">上架時間</td>
     <td align="left" class="tddark"><input name="ontime" type="text" id="ontime" value="<?php echo $nowtime; ?>" size="16" maxlength="19" /></td>
    </tr>
    <tr>
     <td align="left" class="tddark">下架時間</td>
     <td align="left" class="tddark"><input name="offtime" type="text" id="offtime" value="<?php echo add_date($nowtime, '1', '0', '0'); ?>" size="16" maxlength="19" /></td>
    </tr>
    <?php if($_GET['qa_typeid'] == 1 || $_GET['qa_typeid'] == 8) { ?>
    <tr>
     <td align="left" class="tddark">圖檔上傳</td>
     <td align="left" class="tddark"><input name="photo" type="file" id="photo" /></td>
    </tr>
    <? } ?>
    <tr>
     <td align="left" class="tdlight"><font color="#FF0000">*</font><?php if($_GET['qa_typeid'] == 3) { ?>問題<? } ?><?php if($_GET['qa_typeid'] == 4) { ?>討論主題<? } ?><?php if($_GET['qa_typeid'] == '8') { ?>規格<? } ?><?php if($_GET['qa_typeid'] != 3 && $_GET['qa_typeid'] != 4) { ?>標題<? } ?></td>
<td align="left" class="tdlight"><input name="qa_question" type="text" id="qa_question" value=""></td>
    </tr>
    <?php if($_GET['qa_typeid'] == 5) { ?><tr>
     <td align="left" class="tdlight"><font color="#FF0000">*</font>電子郵件</td>
<td align="left" class="tdlight"><input name="qa_email" type="text" id="qa_email" value=""></td>
    </tr><? } ?>
    <?php if($_GET['qa_typeid'] == '1' || $_GET['qa_typeid'] == '3' || $_GET['qa_typeid'] == '7') { ?><tr>
     <td align="left" class="tddark"><font color="#FF0000">*</font>自訂排序</td>
     <td align="left" class="tddark"><input name="sort" type="text" id="sort" value="<?php echo($max_count->getColumnVal("max_count")+1); ?>" size="4" />
     </td>
    </tr><? } ?>
   </table>
   <table border="0" cellpadding="0" cellspacing="0" id="tableB">
    <?php if($_GET['qa_typeid'] != 1) { ?><tr>
     <td align="left" class="tdlight"><?php if($_GET['qa_typeid'] == 3) { ?>答案<? } ?><?php if($_GET['qa_typeid'] != 3) { ?>內容<? } ?></td>
    </tr>
    <tr>
     <td align="left" class="tdlight"><textarea name="qa_content" id="qa_content"></textarea>
     <script type="text/javascript">CKEDITOR.replace('qa_content');</script>
     </td>
    </tr><? } ?>
   </table>
     </form>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
</body>
</html>