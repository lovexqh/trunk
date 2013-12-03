<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="__PUBLIC__/admin/css/consolidated_common.css" type="text/css"/>

<script src="__PUBLIC__/js/livevalidation.js" type="text/javascript"></script>
<link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
<link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1">
    <p class="xy"><span class="fontw">当前位置：</span>房屋管理 > 修改房屋查看历史</p>

    <div class="content">
        <form action="<?php echo U('house/HomeHistory/saveOrUpdate');?>" method="post" enctype="multipart/form-data" >
            <table class="myaddhome">
              <tr class="whitebg">
                    <td class="textr" width="10%">
                        <span class="fontw">创建时间：</span>
                    </td>
                    <td class="textl"  colspan="7">
                        <?php echo (toDate($vo["createtime"],'Y-m-d H#i#s')); ?>
                    </td>
                </tr>

                <tr class="graybg" height="165px">
                    <td class="textr" width="10%">
                        <span class="fontw">备注：</span>
                    </td>
                    <td class="textl" colspan="7">
                        <textarea cols="82" rows="10" id="f2" name="remark" ><?php echo ($vo["remark"]); ?></textarea>
                    </td>

                </tr>
                <tr class="whitebg">
                    <td class="textc btnbg" colspan="8">
                        <input type="submit" value="提 交"/>
                          <input type="button" value="返 回" onclick="window.location.href='__URL__/index/homeid/<?php echo ($vo["homeid"]); ?>'"/>

                    </td>
                </tr>
            </table>
			<input name="id" type="text" value="<?php echo ($vo["id"]); ?>"/>
			<input name="username"type="text" value="<?php echo ($vo["username"]); ?>"/>
			<input name="userid"type="text" value="<?php echo ($vo["userid"]); ?>"/>
			<input name="homeid" type="text" value="<?php echo ($vo["homeid"]); ?>"/>
        </form>
    </div>
</div>

	  <script type="text/javascript">
					
					  var f2 = new LiveValidation('f2',{onlyOnSubmit: true ,validMessage: " "} );
					      f2.add(Validate.Presence, {failureMessage: "不能为空!"});
		            f2.add(Validate.Length, { maximum: 1000} );
					
					  var automaticOnSubmit = f2.form.onsubmit;
          f2.form.onsubmit = function(){
	          var valid = automaticOnSubmit();
	          if(valid){return true;}
            return false;
          }
		          </script>