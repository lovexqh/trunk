<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
    window.UEDITOR_HOME_URL = "__PUBLIC__/ueditor_1_2_0/";
</script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/ueditor_1_2_0/editor_config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/ueditor_1_2_0/editor_all_min.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/js/ImgObject.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/ueditor_1_2_0/themes/default/ueditor.css"/>
<link rel="stylesheet" href="__PUBLIC__/admin/css/consolidated_common.css" type="text/css"/>
<script src="__PUBLIC__/admin/js/livevalidation.js" type="text/javascript"></script>
<script src="http://api.map.baidu.com/api?v=1.3" type="text/javascript"></script>
<link rel="stylesheet" href="__PUBLIC__/admin/css/reset.css" type="text/css"/>
<link rel="stylesheet" href="__PUBLIC__/admin/css/adminmain.css" type="text/css"/>
<style type="text/css">
    #mapcontainer {
        width: 600px;
        height: 300px;
    }
.showimg div{float: left;margin-right: 10px;text-align: center;width:150px;height:130px;}
    .showimg img{display: block;}
</style>
<div class="container solid1">
    <p class="xy"><span class="fontw">当前位置：</span>房屋管理 >修改房屋
        <span style="color:red;">&nbsp;&nbsp;*内容全部为必填项,无法提交时请注意红色边框提示！</span>
    </p>

    <div class="content">
        <form action="<?php echo U('house/Home/update');?>" method="post" enctype="multipart/form-data">
            <table class="myaddhome">
                <tr class="graybg">
                    <td class="textr" width="10%">
                        <span class="fontw">标题：</span>
                    </td>
                    <td class="textl" width="15%">
                        <input maxlength="100" title="必填" type="text" name="title" value="<?php echo ($vo["title"]); ?>" class="myinput"
                               id="f1">
                    </td>
                                        <td class="textr" width="10%">
                        <span class="fontw">类型：</span>
                    </td>
                    <td class="textl" width="15%">
                        <select name="type" title="必选" id="f2" onchange="typechange(this)">
                            <option value="">---请选择---</option>
                                <option value="3" <?php if($vo['type'] == 3): ?>selected="selected"<?php endif; ?>>出售 </option>
                                <option value="4" <?php if($vo['type'] == 4): ?>selected="selected"<?php endif; ?>>出租 </option>
                        </select>
                    </td>
                    <td class="textr" width="10%">
                        <span class="fontw">房源类型：</span>
                    </td>
                    <td class="textl" width="15%">
                        <select name="hometypeid" title="必选" id="f2">
                            <?php if(is_array($homeType)): ?><?php $i = 0;?><?php $__LIST__ = $homeType?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$homeType): ?><?php ++$i;?><?php $mod = ($i % 2 )?><option
                                <?php if($vo['hometypeid'] == $homeType['id']): ?>selected="selected"<?php endif; ?>
                                value="<?php echo ($homeType["id"]); ?>"><?php echo ($homeType["name"]); ?></option><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
                        </select>
                    </td>
                    <td width="10%" class="textr"><span class="fontw">关键字：</span></td>
                    <td class="textl" width="15%">
                        <input type="text" title="必填" maxlength="20" value="<?php echo ($vo["keywords"]); ?>"class="myinput" name="keywords" id="f3">
                    </td>

                </tr>
                <tr class="whitebg">
                    <td width="10%" class="textr"><span class="fontw">朝向：</span></td>
                    <td class="textl" width="15%">
                        <input name="face" title="必填" id="f4" value="<?php echo ($vo["face"]); ?>" maxlength="20" class="myinput"/>
                    </td>
                    <td class="textr"><span class="fontw">户型：</span></td>
                    <td class="textl">
                        <input name="homesize" title="必填整数" id="f5" maxlength="3" value="<?php echo ($vo["homesize"]); ?>" class="width30"/> 室
                        <input title="必填数字" id="f6" value="<?php echo ($vo["parlour"]); ?>" name="parlour" maxlength="3" class="width30"/>厅
                        <input name="toilet" value="<?php echo ($vo["toilet"]); ?>" maxlength="3" id="f7" title="必填整数" class="width30"/>卫
                    </td>
                    <td class="textr"><span class="fontw">户型面积：</span></td>
                    <td class="textl">
                        <input name="square" maxlength="10" id="f8" value="<?php echo ($vo["square"]); ?>" title="必填整数" class="width30"/> 平米
                    </td>
                    <td class="textr"><span class="fontw">层数：</span></td>
                    <td class="textl">
                        第 <input name="myhigh" id="f9" maxlength="3" title="必填数字" value="<?php echo ($vo["myhigh"]); ?>" class="width30"/>
                        /
                        <input name="high" title="必填数字" id="f10" value="<?php echo ($vo["high"]); ?>" maxlength="3" class="width30"/> 层数
                    </td>
                    
                </tr>
                <tr class="graybg">
                    <td class="textr"><span class="fontw">装修：</span></td>
                    <td class="textl"><select name="fitment">
                        <option
                        <?php if($vo['fitment'] == 1): ?>selected="selected"<?php endif; ?>
                        value="1">普通装修</option>
                        <option
                        <?php if($vo['fitment'] == 2): ?>selected="selected"<?php endif; ?>
                        value="2">精装修</option>
                    </select></td>

                    <td class="textr" width="10%">
                        <span class="fontw">地址：</span>
                    </td>
                    <td class="textl" width="15%">
                        <input maxlength="100" title="必填" value="<?php echo ($vo["address"]); ?>" id="f11" type="text" name="address"
                               class="myinput">
                    </td>
                    <td class="textr" width="10%"><span class="fontw">小区：</span></td>
                    <td class="textl" width="15%"><select name="homeregionid" title="必选" id="f12"  onchange="getHomeRegion(this.value)">
                        <?php if(is_array($homeRegion)): ?><?php $i = 0;?><?php $__LIST__ = $homeRegion?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$region): ?><?php ++$i;?><?php $mod = ($i % 2 )?><option
                            <?php if($vo['homeregionid'] == $region['id']): ?>selected="selected"<?php endif; ?>
                            value="<?php echo ($region["id"]); ?>"><?php echo ($region["name"]); ?></option><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
                    </select></td>
                    <td class="textr"><span class="fontw">价格：</span></td>
                    <td class="textl" colspan="3">
                        <input name="price" maxlength="10" id="f15" title="必填整数" class="width30" value="<?php echo ($vo["price"]); ?>"> <span id="etype">元/月</span>
                    </td>

                </tr>
                <tr class="whitebg">
                    <td class="textr"><span class="fontw">房屋配置：</span></td>
                    <td class="textl" colspan="7" id="myconfig">
                        <?php if(is_array($homeConfig)): ?><?php $i = 0;?><?php $__LIST__ = $homeConfig?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$config): ?><?php ++$i;?><?php $mod = ($i % 2 )?><input type="checkbox" value="<?php echo ($config["id"]); ?>" class="houseconfig"/><?php echo ($config["name"]); ?>&nbsp;<?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
                         <input type="button" id="selectall" class="houseselall" value="全选">
                    </td>
                </tr>
                <tr class="graybg" >
                    <td class="textr" width="10%">
                        <span class="fontw">户型图：</span>
                    </td>
	                <td colspan="7">
	                	<div id="timage" ></div>
	                </td>
                </tr>
                 <tr class="whitebg">
	                 <td class="textr" width="10%">
	                        <span class="fontw">小区图：</span>
	                    </td>
		                <td colspan="7">
		                	<div id="oimage" ></div>
		                </td>
                 </tr>
                <tr class="graybg" height="165px">
                    <td class="textr" width="10%">
                        <span class="fontw">房屋描述：</span>
                    </td>
                    <td class="textl" colspan="3">
                        <textarea cols="82" rows="10" style="width:370px;" title="必填字数小于5000字" id="f13" name="description"><?php echo ($vo["description"]); ?></textarea>
                    </td>
                    <td class="textr"><span class="fontw">小区描述：</span></td>
                    <td class="textl" colspan="3">
                        <textarea style="width:370px;" title="必填字数小于5000字" id="f14" cols="82" rows="10" name="village"><?php echo ($vo["village"]); ?></textarea>
                    </td>

                </tr>
                <tr class="whitebg" height="145px">
                    <td class="textr">
                        <span class="fontw">图片上传：</span>
                    </td>
                    <td class="textl" colspan="7">
                        
                    </td>
                </tr>
                <tr class="whitebg" height="145px">
                    <td class="textr">
                        <span class="fontw">地理位置：</span>
                    </td>
                    <td class="textl">
                        <input id="location" title="必填" value="<?php echo ($vo["map"]); ?>" name="map" class="myinput" maxlength="50" size="20"/>
                    </td>
                    <td class="textl" colspan="6">
                        <div id="mapcontainer"></div>
                    </td>
                </tr>
                <tr class="graybg">
                    <td class="textc btnbg" colspan="8">
                        <input type="submit" value="提 交"/>
                        <input type="button" value="返 回" onclick="window.location.href='__URL__';"/>

                    </td>
                </tr>
            </table>
            <input id="homeconfigid" name="homeconfigid" type="hidden"/>
            <input value="<?php echo ($vo["homeconfigid"]); ?>" type="hidden" id="oldconfig"/>
            <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>"/>
			  <input type="hidden" name="userid" value="<?php echo ($_SESSION[C('USER_AUTH_KEY')]); ?>" />
            <input type="hidden" name="publish" value="1"/>
            <input type="hidden" id="editimgs" name="thumb" value="<?php echo ($vo["thumb"]); ?>">
             <input type="hidden" id="oimageipt" name="oimage" value="<?php echo ($oimage); ?>">
              <input type="hidden" id="timageipt" name="timage" value="<?php echo ($timage); ?>">
        </form>
    </div>
