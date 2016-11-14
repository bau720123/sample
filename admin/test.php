<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php
if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST)) {
  $DeleteQuery = new WA_MySQLi_Query($connection);
  $DeleteQuery->setQuery("DELETE FROM qa WHERE qa_id = ?");
  $DeleteQuery->bindParam("i","".($_GET['qa_id'])  ."");
  $DeleteQuery->execute();
  $DeleteGoTo = "";
  if (function_exists("rel2abs")) $DeleteGoTo = $DeleteGoTo?rel2abs($DeleteGoTo,dirname(__FILE__)):"";
  $DeleteQuery->redirect($DeleteGoTo);
}
?>
<?php
if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST)) {
  $InsertQuery = new WA_MySQLi_Query($connection);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "qa";
  $InsertQuery->bindColumn("qa_id", "i", "", "WA_BLANK");
  $InsertQuery->bindColumn("qa_typeid", "i", "".$_SESSION['member_id']  ."", "WA_DEFAULT");
  $InsertQuery->saveInSession("");
  $InsertQuery->execute();
  $InsertGoTo = "";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
}
?>
<?php

$maxRows_Recordset1 =10;?>
<?php
$Recordset1 = new WA_MySQLi_RS("Recordset1",$connection,$maxRows_Recordset1);
$Recordset1->setQuery("SELECT * FROM qa");
$Recordset1->execute();?>
<?php
$Recordset2 = new WA_MySQLi_RS("Recordset2",$connection,0);
$Recordset2->setQuery("SELECT photo, photo_thum, qrcode FROM class3 WHERE qa_id = ? ORDER BY class3_id ASC");
$Recordset2->bindParam("i", "".(isset($_GET['qa_id'])?$_GET['qa_id']:"")  ."", "-1"); //colname
$Recordset2->execute();?>
<?php
$member = new WA_MySQLi_RS("member",$connection,1);
$member->setQuery("SELECT member_id, member_name, member_email FROM member WHERE member_ok = 1");
$member->execute();
?>
<?php

