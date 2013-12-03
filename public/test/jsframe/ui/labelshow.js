(function () {
   var UIBase = XF.UIBase,
           Stateful = XF.Stateful;
   var LabelShow = XF.ui.LabelShow = function (opt) {
       this.initOptions(opt);
       this.initLabelShow();
   };
   LabelShow.prototype = {
       initLabelShow:function(){
           this.initUIBase();
           this.Stateful_init();
       },
       getHtmlTpl:function () {
           return '<div id="##" class="xfui-box %%">' +
                   '<div id="##_choosed" class="xfui-box %%-choosed">' +
                   '<h3 class="%%-label">您已选择：</h3>' +this.getContentHtmlTpl()+
                   '</div>'+
                   '</div>';
       },
       getContentHtmlTpl:function () {
           var obj = this.data,
                   all = [];
           for(var i=0,o;o=obj[i++];){
               all.push(' <a class="%%-label-item" value="'+o.value+'">'+o.label+'<b  onclick="return $$._onClick();"></b></a>');
           }
           return all.join("");
       },
       _onClick:function(evt){
           var evt = evt||event,
                   el = evt.srcElement||evt.target;
           domUtils.remove(el.parentNode);
       },
       getCondition:function(){
           var choose = this.getDom("choosed"),
                   items = domUtils.getElementsByTagName(choose,"a"),
                   values = [];
           for(var i=0,item;item = items[i++];){
               values.push(item.getAttribute("value"));
           }
           return values;
       }
   };
   utils.inherits(LabelShow, UIBase);
   utils.extend(LabelShow.prototype, Stateful);
})();