</div>
<script type="text/javascript">
function forAdd(str,add){
    return add+str.split(",").join(","+add);
}
function putImg(s){
    var imgs = s.split(",");
    for(var i=0,url;url=imgs[i++];){
        var img = document.createElement("img");
        img.src = url;
        document.body.appendChild(img);
    }
}
function getHomeRegion(rid){
    UE.ajax.request("__GROUP__/HomeRegion/getHomeRegion/id/"+rid,{
        type:"post",
        onsuccess:function(data){
            var obj = eval('('+data.responseText+')');
            document.getElementById("timageipt").value=obj.timage;
            document.getElementById("oimageipt").value=obj.oimage;
            document.getElementById("f14").value=obj.remark;
            var oimage =forAdd(obj.oimage, "/Tpl/Uploads/s_");
            var timage =forAdd(obj.timage, "/Tpl/Uploads/s_");
            var oimgobj = new ImgObject({
                str : oimage,
                name:"oimage[]"
            });
            var timgobj = new ImgObject({
                str : timage,
                name:"timage[]"
            });
                oimgobj.render("oimage");
                timgobj.render("timage");
            ue1.setContent(obj.remark);
//            putImg(s);
        }
    })
}
var oimgobj = new ImgObject({
    str : forAdd(document.getElementById( 'oimageipt' ).value, "/Tpl/Uploads/s_"),
    name:"oimage[]"
});
var timgobj = new ImgObject({
    str :forAdd( document.getElementById( 'timageipt' ).value, "/Tpl/Uploads/s_"),
    name:"timage[]"
});
    oimgobj.render("oimage");
    timgobj.render("timage");

    (function () {
        //初始化房屋配置
        var config = document.getElementById( 'oldconfig' ).value;
        var allconfig = document.getElementById( 'myconfig' ).getElementsByTagName( 'input' );
        var myconfig = config.split( ',' );
        for ( var j = 0, b; b = myconfig[j++]; ) {
            for ( var i = 0, a; a = allconfig[i++]; ) {
                if ( b == a.value ) {
                    a.checked = true;
                    break;
                }
            }
        }
    })();

    //location
    var local = document.getElementById( "location" );
    local.onblur = function () {
        initMap();
    }
    var initMap = function () {
        //地图
        var map = new BMap.Map( "mapcontainer" ); // 创建地图实例 创建地图实例
        var myGeo = new BMap.Geocoder();
        myGeo.getPoint( local.value, function ( point ) {
            if ( point ) {
                map.centerAndZoom( point, 16 );
                map.addOverlay( new BMap.Marker( point ) );
            }
        }, "北京市" );
    }
    initMap();

