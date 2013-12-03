<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="__PUBLIC__/admin/css/consolidated_common.css"
	type="text/css" />
<script src="__PUBLIC__/js/livevalidation.js" type="text/javascript"></script>
<link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css" />
<link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css"
	type="text/css" />
<div class="container solid1">
	<p class="xy">
		<span class="fontw">当前位置：</span>房屋管理 > 查看房屋类型
	</p>

	<div class="content">
		<form action="<?php echo U('house/homeMember/index');?>" method="post">
			<table class="myaddhome">
				<tr class="graybg">
					<td class="textr" width="10%"><span class="fontw">标题：</span></td>
					<td class="textl" colspan="7"><?php echo ($vo["name"]); ?></td>
				</tr>
				<tr class="whitebg">
					<td class="textr" width="10%"><span class="fontw">房屋类型：</span></td>
					<td class="textl" colspan="7"><?php switch($vo["type"]): ?><?php case "1":  ?>求购<?php break;?>
<?php case "2":  ?>求租<?php break;?>
<?php case "3":  ?>出售<?php break;?>
<?php case "4":  ?>出租<?php break;?><?php endswitch;?></td>
				</tr>

				<tr class="graybg">
					<td class="textr" width="10%"><span class="fontw">地段：</span></td>
					<td class="textl" colspan="7"><?php echo ($vo["region"]); ?></td>

				</tr>

				<tr class="whitebg">
					<td class="textr" width="10%"><span class="fontw">租金：</span></td>
					<td class="textl" colspan="7"><?php echo ($vo["price"]); ?></td>

				</tr>

				<tr class="graybg">
					<td class="textr" width="10%"><span class="fontw">居室：</span></td>
					<td class="textl" colspan="7"><?php echo ($vo["size"]); ?></td>

				</tr>
				<tr class="whitebg">
					<td class="textr" width="10%"><span class="fontw">手机电话：</span></td>
					<td class="textl" colspan="7"><?php echo ($vo["phone"]); ?></td>

				</tr>
				<tr class="graybg">
					<td class="textr" width="10%"><span class="fontw">联系人：</span></td>
					<td class="textl" colspan="7"><?php echo ($vo["realname"]); ?></td>

				</tr>
				<tr class="whitebg">
					<td class="textr" width="10%"><span class="fontw">补充说明：</span></td>
					<td class="textl" colspan="7"><?php echo ($vo["remark"]); ?></td>

				</tr>
				<tr class="graybg">
					<td class="textc btnbg" colspan="8"><input type="submit"
						value="返 回" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>