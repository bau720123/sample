//確認警告視窗
function tmt_confirm(msg)
{
document.MM_returnValue=(confirm(unescape(msg)));
}
//onclick="tmt_confirm('確定刪除此篇訊息跟它底下所有的回應狀況嗎');return document.MM_returnValue;"

//跳轉頁面
function MM_jumpMenu(targ,selObj,restore)
{
eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}

//全部選取
function selAll()
{
var checkItem = document.form1.selecttype; //變數checkItem為checkbox的集合
 for(var i=0;i<checkItem.length;i++)
 {
 checkItem[i].checked = true;
 } 
 if(i = '0')
 {
 document.form1.selecttype.checked = true;   
 }
//$('input[id=selecttype]').attr("checked",'true');
document.form1.batch_delete.disabled = false;
 if(document.form1.qa_typeid2.value == "5" || document.form1.qa_typeid2.value == "6")
 {
 document.form1.batch_email.disabled = false;
 }
}
//onClick="selAll();"

//全部取消
function unselAll()
{
var checkItem = document.form1.selecttype; //變數checkItem為checkbox的集合
 for(var i=0;i<checkItem.length;i++)
 {
 checkItem[i].checked = false;
 }
 if(i = '0')
 {
 document.form1.selecttype.checked = false;   
 }
//$('input[id=selecttype]').removeAttr("checked");
document.form1.batch_delete.disabled = true;
 if(document.form1.qa_typeid2.value == "5" || document.form1.qa_typeid2.value == "6")
 {
 document.form1.batch_email.disabled = true;
 }
}
//onClick="unselAll();"

//反向選取
function usel()
{
var checkItem = document.form1.selecttype; //變數checkItem為checkbox的集合
 if(checkItem.length == undefined)
 {
 alert('反向選取功能必須頁面上的項目最少為兩個！');
 }
 for(var i=0;i<checkItem.length;i++)
 {
 checkItem[i].checked=!checkItem[i].checked;
 }
 /*$("[id='selecttype']").each(function()
 { 
  if($(this).attr("checked"))
  { 
  $(this).removeAttr("checked"); 
  } 
  else 
  { 
  $(this).attr("checked",'true'); 
  } 
 })*/ 
mycheckbox();
}
//onClick="usel();"

function mycheckbox()
{ 
 if($('input[id=selecttype]:checked').length > 0) 
 {
 document.form1.batch_delete.disabled = false;
  if(document.form1.qa_typeid2.value == "5" || document.form1.qa_typeid2.value == "6")
  {
  document.form1.batch_email.disabled = false;
  }
 }
 else
 {
 document.form1.batch_delete.disabled = true;
  if(document.form1.qa_typeid2.value == "5" || document.form1.qa_typeid2.value == "6")
  {
 document.form1.batch_email.disabled = true;
  }
 }
}

//滑鼠移過去跟移出的顏色變換
function OMOver(OMO){OMO.style.backgroundColor='#FFCC99';}
function OMOut(OMO){OMO.style.backgroundColor='';}
//onmouseover="OMOver(this);"
//onmouseout="OMOut(this);"


//讓頁面上所有的超連結的開啟方式若是同Domain則為本頁開啟，若是不同Domain則變成另開分頁
function parseLink()
{
var tagA = document.getElementsByTagName('a');
re=new RegExp("^(http://"+document.domain+")|(javascript:)","i");
 
 for(var i=0; i<tagA.length; i++)
 {
 if(!tagA[i].href.match(re)){tagA[i].target='_blank'};
 }
}
//onload="parseLink();"

//防止被人frame
if (top.location != self.location)top.location=self.location;

//點選時才載入圖片
function LoadImg(name) 
{
document.getElementById(name).innerHTML = '<img src="' + name + '" border="0">';		
return false;
}
//<a href="image/darkbrown_img1.jpg" name="attachimg" id="image/darkbrown_img1.jpg" target="_blank" onClick="return LoadImg(this.id);">按這裡檢視圖片</a>

//點選時才載入圖片
function LoadAttachImage() 
{
var img = document.getElementsByName('attachimg');
var imgLength = img.length;
 
 for (i=0; i<imgLength; i++)
 {
 img[i].innerHTML = '<img src="' + img[i].id + '" border="0">';
 }

var img = document.getElementsByName('waypointimg');
var imgLength = img.length;
 
 for (i=0; i<imgLength; i++) 
 {
 img[i].innerHTML = '<img src="' + img[i].id + '" border="0">';
 }
return false;
}
//onClick="LoadAttachImage();"

