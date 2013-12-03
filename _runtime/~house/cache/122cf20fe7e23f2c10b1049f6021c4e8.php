<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__PUBLIC__/admin/js/admin.js" defer="defer"></script>

 <link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
 <link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1">
	<p class="xy"><span class="fontw">当前位置：</span>房屋类型管理</p>
	<p class="addbtn"><a href="<?php echo U('house/HomeType/add');?>"><span class="addbtnbg">添加类型</span></a>	<input type="button" onclick="allSelect()" class="searchbut" value="全 选">&nbsp;
        <input type="button" onclick="InverSelect()" class="searchbut" value="反 选">&nbsp;
        <input type="button" onclick="allUnSelect()" class="searchbut" value="全 否" >&nbsp;
        <input type="button" onclick="deleteSelect('__URL__')" class="searchbut" value="删除">&nbsp;</p>
	  <notempty name="list">
	<div class="content">
		<table id="selectstate">
			<tr class="homeheard"><td width="10%">选择</td><td width="30%">名称</td><td>创建日期</td><td width="25%">操作</td></tr>
		<?php if(is_array($list)): ?><?php $i = 0;?><?php $__LIST__ = $list?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$content): ?><?php ++$i;?><?php $mod = ($i % 2 )?><tr <?php if(($mod)  ==  "0"): ?>class="graybg"<?php endif; ?><?php if(($mod)  ==  "1"): ?>class="whitebg"<?php endif; ?> ><td><input type="checkbox" value="<?php echo ($content["id"]); ?>" /></td><td><?php echo ($content["name"]); ?></td><td><?php echo (toDate($content["createtime"],'Y-m-d H#i#s')); ?></td>
		<td class="managehometd"><a href="<?php echo U('house/HomeType/edit',array('id'=>$content['id']));?>"><img src="__PUBLIC__/admin/images/updatehome.gif"/>修改</a>
	</td></tr><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
		 
		 
			<tr class="homeheard mypage"><td colspan="5">&nbsp<?php echo ($page); ?></td></tr>
		</table>
	</div></notempty>
</div>