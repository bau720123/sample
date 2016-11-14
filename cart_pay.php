<?php require_once('Connections/connection.php'); ?>
<?php //require_once('priority.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row_seo_detail['seo_title']; ?>-選擇付款方式</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-選擇付款方式" />
<?php require_once("seo.php")?>
<?php require_once("css.php")?>
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/javascript.js"></script>	
</head>

<body>
<div id="mainBg">
  <div id="main">
    <?php require_once('header.php'); ?>    
    <div id="contenttop"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="851">
      <tr>      
        <td width="236" valign="top">        
          <div id="leftOut"><div id="leftC">
            <img src="images/title_cart.jpg" title="神戶TRANSPARENT 我的購物車" alt="神戶TRANSPARENT 我的購物車" /><br />
            <img src="images/decpic7.jpg" vspace="8" />
            <div class="button01">點數折抵</div>
            <div class="button01">選擇收件地址</div>
            <div class="button01b">指定付款方式</div>
            <div class="button01">確認訂購資訊</div>
            <div class="button01">訂購完成</div>
          </div></div>
        </td>
        <td width="615" valign="top"><form id="form1" name="form1" method="post" action="cart_confirm.php">
            <div id="right" style="line-height: 2em;">
            <img src="images/banner_g.jpg" style="margin-bottom: 10px;" />
            <br />
            <img src="images/icon_2.jpg" align="absmiddle" hspace="8" /><span class="font13"><span class="color1"><strong>選擇付款方式</strong></span></span>
            <table border="0" cellpadding="0" cellspacing="0" width="580" class="divpink4table">
              <tr>
                <th width="60">選擇</th>
                <th width="100">付款方式</th>
                <th width="420">備註</th>
              </tr>
              <tr>
                <td align="center"><input name="orders_paytype" type="radio" id="" value="1" /></td>
                <td align="center">線上刷卡</td>
                <td>(可使用VISA、Master、JCB，選擇郵寄或宅配)</td>
              </tr>
              <tr>
                <td align="center"><input name="orders_paytype" type="radio" id="" value="2" /></td>
                <td align="center">貨到付款</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><input name="orders_paytype" type="radio" id="" value="3" checked="checked" /></td>
                <td align="center">ATM轉帳</td>
                <td></td>
              </tr>
              <tr>
                <td align="center"><input name="orders_paytype" type="radio" id="" value="4" /></td>
                <td align="center">臨櫃匯款</td>
                <td><input name="member_name" type="hidden" id="member_name" value="<?php echo $_POST['member_name']; ?>" />
                  <input type="hidden" name="member_code" id="member_code" value="<?php echo $_POST['member_code']; ?>" />
                  <input type="hidden" name="member_address" id="member_address" value="<?php echo $_POST['member_address']; ?>" />
                  <input type="hidden" name="member_phone" id="member_phone" value="<?php echo $_POST['member_phone']; ?>" />
                  <input type="hidden" name="member_tel" id="member_tel" value="<?php echo $_POST['member_tel']; ?>" />
                  <input type="hidden" name="member_email" id="member_email" value="<?php echo $_POST['member_email']; ?>" />
                  <input type="hidden" name="member_sex" id="member_sex" value="<?php echo $_POST['member_sex']; ?>" />
                  <input type="hidden" name="usepointcoda" id="usepointcoda" value="<?php echo $_POST['usepointcoda']; ?>" />
                  <input type="hidden" name="ticket_type" id="ticket_type" value="<?php echo $_POST['ticket_type']; ?>" />
                  <input type="hidden" name="ticket_no" id="ticket_no" value="<?php echo $_POST['ticket_no']; ?>" />
                  <input type="hidden" name="ticket_title" id="ticket_title" value="<?php echo $_POST['ticket_title']; ?>" /></td>
              </tr>
            </table>
            <div align="right" style="height: 30px; margin: 15px 20px 20px 0;">                                             
               <a onclick="javascript:{document.form1.submit();}" class="buttonb">下一步</a>
               
               <a href="cart_pt.php" class="buttonb">修改紅利點數</a>
               <a href="cart.php" class="buttonb">修改購物車內容</a>
               <a href="product.php?class2_id=2" class="buttonb">繼續購物</a>
             </div>
          </div>
          </form>
        </td>        
      </tr>
    </table>
  </div>
  <?php require_once('footer.php'); ?>
</div>
</body>
</html>