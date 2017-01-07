<?php
require "watermark.php";
$watermark = new Watermark();
$watermark->apply('from.jpg', 'to.jpg', 'watermark.png', 3); //apply($imgSource 圖檔來源, $imgTarget 新圖檔名稱,  $imgWatermark 浮水印檔案來源, $position = 0 浮水印的位置)
/*
0︰Centered 中心
1︰Top Left 上左
2︰Top Right 上右
3︰Footer Right 下右
4︰Footer left 下左
5︰Top Centered 上中
6︰Center Right 中右
7︰Footer Centered 下中
8︰Center Left 中左
*/
?>

Original image:
<br />
<img src="from.jpg" />

<br />
Watermark:
<br />
<img src="watermark.png" />

<br />
Watermark applied:
<br />
<img src="to.jpg" />