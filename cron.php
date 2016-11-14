<?php
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://www.littlebau.com/index.php");  
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把這行註解掉的話，就會直接輸出  
$result=curl_exec($ch);  

//取得php首頁的內容  
if (false !== ($contents = $result)) 
{  
//如果內容有讀取完成至</html>  

 if (strpos($contents,'</html>')!==false) 
 {  
 //建立html首頁  
 $html = fopen('index.html','w');  
 fwrite($html,$contents);  
 fclose($html);  
 }
   
}

curl_close($ch);
?>
<?php
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://www.littlebau.com/profile.php");  
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把這行註解掉的話，就會直接輸出  
$result=curl_exec($ch);  

//取得php首頁的內容  
if (false !== ($contents = $result)) 
{  
//如果內容有讀取完成至</html>  

 if (strpos($contents,'</html>')!==false) 
 {  
 //建立html首頁  
 $html = fopen('profile.html','w');  
 fwrite($html,$contents);  
 fclose($html);  
 }
   
}

curl_close($ch);
?>
<?php
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://www.littlebau.com/memorandum.php");  
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把這行註解掉的話，就會直接輸出  
$result=curl_exec($ch);  

//取得php首頁的內容  
if (false !== ($contents = $result)) 
{  
//如果內容有讀取完成至</html>  

 if (strpos($contents,'</html>')!==false) 
 {  
 //建立html首頁  
 $html = fopen('memorandum.html','w');  
 fwrite($html,$contents);  
 fclose($html);  
 }
   
}

curl_close($ch);
?>
<?php
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://www.littlebau.com/faq.php");  
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把這行註解掉的話，就會直接輸出  
$result=curl_exec($ch);  

//取得php首頁的內容  
if (false !== ($contents = $result)) 
{  
//如果內容有讀取完成至</html>  

 if (strpos($contents,'</html>')!==false) 
 {  
 //建立html首頁  
 $html = fopen('faq.html','w');  
 fwrite($html,$contents);  
 fclose($html);  
 }
   
}

curl_close($ch);
?>
<?php
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://www.littlebau.com/exhibition.php?class1_id=1&class2_id=1#x1");  
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把這行註解掉的話，就會直接輸出  
$result=curl_exec($ch);  

//取得php首頁的內容  
if (false !== ($contents = $result)) 
{  
//如果內容有讀取完成至</html>  

 if (strpos($contents,'</html>')!==false) 
 {  
 //建立html首頁  
 $html = fopen('bau1.html','w');  
 fwrite($html,$contents);  
 fclose($html);  
 }
   
}

curl_close($ch);
?>
<?php
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://www.littlebau.com/exhibition.php?class1_id=1&class2_id=2#x1");  
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把這行註解掉的話，就會直接輸出  
$result=curl_exec($ch);  

//取得php首頁的內容  
if (false !== ($contents = $result)) 
{  
//如果內容有讀取完成至</html>  

 if (strpos($contents,'</html>')!==false) 
 {  
 //建立html首頁  
 $html = fopen('bau2.html','w');  
 fwrite($html,$contents);  
 fclose($html);  
 }
   
}

curl_close($ch);
?>
<?php
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://www.littlebau.com/exhibition.php?class1_id=1&class2_id=3#x1");  
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把這行註解掉的話，就會直接輸出  
$result=curl_exec($ch);  

//取得php首頁的內容  
if (false !== ($contents = $result)) 
{  
//如果內容有讀取完成至</html>  

 if (strpos($contents,'</html>')!==false) 
 {  
 //建立html首頁  
 $html = fopen('yihsu.html','w');  
 fwrite($html,$contents);  
 fclose($html);  
 }
   
}

curl_close($ch);
?>
<?php
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://www.littlebau.com/exhibition.php?class1_id=1&class2_id=4#x1");  
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把這行註解掉的話，就會直接輸出  
$result=curl_exec($ch);  

//取得php首頁的內容  
if (false !== ($contents = $result)) 
{  
//如果內容有讀取完成至</html>  

 if (strpos($contents,'</html>')!==false) 
 {  
 //建立html首頁  
 $html = fopen('yaghin.html','w');  
 fwrite($html,$contents);  
 fclose($html);  
 }
   
}

curl_close($ch);
?>
<?php
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://www.littlebau.com/case.php");  
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把這行註解掉的話，就會直接輸出  
$result=curl_exec($ch);  

//取得php首頁的內容  
if (false !== ($contents = $result)) 
{  
//如果內容有讀取完成至</html>  

 if (strpos($contents,'</html>')!==false) 
 {  
 //建立html首頁  
 $html = fopen('case.html','w');  
 fwrite($html,$contents);  
 fclose($html);  
 }
   
}

curl_close($ch);
?>
<script>javascript:window.close();</script>