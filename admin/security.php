<?php
if("" == "")
{
$RestrictAccess = new WA_MySQLi_Auth();
$RestrictAccess->Action = "restrict";
$RestrictAccess->Name = "formadmin";
$RestricAccessRedirect = "login.php";
if (function_exists("rel2abs")) $RestricAccessRedirect = $RestricAccessRedirect?rel2abs($RestricAccessRedirect,dirname(__FILE__)):"";
$RestrictAccess->FailRedirect = $RestricAccessRedirect;
$RestrictAccess->execute();
}
?>