<?php
/*
由 webforce cart v.1.2 修改 (http://webforce.co.nz/cart)
---------------------------------------------------------
織夢平台2005 - 分享是成長的開始
http://www.e-dreamer.idv.tw
*/
class edCart {
	var $total = 0;
	var $deliverfee = 0; //修改，運費
	var $grandtotal = 0; //加上了運費後的總合費用
	var $grandpoint = 0;
	var $itemcount = 0;
	var $items = array();
	var $itempic = array();
	var $itemstandardpic = array();
	var $itemstandard = array();
	var $iteminfo = array();
	var $itemprices = array();
	var $itempoint = array();
	var $itemqtys = array();

	function cart() {} // 宣告函數

	function get_contents(){ // 取得購物車內容
		$items = array();
		foreach($this->items as $tmp_item){
		    $item = FALSE;
			$item['id'] = $tmp_item;
			$item['pic'] = $this->itempic[$tmp_item];
			$item['standardpic'] = $this->itemstandardpic[$tmp_item];
			$item['standard'] = $this->itemstandard[$tmp_item];
			$item['info'] = $this->iteminfo[$tmp_item];
			$item['price'] = $this->itemprices[$tmp_item];
			$item['point'] = $this->itempoint[$tmp_item];
			$item['qty'] = $this->itemqtys[$tmp_item];
			$item['subtotal'] = $item['qty'] * $item['price'];
			$item['subtotalpoint'] = $item['qty'] * $item['point'];
			$items[] = $item;
		}
		return $items;
	} 


	function add_item($itemid,$pic = FALSE,$standardpic = FALSE,$standard = FALSE,$info = FALSE,$price = FALSE,$point = FALSE,$qty){ // 新增至購物車
		//if(!$price){
			//$price = ed_get_price($itemid,$qty);
		//}
		//if(!$info){
			//$info = ed_get_info($itemid);
		//}
		if(isset($this->itemqtys[$itemid]) && $this->itemqtys[$itemid] > 0){ 
			$this->itemqtys[$itemid] = $qty + $this->itemqtys[$itemid];
			$this->_update_total();
		} else {
			$this->items[]=$itemid;
			$this->itempic[$itemid] = $pic;
			$this->itemstandardpic[$itemid] = $standardpic;
			$this->itemstandard[$itemid] = $standard;
			$this->iteminfo[$itemid] = $info;
			$this->itemprices[$itemid] = $price;
			$this->itempoint[$itemid] = $point;
			$this->itemqtys[$itemid] = $qty;
		}
		$this->_update_total();
	} 


	function edit_item($itemid,$qty){ // 更新購物車數量
		if($qty < 1) {
			$this->del_item($itemid);
		} else {
			$this->itemqtys[$itemid] = $qty;
		}
		$this->_update_total();
	} 


	function del_item($itemid){ // 移除購物車
		$ti = array();
		$this->itemqtys[$itemid] = 0;
		foreach($this->items as $item){
			if($item != $itemid){
				$ti[] = $item;
			}
		}
		$this->items = $ti;
		$this->_update_total();
	} 


	function empty_cart(){ // 清空購物車
		$this->items = array();
		$this->itemstandardpic = array();
		$this->itemstandard = array();
		$this->itemprices = array();
		$this->itempoint = array();
		$this->itemqtys = array();
		$this->total = 0;
		$this->itemcount = 0;
		$this->itemdescs = array();
	} 


	function _update_total(){ // 更新購物車的內容
		$this->itemcount = 0;
		$this->total = 0;
		$this->totalpoint = 0;
		if(sizeof($this->items > 0)){
			foreach($this->items as $item) {
				$this->total = $this->total + ($this->itemprices[$item] * $this->itemqtys[$item]);
				$this->totalpoint = $this->totalpoint + ($this->itempoint[$item] * $this->itemqtys[$item]);
				$this->itemcount++;
			}
		}
		$this->grandtotal = $this->total + $this->deliverfee; //計算最後總計
		$this->grandtotalpoint = $this->totalpoint; //計算最後總計
	} 
}
?>