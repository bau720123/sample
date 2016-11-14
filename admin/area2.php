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

$colname_class2 = "-1";
if (isset($_GET['qa_id'])) {
  $colname_class2 = $_GET['qa_id'];
}
mysql_select_db($database_connection, $connection);
$query_class2 = sprintf("SELECT qa_re_id, qa_id, qa_re_question, sort FROM qa_re WHERE qa_id = %s ORDER BY sort ASC", GetSQLValueString($colname_class2, "int"));
$class2 = mysql_query($query_class2, $connection) or die(mysql_error());
$row_class2 = mysql_fetch_assoc($class2);
$totalRows_class2 = mysql_num_rows($class2);
?>
<select name="qa_re_id" id="qa_re_id">
                  <option value="">尚未選擇</option>
				  <?php
do {  
?>
                  <option value="<?php echo $row_class2['qa_re_id']?>"<?php if (!(strcmp($row_class2['qa_re_id'], $_GET['qa_re_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_class2['qa_re_question']?></option>
                    <?php
} while ($row_class2 = mysql_fetch_assoc($class2));
  $rows = mysql_num_rows($class2);
  if($rows > 0) {
      mysql_data_seek($class2, 0);
	  $row_class2 = mysql_fetch_assoc($class2);
  }
?>
                </select>
<?php
mysql_free_result($class2);
?>
