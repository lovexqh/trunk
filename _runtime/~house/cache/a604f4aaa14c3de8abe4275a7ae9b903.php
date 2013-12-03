<?php if (!defined('THINK_PATH')) exit();?><script>
function Jump(){
    window.location.href = '<?php echo ($jumpUrl); ?>';
}
document.onload = setTimeout("Jump()" , <?php echo ($waitSecond); ?>* 1000);
</script>
<link href="<?php echo ($publicCss); ?>" rel="stylesheet" type="text/css">
<base target="_self" />

<?php if(($status)  ==  "1"): ?><div class="Prompt">
  <div class="Prompt_top"></div>
  <div class="Prompt_con">
    <dl>
      <dt>提示信息</dt>
      <dd><span class="Prompt_ok"></span></dd>
      <dd>
        <h2><?php echo ($message); ?></h2>
        <?php if(isset($closeWin)): ?><p>系统将在 <span style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动关闭，如果不想等待,直接点击 <A HREF="<?php echo ($jumpUrl); ?>">这里</A> 关闭</p><?php endif; ?>
        <?php if(!isset($closeWin)): ?><p>系统将在 <span style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动跳转,如果不想等待,直接点击 <A HREF="<?php echo ($jumpUrl); ?>">这里</A> 跳转<br/>
            或者 <a href="<?php if(APP_NAME=='admin' || ACTION_NAME=='Admin'){echo U('admin/Index/index');}else{echo "__ROOT__/" ;} ?>">返回首页</a></p><?php endif; ?>
      </dd>
    </dl>
    <div class="c"></div>
    </div>
    <div class="Prompt_btm"></div>
  </div><?php endif; ?>
<?php if(($status)  ==  "0"): ?><div class="Prompt">
    <div class="Prompt_top"></div>
  <div class="Prompt_con">
    <dl>
      <dt>提示信息</dt>
      <dd><span class="Prompt_x"></span></dd>
      <dd>
      <h2 style="color:red"><?php echo ($message); ?></h2>
        <?php if(isset($closeWin)): ?><p>系统将在 <span style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动关闭，如果不想等待,直接点击 <A HREF="<?php echo ($jumpUrl); ?>">这里</A> 关闭</p><?php endif; ?>
      <?php if(!isset($closeWin)): ?><p>系统将在 <span style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动跳转,如果不想等待,直接点击 <A HREF="<?php echo ($jumpUrl); ?>">这里</A> 跳转<br/>
          或者 <a href="<?php if(APP_NAME=='admin' || ACTION_NAME=='Admin'){echo U('admin/Index/index');}else{echo "__ROOT__/" ;} ?>">返回首页</a></p><?php endif; ?>
      </dd>
    </dl>
    <div class="c"></div>
    </div>
    <div class="Prompt_btm"></div>
  </div><?php endif; ?>