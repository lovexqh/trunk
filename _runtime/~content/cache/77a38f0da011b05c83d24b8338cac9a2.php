<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__PUBLIC__/admin/js/admin.js" defer="defer"></script>
 <link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
 <link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1" >
	<p class="addbtn"><a href="<?php echo  U ('content/Content/add',array('catid'=>$catid,'type'=>$type) ) ;?>"><span class="addbtnbg">添加文章</span></a>
	<input type="button" onclick="allSelect()" class="searchbut" value="全 选">&nbsp;
	<input type="button" onclick="InverSelect()" class="searchbut" value="反 选">&nbsp;
        <input type="button" onclick="allUnSelect()" class="searchbut" value="全 否" >&nbsp;
        <input type="button" onclick="checkDelete('__URL__','<?php echo ($catid); ?>','<?php echo ($type); ?>')" class="searchbut" value="删除">&nbsp;</p>
    <notempty name="list">
	<div class="content">
		<table id="selectstate">
			<tr class="homeheard"><td width="10%">选择</td><td width="20%">名称</td><td width="20%">关键字</td><td>创建日期</td><td width="25%">操作</td></tr>
		<?php if(is_array($list)): ?><?php $i = 0;?><?php $__LIST__ = $list?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$content): ?><?php ++$i;?><?php $mod = ($i % 2 )?><tr <?php if(($mod)  ==  "0"): ?>class="graybg"<?php endif; ?><?php if(($mod)  ==  "1"): ?>class="whitebg"<?php endif; ?> ><td><input type="checkbox" value="<?php echo ($content["id"]); ?>" /></td><td><?php echo ($content["title"]); ?></td><td><?php echo ($content["keywords"]); ?></td><td><?php echo (toDate($content["createtime"],'Y-m-d H#i#s')); ?></td>
		<td class="managehometd"> 
		<a href="<?php echo  U ('content/Content/edit',array('id'=>$content['id'],'catid'=>$catid,'type'=>$type) ) ;?>"><img src="__PUBLIC__/admin/images/updatehome.gif"/>修改</a>
		</td></tr><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
		 
		 
			<tr class="homeheard mypage"><td colspan="5">
				&nbsp;<?php echo ($page); ?>
			</td>
			</tr>
		</table>
	</div>
    </notempty>
</div>
<script type="text/javascript">
<!--
checkDelete = function(url,catid,type){
var result = false;
			var sum ='';
			for(var a=0;a<selectid.length;a++){
				if(selectid[a].checked==true){
					result = true;
					sum+=selectid[a].value+',';
				}
			}
			
			if(result){
				if(confirm('你确定要删除该项信息？')){
					
			 location.href = url+'/delete/catid/'+catid+'/type/'+type+'/id/' + sum;
				}
			}else{
				alert('请选择要删除的选项！');
			}
}
//-->
</script>