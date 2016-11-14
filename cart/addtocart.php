<?php
//加入購物車Class的宣告
require_once('EDcart.php');
session_start();
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
?>
<?
//加入購物車動作
if($_POST['type'] == 'add' && substr_count($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"].'/'."product_detail.php") == 0)
{
$class3_name = stripslashes(str_replace('"',"'",$_POST['class3_name']));
$qa_standard = explode(",", $_POST['qa_standard']);
$qa_size = explode(",", $_POST['qa_size']);
$cart->add_item($_POST['class3_id'].$qa_standard[0],$_POST['photo_thum'],$qa_standard[2],$qa_standard[1],$class3_name,$_POST['class3_price'],$_POST['class3_point'],$_POST['class3_count']);
header("Location:../cart.php");
}

//刪除購物車動作
if($_GET['type'] == 'remove' && substr_count($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"].'/'."cart.php") == 0)
{
$cart->del_item($_GET['class3_id']);
header("Location:../cart.php");
}

//清空購物車動作
if($_POST['type'] == 'empty' && substr_count($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"].'/'."cart.php") == 0)
{
$cart->empty_cart();
header("Location:../cart.php");
}

//更新購物車動作
if($_POST['type'] == 'update' && substr_count($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"].'/'."cart.php") == 0)
{
 for($startNO=0;$startNO < $_POST['itemcount'];$startNO++)
 {
 $cart->edit_item($_POST['itemid'][$startNO],$_POST['qty'][$startNO]);
 }
 header("Location:../cart.php");
}

//下一步購物車動作
if($_POST['type'] == 'next' && substr_count($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"].'/'."cart.php") == 0)
{
 for($startNO=0;$startNO < $_POST['itemcount'];$startNO++)
 {
 $cart->edit_item($_POST['itemid'][$startNO],$_POST['qty'][$startNO]);
 }
 header("Location:../cart_pt.php");
 break;
}

//結束購物車動作
if($_GET['type'] == 'finish' && substr_count($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"].'/'."cart_confirm.php") == 0)
{
$cart->empty_cart();
header("Location:../cart_ok.php?orders_paytype=$_GET[orders_paytype]");
}
?>