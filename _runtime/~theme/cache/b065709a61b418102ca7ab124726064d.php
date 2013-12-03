<?php if (!defined('THINK_PATH')) exit();?>

<script type="text/javascript">
<!--
checkDelete = function(id){
	if(confirm('你确定要删除该配置项？')){location.href='__URL__/delete/id/'+id}
}
//-->
</script>
 <link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
 <link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1">
	<p class="xy"><span class="fontw">当前位置：</span>主题管理</p>
	<div class="content">
		<table>
			<tr class="homeheard">
		<td width="10%">序号</td>
		<td width="10%">名称</td>
		<td width="10%">文件名</td>
		<td width="10%">缩略图</td>
		<td width="20%">状态</td>
		<td>操作</td>
				</tr>
		<?php if(is_array($list)): ?><?php $i = 0;?><?php $__LIST__ = $list?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$vo): ?><?php ++$i;?><?php $mod = ($i % 2 )?><tr <?php if(($mod)  ==  "0"): ?>class="graybg"<?php endif; ?><?php if(($mod)  ==  "1"): ?>class="whitebg"<?php endif; ?> >
<td><?php echo ($key+1); ?></td>
		<td><a href="<?php echo U('theme/layout/editLayout',array('id'=>$vo['id']));?>" target="_blank"><?php echo ($vo["name"]); ?></a></td>
		<td><?php echo ($vo["name"]); ?></td>
		<td><?php echo ($vo["name"]); ?></td>
		<td><?php echo ($vo["name"]); ?></td>
		<td class="managehometd"><a target="_blank" href="<?php echo U('theme/layout/editLayout',array('id'=>$vo['id']));?>"><img src="__PUBLIC__/admin/images/updatehome.gif"/>可视化编辑</a>
		 | <a href="javascript:void(0);" onclick="javascript:checkDelete('<?php echo ($vo["id"]); ?>');">
		 	<img src="__PUBLIC__/admin/images/delhome.gif"/>删除</a></td></tr><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
		 
		 
			<tr class="homeheard mypage"><td colspan="6">&nbsp<?php echo ($page); ?></td></tr>
		</table>
	</div>
</div>