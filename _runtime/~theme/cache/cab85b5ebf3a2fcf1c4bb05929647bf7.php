<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link type="text/css" href="__THEME__/css/index.css" rel="stylesheet" />
    <?php if(($modify)  ==  "1"): ?><link type="text/css" href="__PUBLIC__/test/css/layout.css" rel="stylesheet" /><?php endif; ?>
    <script type="text/javascript" src="__PUBLIC__/test/jsframe/xf_api.js"></script>
</head>
<body>
<div id="container">
    <div class="topad edui-tpl-topad">
        <div id="topad_show">
        </div>
    </div>
  <div id="header">
      <!DOCTYPE html>
<html>
<head>
    <title></title>
    <link type="text/css" href="/Public/css/header.css" rel="stylesheet"/>
</head>
<body>
<div class="logo">
    <a href="/"><img src="/Public/images/logo.png"></a>
</div>
<div class="wrap_ipt">
    <form action="/index.php" method="get" onsubmit="return checkSub()">
        <input name="homeList" type="hidden"/>
        <input id="features" onclick="this.value=''" class="ipt" type="text" name="name" value="输入房源特征">
            <input name="search" id="search_button" type="submit" value="" class="btn-s">
    </form>
</div>
<div class="userstate">
<!-- 
	   <?php if($_SESSION[C('MEMBER_USER_AUTH_KEY')]==''): ?><a href="javascript:void('0');" onclick="login();">登陆</a> | <a href="javascript:void('0');" onclick="zc();">注册</a>
                   <?php else: ?><a href="__APP__/Home/HomeIndex/index">个人中心 </a> | <a href="__APP__/Member/Member/logout">退出</a><?php endif; ?> 
					-->
	
</div>
<div class="clear"></div>

<script type="text/javascript">
    //提交时清空输入房源特征
    function checkSub(){
        var ipt = document.getElementById("features");
        if(ipt.value="输入房源特征"){
            ipt.value = "";
        }
        //alert(ipt.value)
        return true;
    }
	      var dialog = new XF.ui.Dialog({
                                    title:"用户登录",
									className:"userlogin",
                                    content:'<div><div class="zhucebody"><img src="/Public/images/zhucebg.jpg" width="459px" border="0"/>'+
	'<form action="__APP__/Member/Member/login" method="post" onsubmit="return checklogin();"><ul class="zhuceinput"><li>用户名：<input name="name" maxlength="10" class="zhucemyinput" id="f101"/></li><li>密码：&nbsp;&nbsp;&nbsp;<input id="f102" maxlength="10" name="password" type="password"  class="zhucemyinput"/></li>'+
			'<li class="zhucebtn"><input type="submit" class="zhucey" value=""/>&nbsp;&nbsp;&nbsp;<input type="button" onclick="closelogin()" class="zhucec"/></li>'+
		'</ul></form></div></div>',
                                
                                });
								
								var dialog2 = new XF.ui.Dialog({
                                    title:"用户注册",
									className:"zhuce",
                            content:'<div><div class="zhucebody"><img src="/Public/images/zhucebg.jpg" width="459px" border="0"/>'+
	'<form action="__APP__/Member/Member/register" onsubmit="return checkregister();" method="post"><ul class="zhuceinput"><li>用户名：&nbsp;&nbsp;&nbsp;<input name="name" id="f103" maxlength="10" class="zhucemyinput"/></li><li>密码：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="password" maxlength="10" id="f104" type="password"  class="zhucemyinput"/></li>'+
			'<li>确认密码：<input maxlength="10" name="password" type="password" id="f105" class="zhucemyinput"/></li><li class="zhucebtn"><input type="submit" class="zhucey" value=""/>&nbsp;&nbsp;&nbsp;<input type="button" onclick="closezc();" class="zhucec"/></li>'+
		'</ul></form></div></div>',
                                
                                });
								function closelogin(){
									dialog.close();
								}
								function closezc(){
									dialog2.close();
								}
								function zc(){dialog2.open();}
								function login(){dialog.open();}
								  function checklogin(){
								  	var name = document.getElementById('f101').value;
								  	var pwd = document.getElementById('f102').value;
									if(name.length&&pwd.length){
										return true;
									}else{
										alert('用户名或密码不能为空！');
									}
									return false;
								  }
								    function checkregister(){
								  	var name = document.getElementById('f103').value;
								  	var pwd1 = document.getElementById('f104').value;
								  	var pwd2 = document.getElementById('f105').value;
									if(name.length&&pwd1.length&&pwd2.length){
										if(name.length>=5){
											if(pwd1.length>=5){
												
												if(pwd1 == pwd2){
													return true;
												}else{
													alert('密码与确认密码不一致!');
												}
											}else{
												alert('密码应大于等于5位！');
											}
										}else{
												alert('用户名应大于等于5位！');
										}
									}else{
										alert('用户名或密码不能为空！');
									}
									return false;
								  }
</script>

</body>

</html>
  </div>
  <div id="mainContent">
    <div class="sidebar edui-tpl-sidebar">
        <div id="sidebar_show">
        	<?php echo B("sidebar",$lid);?>
        </div>
    </div>
    <div id="content" class="edui-tpl-content">
        <div id="content_show">
			<?php echo B("content",$lid);?>
        </div>
    </div>
      <div class="clear"></div>
  </div>
  <div>
      <!DOCTYPE html>
<html>
<head>
    <title></title>
    <link type="text/css" href="/Public/css/footer.css" rel="stylesheet" />
</head>
<body>
	
	<div class="footbgline"></div>
<p class="footer">
    <a href="http://www.soufun.com/hezuo_file/house/index.html" target="_blank">网站合作</a>‖
    <a href="http://www.soufun.com/aboutus/contactus.html" target="_blank">联系我们</a>‖
    <a href="http://www.soufun.com/aboutus/marketing/index.html" target="_blank" >网络营销</a>‖
    <a href="http://www.soufun.com/zhaopin" target="_blank" >招聘信息</a>‖
    <a href="http://www.soufun.com/sitemap/sitemap.html" target="_blank" >网站地图</a>
</p>
</body>
</html>
  </div>
</div>
<input type="hidden" id="add" value="<?php echo U('theme/layout/addWdidget');?>">
<input type="hidden" id="lw" value="<?php echo U('theme/layout/listWidget');?>">
<input type="hidden" id="dw" value="<?php echo U('theme/layout/delWidget');?>">
<input type="hidden" id="ta" value="<?php echo U('theme/layout/toAddWidget');?>">
<input type="hidden" id="aw" value="<?php echo U('theme/layout/addWidget');?>">
<div  id="blocks" style="display:none"><?php echo ($blocks); ?></div>
<input type="hidden" id="te" value="<?php echo U('theme/layout/toEditWidget');?>">
<?php if(($modify)  ==  "1"): ?><script type="text/javascript" src="__PUBLIC__/test/js/layout.js"></script><?php endif; ?>
</body>
</html>