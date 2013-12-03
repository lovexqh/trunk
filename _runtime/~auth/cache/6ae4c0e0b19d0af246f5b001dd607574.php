<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
<link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1">
    <p class="xy"><span class="fontw">当前位置：</span>节点管理 > 修改节点</p>

    <div class="content">
        <form action="<?php echo U('auth/Node/update');?>" method="post" enctype="multipart/form-data" >
        	  <input  type="hidden" name="id"  value="<?php echo ($vo["id"]); ?>">
            <table class="myaddhome">
                <tr class="graybg">
                    <td class="textr" width="10%">
                        <span class="fontw">标题：</span>
                    </td>
                    <td class="textl"  colspan="7">
                        <input maxlength="40" type="text" name="title"  class="myinput" value="<?php echo ($vo["title"]); ?>">
                    </td>
                </tr>
                <tr class="whitebg">
                    <td class="textr" width="10%">
                        <span class="fontw">名称：</span>
                    </td>
                    <td class="textl"  colspan="7">
                        <input maxlength="40" type="text" name="name" value='<?php echo ($vo["name"]); ?>' class="myinput" id="bname">
                    </td>
                </tr>
                 <tr class="whitebg">
                    <td class="textr" width="10%">
                        <span class="fontw">是否显示为菜单：</span>
                    </td>
                    <td class="textl"  colspan="7">
                        <input maxlength="40" type="radio" name="ismenu"  checked="checked" <?php if(($vo["ismenu"])  ==  "1"): ?>checked="checked"<?php endif; ?> value="1" >是
                        <input maxlength="40" type="radio" name="ismenu"  <?php if(($vo["ismenu"])  ==  "0"): ?>checked="checked"<?php endif; ?> value="0" >否
                    </td>
                </tr>
  				<tr class="graybg">
                    <td class="textr" width="10%">
                        <span class="fontw">序号：</span>
                    </td>
                    <td class="textl"  colspan="7">
                        <input maxlength="40" type="text" name="sort"  class="myinput" value="<?php echo ($vo["sort"]); ?>">
                    </td>
                </tr>
                <tr class="whitebg">
                    <td class="textc btnbg" colspan="8">
                        <input type="submit" value="提 交"/>
                        <input type="reset" value="重 置"/>
                        <input type="button" value="返 回"/>

                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>