//只准表單送出一次做法
function KW_submitOnce(obj)
{
d=document; if (d.getElementById) {for (i=0;i<obj.length;i++){var fObj=obj.elements[i];
fObj.disabled=(fObj.type.toLowerCase()=="submit"||fObj.type.toLowerCase()=="reset")}}
}
//onsubmit="KW_submitOnce(this)"

//自動執行表單
function MM_callJS(jsStr) 
{
return eval(jsStr)
}
//<body onLoad="MM_callJS('document.formlogin.submit();')">

//指定顯示不同區域
function maxjop(sel)
{
var max_ck  = document.getElementById("Table1");
var max_ck2 = document.getElementById("Table2");
var max_ck3 = document.getElementById("Table3");
var max_ck4 = document.getElementById("Table4");
var max_ck5 = document.getElementById("Table5");

if(sel.value == 'maxjop') { max_ck.style.display = "inline"; } else { max_ck.style.display = "none"; }
if(sel.value == 'maxjop2') { max_ck2.style.display = "inline"; } else { max_ck2.style.display = "none"; }
if(sel.value == 'maxjop3') { max_ck3.style.display = "inline"; } else { max_ck3.style.display = "none"; }
if(sel.value == 'maxjop4') { max_ck4.style.display = "inline"; } else { max_ck4.style.display = "none"; }
if(sel.value == 'maxjop5') { max_ck5.style.display = "inline"; } else { max_ck5.style.display = "none"; }
}
//onclick="maxjop(this);"

//付款人同收件人資料打勾相同語法
function sameaspay(thisform)
{
 if(document.form1.pay_thesame.checked==true)
 {
 thisform.member_name.value = thisform.member_name1.value;
 thisform.member_code.value = thisform.member_code1.value;
 thisform.member_address.value = thisform.member_address1.value;
 thisform.member_phone.value = thisform.member_phone1.value;
 thisform.member_tel.value = thisform.member_tel1.value;
 thisform.member_email.value = thisform.member_email1.value;
 thisform.member_sex.value = thisform.member_sex1.value;
 }
 
 if(document.form1.pay_thesame.checked==false)
 {
 thisform.member_name.value = '';
 thisform.member_code.value = '';
 thisform.member_address.value = '';
 thisform.member_phone.value = '';
 thisform.member_tel.value = '';
 thisform.member_email.value = '';
 thisform.member_sex.value = '';
 }
}
//onClick="sameaspay(this.form);"

//指定SMTP主機相關設定
function smtp(sel)
{
 if(sel.value == 'google')
 {
 document.form1.smtp_tls1.checked = true;
 document.form1.smtp_address.value = 'smtp.gmail.com';
 document.form1.smtp_port.value = '587';
 document.form1.smtp_safe1.checked = true;
 document.form1.smtp_username.value = '';
 document.form1.smtp_password.value = '';
 document.form1.smtp_email.value = 'XXX@gmail.com';
 }
 
 if(sel.value == 'yahoo')
 {
 document.form1.smtp_tls1.checked = true;
 document.form1.smtp_address.value = 'smtp.mail.yahoo.com.tw';
 document.form1.smtp_port.value = '587';
 document.form1.smtp_safe1.checked = true;
 document.form1.smtp_username.value = '';
 document.form1.smtp_password.value = '';
 document.form1.smtp_email.value = 'XXX@yahoo.com.tw';
 }
 
 if(sel.value == 'pchome')
 {
 document.form1.smtp_tls2.checked = true;
 document.form1.smtp_address.value = 'smtp.pchome.com.tw';
 document.form1.smtp_port.value = '25';
 document.form1.smtp_safe1.checked = true;
 document.form1.smtp_username.value = '';
 document.form1.smtp_password.value = '';
 document.form1.smtp_email.value = 'XXX@pchome.com.tw';
 }
 
 if(sel.value == 'other')
 {
 document.form1.smtp_tls1.checked = false;
 document.form1.smtp_tls2.checked = false;
 document.form1.smtp_address.value = '';
 document.form1.smtp_port.value = '';
 document.form1.smtp_safe1.checked = false;
 document.form1.smtp_safe2.checked = false;
 document.form1.smtp_username.value = '';
 document.form1.smtp_password.value = '';
 document.form1.smtp_email.value = '@';
 }
}
//onClick="smtp(this);"

