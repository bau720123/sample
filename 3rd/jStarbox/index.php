<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-tw" />
<title></title>
<link href="css/jstarbox.css" rel="stylesheet"></link>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="jstarbox.js"></script>

</head>

<body>
<span class="starboxselect"></span> <span class="starboxselect_value"></span>
<br>
<span class="starboxstatic"></span>

<script>
$('.starboxselect').starbox(
{
average: 0, //可以預設一開始是多少值
stars: 5, //預設幾顆星星
buttons: 10, //設定星星可以切割成多少區塊可以選擇，假設有5顆星星，buttons設10，每顆星星就可以選擇半顆或整顆
ghosting: true, 
changeable: 'once', //once代表點選後不可改變，true則是可改變，false則是不可改變
autoUpdateAverage: true,
}).bind('starbox-value-moved', function(event, value) { $('.starboxselect_value').html($('.starboxselect').starbox("getValue")*5); });

$('.starboxstatic').starbox(
{
average: 0.7, //可以預設一開始是多少值
stars: 5, //預設幾顆星星
changeable: false, //once代表點選後不可改變，true則是可改變，false則是不可改變
});

$('.starboxselect').click(function()
{
alert($('.starboxselect').starbox("getValue")*5);
});
</script>
</body>
</html>