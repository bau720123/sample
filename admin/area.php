<?php require_once('../Connections/connection.php'); ?>

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

$colname_area = "-1";
if (isset($_GET['city_id'])) {
  $colname_area = $_GET['city_id'];
}
mysql_select_db($database_connection, $connection);
$query_area = sprintf("SELECT * FROM area WHERE city_id = %s", GetSQLValueString($colname_area, "int"));
$area = mysql_query($query_area, $connection) or die(mysql_error());
$row_area = mysql_fetch_assoc($area);
$totalRows_area = mysql_num_rows($area);
?>
<select name="area_id" class="select3" id="area_id">
  <option value="">鄉鎮市區</option>
  <?php
do {  
?>
  <option value="<?php echo $row_area['area_id']?>"><?php echo $row_area['area_name']?></option>
  <?php
} while ($row_area = mysql_fetch_assoc($area));
  $rows = mysql_num_rows($area);
  if($rows > 0) {
      mysql_data_seek($area, 0);
	  $row_area = mysql_fetch_assoc($area);
  }
?>
</select>
<?php
mysql_free_result($area);
?>
