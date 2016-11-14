<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php require_once('seo.php'); ?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))
{
$UpdateQuery = new WA_MySQLi_Query($connection);
$UpdateQuery->Action = "update";
$UpdateQuery->Table = "seo";
$UpdateQuery->bindColumn("seo_title", "s", "".((isset($_POST["seo_title"]))?$_POST["seo_title"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_btitle", "s", "".((isset($_POST["seo_btitle"]))?$_POST["seo_btitle"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_keywords", "s", "".((isset($_POST["seo_keywords"]))?$_POST["seo_keywords"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_description", "s", "".((isset($_POST["seo_description"]))?$_POST["seo_description"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_author", "s", "".((isset($_POST["seo_author"]))?$_POST["seo_author"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_company", "s", "".((isset($_POST["seo_company"]))?$_POST["seo_company"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_copyright", "s", "".((isset($_POST["seo_copyright"]))?$_POST["seo_copyright"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_distribution", "s", "".((isset($_POST["seo_distribution"]))?$_POST["seo_distribution"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_robots", "s", "".((isset($_POST["seo_robots"]))?$_POST["seo_robots"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_revisitafter", "s", "".((isset($_POST["seo_revisitafter"]))?$_POST["seo_revisitafter"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_rating", "s", "".((isset($_POST["seo_rating"]))?$_POST["seo_rating"]:"")."", "WA_DEFAULT");
$UpdateQuery->bindColumn("seo_GoogleAnalytics", "s", "".((isset($_POST["seo_GoogleAnalytics"]))?$_POST["seo_GoogleAnalytics"]:"")."", "WA_DEFAULT");
$UpdateQuery->addFilter("seo_id", "=", "i", "".($_POST['seo_id'])."");
$UpdateQuery->execute();
$UpdateGoTo = basename($_SERVER['REQUEST_URI']);
if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
$UpdateQuery->redirect($UpdateGoTo);
}
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
      <div class="titleBText"><input type="submit" name="button" id="button" value="修改資料" onclick="this.disabled = true;this.value='修改中，請稍後！';document.form1.submit();" /><input name="seo_id" type="hidden" id="seo_id" value="<?php echo($seo->getColumnVal("seo_id")); ?>" />
     </div>
     </div>
   <table border="0" cellpadding="0" cellspacing="0" id="tableB">
    <tr>
     <td align="left" class="tdlight"><font color="#FF0000">*</font>網站標題</td>
     <td align="left" class="tddark"><input name="seo_title" type="text" id="seo_title" value="<?php echo($seo->getColumnVal("seo_title")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">網站後台標題</td>
     <td align="left" class="tddark"><input name="seo_btitle" type="text" id="seo_btitle" value="<?php echo($seo->getColumnVal("seo_btitle")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">關鍵字</td>
     <td align="left" class="tddark"><textarea name="seo_keywords" rows="5" id="seo_keywords"><?php echo($seo->getColumnVal("seo_keywords")); ?></textarea></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">網站描述</td>
     <td align="left" class="tddark"><textarea name="seo_description" rows="5" id="seo_description"><?php echo($seo->getColumnVal("seo_description")); ?></textarea></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">作者</td>
     <td align="left" class="tddark"><input name="seo_author" type="text" id="seo_author" value="<?php echo($seo->getColumnVal("seo_author")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">公司名稱</td>
     <td align="left" class="tddark"><input name="seo_company" type="text" id="seo_company" value="<?php echo($seo->getColumnVal("seo_company")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">版權所有</td>
     <td align="left" class="tddark"><input name="seo_copyright" type="text" id="seo_copyright" value="<?php echo($seo->getColumnVal("seo_copyright")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">地理位置</td>
     <td align="left" class="tddark"><input name="seo_distribution" type="text" id="seo_distribution" value="<?php echo($seo->getColumnVal("seo_distribution")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">搜尋引擎搜尋方式</td>
     <td align="left" class="tddark"><input name="seo_robots" type="text" id="seo_robots" value="<?php echo($seo->getColumnVal("seo_robots")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">更新頻率</td>
     <td align="left" class="tddark"><input name="seo_revisitafter" type="text" id="seo_revisitafter" value="<?php echo($seo->getColumnVal("seo_revisitafter")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">更新狀況</td>
     <td align="left" class="tddark"><input name="seo_rating" type="text" id="seo_rating" value="<?php echo($seo->getColumnVal("seo_rating")); ?>" /></td>
    </tr>
    <tr>
     <td align="left" class="tdlight">Google Analytics</td>
     <td align="left" class="tddark"><textarea name="seo_GoogleAnalytics" rows="5" id="seo_GoogleAnalytics"><?php echo($seo->getColumnVal("seo_GoogleAnalytics")); ?></textarea></td>
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