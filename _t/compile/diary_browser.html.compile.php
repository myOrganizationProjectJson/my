<?php !defined("__TPL_IN__") && exit(); ?><?php include $GLOBALS['__TPL__']->inc('../common/head.html'); ?><?php include $GLOBALS['__TPL__']->inc('menu.html'); ?><?php include $GLOBALS['__TPL__']->inc('year.html'); ?><?php include $GLOBALS['__TPL__']->inc('empty_content.html'); ?><div id="month"><?php if(count($yeardetial)){ foreach($yeardetial as $m=>$d){ ?>    	<li <?php if($month==$m){ ?>class="focus"<?php } ?>><a href="index.php?m=diary&a=browser&year=<?php echo($year); ?>&month=<?php echo($m); ?>"><?php echo($m); ?><?php echo lang('month'); ?></a></li>
    <?php }}else{{ ?>
    <?php echo lang('no'); ?><?php echo lang('diary'); ?>    <?php }} ?>
</div><?php if($month && isset($yeardetial[$month])){ ?><div id="day"><?php if(count($yeardetial[$month])){ foreach($yeardetial[$month] as $m=>$md){ ?>    <?php $d=substr($md,0,-4); ?>    	<li <?php if($day==$d){ ?>class="focus"<?php } ?>><a href="index.php?m=diary&a=browser&year=<?php echo($year); ?>&month=<?php echo($month); ?>&day=<?php echo($d); ?>"><?php echo($d); ?><?php echo lang('day'); ?></a></li>
    <?php }}else{{ ?>
    <?php echo lang('no'); ?><?php echo lang('diary'); ?>    <?php }} ?>
</div>
<?php } ?><?php if($diary_view){ ?><div id="diary_view">
<div class="datetime"><?php echo lang('datetime'); ?>:<?php echo($year); ?>-<?php echo($month); ?>-<?php echo($day); ?></div>
<div class="edittime"><?php echo lang('edittime'); ?>:<?php echo date('Y-m-d H:i',$diary_view['edittime']) ?></div>
    <?php if(G('userid')){ ?>    <div class="operate">
    	<a href="index.php?m=diary&a=edit&year=<?php echo($year); ?>&month=<?php echo($month); ?>&day=<?php echo($day); ?>"><?php echo lang('edit'); ?></a>
    	<a href="javascript:void(0);" onclick="delete_diary();"><?php echo lang('delete'); ?></a>
        <script language="javascript">
function delete_diary()
{
if(confirm("确定要删除吗？"))
 {
$.get('index.php?m=diary&a=delete&year=<?php echo($year); ?>&month=<?php echo($month); ?>&day=<?php echo($day); ?>',
  {},function(d){
  if('ok'==d){
 	dialog.alert('<?php echo lang('delete'); ?><?php echo lang('success'); ?>',''
 ,'tourl(\'index.php?m=diary&a=browser&year=<?php echo($year); ?>&month=<?php echo($month); ?>\')');
  }else{
    dialog.alert(d);
      }
});	
 }
}
</script>
    </div>
    <?php } ?>
    <div class="content"><?php echo($diary_view['content']); ?></div>
</div>
<?php } ?><?php include $GLOBALS['__TPL__']->inc('../common/foot.html'); ?>