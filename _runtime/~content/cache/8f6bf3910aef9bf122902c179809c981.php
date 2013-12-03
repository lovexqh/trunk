<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/ztree/jquery.ztree.core-3.1.js"></script>
<link rel="stylesheet" href="__PUBLIC__/admin/css/demo.css" type="text/css">
<link rel="stylesheet" href="__PUBLIC__/js/ztree/zTreeStyle.css" type="text/css">
<div>
<div style="width:16%;float:left;" >
    <ul id="treeDemo" class="ztree" style="width:155px;height:300px;" ></ul>
</div>
<input type="hidden" value="<?php echo ($catid); ?>" id="treeShowId"/>
<div style="width:84%;float:left;" >

   <iframe  style="overflow-x:hidden;"  id="content_frame" src="<?php echo U('content/Content/welcome');?>" width="100%"  height="100%" frameborder="no" marginwidth="0"></iframe>

</div>
<div style="clear:both;"></div>
</div>
<SCRIPT type="text/javascript">
    <!--
    var setting = {
        view:{
            selectedMulti:false
        },
        async:{
            enable:true,
            url:"<?php echo U('content/Category/showCategoryListAjax');?>",
            autoParam:["id"],
//            otherParam:{"otherParam":"zTreeAsyncTest"},
            dataFilter:filter
        },
        callback:{
            beforeClick:beforeClick,
            beforeAsync:beforeAsync,
            onAsyncError:onAsyncError,
            onAsyncSuccess:onAsyncSuccess
        }
    };
    function filter(treeId, parentNode, childNodes) {
        if (!childNodes) return null;
        for (var i=0, l=childNodes.length; i<l; i++) {
            childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');
        }
        return childNodes;
    }
    function beforeClick(treeId, treeNode) {
        if (!treeNode.isParent) {
        	if(treeNode.cattype == 1){

          document.getElementById('content_frame').src="<?php echo U('content/content/singlePage');?>&catid="+treeNode.id+"&type="+treeNode.type;
        	}
        	else{
        document.getElementById('content_frame').src="<?php echo U('content/content/content');?>&catid="+treeNode.id+"&type="+treeNode.type+"&modelid="+treeNode.modelid;
        	}
          return false;
        } else {
            return true;
        }
    }
    var log, className = "dark";
    function beforeAsync(treeId, treeNode) {
        className = (className === "dark" ? "":"dark");
        showLog("[ "+getTime()+" beforeAsync ]&nbsp;&nbsp;&nbsp;&nbsp;" + ((!!treeNode && !!treeNode.name) ? treeNode.name : "root") );
        return true;
    }
    function onAsyncError(event, treeId, treeNode, XMLHttpRequest, textStatus, errorThrown) {
        showLog("[ "+getTime()+" onAsyncError ]&nbsp;&nbsp;&nbsp;&nbsp;" + ((!!treeNode && !!treeNode.name) ? treeNode.name : "root") );
    }
    function onAsyncSuccess(event, treeId, treeNode, msg) {
        showLog("[ "+getTime()+" onAsyncSuccess ]&nbsp;&nbsp;&nbsp;&nbsp;" + ((!!treeNode && !!treeNode.name) ? treeNode.name : "root") );
    }

    function showLog(str) {
        if (!log) log = $("#log");
        log.append("<li class='"+className+"'>"+str+"</li>");
        if(log.children("li").length > 8) {
            log.get(0).removeChild(log.children("li")[0]);
        }
    }
    function getTime() {
        var now= new Date(),
        h=now.getHours(),
        m=now.getMinutes(),
        s=now.getSeconds(),
        ms=now.getMilliseconds();
        return (h+":"+m+":"+s+ " " +ms);
    }
    function checkDelete(id,catid,type){
        if(confirm('你确定要删除该栏目？')){location.href='__URL__/foreverdelete/id/'+id+'/catid/'+catid+'/type/'+type}
    }
    //-->

</SCRIPT>
<script type="text/javascript">
    $.fn.zTree.init($("#treeDemo"), setting);
</script>