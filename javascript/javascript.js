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

//匯出成圖檔開始
/*
<script src="javascript/html2canvas.min.js" type="text/javascript"></script>
<a id="auto" style="display:none;"></a><a style="cursor: pointer;" id="download_html2canvas">點我下載成圖片</a>
*/
$("#download_html2canvas").click(function()
{
 html2canvas($(".schedule_list_wrap")[0], 
 {
  onrendered: function(canvas)
  {
  window.open(canvas.toDataURL("image/png")); //開啟一新視窗顯示html2canvas的圖  
  $("#auto").attr('href', canvas.toDataURL("image/png"));
  $("#auto").attr('download', 'download.png');
  var lnk = document.getElementById("auto");
  lnk.click();
  }
 });
});
//匯出成圖檔結束

//匯出成PDF開始
/*
<script src="javascript/html2canvas.min.js" type="text/javascript"></script>
<script src="javascript/jspdf.min.js" type="text/javascript"></script>
<a style="cursor: pointer;" id="download_pdf">點我下載成PDF</a>
*/
$("#download_pdf").click(function()
{
 html2canvas($(".schedule_list_wrap")[0], 
 {
  onrendered: function(canvas)
  {
  var imgData = canvas.toDataURL("image/png");
  var doc = new jsPDF();
  doc.addImage(imgData, 'png', 60, 0, 0, 295, undefined, 'fast');
  doc.save('download.pdf');
  }
 });
});
//匯出成PDF結束

//匯出成EXCEL開始
/*
<script src="javascript/jquery.table2excel.min.js" type="text/javascript"></script>
<a style="cursor: pointer;" id="download_excel">點我下載成Excel</a>
*/
$("#download_excel").click(function()
{
 $(".timetable").table2excel(
 {
 exclude: ".noExl",
 name: "Excel Document Name",
 filename: "download",
 fileext: ".xls",
 exclude_img: true,
 exclude_links: true,
 exclude_inputs: true
 });
});
//匯出成EXCEL結束

//匯出成txt開始
/*
<a style="cursor: pointer;" id="download_txt">點我下載成TXT</a>
*/
$("#download_txt").click(function()
{
var thecontent = $(".timetable_txt").html();
//thecontent = thecontent.replace("XXX", "\r\n");
thecontent = thecontent.replace(/\XXX/g,"\r\n");
var textFileAsBlob = new Blob([thecontent], {type:'text/plain'});
 
var downloadLink = document.createElement("a");
downloadLink.download = 'download';
downloadLink.innerHTML = "Download File";
 if (window.url != null)
 {
 downloadLink.href = window.url.createObjectURL(textFileAsBlob); //Chrome允許連結被點擊在DOM節點並沒有實際存在的情況下
 }
  else
  {
  //Firefox的連結一定要在DOM節點實際存在的情況下才能夠被點擊
  downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
  downloadLink.onclick = destroyClickedElement;
  downloadLink.style.display = "none";
  document.body.appendChild(downloadLink);
  }
downloadLink.click();
});

function destroyClickedElement(event)
{
document.body.removeChild(event.target);
}
//匯出成txt結束

//千分位符號開始
//var money = formatNumber('數字字串','分格符號');
//alert(money);
function formatNumber(str, glue)
{
 //如果傳入必需為數字型參數，不然就噴 isNaN 回去
 if(isNaN(str))
 {
 return NaN;
 }

 //決定三個位數的分隔符號
 var glue= (typeof glue== 'string') ? glue: ',';
 var digits = str.toString().split('.'); //先分左邊跟小數點
 
 var integerDigits = digits[0].split(""); //獎整數的部分切割成陣列
 var threeDigits = []; //用來存放3個位數的陣列
 
 //當數字足夠，從後面取出三個位數，轉成字串塞回 threeDigits
 while(integerDigits.length > 3)
 {
 threeDigits.unshift(integerDigits.splice(integerDigits.length - 3, 3).join(""));
 }
 
threeDigits.unshift(integerDigits.join(""));
digits[0] = threeDigits.join(glue);
return digits.join(".");
}
//千分位符號結束

//使用原生js來操作DOM︰https://www.ptt.cc/bbs/Web_Design/M.1491563726.A.508.html

/*
replaceAll 小數點
var s1 = "A.B.C";
alert(s1.replace(/\./g,"_")); //"A_B_C"

replaceAll 空白
var s2 = "A B C";
alert(s1.replace(/\s+/g,"_")); //"A_B_C"
*/

//判斷語系並且導引頁面開始
/*$(function()
{
var lang = window.navigator.userLanguage || window.navigator.language ;		
var relang=lang.toLowerCase();
 switch (relang)
 {
 case "zh-cn":
 $("#tbody").load("minwt_zh-cn.html");
 break;
			
 case "zh-tw":
 $("#tbody").load("minwt_zh-tw.html");
 break;

 default:
 $("#tbody").load("minwt_zh-tw.html");
 }			
});*/
//判斷語系並且導引頁面結束

//判斷當下某個cookie是否有值
function getCookie(cookiename) {
    var name = cookiename + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
//alert(getCookie('要偵測的cookie'));

//身份證字號是否有誤
function checkID(idStr) {
  // 依照字母的編號排列，存入陣列備用。
  var letters = new Array('A', 'B', 'C', 'D', 
      'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 
      'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 
      'X', 'Y', 'W', 'Z', 'I', 'O');
  // 儲存各個乘數
  var multiply = new Array(1, 9, 8, 7, 6, 5, 
                           4, 3, 2, 1);
  var nums = new Array(2);
  var firstChar;
  var firstNum;
  var lastNum;
  var total = 0;
  // 撰寫「正規表達式」。第一個字為英文字母，
  // 第二個字為1或2，後面跟著8個數字，不分大小寫。
  var regExpID=/^[a-z](1|2)\d{8}$/i; 
  // 使用「正規表達式」檢驗格式
  if (idStr.search(regExpID)==-1) {
    // 基本格式錯誤
	alert("請仔細填寫身份證號碼");
   return false;
  } else {
	// 取出第一個字元和最後一個數字。
	firstChar = idStr.charAt(0).toUpperCase();
	lastNum = idStr.charAt(9);
  }
  // 找出第一個字母對應的數字，並轉換成兩位數數字。
  for (var i=0; i<26; i++) {
	if (firstChar == letters[i]) {
	  firstNum = i + 10;
	  nums[0] = Math.floor(firstNum / 10);
	  nums[1] = firstNum - (nums[0] * 10);
	  break;
	} 
  }
  // 執行加總計算
  for(var i=0; i<multiply.length; i++){
    if (i<2) {
      total += nums[i] * multiply[i];
    } else {
      total += parseInt(idStr.charAt(i-1)) * 
               multiply[i];
    }
  }
  // 和最後一個數字比對
  if ((10 - (total % 10))!= lastNum) {
	alert("身份證號碼寫錯了！");
	return false;
  } 
  return true;
}
//alert(checkID('要偵測的身份證字號'));

/*
去除字串中所有空白的方式
var e="aa";
while(e.indexOf(" ")>=0) { e=e.replace(" ",""); }
var e="aa";
e=e.replace(/[s]+/g,"");
*/

/*
var reg=/[\D\s]/;
var str= '要檢測的內容';
if(reg.exec(str)) {
alert('還有非數字')'
}
*/