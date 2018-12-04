<?php
/*$invNum = 'HW78463674'; //發票號碼
$invTerm = '10710'; //發票民國年月
$UUID = '12345'; //UUID自定義
$randomNumber = '2795'; //隨機碼
$appID = 'EINV5201808264143'; //系統串接*/

/*$invNum = 'HF35497562'; //發票號碼
$invTerm = '10710'; //發票民國年月
$UUID = '12345'; //UUID自定義
$randomNumber = '0710'; //隨機碼
$appID = 'EINV5201808264143'; //系統串接*/

$invNum = 'HQ18334839'; //發票號碼
$invTerm = '10710'; //發票民國年月
//$UUID = '12345'; //UUID自定義
$UUID = '77998'; //UUID自定義
$randomNumber = '7321'; //隨機碼
$appID = 'EINV5201808264143'; //系統串接

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.einvoice.nat.gov.tw/PB2CAPIVAN/invapp/InvApp",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 10,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "version=0.5&type=Barcode&invNum=" . $invNum . "&action=qryInvDetail&generation=V2&invTerm=" . $invTerm . "&UUID=" . $UUID . "&randomNumber=" . $randomNumber . "&appID=" . $appID,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
$response = json_decode($response);
$response = json_decode(json_encode($response), true);
if($response['code'] != '200') {
echo $response['msg'].'<br>';
} else {
		$responsetemp = $response['details'];

		$totalPrice = 0;
		foreach($response['details'] as $key=>$value) {
			$totalPrice = $totalPrice + $value['amount'];
		}

		$response['randNum'] = $randomNumber;
		$response['totalPrice'] = $totalPrice;
		echo '<pre>';
		print_r($response);
		echo '</pre>';

		echo '發票類別︰' . $response['invDate'] . '<br>';
		echo '發票號碼︰' . $response['invNum'] . '<br>';
		echo '隨機碼︰' . $response['randNum'] . '<br>';
		echo '合計︰' . $response['totalPrice'] . '<br>';

		foreach($response['details'] as $key=>$value) {
			$value['amount'] = (int)$value['amount'];
			echo '產品明細︰' . $value['description'] . 'X' . $value['quantity'] . '；' . '產品金額︰' . $value['amount'] . '<br>';
		}
	}
}
?>
<form method="post" action="ticket.php" class="form-inline" role="form">
<input type="hidden" id="invoicetemp" name="invoicetemp" value='<?php echo json_encode($response['details']); ?>'>
<button type="submit" id="submit" class="btn btn-primary text-right">搜尋</button>
<?php

if(isset($_POST['invoicetemp'])) {
echo '<br>';
echo gettype($_POST['invoicetemp']) . '<br>';
echo $_POST['invoicetemp'] . '<br>';
$invoicetemp = json_decode($_POST['invoicetemp']);
$invoicetemp = json_decode(json_encode($invoicetemp), true);
echo gettype($invoicetemp) . '<br>';
	if(count($invoicetemp) > 0) {
		foreach($invoicetemp as $key=>$value) {
			echo '產品明細︰' . $value['description'] . 'X' . $value['quantity'] . '；' . '產品金額︰' . $value['amount'] . '<br>';
		}
	}
}
?>
</form>