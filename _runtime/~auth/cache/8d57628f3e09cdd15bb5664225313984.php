<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
</script>
 <link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
 <link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1">
	<p class="xy"><span class="fontw">当前位置：</span>用户组管理</p>
	<p class="addbtn"><a href="<?php echo U('auth/Group/add');?>"><span class="addbtnbg">添加组</span></a>
	<div class="content">
		<table>
			<tr class="homeheard">
					<td width="10%">序号</td>
		<td width="15%" align="center">名称</td>
		<td width="10%">创建时间</td>
		<td width="10%">更新时间</td>
		<td  width="30%">操作</td>
				</tr>
		<?php if(is_array($list)): ?><?php $i = 0;?><?php $__LIST__ = $list?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$vo): ?><?php ++$i;?><?php $mod = ($i % 2 )?><tr <?php if(($mod)  ==  "0"): ?>class="graybg"<?php endif; ?><?php if(($mod)  ==  "1"): ?>class="whitebg"<?php endif; ?> >
<td><?php echo ($key+1); ?></td>
		<td  align="left"><?php echo ($vo["name"]); ?></td>
		<td><?php echo (toDate($vo["create_time"],'Y-m-d H#i#s')); ?>
		</td>
		<td><?php echo (toDate($vo["create_time"],'Y-m-d H#i#s')); ?>
		</td>
		<td class="managehometd"><a href="<?php echo U('auth/Group/add',array('pid'=>$vo['id']));?>"><img src="__PUBLIC__/admin/images/addbtn.gif"/>添加子组</a> | <a href="<?php echo U('auth/Group/edit',array('id'=>$vo['id']));?>"><img src="__PUBLIC__/admin/images/updatehome.gif"/>修改</a>
		 | <a href="javascript:void(0);" onclick="javascript:checkDelete('<?php echo ($vo["id"]); ?>');">
		 	<img src="__PUBLIC__/admin/images/delhome.gif"/>删除</a></td></tr><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
		 
		 
			<tr class="homeheard mypage"><td colspan="5">&nbsp;</td></tr>
		</table>
	</div>
</div>