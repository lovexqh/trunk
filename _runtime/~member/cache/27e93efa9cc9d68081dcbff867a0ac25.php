<?php if (!defined('THINK_PATH')) exit();?><script src="__PUBLIC__/js/livevalidation.js" type="text/javascript"></script>
<link rel="stylesheet" href="__PUBLIC__/admin/css/consolidated_common.css" type="text/css"/>
<link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
<link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1">
    <p class="xy"><span class="fontw">当前位置：</span>会员管理 </p>
	<p class="addbtn"><a href="<?php echo U('member/Member/add');?>"><span class="addbtnbg">添加会员</span></a>
	<div class="content">
		<table>
			<tr class="homeheard">
		<td width="10%">序号</td>
		<td width="30%">名称</td>
		<td width="20%">联系方式</td>
		<td width="15%">创建时间</td>
		<td>操作</td>
	</tr>		<?php if(is_array($list)): ?><?php $i = 0;?><?php $__LIST__ = $list?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$vo): ?><?php ++$i;?><?php $mod = ($i % 2 )?><tr <?php if(($mod)  ==  "0"): ?>class="graybg"<?php endif; ?><?php if(($mod)  ==  "1"): ?>class="whitebg"<?php endif; ?> >
	<td><?php echo ($key+1); ?></td>
		<td><?php echo ($vo["name"]); ?></td>
		<td><?php echo ($vo["telephone"]); ?></td>
		<td><?php echo (toDate($vo["create_time"],'Y-m-d H#i#s')); ?>
		</td>
		<td class="managehometd"><a href="__URL__/edit/id/<?php echo ($content["id"]); ?>/pid/<?php echo ($content["pid"]); ?>"><img src="__PUBLIC__/admin/images/updatehome.gif"/>修改</a>
		 | <a href="javascript:void(0);" onclick="javascript:checkDelete('<?php echo ($vo["id"]); ?>');">
		 	<img src="__PUBLIC__/admin/images/delhome.gif"/>删除</a>
			</td></tr><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
		 
		 
			<tr class="homeheard mypage"><td colspan="5">&nbsp;<?php echo ($page); ?></td></tr>
		</table>
	</div>
</div>