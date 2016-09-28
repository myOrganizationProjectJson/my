<?php !defined("__TPL_IN__") && exit(); ?><div id="year"><?php if(count($years)){ foreach($years as $y){ ?><li <?php if(isset($year) && $year==$y){ ?>class="focus"<?php } ?>><a href="index.php?m=diary&a=browser&year=<?php echo($y); ?>"><?php echo($y); ?><?php echo lang('year'); ?></a></li>
<?php }}else{{ ?><?php echo lang('no'); ?><?php echo lang('diary'); ?><?php }} ?>
<li><a href="index.php?m=diary&amp;a=add" style="font-size: 28px;">添加</a></li>
</div>