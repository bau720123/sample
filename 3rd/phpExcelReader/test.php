<?php
error_reporting(0);
require_once 'Excel/reader.php';
$xlsData = new Spreadsheet_Excel_Reader();
$xlsData->setOutputEncoding('UTF-8');
$xlsData->read('test.xls');
$m_arrData = $xlsData->sheets[0]['cells'];
 
unset($m_arrData[1]); //刪除第一列表頭欄
$m_arrData = array_values($m_arrData); //重新排序
echo '共有' . count($m_arrData) . '筆資料';
echo '<pre>';
print_r($m_arrData);
echo '</pre>';

foreach($m_arrData as $_arrData[$key])
{
$_arrData[$key][8] = str_replace("　","",$_arrData[$key][8]);
$_arrData[$key][9] = str_replace("　","",$_arrData[$key][9]);
$_arrData[$key][10] = str_replace("　","",$_arrData[$key][10]);
$_arrData[$key][11] = str_replace("　","",$_arrData[$key][11]);
$_arrData[$key][23] = str_replace("　","",$_arrData[$key][23]);
$_arrData[$key][25] = str_replace("　","",$_arrData[$key][25]);

echo $_arrData[$key][8];
}
?>
