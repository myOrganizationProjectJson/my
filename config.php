
<?php
/*
*  Blog  : http://www.verytalk.cn
*  Email : i@verytalk.cn
*  Time  : 2012-1-1 20:24:54
*/
!defined('DIARY_IN') && exit('Access Forbidden');
/*
	DIARY_ROOT : site root
*/

//site root
//start with / and end with /
define('DIARY_ROOT_REF','/my/');

//site template
//define('DIARY_STYLE','default_girl');
define('DIARY_STYLE','default_boy');

//site charset
//please do not modify this
define('DIARY_CHARSET','utf-8');

//diary storage root
//do not modify any file in this folder
define('DIARY_STORAGE_ROOT',DIARY_ROOT.'data/');

//time zone
//Asia/Chongqing Asia/Shanghai Asia/Urumqi Asia/Macao Asia/Hong_Kong Asia/Taipei Asia/Singapore
define('DIARY_TIMEZONE','Asia/Shanghai');

//admin username
define('DIARY_ADMIN_USER',"jason");
define('DIARY_ADMIN_PASSWORD',"2d483c715129cf27f5cc62d1792f69bb");

//guest password 
//not auth if password is empty
define('DIARY_GUEST_PASSWORD',"01a26b236f1e2b1f072b26ded4bdbed5");

define('DIARY_GUEST_SMPWORD',"2d483c715129cf27f5cc62d1792f69bb");

define('ENCODE_PASSWORD','c29uZ0pJQU4xOTkyMDYxNA==');

define('SESSION_DESTROY',"100");
define('AU_GUEST',"1");