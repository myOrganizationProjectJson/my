<?php !defined("__TPL_IN__") && exit(); ?><?php include $GLOBALS['__TPL__']->inc('../common/head.html'); ?><div style="width:400px;height:200px;margin:50px auto;margin-top:200px;border:2px solid #999;background:#CCC;text-align:center;padding:10px;">

<div style="text-align:left;font-size:16px;font-weight:bold;">
    <?php echo lang('notice'); ?>    </div>
<div style="line-height:150px;"><?php echo($msg); ?></div>
<div style="text-align:right;">
    	<a href="javascript:history.go(-1);"><?php echo lang('return'); ?></a>
    	<a href="index.php"><?php echo lang('home'); ?></a>
    </div>



</div><?php include $GLOBALS['__TPL__']->inc('../common/foot.html'); ?>