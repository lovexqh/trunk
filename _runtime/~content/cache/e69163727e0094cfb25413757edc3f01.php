<?php if (!defined('THINK_PATH')) exit();?><script src="__PUBLIC__/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function checkDelete(id){
	if(confirm('你确定要删除该栏目？')){return true;}
}
//更改栏目排序
function modifyOrder(id,oldOrder){
	if($("#content"+id).val() !=oldOrder){
		var order = $('#content'+id).val();
		$.ajax({
  		  type: "post",
  		  url: "__APP__/Admin/Category/updateOrder/id/"+id+"/sort/"+order,
  		  dataType: "json",
  		  success: function(data){  
             }   
  		});
		
	}
	
}
//-->
</script>
        <style type="text/css">
            .message table tr th{
                height: 30px;
                background: #EEF3F7;
                border-bottom: 1px solid #D5DFE8;
                font-weight: normal;
            }
            .message .input-text-c{
                padding: 0;
                height: 18px;
                margin: 0 auto;
                text-align: center;
            }
            .message table a{
                text-decoration: none;
                color:#444;
                display: inline-block;
                margin:0 5px;
            }
            .message table a:hover{
                text-decoration: underline;
            }
        </style>

 <link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
 <link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1">
	<p class="xy"><span class="fontw">当前位置：</span>栏目管理</p>
	<p class="addbtn">
		<input type="button" class="searchbut" value="排 序" onclick="javascript:location.reload();">
		</p>
	<div class="content">
		<table>
			<tr class="homeheard"><td width="10%">排序</td><td width="20%">栏目名称</td><td>栏目类型</td><td>创建时间</td><td width="25%">操作</td></tr>
		<tr><td></td><td  style="text-align:left;">首页</td><td>普通栏目</td><td></td><td class="managehometd"><a href="<?php echo  U ('content/Category/add') ;?>"><img src="__PUBLIC__/admin/images/addbtn.gif"/>添加子栏目</a></td></tr>
		<?php if(is_array($categoryList)): ?><?php $i = 0;?><?php $__LIST__ = $categoryList?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$cat): ?><?php ++$i;?><?php $mod = ($i % 2 )?><tr <?php if(($mod)  ==  "1"): ?>class="graybg"<?php endif; ?><?php if(($mod)  ==  "0"): ?>class="whitebg"<?php endif; ?> ><td>
<input name="sort[1]" onkeyup="javascript:modifyOrder('<?php echo ($cat["id"]); ?>','<?php echo ($cat["sort"]); ?>');" id="content<?php echo ($cat["id"]); ?>" maxlength="2" type="text" size="3" value="<?php echo ($cat["sort"]); ?>" class="input-text-c">
</td><td style="text-align:left;"><?php echo ($cat["name"]); ?></td><td><?php if($cat["type"] == 1 ): ?>单页栏目<?php else: ?>普通栏目<?php endif; ?></td>
<td><?php echo (toDate($cat["createtime"],'Y-m-d H#i#s')); ?></td>
		<td class="managehometd"><a href="<?php echo  U ('content/Category/add',array('pid'=>$cat['id']) ) ;?>"><img src="__PUBLIC__/admin/images/addbtn.gif"/>添加子栏目</a> |
		 <a href="<?php echo  U ('content/Category/edit',array('id'=>$cat['id']) ) ;?>"><img src="__PUBLIC__/admin/images/updatehome.gif"/>修改</a>
		 | <a href="<?php echo  U ('content/Category/foreverdelete',array('id'=>$cat['id']) ) ;?>" onclick="javascript:checkDelete();">
		 	<img src="__PUBLIC__/admin/images/delhome.gif"/>删除</a></td></tr><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
		 
		 
			<tr class="homeheard mypage"><td colspan="5"></td></tr>
		</table>
	</div>
</div>