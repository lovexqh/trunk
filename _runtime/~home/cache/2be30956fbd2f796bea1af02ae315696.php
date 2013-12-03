<?php if (!defined('THINK_PATH')) exit();?><link type="text/css" href="/Public/widget/History/css/history.css" rel="stylesheet"/>
<div id="xfui-history" class="xfui-box xfui-history ">
    <div class="xfui-history-header xfui-history-blue">
        <span class="xfui-history-left">您的浏览历史</span>
        <span class="xfui-history-right" onclick="delCookie()">[清空]</span>
        <div class="clear">
        </div>
    </div>
    <ul id="xfui_history_content" class="xfui-history-content">
        <?php if(is_array($homes)): ?><?php $i = 0;?><?php $__LIST__ = $homes?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$vo): ?><?php ++$i;?><?php $mod = ($i % 2 )?><li class="xfui-history-item 
                <?php if(($mod)  ==  "1"): ?>egg<?php endif; ?>">
                <p class="xfui-history-desc">
                    <img class="xfui-history-img" onerror="this.src='/Public/images/indexnopic.jpg'" src="<?php echo ($vo["thumb"]); ?>"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a>
                </p>
                <div class="clear">
                </div>
                <p>
                </p>
            </li><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
    </ul>
</div>
<script type="text/javascript">
    //删除cookies
    function delCookie(){
        var name = "home_history";
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval = getCookie(name);
        if (cval != null) 
            document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
        document.getElementById("xfui_history_content").innerHTML = "";
    }
</script>