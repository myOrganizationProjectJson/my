<?php !defined("__TPL_IN__") && exit(); ?><?php include $GLOBALS['__TPL__']->inc('../common/head.html'); ?><?php include $GLOBALS['__TPL__']->inc('menu.html'); ?><div style="width:500px;margin:50px auto;margin-top:200px;border:2px solid #999;background:#E4E4E4;text-align:center;padding:10px;">

<div style="text-align:left;font-size:16px;font-weight:bold;">
    	资料修改
    </div>
<div style="line-height:4em;">
<form action="<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=doupauthorization" method="post" submittype="ajax">
    <?php if(count($sessionId)){ foreach($sessionId as $y){ ?>     <?php if($sessionNow==$y ){ ?> <font color='red'>MySession:</font><?php }else{ ?> SessionID: <?php } ?><input type="text" class="text" name="sessionId[]" value='<?php echo($y); ?>'/><br/>
<?php }}else{{ ?>
没有数据!</br>
<?php }} ?>
 <font color='red'>MySession:</font> 
 <?php if(!$dis){ ?><input type="text" class="text" name="sessionId[]" value='<?php echo($sessionNow); ?>'/><br/><?php }else{ ?><font color='red'>SessionID已经绑定！</font></br><?php } ?>
            <input type="submit" class="button" value="确定" />
            <input type="button" class="button" value="退出" onclick="tourl('index.php?m=index&a=logout')" />
        </form>
</div>
<div style="text-align:right;">
    	<a href="javascript:history.go(-1);" style="color:#666;"><?php echo lang('return'); ?></a>
    	<a href="index.php" style="color:#666;"><?php echo lang('home'); ?></a>
    </div>



</div><?php include $GLOBALS['__TPL__']->inc('../common/foot.html'); ?>