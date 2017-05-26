<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
<script>
/*
Notification.permission
default：用户还没有做出任何许可，因此不会弹出通知。
granted：用户明确同意接收通知。
denied：用户明确拒绝接收通知。
*/

if(window.Notification)
{
console.log("您支援推播功能！");
 Notification.requestPermission(function(status)
 {
  if(status === "granted")
  {
   var n = new Notification('這是標題', 
   { 
   dir: 'auto', //文字方向，可能的值為auto、ltr（從左到右）和rtl（從右到左），一般是繼承瀏覽器的設置
   lang: 'zh-TW', //使用的語種，比如en-US、zh-CN
   body: '這是內容！', //通知內容，格式為字符串，用來進一步說明通知的目的
   tag: '12345', //通知的ID，格式為字符串。一組相同tag的通知，不會同時顯示，只會在用戶關閉前一個通知後，在原位置顯示
   icon: 'http://www.littlebau.com/phonegap_build_6.3.0/material/icon.png', //圖表的URL，用來顯示在通知上
   });
   n.onshow = function()
   {
   console.log("訊息已顯示！");
   setTimeout(n.close.bind(n), 10000); //自動關閉
   }
   n.onclick = function()
   {
   console.log("訊息已點擊！");
   window.open('http://www.littlebau.com');
   n.close();
   }
   n.onclose = function()
   {
   console.log("訊息已關閉！");
   }        
   n.onerror = function()
   {
   console.log("訊息發生錯誤！");
   }   
  }
   else
   {
   alert("您尚未允許或已封鎖了推播！");
   }
 })
} 
 else
 {
 alert('不支援推播');
 }
</script>
</body>
</html>
