<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))
{
$UpdateQuery = new WA_MySQLi_Query($connection);
$UpdateQuery->Action = "update";
$UpdateQuery->Table = "system_data";
$UpdateQuery->bindColumn("system_data_1", "i", "".((isset($_POST["system_data_1"]))?$_POST["system_data_1"]:"")  ."", "WA_DEFAULT");
$UpdateQuery->bindColumn("system_data_2", "i", "".((isset($_POST["system_data_2"]))?$_POST["system_data_2"]:"")  ."", "WA_DEFAULT");
$UpdateQuery->bindColumn("system_data_3", "i", "".((isset($_POST["system_data_3"]))?$_POST["system_data_3"]:"")  ."", "WA_DEFAULT");
$UpdateQuery->bindColumn("system_data_4", "i", "".((isset($_POST["system_data_4"]))?$_POST["system_data_4"]:"")  ."", "WA_DEFAULT");
$UpdateQuery->bindColumn("system_data_5", "i", "".((isset($_POST["system_data_5"]))?$_POST["system_data_5"]:"")  ."", "WA_DEFAULT");
$UpdateQuery->bindColumn("system_data_6", "i", "".((isset($_POST["system_data_6"]))?$_POST["system_data_6"]:"")  ."", "WA_DEFAULT");
$UpdateQuery->bindColumn("system_data_7", "i", "".((isset($_POST["system_data_7"]))?$_POST["system_data_7"]:"")  ."", "WA_DEFAULT");
$UpdateQuery->bindColumn("system_data_8", "i", "".((isset($_POST["system_data_8"]))?$_POST["system_data_8"]:"")  ."", "WA_DEFAULT");
$UpdateQuery->bindColumn("system_data_9", "i", "".((isset($_POST["system_data_9"]))?$_POST["system_data_9"]:"")  ."", "WA_DEFAULT");
$UpdateQuery->bindColumn("system_data_10", "d", "".((isset($_POST["system_data_10"]))?$_POST["system_data_10"]:"")  ."", "WA_DEFAULT");
$UpdateQuery->addFilter("system_data_id", "=", "i", "".($_POST['system_data_id'])  ."");
$UpdateQuery->execute();
$UpdateGoTo = basename($_SERVER['REQUEST_URI']);
if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
$UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
$system_data = new WA_MySQLi_RS("system_data",$connection,1);
$system_data->setQuery("SELECT * FROM system_data WHERE system_data_id = 1");
$system_data->execute();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="admin.css" />
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
     <form method="post" name="form1" id="form1">
     <div class="titleB">
      <div class="titleBText"><input type="submit" name="button" id="button" value="修改資料" onclick="this.disabled = true;this.value='修改中，請稍後！';document.form1.submit();" /><input name="system_data_id" type="hidden" id="system_data_id" value="<?php echo($system_data->getColumnVal("system_data_id")); ?>" />
      </div>
     </div>
   <table border="0" cellpadding="0" cellspacing="0" id="tableB">
    <tr>
     <td align="left" class="tdlight">最新消息分頁數</td>
     <td align="left" class="tddark"><input name="system_data_1" type="text" id="system_data_1" value="<?php echo($system_data->getColumnVal("system_data_1")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">常見問題分頁數</td>
     <td align="left" class="tddark"><input name="system_data_2" type="text" id="system_data_2" value="<?php echo($system_data->getColumnVal("system_data_2")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">留言版分頁數</td>
     <td align="left" class="tddark"><input name="system_data_3" type="text" id="system_data_3" value="<?php echo($system_data->getColumnVal("system_data_3")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">討論區分頁數</td>
     <td align="left" class="tddark"><input name="system_data_4" type="text" id="system_data_4" value="<?php echo($system_data->getColumnVal("system_data_4")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">討論區回覆分頁數</td>
     <td align="left" class="tddark"><input name="system_data_5" type="text" id="system_data_5" value="<?php echo($system_data->getColumnVal("system_data_5")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">產品資料分頁數</td>
     <td align="left" class="tddark"><input name="system_data_6" type="text" id="system_data_6" value="<?php echo($system_data->getColumnVal("system_data_6")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">單筆訂單金額大於或等於多少錢則免運費</td>
     <td align="left" class="tdlight"><input name="system_data_7" type="text" id="system_data_7" value="<?php echo($system_data->getColumnVal("system_data_7")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">運費金額</td>
     <td align="left" class="tddark"><input name="system_data_8" type="text" id="system_data_8" value="<?php echo($system_data->getColumnVal("system_data_8")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">單筆訂單金額大於或等於多少錢則進行打折</td>
     <td align="left" class="tdlight"><input name="system_data_9" type="text" id="system_data_9" value="<?php echo($system_data->getColumnVal("system_data_9")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">折扣數〔0.85代表85折〕</td>
     <td align="left" class="tddark"><input name="system_data_10" type="text" id="system_data_10" value="<?php echo($system_data->getColumnVal("system_data_10")); ?>" /></td>
    </tr>
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