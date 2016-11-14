<?php
//加入購物車Class的宣告
require_once('cart/EDcart.php');
session_start();
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
?>
<?php
//購物車為空時重新導向指定頁
if ($cart->itemcount == 0){header("Location:index.php");}
?>
<?php
//設定購物車的初始運費
$cart->deliverfee = 0;
?>
<?php require_once('Connections/connection.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-tw" />
<title><?php echo $row_seo_detail['seo_title']; ?>-當前購物列表</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-當前購物列表" />
<?php require_once("seo.php")?>
<?php require_once("css.php")?>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body>
<?php require_once("header.php")?>
  <tr>
    <td height="100%">
      <table width="990" height="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <?php require_once("left.php")?>
          <td valign="top">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td class="brown"><a href="index.php" class="gray2">HOME</a> &gt; 詢價清單</td>
              </tr>
              <tr>
                <td width="615" valign="top"><form id="form1" name="form1" method="post" action="cart/addtocart.php">
            <div id="right">
              <table border="0" cellpadding="0" cellspacing="0" class="divpink4table">
                <tr>
                 <th>刪除</th>
                 <th>商品圖片</th>
                 <th>規格</th>
                 <th>商品名稱</th>
                 <th>單價</th>
                 <th>單紅利</th>
                 <th>數量</th>
                 <th>價格</th>                 
               </tr>
               <?php
if($cart->itemcount > 0) {
	foreach($cart->get_contents() as $item) {
?>
<tr>
                 <td align="center"><a onClick="tmt_confirm('確定刪除嗎');return document.MM_returnValue" href="cart/addtocart.php?type=remove&class3_id=<?php echo $item['id'];?>"><img src="image/del.jpg" alt="刪除" border="0" title="刪除" /></a></td>
                 <td class="tdpic" align="center"><img src="upload/<?php echo $item['pic'];?>" title="產品圖" alt="產品圖" /></td>
                 <td align="center"><img src="upload/<?php echo $item['standardpic'];?>" title="產品圖" alt="產品圖" /><br />                   <?php echo $item['standard'];?></td>
                 <td align="center"><input name="itemid[]" type="hidden" id="itemid[]" value="<?php echo $item['id'];?>">
              <?php echo $item['info'];?></td>
                 <td align="center">$<?php echo $item['price'];?></td>
                 <td align="center"><?php echo $item['point'];?></td>
                 <td align="center"><input name="qty[]" type="text" id="qty[]" value="<?php echo $item['qty'];?>" /></td>
                 <td align="center">$<?php echo $item['subtotal'];?><br />
(紅利點數<?php echo $item['subtotalpoint'];?>)<br /></td>
               </tr>
               <?php
	}
}
?><tr>
                 <th colspan="8" align="right">小計</th>
                 <td align="right">$<?php echo $cart->total;?></td>
               </tr>
               <tr>
                 <th colspan="8" align="right">本次新增點數</th>
                 <td align="right"><?php echo $cart->grandtotalpoint;?>pt</td>
               </tr>

           </table>
             <input name="type" type="hidden" id="type" value="update">
             <input name="itemcount" type="hidden" id="itemcount" value="<?php echo $cart->itemcount;?>">
             <div align="right" style="height: 30px; margin: 30px 0;"><a onclick="javascript:{document.form1.submit();}" class="buttonb" onmouseover="document.form1.type.value='next'">下一步</a>
               <a onclick="javascript:{document.form1.submit();}" class="buttonb" onmouseover="document.form1.type.value='empty'">清空購物車</a>
               <a onclick="javascript:{document.form1.submit();}" class="buttonb" onmouseover="document.form1.type.value='update'">點我進行試算</a>
               
</div>
                          
          </div>
          </form>
        
        </td>
              </tr>
              
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <?php require_once("footer.php")?>
</table>
</body>
</html>