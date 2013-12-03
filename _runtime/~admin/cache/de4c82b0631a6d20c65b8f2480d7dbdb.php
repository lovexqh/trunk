<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
<html xmlns=”http://www.w3.org/1999/xhtml”>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css"
	type="text/css" />
<link rel="stylesheet" href="__PUBLIC__/admin/css/admin.css"
	type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jsframe/xf_api.js"></script>
<title>后台管理系统</title>
</head>
<body>
	<div class="wrap">
		<div class="header">
			<div class="logoarea">
				<h1 class="logo">
					<img src="__PUBLIC__/admin/images/logo.png" width="264" height="66">
				</h1>
				<ul>
					<span> 管理员 , 您好！</span>
					<li><a class="close" href="<?php echo U('admin/Public/logout');?>">退出</a>
					</li>
				</ul>
			</div>

		</div>
		<div class="container fixed">
			<div class="left fixed">
				<ul id="leftmenu">

				</ul>
			</div>
			<div class="right">
				<div class="content">
					<ul class="row" id="contmenu">
					</ul>
					<div class="fun_area"></div>
				</div>
				<div class="foot">
					<span>版权所有：第三空间 Copyright© 2011&gt;</span><a href="#">联系我们</a><a
						href="#">使用帮助</a>
				</div>
			</div>
		</div>
		<div class="tabarea">
			<div class="tabpadding"></div>
			<div class="con_area">
				<iframe id="contIframe" src="" width="100%" height="650px"
					frameborder="0"></iframe>
			</div>
		</div>
	</div>
	</div>
	<script type="text/javascript">
    (function(){
        var UIBase = XF.UIBase,
                Stateful = XF.Stateful;
        var MainMenu = XF.ui.MainMenu = function(opt){
            this.initOptions(opt);
            this.initMainMenu();
        };
        MainMenu.prototype = {
            baseUrl : "<?php echo U('admin/Index/getMenu');?>"+"&id=",
            cindex:1,
            ccname:"arr",
            childs:[],
            initMainMenu:function(){
                this.initUIBase();
                this.Stateful_init();
            },
            getHtmlTpl : function(){
                return '<ul>' +this.getDataTpl()+
                        '</ul>';
            },
            getDataTpl : function(){
                var arr = [];
                for(var i=0,m;m=this.data[i++];){
                    var url = this.baseUrl+m.id;
                    arr.push('<li ><a id="'+i+'" '+(this.cindex==i?'class=\"'+this.ccname+'\"' : "")+' onclick="return $$._onClick(\''+url+'\',event);">'+m.title+'</a></li>');
                }
                return arr.join("");
            },
            clearChilds : function(){

                for(var i=0,el;el=this.childs[i++];){
                    domUtils.removeClasses(el.firstChild,[this.ccname]);
                }
            },
            _onClick:function(url,evt){
                evt = evt||event;
                var el = evt.srcElement||evt.target;
                this.clearChilds();
                domUtils.addClass(el,this.ccname);
                this.cindex = el.getAttribute("id");
                this.postAjax();
                return false;
            },
            postRender : function(){
                this.childs = domUtils.getElementsByTagName(document.getElementById(this.id),"li");
                this.postAjax();
            },
            postAjax:function(){
                var ajax = XF.ajax,
                        me = this;
                ajax.request(this.baseUrl+this.data[this.cindex-1].id,{
                    async:false,
                    onsuccess:function(xhr){
                        var obj = eval('('+xhr.responseText+')'),
                                contmenu = document.getElementById("contmenu"),
                                arr = [] ,firsturl;
                        for(var i=0,o;o=obj[i++];){
                            url = o.url;
                            if(!firsturl)firsturl = url;
                            arr.push('<li><a '+(i==1? 'class="curr"' : "")+' onclick="linkmenu(\''+url+'\',event)">'+o.title+'</a></li>');
                        }
                        contmenu.innerHTML = ''+arr.join("")+"";
                        document.getElementById("contIframe").src = firsturl;
                    },
                    onerror:function(){
                        alert("error");
                    }
                })
            }
        };
        utils.inherits(MainMenu, UIBase);
        utils.extend(MainMenu.prototype, Stateful);
		
		
    })();
    var mmenu = new XF.ui.MainMenu({
        id:"leftmenu",
        data:<?php echo ($menu); ?>
    });
    mmenu.render();
    function linkmenu(url,evt){
        evt = evt || event;
        var topmenu = document.getElementById("contmenu"),
            ms = domUtils.getElementsByTagName(topmenu,"li"),
            el = evt.srcElement||evt.target;
        for(var i=0,m;m=ms[i++];){
            domUtils.removeClasses(m.firstChild,["curr"]);
        }
        domUtils.addClass(el,"curr");
        document.getElementById("contIframe").src = url;
    }




</script>
</body>
</html>