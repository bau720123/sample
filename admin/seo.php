<?php
$seo = new WA_MySQLi_RS("seo",$connection,1);
$seo->setQuery("SELECT * FROM seo WHERE seo_id = 1");
$seo->execute();
?>