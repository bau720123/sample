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

$colname_class3_detail = "-1";
if (isset($_GET['class3_id'])) {
  $colname_class3_detail = $_GET['class3_id'];
}
mysql_select_db($database_connection, $connection);
$query_class3_detail = sprintf("SELECT class3_id, class3_name, class3_price, class3_point, photo_thum FROM class3 WHERE class3_id = %s AND ready = 1 AND ontime <= '$nowtime' AND offtime > '$nowtime'", GetSQLValueString($colname_class3_detail, "int"));
$class3_detail = mysql_query($query_class3_detail, $connection) or die(mysql_error());
$row_class3_detail = mysql_fetch_assoc($class3_detail);
$totalRows_class3_detail = mysql_num_rows($class3_detail);

$colname_qa_standard = "-1";
if (isset($_GET['class3_id'])) {
  $colname_qa_standard = $_GET['class3_id'];
}
mysql_select_db($database_connection, $connection);
$query_qa_standard = sprintf("SELECT qa_id, qa_question, photo, photo_thum FROM qa WHERE class3_id = %s AND qa_typeid = 8 AND ready = 1 AND ontime <= '$nowtime' AND offtime > '$nowtime' ORDER BY sort ASC", GetSQLValueString($colname_qa_standard, "int"));
$qa_standard = mysql_query($query_qa_standard, $connection) or die(mysql_error());
$row_qa_standard = mysql_fetch_assoc($qa_standard);
$totalRows_qa_standard = mysql_num_rows($qa_standard);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row_seo_detail['seo_title']; ?>-</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-" />
<?php require_once("seo.php")?>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body>
<form action="cart/addtocart.php" method="post" id="form1" name="form1">
  <input name="type" type="hidden" id="type" value="add" />
  <input name="class3_id" type="hidden" id="class3_id" value="<?php echo $row_class3_detail['class3_id']; ?>" />
  <input name="photo_thum" type="hidden" id="photo_thum" value="<?php echo $row_class3_detail['photo_thum']; ?>" />
  <select name="qa_standard" id="qa_standard">
    <?php
do {  
?>
    <option value="<?php echo $row_qa_standard['qa_id']?>,<?php echo $row_qa_standard['qa_question']?>,<?php echo $row_qa_standard['photo_thum']; ?>"><?php echo $row_qa_standard['qa_question']?></option>
    <?php
} while ($row_qa_standard = mysql_fetch_assoc($qa_standard));
  $rows = mysql_num_rows($qa_standard);
  if($rows > 0) {
      mysql_data_seek($qa_standard, 0);
	  $row_qa_standard = mysql_fetch_assoc($qa_standard);
  }
?>
  </select>
  <input name="class3_name" type="hidden" id="class3_name" value="<?php echo $row_class3_detail['class3_name']; ?>" />
  <input name="class3_price" type="hidden" id="class3_price" value="<?php echo $row_class3_detail['class3_price']; ?>" />
  <input name="class3_point" type="hidden" id="class3_point" value="<?php echo $row_class3_detail['class3_point']; ?>" />
  <input name="class3_count" type="text" id="class3_count" value="1" />
  <input type="submit" name="button" id="button" value="送出" />
</form>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script language="javascript" src="../javascript.js" type="text/javascript"></script>	
</body>
</html>
<?php
mysql_free_result($class3_detail);

mysql_free_result($qa_standard);
?>