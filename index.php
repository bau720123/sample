<?php //require_once('priority.php'); ?>
<?php require_once('Connections/connection.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-tw" />
<title><?php echo $row_seo_detail['seo_title']; ?>-我的首頁</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-我的首頁" />
<?php require_once("seo.php")?>
<?php require_once("css.php")?>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.activity-indicator.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>
</head>

<body onload="parseLink();">
<span>
<script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
<script type="text/javascript">
new media_line_me.LineButton({"pc":false,"lang":"zh-hant","type":"a"});
</script>
</span>
<a href="javascript:void(window.open('http://www.plurk.com/?qualifier=shares&status='.concat(encodeURIComponent(location.href)).concat(' ') .concat('&#40;').concat(encodeURIComponent(document.title)) .concat('&#41;')));">[推到Plurk]</a><a href="javascript: void(window.open('http://twitter.com/home/?status='.concat(encodeURIComponent(document.title)).concat(' ') .concat(encodeURIComponent(location.href))));">[推到Twitter]</a><a href="javascript: void(window.open('http://www.facebook.com/share.php?u='.concat(encodeURIComponent(location.href))));">[推到 Facebook]</a><a href="http://whos.amung.us/" target="_blank">http://whos.amung.us/</a><a href="https://www.addthis.com/get/sharing?frm=hp#.UP0M8HeykQg" target="_blank">addthis1</a><a href="http://addthis.org.cn/" target="_blank">addthis2</a>
<?php 
if ($_SERVER["HTTP_HOST"] == 'localhost:8086')
{
echo 1;
}
if ($_SERVER["HTTP_HOST"] != 'localhost:8086')
{
echo 2;
}
?>
</body>
</html>