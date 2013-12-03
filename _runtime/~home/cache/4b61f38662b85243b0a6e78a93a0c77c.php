<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title></title>
        <!--<link type="text/css" href="<?php echo ($uri); ?>/css/home.css" rel="stylesheet" />-->
    </head>
    <body>
        <div id="homeindex_<?php echo ($style); ?>">
        </div>
        <div id="xfui-articleList" class="xfui-box xfui-articleList ">
            <div class="xfui-articleList-header xfui-articleList-<?php echo ($style); ?>">
                <a class="xfui-articleList-header-more" href="<?php echo ($more); ?>">更多&gt;&gt;</a>
            </div>
			<?php if(is_array($postlist)): ?><?php $i = 0;?><?php $__LIST__ = $postlist?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$plist): ?><?php ++$i;?><?php $mod = ($i % 2 )?><div class="xfui-box xfui-articleitem ">
                <div class="xfui-articleitem-img">
                    <a href="<?php echo ($plist["url"]); ?>"><img src="<?php echo ($plist["thumb"]); ?>" onerror="this.src='__THEME__/images/indexnopic.jpg'" title="房屋" alt="房屋" width="140px" height="105px"></a>
                </div>
                <div class="xfui-articleitem-area">
                    <span class="xfui-articleitem-label">区域：</span>
                    <span class="xfui-articleitem-value"><?php echo ($plist["homeregion"]); ?></span>
                </div>
                <div class="xfui-articleitem-price">
                    <span class="xfui-articleitem-label">租金：</span>
                    <span class="xfui-articleitem-value"><?php echo ($plist["price"]); ?></span>
                </div>
                <div class="xfui-articleitem-type">
                    <span class="xfui-articleitem-label">房型：</span>
                    <span class="xfui-articleitem-value"><?php echo ($plist["hometype"]); ?></span>
                </div>
            </div><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
            <div class="clear">
            </div>
        </div>
    </body>
</html>