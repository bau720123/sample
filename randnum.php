<!--
程式名稱:亂數抽獎
程式設計:梅問題&男丁格爾
作者網址:http://www.minwt.com
 -->

<form id="form1" name="form1" method="post" action="">
總數：
<input type="text" name="total" id="total" />
<br />
筆數：
<input type="text" name="count" id="count" />
<br /> 
排除：
<input name="except" type="text" id="except"  />
<br />
<input type="submit" name="button" id="button" value="送出" />
</form>
<hr>
<?php
if(isset($_POST['total']) && isset($_POST['count'])){
	$POST_total = $_POST['total'];
	$POST_count = $_POST['count'];
	$POST_except = $_POST['except'];
	
	$Rand = Array(); //定義陣列	
	$count = $POST_count ; //共產生幾筆
	
	if(isset($_POST['except'])){
		/*文字轉陣列－排除名單*/
		$Rand = explode(",",$POST_except);	
	}

	while($count > 0){
		$randval = mt_rand(1,$POST_total); //取亂數
		
		if (!in_array($randval, $Rand)) {
			$count--;
			$Rand[] = $randval; //若無重復則 將亂數塞入陣列
			echo $randval."<br>";
		}	
	}	
}
?>

