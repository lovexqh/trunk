<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__PUBLIC__/admin/js/admin.js" defer="defer"></script>
<link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
<link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1">
    <p class="xy">
        <span class="fontw">当前位置：</span>全局管理 >站点配置
    </p>
    <div class="content">
        <form action="<?php echo U('admin/Global/doSetSiteOpt');?>" method="post" enctype="multipart/form-data">
            <table class="myaddhome">
                <tr class="graybg">
                    <td class="textr" width="10%">
                        <span class="fontw">站点名称：</span>
                    </td>
                    <td class="textl" colspan="7">
                        <input maxlength="40" type="text" name="site_name" class="myinput" value="<?php echo ($site_name); ?>">
                    </td>
                </tr>
                <tr class="whitebg">
                    <td class="textr" width="10%">
                        <span class="fontw">默认标题：</span>
                    </td>
                    <td class="textl" colspan="7">
                        <input maxlength="40" type="text" name="site_header_title" value='<?php echo ($site_header_title); ?>' class="myinput" id="bname">
                    </td>
                </tr>
                <tr class="graybg">
                    <td class="textr" width="10%">
                        <span class="fontw">默认关键字：</span>
                    </td>
                    <td class="textl" colspan="7">
                        <input maxlength="40" type="text" name="site_header_keywords" value='<?php echo ($site_header_keywords); ?>' class="myinput" id="bname">
                    </td>
                </tr>
                <tr class="whitebg">
                    <td class="textr" width="10%">
                        <span class="fontw">默认描述信息：</span>
                    </td>
                    <td class="textl" colspan="7">
                        <input maxlength="40" type="text" name="site_header_description" value='<?php echo ($site_header_description); ?>' class="myinput" id="bname">
                    </td>
                </tr>
                <tr class="graybg">
                    <td class="textr" width="10%">
                        <span class="fontw">ICP备案：</span>
                    </td>
                    <td class="textl" colspan="7">
                        <input maxlength="40" type="text" name="site_icp" value='<?php echo ($site_icp); ?>' class="myinput" id="bname">
                    </td>
                </tr>
                <tr class="whitebg">
                    <td class="textc btnbg" colspan="8">
                        <input type="submit" value="提 交"/><input type="reset" value="重 置"/><input type="button" value="返 回"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>