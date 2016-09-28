<?php !defined("__TPL_IN__") && exit(); ?><div id="empty_content"><?php if((!isset($year) && !isset($month) && !isset($day)) || (!$year && !$month && !$day)){ ?>    	<div style="padding:5px;">
        <?php echo lang('choose_year'); ?>        </div>
        <div style="padding:10px;">
        <?php if(count($years)){ foreach($years as $y){ ?>            <li class="year"><a href="index.php?m=diary&a=browser&year=<?php echo($y); ?>"><?php echo($y); ?><?php echo lang('year'); ?></a></li>
        <?php }}else{{ ?>
            <?php echo lang('no'); ?><?php echo lang('diary'); ?>        <?php }} ?>	
        </div>
    <?php }else if(isset($year) && $year && (!isset($month) || !$month)){ ?>    	<div style="padding:5px;">
        <?php echo lang('choose_month'); ?>        </div>
        <div style="padding:10px;">
        <?php if(count($yeardetial)){ foreach($yeardetial as $m=>$d){ ?>            <li class="month"><a href="index.php?m=diary&a=browser&year=<?php echo($year); ?>&month=<?php echo($m); ?>"><?php echo($m); ?><?php echo lang('month'); ?></a></li>
        <?php }}else{{ ?>
            <?php echo lang('no'); ?><?php echo lang('diary'); ?>        <?php }} ?>
        </div>
    <?php }else if(isset($year) && $year && isset($month) && isset($yeardetial[$month]) && $month && (!isset($day) || !$day)){ ?>    	<div style="padding:5px;">
        <?php echo lang('choose_day'); ?>        </div>
        <div style="padding:10px;">
        <?php if(count($yeardetial[$month])){ foreach($yeardetial[$month] as $m=>$md){ ?>            <?php $d=substr($md,0,-4); ?>            <li class="day"><a href="index.php?m=diary&a=browser&year=<?php echo($year); ?>&month=<?php echo($month); ?>&day=<?php echo($d); ?>"><?php echo($d); ?><?php echo lang('day'); ?></a></li>
        <?php }}else{{ ?>
            <?php echo lang('no'); ?><?php echo lang('diary'); ?>        <?php }} ?>
        </div>
    <?php } ?>


</div>