$Recordset1Total = new WA_MySQLi_RS("Recordset1Total",$connection);
$Recordset1Total->setQuery("SELECT count(*) as totalcount FROM qa");
$Recordset1Total->execute();
$Recordset1_Total = (int)$Recordset1Total->Results[0]['totalcount'];
$Req_Pages = ceil($Recordset1_Total/$maxRows_Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>
<p>
  <?php
while(!$Recordset1->atEnd()) {
?>
    <?php echo($Recordset1->getColumnVal("qa_question")).'</br>'; ?>
<?php
  $Recordset1->moveNext();
}
$Recordset1->moveFirst(); //return RS to first record
?>
</p>
<table>
  <tr>
    <td><?php if ($Recordset1->PageNum > 0) { // Show if mysqli not first page ?>
  <a href="<?php echo $Recordset1->getFirstPageLink(); ?>">第一頁</a>
  <?php } // Show if mysqli not first page ?></td>
    <td><?php if ($Recordset1->PageNum > 0) { // Show if mysqli not first page ?>
        <a href="<?php echo $Recordset1->getPrevPageLink(); ?>">上一頁</a>
    <?php } // Show if mysqli not first page ?></td>
    <td><?php
						
	$totalRows_Recordset1 = $Recordset1_Total;
			
	$pageNum_Recordset1 = 0;
		if (isset($_GET['pageNum_Recordset1'])) {
				$pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
			}

				$incdone = false;
				if ($maxRows_Recordset1 == 0)
			{
				$maxRows_Recordset1 =1;
				$incdone = true;
			}
			
			$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;						


		if($totalPages_Recordset1 > 0 && !$incdone ) 
		{ 
				$elems = array();
				for ($i=0;$i<$Req_Pages;$i++)
			{
				if ($i==$pageNum_Recordset1)
			{
	
				$elems[] = "<b>".($i+1)."</b>";
			}
		else
			{
				$elems[] = "<a href=\"$filename?pageNum_Recordset1=$i\">".($i+1)."</a>";
			}
		}
	
	echo implode(" | ",$elems);
	}
 ?></td>
    <td><?php if ($Recordset1->PageNum < $Recordset1->TotalPages) { // Show if mysqli not last page ?>
  <a href="<?php echo $Recordset1->getNextPageLink(); ?>">下一頁</a>
  <?php } // Show if mysqli not last page ?></td>
    <td><?php if ($Recordset1->PageNum < $Recordset1->TotalPages) { // Show if mysqli not last page ?>
        <a href="<?php echo $Recordset1->getLastPageLink(); ?>">最後一頁</a>
    <?php } // Show if mysqli not last page ?></td>
  </tr>
</table>
<br>
第<font color="#FF0000"><?php echo $Recordset1->StartRow ?></font>筆到第
<font color="#FF0000"><?php echo $Recordset1->LastRow ?></font>筆，共資料筆數<font color="#FF0000"><?php echo $Recordset1->TotalRows ?></font>筆
<?php if ($Recordset1->TotalRows == 0) { // Show if mysqli recordset empty ?>
  沒資料
  <?php } // Show if mysqli recordset empty ?>
<br>
<?php if ($Recordset1->TotalRows > 0) { // Show if mysqli recordset not empty ?>
  有資料
  <?php } // Show if mysqli recordset not empty ?>
<br>
<p><?php echo($Recordset1->getColumnVal("qa_id")); ?> </p>
<?php if ($Recordset1->PageNum == 0) { // Show if mysqli first page ?>
  如果是第一頁
  <?php } // Show if mysqli first page ?>
<br>
<?php if ($Recordset1->PageNum >= $Recordset1->TotalPages) { // Show if mysqli last page ?>
  如果是最後一頁
  <?php } // Show if mysqli last page ?>
<br>
<?php if ($Recordset1->PageNum > 0 && $Recordset1->PageNum < $Recordset1->TotalPages) { ?>
    如果非第一頁也不是最後
  一頁
  <?php } ?>
<?php echo basename($_SERVER['REQUEST_URI']);?>
<?php
function abc()
{
return basename($_SERVER['REQUEST_URI']);
}
?>
  <select onChange="location = this.options[this.selectedIndex].value;">
<option value="#">請選擇</option>
<option value="<?php echo abc();?>">Google 台灣</option>
<option value="test.php?id=1&abc=1">Yahoo! 奇摩1</option>
<option value="test.php?id=2&abc=2">Yahoo! 奇摩</option>
<option value="test.php?id=3&abc=3">PHP.net</option>
</select>
<?php
if(!filter_has_var(INPUT_GET, "id"))
 {
 echo("id編號不存在");
 }
else
 {
 if (!filter_input(INPUT_GET, "id", FILTER_VALIDATE_id))
  {
  echo "id is not valid";
  echo $_GET['id'];
  }
 else
  {
  echo "id is valid";
  echo $_GET['id'];
  }
 }
?>
<label for="id">Text Field:</label>
<input type="text" name="id" id="id">
<br>
<?php if ($Recordset2->TotalRows > 0) { // Show if mysqli recordset not empty ?>
<?php
while(!$Recordset2->atEnd()) {
?>    
  <?php echo($Recordset2->getColumnVal("photo")); ?>
,<?php echo($Recordset2->getColumnVal("photo_thum")); ?> ,<?php echo($Recordset2->getColumnVal("qrcode")); ?><br><?php
  $Recordset2->moveNext();
}
$Recordset2->moveFirst(); //return RS to first record
?>
<?php } // Show if mysqli recordset not empty ?>
<?php
for($i=1;$i<=10;$i++)
{
echo $i.'</br>';
}
?>
<?php
/*echo date('h:i:s') . "<br />";

//延迟 10 描述
usleep(10000000);

//再次开始
echo date('h:i:s');*/
?>
<?php
echo "<script>alert('郵件寄送失敗，錯誤原因為：$mail->ErrorInfo');</script>";
header("refresh:0;url=123.php" );
?>
</body>
</html>