</script>
<script type="text/javascript">
    var f1 = new LiveValidation( 'f1', {onlyOnSubmit:true, validMessage:" "} );
    f1.add( Validate.Presence, {failureMessage:" "} );
    var f2 = new LiveValidation( 'f2', {onlyOnSubmit:true, validMessage:" "} );
    f2.add( Validate.Presence, {failureMessage:" "} );
    var f3 = new LiveValidation( 'f3', {onlyOnSubmit:true, validMessage:" "} );
    f3.add( Validate.Presence, {failureMessage:" "} );
    var f4 = new LiveValidation( 'f4', {onlyOnSubmit:true, validMessage:" "} );
    f4.add( Validate.Presence, {failureMessage:" "} );
    var f5 = new LiveValidation( 'f5', {onlyOnSubmit:true, validMessage:" "} );
    f5.add( Validate.Presence, {failureMessage:" "} );
    f5.add( Validate.Numericality, { onlyInteger:true, failureMessage:" "} );
    f5.add( Validate.Numericality, { minimum:0, failureMessage:" "} );
    var f6 = new LiveValidation( 'f6', {onlyOnSubmit:true, validMessage:" "} );
    f6.add( Validate.Numericality, { onlyInteger:true, failureMessage:" "} );
    f6.add( Validate.Presence, {failureMessage:" "} );
    f6.add( Validate.Numericality, { minimum:0, failureMessage:" "} );
    var f7 = new LiveValidation( 'f7', {onlyOnSubmit:true, validMessage:" "} );
    f7.add( Validate.Numericality, { onlyInteger:true, failureMessage:" "} );
    f7.add( Validate.Presence, {failureMessage:" "} );
    f7.add( Validate.Numericality, { minimum:0, failureMessage:" "} );
    var f8 = new LiveValidation( 'f8', {onlyOnSubmit:true, validMessage:" "} );
    f8.add( Validate.Numericality, {failureMessage:" "} );
    f8.add( Validate.Presence, {failureMessage:" "} );
    f8.add( Validate.Numericality, { minimum:0, failureMessage:" "} );
    var f9 = new LiveValidation( 'f9', {onlyOnSubmit:true, validMessage:" "} );
    f9.add( Validate.Numericality, { onlyInteger:true, failureMessage:" "} );
    f9.add( Validate.Presence, {failureMessage:" "} );
    f9.add( Validate.Numericality, { minimum:0, failureMessage:" "} );
    var f10 = new LiveValidation( 'f10', {onlyOnSubmit:true, validMessage:" "} );
    f10.add( Validate.Numericality, { onlyInteger:true, failureMessage:" "} );
    f10.add( Validate.Presence, {failureMessage:" "} );
    f10.add( Validate.Numericality, { minimum:0, failureMessage:" "} );
    var f11 = new LiveValidation( 'f11', {onlyOnSubmit:true, validMessage:" "} );
    f11.add( Validate.Presence, {failureMessage:" "} );
    var f12 = new LiveValidation( 'f12', {onlyOnSubmit:true, validMessage:" "} );
    f12.add( Validate.Presence, {failureMessage:" "} );
    var f15 = new LiveValidation( 'f15', {onlyOnSubmit:true, validMessage:" "} );
    f15.add( Validate.Numericality, { onlyInteger:true, failureMessage:" "} );
    f15.add( Validate.Presence, {failureMessage:" "} );
    f15.add( Validate.Numericality, { minimum:0, failureMessage:" "} );
    var location2 = new LiveValidation( 'location', {onlyOnSubmit:true, validMessage:" "} );
    location2.add( Validate.Presence, {failureMessage:" "} );
    var automaticOnSubmit = f1.form.onsubmit;
    f1.form.onsubmit = function () {
        var valid = automaticOnSubmit();
        var result = '';
        var allconfig = document.getElementById( 'myconfig' ).getElementsByTagName( 'input' );
        for ( var i = 0, check; check = allconfig[i++]; ) {
            if ( check.checked ) {
                result += check.value + ',';
            }
        }
        document.getElementById( 'homeconfigid' ).value = result;
		var content = ue.getContent();
		var content1 = ue1.getContent();
		if (content.length < 10000&&content1.length < 10000) {
			if (valid) {
				return true;
			}
			else {
				alert('提交内容有误，请查看红色提示框！');
			}
		}else{
			alert('请减少小区描述或者房源描述的字数！');
		}
        return false;
    }

    //编辑器
    var ue = new baidu.editor.ui.Editor({
        toolbars:[['Bold', 'Italic', 'Underline','|','ForeColor', 'BackColor', 'InsertOrderedList', 'InsertUnorderedList']],
        textarea:"description",
        elementPathEnabled:false,
        maximumWords:500,
        minFrameHeight:150,
        autoHeightEnabled:false
    });
    ue.render('f13');
    var ue1 = new baidu.editor.ui.Editor({
        toolbars:[['Bold', 'Italic', 'Underline','|','ForeColor', 'BackColor', 'InsertOrderedList', 'InsertUnorderedList']],
        textarea:"village",
        elementPathEnabled:false,
        maximumWords:500,
        minFrameHeight:130,
        autoHeightEnabled:false
    });
    ue1.render('f14');
