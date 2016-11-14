<?php
session_start();
header("Content-type: image/PNG");
 
//在session中自訂使用captcha這個變數來儲存產生的字串
$_SESSION['captcha']="";
 
//產生一個300*50的圖檔
$im = imagecreate(300,50) or die("Cant's initialize new GD image stream!");
 
//定義使用的顏色,紅色為字體顏色,白色為底色,灰色為黑點雜訊
//若要更動，請自行更改後面三個整數，依序為R、G、B範圍皆在0~255間
$red = imagecolorallocate($im, 255, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);
$gray = imagecolorallocate($im,  100, 100, 100);

//將圖片底色填滿白色
imagefill($im, 0, 0, $white);

//定義候選的字母，我剔除掉一些會混淆的，如大寫I與L
$ychar="A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
$list=explode(",",$ychar);
$cnt = count($list)-1;

//亂數挑選四個字母，字母可重複
for($i=0;$i<4;$i++){
$randnum=rand(0,$cnt);
$authnum.=$list[$randnum]." ";
}

//將最後挑選出來的結果存入session
$_SESSION['captcha']=str_replace(" ","",$authnum);

//將挑選出來的字串印在圖片上,這邊你必須自備truetype的英文字型檔
putenv('GDFONTPATH=' . realpath('.'));
imagettftext($im, 25, 3, 100, 35, $red, "arialuni.ttf", $authnum);

//加入100個黑點雜訊
for($i=0;$i<100;$i++)
imagesetpixel($im, rand()%300 , rand()%50 , $gray);

//最後將圖片產生並且印出來
ImagePNG($im);
ImageDestroy($im);
?>