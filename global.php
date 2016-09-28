<?php
/*
*  Blog  : http://www.verytalk.cn
*  Email : i@verytalk.cn
*  Time  : 2012-1-1 20:24:54
*/
define('DIARY_IN',true);

//version
define('DIARY_VERSION','1.0');


define('DIARY_ROOT',substr(__FILE__,0,-10));

require 'config.php';

//diary info cache root
define('DIARY_CACHE_ROOT',DIARY_ROOT.'_t/cache/');

require DIARY_ROOT.'lang_'.str_replace('-','',DIARY_CHARSET).'.php';
require DIARY_ROOT.'lib/function.php';
require DIARY_ROOT.'lib/Tpl.php';

error_reporting(E_ALL);
date_default_timezone_set(DIARY_TIMEZONE); 
//set_magic_quotes_runtime ( 0 );

if (get_magic_quotes_gpc ()) {
	$GLOBALS ['_POST'] =deep_stripslashes ( $GLOBALS ['_POST'] );
	$GLOBALS ['_GET'] =deep_stripslashes ( $GLOBALS ['_GET'] );
	$GLOBALS ['_COOKIE'] = deep_stripslashes ( $GLOBALS ['_COOKIE'] );
}
@session_start ();

G('userid',0);
G('guestid',0);
G('userupid',0);


//unset($_SESSION['userid']);
//unset($_SESSION['guestid']);

if(isset($_SESSION['userid'])){
	G('userid',$_SESSION['userid']);
}
if(isset($_SESSION['guestid'])){
	G('guestid',$_SESSION['guestid']);
}
if(isset($_SESSION['userupid'])){
	G('userupid',$_SESSION['userupid']);
}



