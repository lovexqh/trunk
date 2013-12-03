<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__PUBLIC__/admin/js/admin.js" defer="defer"></script>
<link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
<link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<div class="container solid1">
    <p class="xy"><span class="fontw">当前位置：</span>房屋管理</p>

    <form action="<?php echo U('house/Home/index');?>" method="GET">

        <div class="solid1 homesearch">
            <p><span>类型：<select name="hometypeid">
                <option value="">----请选择----</option>
                <?php if(is_array($homeType)): ?><?php $i = 0;?><?php $__LIST__ = $homeType?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$homeType): ?><?php ++$i;?><?php $mod = ($i % 2 )?><option
                    <?php if($hometypeid == $homeType['id']): ?>selected="selected"<?php endif; ?>
                    value="<?php echo ($homeType["id"]); ?>"><?php echo ($homeType["name"]); ?></option><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
            </select>
</span>
<span>状态:<select name="publish">
	  <option value="-1" >----请选择----</option>
    <option value="0" <?php if($publish == 1): ?>selected="selected"<?php endif; ?> >已发布</option>
    <option
            value="1"<?php if($publish == 0): ?>selected="selected"<?php endif; ?>>未发布
    </option>
</select></span>
<span>小区：<select name="homeregionid">
    <option value="">----请选择----</option>
    <?php if(is_array($homeRegion)): ?><?php $i = 0;?><?php $__LIST__ = $homeRegion?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$region): ?><?php ++$i;?><?php $mod = ($i % 2 )?><option
        <?php if($homeregionid == $region['id']): ?>selected="selected"<?php endif; ?>
        value="<?php echo ($region["id"]); ?>"><?php echo ($region["name"]); ?></option><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
</select></span>
<span>户型：
<select name="homesize">
    <option value="">----请选择----</option>
    <option value="1"
    <?php if($homesize == 1): ?>selected="selected"<?php endif; ?>>
    1室</option>
    <option value="2"
    <?php if($homesize == 2): ?>selected="selected"<?php endif; ?>>
    2室</option>
    <option value="3"
    <?php if($homesize == 3): ?>selected="selected"<?php endif; ?>>
    3室</option>
    <option value="+"
    <?php if($homesize == '+'): ?>selected="selected"<?php endif; ?>>
    3室以上</option></select></span>

            </p>
            <p>
	<span>
价格：<input name="price1" class="width50" size="10" value="<?php echo ($price1); ?>"/> - <input class="width50" name="price2"
                                                                               value="<?php echo ($price2); ?>" size="10"/> 元
</span>
	<span>
    面积：<input name="square1" class="width50" value="<?php echo ($square1); ?>" size="10"/> - <input class="width50" name="square2"
                                                                                     value="<?php echo ($square2); ?>" size="10"/> 平米
</span>
<input type="hidden" name="app" value="House"/>
<input type="hidden" name="mod" value="Home"/>
<input type="hidden" name="act" value="index"/>
                <input value="搜 索" type="submit" class="searchbut"/>
            </p>
        </div>
    </form>
    <p class="addbtn"><a href="<?php echo U('house/Home/add',array('type'=>$type));?>"><span class="addbtnbg">添加房源</span></a>  
	<input type="button" onclick="allSelect()" class="searchbut" value="全 选">&nbsp;
        <input type="button" onclick="InverSelect()" class="searchbut" value="反 选">&nbsp;
        <input type="button" onclick="allUnSelect()" class="searchbut" value="全 否" >&nbsp;
        <input type="button" onclick="deleteSelect('__URL__')" class="searchbut" value="删除">&nbsp;</p>

    <notempty name="list">
    <div class="content">
        <table id="selectstate">
            <tr class="homeheard">
                <td>选择</td>
                <td width="12%">标题</td>
                <td width="27%">地址</td>
				<td>状态</td>
                <td>创建日期</td>
                <td>操作</td>
            </tr>
            <?php if(is_array($list)): ?><?php $i = 0;?><?php $__LIST__ = $list?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$content): ?><?php ++$i;?><?php $mod = ($i % 2 )?><tr
                <?php if(($mod)  ==  "0"): ?>class="graybg"<?php endif; ?>
                <?php if(($mod)  ==  "1"): ?>class="whitebg"<?php endif; ?>
                >
                <td><input type="checkbox" value="<?php echo ($content["id"]); ?>" /></td>
                <td><?php echo ($content["title"]); ?></td>
                <td><?php echo ($content["address"]); ?></td>
				<td><?php if($content["publish"] == 0): ?>待审核
					<?php else: ?>已发布<?php endif; ?>
	</td>
                <td><?php echo (toDate($content["createtime"],'Y-m-d')); ?></td>
                <td class="managehometd">
                    <!--<a href="__URL__/read/id/<?php echo ($content["id"]); ?>"><img src="__PUBLIC__/admin/images/showhome.gif"/>预览</a> | -->
					  <a href="<?php echo U('house/HomeHistory/add',array('homeid'=>$content['id']));?>"><img
                        src="__PUBLIC__/admin/images/homeremark.gif"/>备注</a> | 
						  <a href="<?php echo U('house/HomeHistory/index',array('homeid'=>$content['id']));?>"><img
                        src="__PUBLIC__/admin/images/homehistory.gif"/>历史</a> | 
                    <a href="<?php echo U('house/Home/edit',array('id'=>$content['id']));?>"><img
                        src="__PUBLIC__/admin/images/updatehome.gif"/>修改</a>
                </td>
                </tr><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>


            <tr class="homeheard mypage">
                <td colspan="6">&nbsp

                    <?php echo ($page); ?>

                </td>
            </tr>
        </table>
    </div>
</div>
</notempty>