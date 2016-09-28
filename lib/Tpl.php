<?php
/*
*  Blog  : http://www.eamonning.com
*  Email : i@eamonning.com
*  Time  : 2012-1-1 20:24:54
*/
!defined('DIARY_IN') && exit('Access Forbidden');

define('TPL_PHP_LEFT_TAG','<'.'?php');
define('TPL_PHP_RIGHT_TAG','?'.'>');

class Tpl
{
	public $template_dir;
	public $compile_dir;
	public $content='';
	
	
	function __construct() {
		$this->template_dir = DIARY_ROOT . 'template/';
		$this->compile_dir = DIARY_ROOT . '_t/compile/';
	}
	public function set_compile_dir($dir)
	{
		$this->compile_dir .= $dir .'/';
	}
	public function set_template_dir($dir)
	{
		$this->template_dir .= $dir .'/';
	}
	public function var_parse($str)
	{
		return $str;
	}
	public function compile($tplfile)
	{
		if(!file_exists($this->template_dir . $tplfile)){
			echo '<div style="color:red;">Template File '.$tplfile.' Not Exists!</div>';
			return false;
		}
		$reftplcompile = str_replace (array ('/', '..' ),array ('^', '@@' ),$tplfile );
		if (
			 !file_exists ( $this->compile_dir . $reftplcompile . '.compile.php' ) 
			 || 
			 filemtime ( $this->compile_dir . $reftplcompile . '.compile.php' ) 
			    < filemtime ( $this->template_dir . $tplfile )
		) {
			$this->content=file_get_contents($this->template_dir.$tplfile);
			
			$this->content = preg_replace(	"/([\n\r]+)\t+/s", 
											  "\\1", 
											  $this->content);
			$this->content = preg_replace(	"/\<\!\-\-\{(.+?)\}\-\-\>/s", 
											 "{\\1}", 
											 $this->content);
			
			$this->content=ereg_replace(
				"[\n\r\t]*\\{(\\$[a-zA-Z0-9_]+(\\[[a-zA-Z0-9_'\"\$]+\\])*)\\}[\n\r\t]*",
				TPL_PHP_LEFT_TAG.' echo(\\1); '.TPL_PHP_RIGHT_TAG,
				$this->content);		
			
			$this->content=ereg_replace(
				"[\n\r\t]*\\{foreach +(\\$[a-zA-Z0-9_]+(\\[[a-zA-Z0-9_'\"\$]+\\])*) +(\\$[a-zA-Z0-9_]+)\\}[\n\r\t]*",
				TPL_PHP_LEFT_TAG.' if(count(\\1)){ foreach(\\1 as \\3){ '.TPL_PHP_RIGHT_TAG,
				$this->content);	
			$this->content=ereg_replace(
				"[\n\r\t]*\\{foreach +(\\$[a-zA-Z0-9_]+(\\[[a-zA-Z0-9_'\"\$]+\\])*) +(\\$[a-zA-Z0-9_]+) +(\\$[a-zA-Z0-9_]+)\\}[\n\r\t]*",
				TPL_PHP_LEFT_TAG.' if(count(\\1)){ foreach(\\1 as \\3=>\\4){ '.TPL_PHP_RIGHT_TAG,
				$this->content);			
			$this->content=str_replace(
						'{foreachelse}',
						TPL_PHP_LEFT_TAG.' }}else{{ '.TPL_PHP_RIGHT_TAG,
						$this->content);
			$this->content=str_replace(
						'{/foreach}',
						TPL_PHP_LEFT_TAG.' }} '.TPL_PHP_RIGHT_TAG,
						$this->content);
			
			
			$this->content=ereg_replace(
				"[\n\r\t]*\\{if +([^\\}]+)\\}[\n\r\t]*",
				TPL_PHP_LEFT_TAG.' if(\\1){ '.TPL_PHP_RIGHT_TAG,
				$this->content);
			$this->content=ereg_replace(
				"[\n\r\t]*\\{elseif +([^\\}]+)\\}[\n\r\t]*",
				TPL_PHP_LEFT_TAG.' }else if(\\1){ '.TPL_PHP_RIGHT_TAG,
				$this->content);
			$this->content=str_replace(
				'{else}',
				TPL_PHP_LEFT_TAG.' }else{ '.TPL_PHP_RIGHT_TAG,
				$this->content);
			$this->content=str_replace(
				'{/if}',
				TPL_PHP_LEFT_TAG.' } '.TPL_PHP_RIGHT_TAG,
				$this->content);
			
			$this->content=ereg_replace(
				"[\n\r\t]*\\{eval ([^\\}]+)\\}[\n\r\t]*",
				TPL_PHP_LEFT_TAG.' \\1 '.TPL_PHP_RIGHT_TAG,
				$this->content);
			
			$this->content=ereg_replace(
				"[\n\r\t]*\\{const\\.([A-Z0-9_]+)\\}[\n\r\t]*",
				TPL_PHP_LEFT_TAG.' echo \\1; '.TPL_PHP_RIGHT_TAG,
				$this->content);
			
			$this->content=ereg_replace(
				"[\n\r\t]*\\{include +([a-zA-Z0-9_\\.\\/]+)\\}[\n\r\t]*",
				TPL_PHP_LEFT_TAG.' include $GLOBALS[\'__TPL__\']->inc(\'\\1\'); '.TPL_PHP_RIGHT_TAG,
				$this->content);
			
			$this->content=ereg_replace(
				"[\n\r\t]*\\{lang +([a-zA-Z0-9_\\/]+)\\}[\n\r\t]*",
				TPL_PHP_LEFT_TAG.' echo lang(\'\\1\'); '.TPL_PHP_RIGHT_TAG,
				$this->content);
			
			$this->content=ereg_replace(
				"[\n\r\t]*\\{global +([a-zA-Z0-9_\\/]+)\\}[\n\r\t]*",
				TPL_PHP_LEFT_TAG.' echo G(\'\\1\'); '.TPL_PHP_RIGHT_TAG,
				$this->content);
			
			$this->content=str_replace(
						'{LF}',
						"\n\r",
						$this->content);
			
			
			$this->content=TPL_PHP_LEFT_TAG.' !defined("__TPL_IN__") && exit(); '.TPL_PHP_RIGHT_TAG.$this->content;
			
			if (!file_exists ($this->compile_dir)){ 
				mkdir ($this->compile_dir, 0777, true );
			}
			file_put_contents($this->compile_dir.$reftplcompile.'.compile.php',$this->content);
		}
		return true;
	}
	public function inc($tplfile)
	{
		if($this->compile ( $tplfile )){
			$reftplcompile = str_replace (array ('/', '..' ),array ('^', '@@' ),$tplfile );
			return $this->compile_dir . $reftplcompile . '.compile.php';
		}else{
			echo '<div style="color:red;">Template Include '.$tplfile.' Error!</div>';	
			exit();
		}
	}
	public function template($tplfile)
	{
		$GLOBALS['__TPL__'] = &$this;
		if (! defined ( '__TPL_IN__' )) {
			define ( '__TPL_IN__', '' );
		}
		if($this->compile($tplfile)){
			$reftplcompile = str_replace (array ('/', '..' ),array ('^', '@@' ),$tplfile );
			return $this->compile_dir . $reftplcompile . '.compile.php';
		}else{
			echo '<div style="color:red;">Template Display '.$tplfile.' Error!</div>';
			exit();
		}
	}
	
}