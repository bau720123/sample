<?php require_once('Connections/connection.php'); ?>
<?php //require_once('priority.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $row_seo_detail['seo_title']; ?>-訂單完成</title>
<meta property="og:title" content="<?php echo $row_seo_detail['seo_title']; ?>-訂單完成" />
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
            <div class="button01">指定付款方式</div>
            <div class="button01">確認訂購資訊</div>
            <div class="button01b">訂購完成</div>
          </div></div>
        </td>
        <td width="615" valign="top">
          <div id="right" style="line-height: 2em;">
            <img src="images/banner_g.jpg" style="margin-bottom: 10px;" />
            <br />
            <img src="images/icon_2.jpg" align="absmiddle" hspace="9" /><span class="font13"><span class="color1"><strong>感謝您選購神戶 Transp'arent 的產品，您的付款方式為<?php if($_GET['orders_paytype'] == 1 ) { ?>線上刷卡<? } ?><?php if($_GET['orders_paytype'] == 2 ) { ?>貨到付款<? } ?><?php if($_GET['orders_paytype'] == 3 ) { ?>ATM轉帳<? } ?><?php if($_GET['orders_paytype'] == 4 ) { ?>臨櫃匯款<? } ?></strong></span></span>
            <div class="divpink2">
              <?php if($_GET['orders_paytype'] == 1 ) { ?>
              <a href="mypage.php">立刻線上刷卡<br />
              </a><img src="images/gwapy_01.gif" /><img src="images/gwapy_02.gif" /><img src="images/ecpay_01.gif" /><img src="images/b2c.gif" />
              <? } ?>
              <?php if($_GET['orders_paytype'] == 2 ) { ?>我們將於訂購完成3天內，寄出您的產品，您只需在收到產品時將款項交付給貨運人員即可。<? } ?>
              <?php if($_GET['orders_paytype'] == 3 ) { ?>
              別忘了下一步：<br />
              請於訂購完成3天內，  選擇任何一部銀行或郵局的「ATM自動提款機」轉帳，輸入下方的轉帳帳號，就能輕鬆完成付款！
              <table width="540" border="1" bordercolor="#000000" cellpadding="9" cellspacing="0">
                <col width="170" />
                <col width="447" />
                <tr valign="top">
                  <td width="170"><p align="center">付款方式：</p></td>
                  <td width="447"><p>ATM轉帳</p></td>
                </tr>
                <tr>
                  <td width="170"><p align="center">轉帳銀行：</p></td>
                  <td width="447" valign="top"><p>812 (台新國際商業銀行  			)</p></td>
                </tr>
                <tr>
                  <td width="170"><p align="center">轉帳帳號：</p></td>
                  <td width="447" valign="top"><p>2011-01-0001991-1</p></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td valign="top">神戶Transp'arent保留接受訂單與否的權利，若因交易條件有誤、商品無庫存或有其他本公司無法接受訂單之情形，本公司將以email通知您訂單不成立/取消訂單。</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td valign="top">請於繳款期限內完成付款，逾期將自動取消訂單，繳款期限不受例假日影響，因此只要於繳款期限內轉帳即可。</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td valign="top">轉帳完成後請記得撥打客服專線0800-557-888  				告知客服人員或email至<U><a href="mailto:transparent.service@gmail.com">transparent.service@gmail.com</a></U> 以下資料:<br />
                    1、轉帳帳號後5碼<br />
                    2、轉帳日期<br />
                    3、姓名<br />
                    4、訂單編號</td>
                </tr>
              </table>
              <? } ?>
              <?php if($_GET['orders_paytype'] == 4 ) { ?>
              別忘了下一步：<br />
              請於訂購完成3天內至臨櫃匯款，填寫將以下資料填入匯款單中，就能輕鬆完成付款！
              <table width="540" border="1" bordercolor="#000000" cellpadding="9" cellspacing="0">
                <col width="170" />
                <col width="447" />
                <tr valign="top">
                  <td width="170"><p align="center">付款方式：</p></td>
                  <td width="447"><p>臨櫃匯款</p></td>
                </tr>
                <tr>
                  <td width="170"><p align="center">轉帳銀行：</p></td>
                  <td width="447" valign="top"><p>812 (台新國際商業銀行 0115南京東路分行) </p></td>
                </tr>
                <tr>
                  <td width="170"><p align="center">轉帳帳號：</p></td>
                  <td width="447" valign="top"><p>2011-01-0001991-1</p></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td valign="top">神戶Transp'arent保留接受訂單與否的權利，若因交易條件有誤、商品無庫存或有其他本公司無法接受訂單之情形，本公司將以email通知您訂單不成立/取消訂單。</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td valign="top">請於繳款期限內完成付款，逾期將自動取消訂單</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td valign="top">轉帳完成後請記得撥打客服專線0800-557-888  				告知客服人員或email至<U><a href="mailto:transparent.service@gmail.com">transparent.service@gmail.com</a></U> 以下資料:<br />
                    1、匯款人<br />
                    2、匯款日期<br />
                    3、訂購人姓名<br />
                    4、訂單編號</td>
                </tr>
              </table>
                <? } ?>
            </div>
          </div>
        </td>        
      </tr>
    </table>
  </div>
  <?php require_once('footer.php'); ?>
</div>
</body>
</html>