//addthis的語系設定方式
var addthis_config = { ui_language: "zh" } //http://support.addthis.com/customer/portal/articles/381240-languages#codes
var addthis_localize = 
{
share_caption: "添加到收藏夾 / 分享",
email_caption: "發送電子郵件給好友",
email: "電子郵件",
favorites: "我的最愛",
print: "列印",
more: "查看更多"
}

//進度條使用
/*
segments：由多少條線組成，預設值是12
width：每行線的寬度，預設值是4
space：每行線條的內端部之間的空間，預設值是3
length：線的長度，預設值是7
color：線的顏色，支持的格式是RGB和＃RRGGBB，預設值是目標元素的文本顏色
steps：圈中指定的分水的梯度的大小，索引大於這個值的分部，將有相同的不透明度，預設值是段1。
opacity：不透明度，預設值是1
speed：圈圈每秒旋轉的速度，預設值是1.2
align：圈圈的水平對齊方式，可能的值是左，右，或中心（預設值）
valign：圈圈的垂直對齊方式，可能的值是頂部，底部，或中心（預設值）
padding：邊界的設定方式，預設值是4
outside：微調器是否應該被添加到的身體，而不是到目標元素，如果目標不支持嵌套元素，例如的IMG，那麼該對象或輸入元素會非常有用。默認是false的。
*/
/*$('#busy1').activity(
{
segments:12,
width:4,
space:3,
length:7, 
color:'#0b0b0b', 
steps:1,
opacity:0.3,
speed:1.2,
align:'center',
valign:'middle',
padding:4,
outside: false
}
);*/

//AJAX共用資料宣告
var xmlHttp;
function createXHR()
{

 if (window.XMLHttpRequest) 
 {
 xmlHttp = new XMLHttpRequest();
 }
 
  else if (window.ActiveXObject) 
  {
  xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

   if (!xmlHttp) 
   {
   alert('您使用的瀏覽器不支援 XMLHTTP 物件');
   return false;
   }
   
}

function Buildkey1(num1)
{
createXHR();
var requestString="area.php?city_id="+num1;
//window.status='轉頁中稍後';
xmlHttp.open('GET',requestString,true);
//xmlHttp.onreadystatechange=catchGetTime;
 xmlHttp.onreadystatechange = function() 
 {  
 catchGetTime(num1);  
 };
  
xmlHttp.send(null);
}

function Buildkey2(num1)
{
createXHR();
var requestString="area2.php?qa_id="+num1;
//window.status='轉頁中稍後';
xmlHttp.open('GET',requestString,true);
//xmlHttp.onreadystatechange=catchGetTime;
 xmlHttp.onreadystatechange = function() 
 {  
 catchGetTime(num1);  
 };
  
xmlHttp.send(null);
}

function catchGetTime(num1)
{
 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=='complete')
 {
 
  if (xmlHttp.status == 200) 
  {
  var result = xmlHttp.responseText;
  document.getElementById('idbau1').innerHTML=result;
  }
 
 }

}

//判斷使用者瀏覽器版本之方法
function detectBrowser()
{
var isIE = navigator.userAgent.search("MSIE") > -1;
var isIE7 = navigator.userAgent.search("MSIE 7") > -1;
var isFirefox = navigator.userAgent.search("Firefox") > -1;
var isOpera = navigator.userAgent.search("Opera") > -1;
var isSafari = navigator.userAgent.search("Safari") > -1;//Google瀏覽器是用這核心
    
if (isIE7) { browser = 'IE7'; }
if (isIE) {  browser = 'IE';  }
if (isFirefox) { browser = 'Firefox'; }
if (isOpera) { browser = 'Opera'; }
if (isSafari) { browser = 'Safari/Chrome'; }
return browser;
}
//onload="detectBrowser();"
//var browser = detectBrowser();
//alert(browser);

//鎖滑鼠右鍵
$(function()
{
//$(document).get(0).oncontextmenu = function() { return false; };
});
//放到</head>之前即可

//偵測偵測出有幾個段落字
function keywords()
{
var str = "How,are,you,doing,today?"
var str_length = str.split(",").length;
return str_length;
}
//var keywords = keywords();
//alert(keywords);

//偵測GET參數
function getUrlParam(name)
{
var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
var r = window.location.search.substr(1).match(reg);  
if(r != null)
return unescape(r[2]);
return null; 
}
//alert(getUrlParam('要偵測的欄位'));