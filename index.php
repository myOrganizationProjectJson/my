<?php
/*
*  Blog  : http://www.verytalk.cn
*  Email : i@verytalk.cn
*  Time  : 2012-1-1 20:24:54
*/
error_reporting(0);

require 'global.php';

$model_array=array('index','diary');

$model_name=isset($_GET['m'])?$_GET['m']:'';
$model_action=isset($_GET['a'])?$_GET['a']:'';
$model_operate=isset($_GET['o'])?$_GET['o']:'';


if(!in_array($model_name,$model_array)){
	$model_name='index';
}

require DIARY_ROOT.'lib/model/'.$model_name.'.php';

$model_action='on'.ucwords(strtolower($model_action));
if(!method_exists('Model_'.$model_name,$model_action)){
	$model_action='onDefault';	
}

$model_name='Model_'.$model_name;
$model=new $model_name;
$action=$model_action;
$model->$action();
