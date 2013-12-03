(function(){
    var dialog="",
            cname = "",
            wname = "",
            cwidget = null,
            popmask = null,
            curwidget = null;
    function $(id){
        return document.getElementById(id);
    }
    String.prototype.trim = function(){
        return this.replace(/(^[ \t\n\r]+)|([ \t\n\r]+$)/g, '');
    }
    //获得可编辑模板
    function getTpls(){
        var allTpl = domUtils.getElementsByTagName(document.body,"div"),
                tpls = [];
        for(var i=0,tpl;tpl=allTpl[i++];){
            if(/edui-tpl/ig.test(tpl.className)){
                tpls.push(tpl);
            }
        }
        return tpls;
    }
    //页面加载获得witem类的div,增加修改和删除按钮
    function getWitemList(){
        var witems = domUtils.getElementsByTagName(document,"div"),
            itemlist = [];
        for(var i= 0,item;item=witems[i++];){
            if(/witem/ig.test(item.className)){
                itemlist.push(item);
            }
        }
        return itemlist;
    }

    //创建按钮
    function createButton(id,className){
        var btn = document.createElement("div");
        btn.id = id;
        btn.className = className;
        return btn;
    }
    function renderBtn(){
        var tpls = getTpls();

        for(var i=0,tpl;tpl=tpls[i++];){
            cname = tpl.className.match(/edui-tpl-([\w]+)/i)[1];
            var addbtn = createButton(cname+"_add_btn","btn");
            addbtn.innerHTML = "添加";
            addbtn.onclick =function(){
                cwidget = null;
                cname = this.id.match(/([^_.*]+)_/i)[1];
                var show = $(cname+"_show");
                var obj = {
                    url:$("lw").value,
                    onsuccess:function(xhr){
                        var obj = eval('('+xhr.responseText+')');
                        var listWidget = [],
                                dialogObj = {
                                    title:"选择微件"
                                };
                        for(var i=0,item;item=obj[i++];){
                            listWidget.push("<span onclick='changeWidget(\""+item+"\",\""+cname+"\")'>"+item+"</span><br>");
                        }
                        dialogObj.dialogContent = listWidget.join("");
                        createDialog(dialogObj);
                    }
                };
                sendAction(obj);
            }
            tpl.appendChild(addbtn);
        }
    }
    //选择微件
    window.changeWidget = function(wname,position){
        this.wname = wname;
        var obj = {
            iframeUrl:$("ta").value+"&wname="+wname,
            title:"添加微件"
        };
        createDialog(obj);
    }
    //创建dialog
    function createDialog(dialogObj){
        //实例化dialog
        dialog&&dialog.dispose();
        dialog = new XF.ui.Dialog({
            title:dialogObj.title,
            content:dialogObj.dialogContent,
            iframeUrl:dialogObj.iframeUrl,
            buttons:[
                {
                    className:'edui-okbutton',
                    label:'确认',
                    onclick:function () {
                        dialogObj.onok&&dialogObj.onok.call(this);
                        dialog.close(true);
                    }
                },
                {
                    className:'edui-cancelbutton',
                    label:"取消",
                    onclick:function () {
                        dialogObj.oncancel&&dialogObj.oncancel.call(this);
                        dialog.close(false);
                    }
                }
            ]
        });
        dialog.open();
    }

    //发送请求
    function sendAction(obj){
        XF.ajax.request(obj.url,{
            data:obj.data,
            onsuccess:function(xhr){
                obj.onsuccess.call(this,xhr);
            },
            onerror:function(){
                obj.onerror.call(this);
            }
        });
    }
    //实例化popmask
    popmask = new XF.ui.PopMask({
        content:"<span onclick='delwidget()'>删除</span><span onclick='upwidget()'>修改</span>"
    });
    //给可以增加按钮的模板创建添加按钮
    renderBtn();
    bindBtn();
    //得到对应位置id
    function getLayoutId(){
        var str = document.getElementById("blocks").innerHTML,
        block = eval('('+str+')');
        for(var i= 0;i<block.length;i++){
            if(block[i].name == cname){
                return block[i].id;
            }
        }
        return null;
    }
    //用于给dialog里提交时使用
    window.wsubmit = function(param){
        var me = this;
        XF.ajax.request( $("aw").value+(cwidget?"&id="+cwidget.id:""),{
			method:"POST",
            data:{
                'bid':getLayoutId(),
                'name':this.wname,
                'param':param
            },
            onsuccess:function(xhr){
                var cid = cname+"_show",
                    widgetitem = document.createElement("div"),
                    cdiv = document.getElementById(cid);
                widgetitem.className = "witem";
                widgetitem.innerHTML = xhr.responseText;
                widgetitem.firstChild.onmouseover = bindMouseOver;
                if(cwidget){
                    cdiv.insertBefore(widgetitem,cwidget);
                    cdiv.removeChild(cwidget);
                    cwidget = null;
                }else{
                     cdiv.appendChild(widgetitem.firstChild);
                    widgetitem = null;
                }
            }
        });
    }
    //给有witem为classname的div增加修改和删除按钮
    function bindBtn(){
        var itemlist = getWitemList();
        for(var i= 0,item;item=itemlist[i++];){
            (function(){
                item.onmouseover = bindMouseOver;
            })();
        }
    }
    function bindMouseOver(evt){
        curwidget = this;
        domUtils.findParent(cwidget,function(node){
            var arr = node.id.match(/([^_.*]+)_/i);
            if(arr&&arr.length>1){
                cname = arr[1];
                return;
            }
        })
        var evt = evt||event,
            rect = XF.uiUtils.getClientRect(this);
        popmask.showAt({
            left : rect.left,
            top : rect.top-30
        });
        XF.domUtils.setStyles(popmask.getDom(),{
            width:rect.width+'px',
            height:'30px'
        });
    }
    window.upwidget = function(){
        cwidget = curwidget;
        var obj = {
            iframeUrl:$("te").value+"&id="+cwidget.id,
            title:"修改微件",
            onok:function(){
                popmask.hide();
            }
        };
        createDialog(obj);
    }
    window.delwidget = function(){
        cwidget = curwidget;
        var obj = {
            url:$('dw').value+"&id="+curwidget.id,
            onsuccess:function(xhr){
                XF.domUtils.remove(curwidget);
                popmask.hide();
            }
        };
        sendAction(obj);
    }
})();