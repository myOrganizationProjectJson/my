<?php !defined("__TPL_IN__") && exit(); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo DIARY_CHARSET; ?>" />
<script language="javascript">var ROOT='<?php echo DIARY_ROOT_REF; ?>';</script>
<script language="javascript" src="<?php echo DIARY_ROOT_REF; ?>lib/js.js"></script>
<title><?php echo lang('site_title'); ?> - <?php echo G('page_title'); ?></title>
<link type="text/css" rel="stylesheet" href="<?php echo DIARY_ROOT_REF; ?>lib/common.css" />
<link type="text/css" rel="stylesheet" href="<?php echo DIARY_ROOT_REF; ?>template/<?php echo DIARY_STYLE; ?>/style.css" />
<script>
$(document).ready(function(){  $('.text:first').focus(); });
</script>

<script>
jQuery(document).keypress(function(e){
 if (e.shiftKey && e.which==70 || e.which == 10) {
  $('.text:first').focus();
}	
});
//键码获取/*
//$(document).keydown(function (event) {  alert(event.keyCode);});
</script>
</head>
<body><?php include $GLOBALS['__TPL__']->inc('copyright.html'); ?><div id="site_title" onclick="javascript:window.location.href='index.php?m=index&a=logout'" style='cursor:pointer;'><?php echo lang('site_title'); ?></div>
<div id="site_description" onclick="javascript:window.location.href='index.php?m=index&a=logout'" style='cursor:pointer;'><?php echo lang('site_description'); ?></div>