</script>
<script type="text/javascript">
    var URL = "__URL__",
        //全局变量
        imageUrls = [],          //用于保存从服务器返回的图片信息数组
        selectedImageCount = 0;  //当前已选择的但未上传的图片数量
    setTimeout(function(){
        //创建Flash相关的参数集合
        var flashOptions = {
            container:"flashContainer",                                                    //flash容器id
            url:URL+'/uploadImg',                                  // 上传处理页面的url地址
            ext:'',                             //可向服务器提交的自定义参数列表
            fileType:'{"description":"图片", "extension":"*.gif;*.jpeg;*.png;*.jpg"}',     //上传文件格式限制
            flashUrl:'__PUBLIC__/ueditor_1_2_0/dialogs/image/imageUploader.swf',                                                  //上传用的flash组件地址
            width:608,          //flash的宽度
            height:272,         //flash的高度
            gridWidth:121,     // 每一个预览图片所占的宽度
            gridHeight:120,    // 每一个预览图片所占的高度
            picWidth:100,      // 单张预览图片的宽度
            picHeight:100,     // 单张预览图片的高度
            uploadDataFieldName:'name',    // POST请求中图片数据的key
            picDescFieldName:'pictitle',      // POST请求中图片描述的key
            maxSize:2,                         // 文件的最大体积,单位M
            compressSize:1,                   // 上传前如果图片体积超过该值，会先压缩,单位M
            maxNum:32,                         // 单次最大可上传多少个文件
            backgroundUrl:'',                 // flash界面的背景图片,留空默认
            listBackgroundUrl:'',            // 单个预览框背景，留空默认
            buttonUrl:'',                     // 上传按钮背景，留空默认
            mode:"",                    //可选add添加，只显示上传   update修改，只显示图片管理
            getImgs:function(){
                return $G("editimgs").value.split(",");
            },
            delImg:function(url){
                var reg = new RegExp(",?"+url);
                $G("editimgs").value = $G("editimgs").value.replace(reg,"").replace(/^,?/,"");
            },
            defaultImg:function(){
                var reg = new RegExp(",?"+url);
                       $G("editimgs").value = url+","+$G("editimgs").value.replace(reg,"");
            }
        };
        //回调函数集合，支持传递函数名的字符串、函数句柄以及函数本身三种类型
        var callbacks={
            // 选择文件的回调
            selectFileCallback: function(selectFiles){
                selectedImageCount += selectFiles.length;
                if(selectedImageCount) baidu.g("upload").style.display = "";
                dialog.buttons[0].setDisabled(true); //初始化时置灰确定按钮
            },
            // 删除文件的回调
            deleteFileCallback: function(delFiles){
                selectedImageCount -= delFiles.length;
                if (!selectedImageCount) {
                    baidu.g("upload").style.display = "none";
                    dialog.buttons[0].setDisabled(false);         //没有选择图片时重新点亮按钮
                }
            },
            // 单个文件上传完成的回调
            uploadCompleteCallback: function(data){
                try{
                    var info = eval("(" + data.info + ")");
                    info && imageUrls.push(info);
                    selectedImageCount--;
                    $G("editimgs").value += ","+info.url;
                }catch(e){}},
            // 单个文件上传失败的回调,
            uploadErrorCallback: function (data){
                //console && console.log(data);
            },
            // 全部上传完成时的回调
            allCompleteCallback: function(){
                $G("editimgs").value = $G("editimgs").value.replace(/^,/ig,"");
                dialog.buttons[0].setDisabled(false);
            }
        };
        imageUploader.init(flashOptions,callbacks);
    },300);
    function initBtn() {
        var cont = document.getElementById( "myconfig" );
        var selectall = document.getElementById( "selectall" );
        selectall.onclick = function () {
            var iptlist = cont.getElementsByTagName( "input" );
            for ( var i = 0, ipt; ipt = iptlist[i++]; ) {
                ipt.checked = "true";
            }
        }
    }
    initBtn();

</script>