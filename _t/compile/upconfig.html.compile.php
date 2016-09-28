<?php !defined("__TPL_IN__") && exit(); ?><?php include $GLOBALS['__TPL__']->inc('../common/head.html'); ?><?php include $GLOBALS['__TPL__']->inc('menu.html'); ?><div style="width:500px;margin:50px auto;margin-top:200px;border:2px solid #999;background:#E4E4E4;text-align:center;padding:10px;">

<div style="text-align:left;font-size:16px;font-weight:bold;">
    	资料修改
    </div>
<div style="line-height:4em;">
<form action="<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=doupconfig" method="post" submittype="ajax">
        	原<?php echo lang('username'); ?>:<input type="text" class="text" value='<?php echo($username); ?>' /><br />
                             原<?php echo lang('password'); ?>:<input type="password" class="text" name="rpassword" /><br />
        <?php echo lang('username'); ?>:&nbsp;<input type="text" class="text" name="username" value='<?php echo($username); ?>'/><br />
            <?php echo lang('password'); ?>:&nbsp;<input type="password" class="text" name="password" /><br />
            
            
            <?php echo lang('password'); ?>1:<input type="password" class="text" name="password1" /><br />
            <?php echo lang('password'); ?>2:<input type="password" class="text" name="password2" /><br />
            
                       TIME: <input type="text" class="text" name="time" value='<?php echo($time); ?>'/><br />
                                         是否开启GUEST权限:<select name='guest'>
  <option value ="1"  <?php if($GUEST==1 ){ ?>selected = selected <?php } ?>>开启</option>
  <option value="0" <?php if($GUEST !=1 ){ ?>selected = selected <?php } ?> >关闭</option>
</select>  <br />
            
            <input type="submit" class="button" value="修改" />
            
            <input type="button" class="button" value="退出" onclick="tourl('index.php?m=index&a=logout')" />
        </form>
</div>
<div style="text-align:right;">
    	<a href="javascript:history.go(-1);" style="color:#666;"><?php echo lang('return'); ?></a>
    	<a href="index.php" style="color:#666;"><?php echo lang('home'); ?></a>
    </div>



</div><?php include $GLOBALS['__TPL__']->inc('../common/foot.html'); ?>