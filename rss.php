<?php require_once('Connections/connection.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_connection, $connection);
$query_experience = "SELECT experience_id, experience_heart, experience_date, experience_name FROM experience ORDER BY experience_date DESC";
$experience = mysql_query($query_experience, $connection) or die(mysql_error());
$row_experience = mysql_fetch_assoc($experience);
$totalRows_experience = mysql_num_rows($experience);
	
$rss = "";
header("Content-Type: text/xml; charset=utf-8");

$rss .= "<?xml version=\"1.0\" ?>\r\n";

$rss .= "<rss version=\"2.0\">\r\n";

$rss .= "<channel>\r\n";
$rss .= "<title>".$row_seo_detail['seo_title']."</title>\r\n";
$rss .= "<link>rss.php</link>\r\n";
$rss .= "<description>".$row_seo_detail['seo_description']."</description>\r\n";
$rss .= "<copyright>".$row_seo_detail['seo_copyright']."</copyright>\r\n";
//$rss .= "<lastBuildDate></lastBuildDate>\r\n";
//$rss .= "<image>\r\n";
//$rss .= "<url>http://</url>\r\n";
//$rss .= "</image>\r\n";

do{

$rss .= "<item>\r\n";
$rss .= "<pubDate>" . gmdate("D, d M Y H:i:s", strtotime($row_experience['experience_date'])) . " GMT"."</pubDate>\r\n";
$rss .= "<title>" . $row_experience['experience_name'] ."</title>\r\n";
$rss .= "<link>http://" . $_SERVER["HTTP_HOST"] . "/memorandum_content.php?experience_id=" .$row_experience['experience_id'] ."</link>\r\n";
$rss .= "<description>" . stripslashes(trim($row_experience['experience_brief'])) . "</description>\r\n";
$rss .= "</item>\r\n\r\n";
}while ($row_experience = mysql_fetch_array($experience));

$rss .= "</channel>\r\n";
$rss .= "</rss>\r\n";

echo $rss;
mysql_free_result($experience);
// RSS 2.0 end
?>
