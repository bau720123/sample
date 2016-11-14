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
$query_class_all = "SELECT qa.qa_id, qa_question, qa_re.qa_re_id, qa_re_question FROM qa, qa_re WHERE qa_typeid=7 AND qa.qa_id = qa_re.qa_id ORDER BY qa.sort ASC , qa_re.sort ASC";
$class_all = mysql_query($query_class_all, $connection) or die(mysql_error());
$row_class_all = mysql_fetch_assoc($class_all);
$totalRows_class_all = mysql_num_rows($class_all);
?>
<?php  $lastTFM_nest = "";?>
<?php if ($totalRows_class_all > 0) { // Show if recordset not empty ?>
                <?php do { ?>
                <ul>
          <li><!-- 細項連結 --><?php $TFM_nest = $row_class_all['qa_question'];
if ($lastTFM_nest != $TFM_nest) { 
	$lastTFM_nest = $TFM_nest; ?>
        <u><?php echo $row_class_all['qa_question']; ?></u><?php } //End of Basic-UltraDev Simulated Nested Repeat?></li>
        <li><!-- 細項連結 --><a href="class3.php?qa_id=<?php echo $row_class_all['qa_id']; ?>&qa_re_id=<?php echo $row_class_all['qa_re_id']; ?>"><?php echo $row_class_all['qa_re_question']; ?></a></li>
        </ul>
<?php } while ($row_class_all = mysql_fetch_assoc($class_all)); ?><?php } // Show if recordset not empty ?>
<?php
mysql_free_result($class_all);
?>