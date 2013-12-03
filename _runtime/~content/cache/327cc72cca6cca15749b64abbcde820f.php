<?php if (!defined('THINK_PATH')) exit();?><script src="__PUBLIC__/js/livevalidation.js" type="text/javascript"></script>
<link rel="stylesheet" href="__PUBLIC__/css/consolidated_common.css" type="text/css"/>
<link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
<link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1">
    <p class="xy"><span class="fontw">当前位置：</span>内容管理 > 修改栏目</p>

    <div class="content">
        <form action="<?php echo  U ('content/Category/update');?>" method="post" enctype="multipart/form-data">
        		<input name="oldparentid" type="hidden" value="<?php echo ($vo["pid"]); ?>"/>
	<input name="id" type="hidden" value="<?php echo ($vo["id"]); ?>"/>
            <table class="myaddhome">
                <tr class="graybg">
                    <td class="textr" width="10%">
                        <span class="fontw">栏目名称：</span>
                    </td>
                    <td class="textl"  colspan="7">
                        <input maxlength="40" type="text" name="name" class="myinput" value="<?php echo ($vo["name"]); ?>" id="f1">
                    </td>
                </tr>
                <tr class="whitebg">
                    <td class="textr" width="10%">
                        <span class="fontw">上级栏目：</span>
                    </td>
                    <td class="textl"  colspan="7">
                     <select name="pid">
         <option value="0" <?php if($vo["pid"] ==  0): ?>selected="selected"<?php endif; ?>>首页</option>
       <?php if(is_array($categoryList)): ?><?php $i = 0;?><?php $__LIST__ = $categoryList?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$cat): ?><?php ++$i;?><?php $mod = ($i % 2 )?><option value="<?php echo ($cat['id']); ?>" <?php if(($vo['pid'] == $cat['id']) OR ($pid == $cat['id']) ): ?>selected="selected"<?php endif; ?>>
       <?php echo ($cat["name"]); ?></option><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
        </select>
                    </td>
                </tr>
                <tr class="graybg">
                    <td class="textr" width="10%">
                        <span class="fontw">选择列表布局：</span>
                    </td>
                    <td class="textl"  colspan="7">
                   <select name="sitelistlayoutid">
							<option value="1">1</option>
						<?php if(is_array($list)): ?><?php $i = 0;?><?php $__LIST__ = $list?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$row): ?><?php ++$i;?><?php $mod = ($i % 2 )?><option value="<?php echo ($row['sitelayoutid']); ?>" <?php if($row["sitelayoutid"] ==  vo.sitelistlayoutid): ?>selected="selected"<?php endif; ?>>
					<?php echo ($row["imageurl"]); ?></option><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
				</select>
                    </td>
                </tr>
                <tr class="whitebg">
                    <td class="textr" width="10%">
                        <span class="fontw">选择内容布局：</span>
                    </td>
                    <td class="textl"  colspan="7">
             <select name="sitecontentlayoutid">
							<option value="1">1</option>
						<?php if(is_array($listcontent)): ?><?php $i = 0;?><?php $__LIST__ = $listcontent?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$row): ?><?php ++$i;?><?php $mod = ($i % 2 )?><option value="<?php echo ($row['sitelayoutid']); ?>" <?php if($row["sitelayoutid"] ==  vo.sitelistlayoutid): ?>selected="selected"<?php endif; ?> ><?php echo ($row['imageurl']); ?></option><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
				</select>
                    </td>
                </tr>
            

                <tr class="graybg">
                    <td class="textr" width="10%">
                        <span class="fontw">选择栏目模型：</span>
                    </td>
                    <td class="textl" colspan="7">
                     <?php echo ($vo["model"]["name"]); ?>
                    </td>

                </tr>
                <tr class="whitebg">
                    <td class="textc btnbg" colspan="8">
                        <input type="submit" value="提 交"/>
                      <input type="button" value="返 回" onclick="window.location.href='__URL__'"/>

                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
	  <script type="text/javascript">
		            var f1 = new LiveValidation('f1', {onlyOnSubmit: true ,validMessage: " "});
		            f1.add(Validate.Presence, {failureMessage: "不能为空!"});
					  var automaticOnSubmit = f1.form.onsubmit;
          f1.form.onsubmit = function(){
	          var valid = automaticOnSubmit();
	          if(valid){return true;}
            return false;
          }
		          </script>