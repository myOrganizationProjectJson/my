<?php !defined("__TPL_IN__") && exit(); ?><div id="menu">
<li><a href="<?php echo DIARY_ROOT_REF; ?>index.php"><?php echo lang('view'); ?></a></li>
<li><a href="<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=browser&year=<?php echo($y); ?>&month=<?php echo($m); ?>&day=<?php echo($d); ?>">当天</a></li>
<li><a href="<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=browser&year=<?php echo($y); ?>&month=<?php echo($m); ?>">当月</a></li>
    <?php if(G('userid')){ ?><li><a href="<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=add"><?php echo lang('add'); ?></a></li>
    <?php } ?>
  
    <?php if(G('userid')){ ?>      <?php if(G('userupid')){ ?>   		 <li><a href="<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=upconfig">修改</a></li>
   		 <li><a href="<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=upauthorization">权限</a></li>
   		 <li><a href="javascript:void(0);" onclick="$.get('<?php echo DIARY_ROOT_REF; ?>index.php?m=index&a=cache',{},function(d){dialog.alert('<?php echo lang('operate'); ?><?php echo lang('success'); ?>');});"><?php echo lang('cache'); ?></a></li>	
      <?php } ?>
    	<li><a href="<?php echo DIARY_ROOT_REF; ?>index.php?m=index&a=logout"><?php echo lang('logout'); ?></a></li>	
    <?php }else{ ?>
    	<li><a href="<?php echo DIARY_ROOT_REF; ?>index.php?m=index&a=login"><?php echo lang('login'); ?></a></li>
    <?php } ?>
</div>

<script>
jQuery(document).keypress(function(e){
if(e.ctrlKey && e.which == 13 || e.which == 10) {
 // window.location.href='<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=add';
editor.sync();
$('form').submit();
S	} else if (e.shiftKey && e.which==13 || e.which == 10) {
   window.location.href='<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=add';
  // window.location.href='<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=browser&year=<?php echo($y); ?>&month=<?php echo($m); ?>&day=<?php echo($d); ?>';
} else if (e.shiftKey && e.which==76 || e.which == 10) {
   window.location.href='<?php echo DIARY_ROOT_REF; ?>index.php?m=index&a=logout';
}else if (e.shiftKey && e.which==68 || e.which == 10) {
   window.location.href='<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=browser&year=<?php echo($y); ?>&month=<?php echo($m); ?>&day=<?php echo($d); ?>';
}else if (e.shiftKey && e.which==77 || e.which == 10) {
   window.location.href='<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=browser&year=<?php echo($y); ?>&month=<?php echo($m); ?>';
}else if (e.shiftKey && e.which==69 || e.which == 10) {
   window.location.href='<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=edit&year=<?php echo($y); ?>&month=<?php echo($m); ?>&day=<?php echo($d); ?>';
}else if (e.shiftKey && e.which==89 || e.which == 10) {
   window.location.href='<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=browser&year=<?php echo($y); ?>';
}else if (e.shiftKey && e.which==65 || e.which == 10) {
  window.location.href='<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=add';
}else if (e.shiftKey && e.which==83 || e.which == 10) {
  window.location.href='<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=add';
}else if (e.shiftKey && e.which==70 || e.which == 10) {
 // $('.text:first').focus();
 
 
}	
});
//键码获取/*
//$(document).keydown(function (event) {  alert(event.keyCode);});
</script>
