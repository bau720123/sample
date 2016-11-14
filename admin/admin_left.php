<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/authentication.php'); ?>
<?php require_once('security.php'); ?>
<?php
$class_all = new WA_MySQLi_RS("class_all",$connection,0);
$class_all->setQuery("SELECT qa.qa_id, qa.qa_question, qa_re.qa_re_id, qa_re.qa_re_question FROM qa INNER JOIN qa_re ON qa.qa_id = qa_re.qa_id WHERE qa.qa_typeid = 7 ORDER BY qa.sort ASC, qa_re.sort ASC");
$class_all->execute();
?>
<?php  $lastTFM_nest = "";?>
<td width="204" valign="top">
<div><img src="images/nav_top.jpg" /></div>
<div id="nav">
<img src="images/arrow.gif" align="absmiddle" />&nbsp;<strong>後台資料管理</strong>
 <ul>
   <li><a href="admin_fix.php">管理者帳號</a></li>
   <li><a href="seo_fix.php">SEO關建字內容</a></li>
   <li><a href="system_data_fix.php">系統參數</a></li>
   <li><a href="smtp_fix.php">郵件伺服器</a></li>
   <li><a href="qa.php?qa_typeid=1">首頁輪播廣告</a></li>
   <li><a href="aboutus_fix.php?x=1">關於我們</a></li>
   <li><a href="qa.php?qa_typeid=2">最新消息</a></li>
   <li><a href="qa.php?qa_typeid=3">常見問題</a></li>
   <li><a href="qa.php?qa_typeid=4">討論區與回應內容</a></li>
   <li><a href="qa.php?datasource=member">會員資料</a></li>
   <li><a href="member_list.php?member_level=2">會員資料</a></li>
   <li><a href="qa.php?datasource=orders">訂單資料</a></li>
   <li><a href="orders.php">訂單資料</a></li>
   <li><a href="qa.php?qa_typeid=5">連絡我們</a></li>
   <li><a href="qa.php?qa_typeid=6">電子報</a></li>
   <li><a href="qa.php?qa_typeid=7">產品種類與特性</a></li>
 </ul>
<img src="images/line.gif" vspace="10"/>
 <?php if($class_all->TotalRows > 0) { ?>
 <?php while(!$class_all->atEnd()) { ?>
 <ul>
  <li>
  <?php $TFM_nest = $class_all->getColumnVal("qa_question");
  if ($lastTFM_nest != $TFM_nest)
  { 
  $lastTFM_nest = $TFM_nest;
  ?>
<img src="images/arrow.gif" align="absmiddle" />&nbsp;<?php echo $class_all->getColumnVal("qa_question"); ?>
  <?php } ?>
  </li>
  <li><a href="class3.php?qa_id=<?php echo $class_all->getColumnVal("qa_id"); ?>&qa_re_id=<?php echo $class_all->getColumnVal("qa_re_id"); ?>"><?php echo $class_all->getColumnVal("qa_re_question"); ?></a>
  </li>
 </ul>
 <?php $class_all->moveNext(); } $class_all->moveFirst(); ?>
 <?php } ?>
</div>
</td>