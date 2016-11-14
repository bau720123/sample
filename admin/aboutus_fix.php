<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST))
{
$UpdateQuery = new WA_MySQLi_Query($connection);
$UpdateQuery->Action = "update";
$UpdateQuery->Table = "aboutus";
$UpdateQuery->bindColumn("aboutus_content".$_POST['x'], "s", "".((isset($_POST["aboutus_content".$_POST['x']]))?$_POST["aboutus_content".$_POST['x']]:"")  ."", "WA_DEFAULT");
$UpdateQuery->addFilter("aboutus_id", "=", "i", "1");
$UpdateQuery->execute();
$UpdateGoTo = basename($_SERVER['REQUEST_URI']);
if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
$UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
$aboutus = new WA_MySQLi_RS("aboutus",$connection,1);
$aboutus->setQuery("SELECT * FROM aboutus WHERE aboutus_id = 1");
$aboutus->execute();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" type="text/css" href="admin.css" />
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
     <form method="post" name="form1" id="form1">
     <div class="titleB">
      <div class="titleBText"><input type="submit" name="button" id="button" value="修改資料" onclick="this.disabled = true;this.value='修改中，請稍後！';document.form1.submit();" /><input name="x" type="hidden" id="x" value="<?php echo $_GET['x']; ?>" />
        </div>
     </div>
   <table border="0" cellpadding="0" cellspacing="0" id="tableB">
    <tr>
     <td colspan="2" align="left" class="tdlight"><textarea name="aboutus_content<?php echo $_GET['x']; ?>" id="aboutus_content<?php echo $_GET['x']; ?>"><?php echo($aboutus->getColumnVal("aboutus_content".$_GET['x'])); ?></textarea>
	 <script type="text/javascript">CKEDITOR.replace('aboutus_content<?php echo $_GET['x']; ?>');</script>
     </td>
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