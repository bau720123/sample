<?php
session_start();

$num1=rand(0,9);
$num2=rand(0,9);
$num3=rand(0,9);
$op1=rand(0,2);
$op2=rand(0,2);

if($op1=="0") $op3="+";
if($op1=="1") $op3="-";
if($op1=="2") $op3="*";
if($op2=="0") $op4="+";
if($op2=="1") $op4="-";
if($op2=="2") $op4="*";

if($op3=="*")
{
 if($op4=="*")
    $mcap="(".$num1.$op3.$num2.")".$op4.$num3;  
  else if($op4=="+" || $op4=="-")
     $mcap="(".$num1.$op3.$num2.")".$op4.$num3;
}
else if($op3=="+" || $op3=="-")
{
  if($op4=="+" || $op4=="-")
      $mcap="(".$num1.$op3.$num2.")".$op4.$num3;
  else if($op4=="*")
      $mcap=$num1.$op3."(".$num2.$op4.$num3.")";
}

if($op3=="+" && $op4=="+")
  $res=($num1+$num2)+$num3;
else if($op3=="+" && $op4=="-")
  $res=($num1+$num2)-$num3;
else if($op3=="+" && $op4=="*")
 $res=$num1+($num2*$num3);

else if($op3=="-" && $op4=="+")
  $res=($num1-$num2)+$num3;
else if($op3=="-" && $op4=="-")
  $res=($num1-$num2)-$num3;
else if($op3=="-" && $op4=="*")
 $res=$num1-($num2*$num3);

else if($op3=="*" && $op4=="+")
  $res=($num1*$num2)+$num3;
else if($op3=="*" && $op4=="-")
  $res=($num1*$num2)-$num3;
else if($op3=="*" && $op4=="*")
 $res=($num1*$num2)*$num3;


    $_SESSION['captcha'] = $res;
    $secure = $_SESSION['captcha'];
    $a=rand(150,255);
   
    $width = 100;
    $height = 40;     
    $image = ImageCreate($width, $height);  
    $linecol = ImageColorAllocate($image, rand(155,200), rand(155,200), rand(155,200));
    $textcol = ImageColorAllocate($image, rand(200,255),rand(200,255),rand(200,255));
    $bgcol = ImageColorAllocate($image, rand(0,155),rand(0,155), rand(0,155));
    
    ImageFill($image, 0, 0, $bgcol); 
    //Add randomly generated string in white to the image
    
    ImageString($image, 10, 20, 10, $mcap, $textcol); 
    ImageRectangle($image,0,0,$width-1,$height-1,$bgcol); 
    imageline($image, 0, $height-30, $width, $height-30, $linecol);
    imageline($image, 0, $height-20, $width, $height-20, $linecol); 
    imageline($image, 0, $height-10, $width, $height-10, $linecol); 
 
    imagedashedline($image, $width/2, 0, $width/2, $height, $linecol); 
    imagedashedline($image, $width-25, 0, $width-25, $height, $linecol);
    imagedashedline($image, $width-75, 0, $width-75, $height, $linecol);

    header("Content-Type: image/jpeg"); 
    ImageJpeg($image);
    ImageDestroy($image);
?>
