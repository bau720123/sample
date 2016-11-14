/**
 * @classDescription 模擬Marquee，無間斷滾動內容
 * @author Aken Li(www.kxbd.com)
 * @DOM
 * <div id="marquee">
 * <ul>
 * <li></li>
 * <li></li>
 * </ul>
 * </div>
 * @CSS
 * #marquee {overflow:hidden;width:200px;height:50px;}
 * @Usage
 * $("#marquee").kxbdMarquee(options);
 * @options
 * isEqual:true, //所有滾動的元素長寬是否相等,true,false
 * loop:0, //循環滾動次數，0時無限
 * direction:"left", //滾動方向，"left","right","up","down"
 * scrollAmount:1, //步長
 * scrollDelay:20 //時長
 */
(function($){
$.fn.kxbdMarquee=function(options){
var opts=$.extend({},$.fn.kxbdMarquee.defaults, options);

return this.each(function(){
var $marquee=$(this); //滾動元素容器
var _scrollObj=$marquee.get(0); //滾動元素容器DOM
var scrollW=$marquee.width(); //滾動元素容器的寬度
var scrollH=$marquee.height(); //滾動元素容器的高度
var $element=$marquee.children(); //滾動元素
var $kids=$element.children(); //滾動子元素
var scrollSize=0; //滾動元素尺寸

//滾動類型，1左右，0上下
var _type=(opts.direction=="left"||opts.direction=="right") ? 1:0;

//防止滾動子元素比滾動元素寬而取不到實際滾動子元素寬度
$element.css(_type?"width":"height",10000);

//獲取滾動元素的尺寸
if(opts.isEqual){
scrollSize=$kids[_type?"outerWidth":"outerHeight"]()*$kids.length;
}else{
$kids.each(function(){
scrollSize+=$(this)[_type?"outerWidth":"outerHeight"]();
});
};

//滾動元素總尺寸小於容器尺寸，不滾動
if(scrollSize<(_type?scrollW:scrollH)){return;};

//克隆滾動子元素將其插入到滾動元素後，並設定滾動元素寬度
$element.append($kids.clone()).css(_type?"width":"height",scrollSize*2);

var numMoved=0;
function scrollFunc(){
var _dir=(opts.direction=="left"||opts.direction=="right") ? "scrollLeft":"scrollTop";
if (opts.loop>0) {
numMoved+=opts.scrollAmount;
if(numMoved>scrollSize*opts.loop){
_scrollObj[_dir]=0;
return clearInterval(moveId);
};
};

if(opts.direction=="left"||opts.direction=="up"){
var newPos=_scrollObj[_dir]+opts.scrollAmount;
if(newPos>=scrollSize){
newPos-=scrollSize;
}
_scrollObj[_dir]=newPos;
}else{
var newPos=_scrollObj[_dir]-opts.scrollAmount;
if(newPos<=0){
newPos += scrollSize;
};
_scrollObj[_dir]=newPos;
};
};

//滾動開始
var moveId=setInterval(scrollFunc, opts.scrollDelay);

//鼠標劃過停止滾動
$marquee.hover(function(){
clearInterval(moveId);
},function(){
clearInterval(moveId);
moveId=setInterval(scrollFunc, opts.scrollDelay);
});
});
};

$.fn.kxbdMarquee.defaults={
isEqual:true, //所有滾動的元素長寬是否相等,true,false
loop: 0, //循環滾動次數，0時無限
direction: "left", //滾動方向，"left","right","up","down"
scrollAmount:1, //步長
scrollDelay:20 //時長

};

$.fn.kxbdMarquee.setDefaults=function(settings) {
$.extend( $.fn.kxbdMarquee.defaults, settings );
};
})(jQuery);