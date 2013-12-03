<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <!--<link type="text/css" href="<?php echo ($uri); ?>/css/news.css" rel="stylesheet"/>-->
</head>
<body>
<div class="xfui-box xfui-news ">
    <div class="xfui-news-header xfui-news-<?php echo ($style); ?>">
        <span class="xfui-news-left">动态新闻</span>
        <span class="xfui-news-right">
            <a href="<?php echo ($more); ?>">[更多]</a>
        </span>
        <div class="clear"></div>
    </div>
    <ul class="xfui-news-content">
        <?php if(is_array($postlist)): ?><?php $i = 0;?><?php $__LIST__ = $postlist?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$plist): ?><?php ++$i;?><?php $mod = ($i % 2 )?><li class="xfui-news-item
            <?php if(($mod)  ==  "1"): ?>egg<?php endif; ?>
            ">
                <a class="xfui-news-desc" href="<?php echo ($plist["url"]); ?>"><?php echo ($plist["title"]); ?></a>
                <span class="xfui-news-time">[<?php echo ($plist["createtime"]); ?>]</span>
            </li><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
    </ul>
</div>
</body>
</html>