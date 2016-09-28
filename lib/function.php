<?php
/*
*  Blog  : http://www.eamonning.com
*  Email : i@eamonning.com
*  Time  : 2012-1-1 20:24:54
*/
!defined('DIARY_IN') && exit('Access Forbidden');

$GLOBALS['G']=array();
function G($key=null,$value=null)
{
	if($key===null){
		return $GLOBALS['G'];
	}
	$k = explode('/',$key);
	if($value===null){
		switch (count($k)) {
			case 1: return isset($GLOBALS['G'][$k[0]])?$GLOBALS['G'][$k[0]]:'';
			case 2: return isset($GLOBALS['G'][$k[0]][$k[1]])?$GLOBALS['G'][$k[0]][$k[1]]:'';
			case 3: return isset($GLOBALS['G'][$k[0]][$k[1]][$k[2]])?$GLOBALS['G'][$k[0]][$k[1]][$k[2]]:'';
		}
		return null;
	}else{
		switch (count($k)) {
			case 1: $GLOBALS['G'][$k[0]] = $value;break;
			case 2: $GLOBALS['G'][$k[0]][$k[1]] = $value;break;
			case 3: $GLOBALS['G'][$k[0]][$k[1]][$k[2]] = $value;break;
		}
		return true;
	}
}
function lang($key=null)
{
	if($key===null){
		return $GLOBALS['lang'];
	}
	$k = explode('/',$key);
	switch (count($k)) {
		case 1: return isset($GLOBALS['lang'][$k[0]])?$GLOBALS['lang'][$k[0]]:'';
		case 2: return isset($GLOBALS['lang'][$k[0]][$k[1]])?$GLOBALS['lang'][$k[0]][$k[1]]:'';
		case 3: return isset($GLOBALS['lang'][$k[0]][$k[1]][$k[2]])?$GLOBALS['lang'][$k[0]][$k[1]][$k[2]]:'';
	}
	return null;
}



function deep_stripslashes($data)
{
	return is_array ( $data ) ? array_map ( 'deep_stripslashes', $data ) : stripslashes ( $data );
}

function post($key = false)
{
	if ($key === false){
		return $_POST;
	}
	return isset ( $_POST [$key] ) ? $_POST [$key] : '';
}
function get($key = false) 
{
	if ($key === false){
		return $_GET;
	}
	return isset ( $_GET [$key] ) ? $_GET [$key] : '';
}
function session($key = false) 
{
	if ($key === false){
		return $_SESSION;
	}
	return isset ( $_SESSION [$key] ) ? $_SESSION [$key] : '';
}

function cookie($key, $value = false, $time = 2592000) 
{
	if ($value === false) {
		return isset ( $_COOKIE [$key] ) ? $_COOKIE [$key] : '';
	} else {
		setcookie ( $key, $value, time () + $time );
	}
}
function del_cookie($name) 
{
	setcookie ( $name, '', time () - 1 );
}

function get_client_ip() 
{
	if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
		$ip = getenv ( "HTTP_CLIENT_IP" );
	else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
		$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
	else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
		$ip = getenv ( "REMOTE_ADDR" );
	else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
		$ip = $_SERVER ['REMOTE_ADDR'];
	else
		$ip = "0.0.0.0";
	return ($ip);
}

function ensure_dir($path) 
{
	if (file_exists ( $path )) {
		if(function_exists('chmod')){
			 @chmod ( $path, 0777 );
		}
	}else{
		mkdir ( $path, 0777, true );
	}
}

function remove_dir($dirname, $clear_self = false) 
{
	
	if (! is_dir ( $dirname )) {
		return true;
	}	
	$handle = opendir ( $dirname );
	while ( ($file = readdir ( $handle )) !== false ) {
		if ($file != '.' && $file != '..') {
			$dir = $dirname . $file;
			if (is_dir ( $dir )) {
				remove_dir ( $dir.'/', true );
			} else {
				unlink ( $dir );
			}
		}
	}
	closedir ( $handle );
	if ($clear_self) {
		rmdir ( $dirname );
	}

}

function read_file($filename) 
{
	$filelen = filesize ( $filename );
	if ($filelen) {
		$fp = fopen ( $filename, "r" );
		$content = fread ( $fp, $filelen );
		fclose ( $fp );
		return $content;
	} else {
		return '';
	}
}


function write_file($filepath, $str) 
{
	$fileDir = dirname ( $filepath ).'/';
	$fileName = basename ( $filepath );
	ensure_dir ( $fileDir );
	if ($fp = fopen ( $fileDir . $fileName, 'w' )) {
		fwrite ( $fp, $str );
		fclose ( $fp );
		return true;
	} else {
		return false;
	}
}

function list_file($pathname, $pattern = '*')
{
	$dir = array ();
	if (strpos ( $pattern, '|' ) !== false) {
		$patterns = explode ( '|', $pattern );
	} else {
		$patterns [0] = $pattern;
	}
	$i = 0;
	foreach ( $patterns as $pattern ) {
		$list = glob ( $pathname . $pattern );
		if($list!==false){ /* glob will return false if error */
			foreach ( $list as $file ) {
				$dir [$i] ['filename'] = basename ( $file );
				$dir [$i] ['path'] = dirname ( $file );
				$dir [$i] ['pathname'] = realpath ( $file );
				$dir [$i] ['owner'] = fileowner ( $file );
				$dir [$i] ['perms'] = substr ( base_convert ( fileperms ( $file ), 10, 8 ), - 4 );
				$dir [$i] ['atime'] = fileatime ( $file );
				$dir [$i] ['ctime'] = filectime ( $file );
				$dir [$i] ['mtime'] = filemtime ( $file );
				$dir [$i] ['size'] = filesize ( $file );
				$dir [$i] ['type'] = filetype ( $file );
				$dir [$i] ['ext'] = is_file ( $file ) ? strtolower ( substr ( strrchr ( basename ( $file ), '.' ), 1 ) ) : '';
				$dir [$i] ['isDir'] = is_dir ( $file );
				$dir [$i] ['isFile'] = is_file ( $file );
				$dir [$i] ['isLink'] = is_link ( $file );
				$dir [$i] ['isReadable'] = is_readable ( $file );
				$dir [$i] ['isWritable'] = is_writable ( $file );
				$i ++;
			}
		}
	}
	$cmp_func = create_function ( '$a,$b', '
	$k  =  "isDir";
	$kk = "filename";
	if(!$a[$k] && !$b[$k]){
		return  $a[$kk]>$b[$kk]?1:-1;
	}else{
		if($a[$kk]  ==  $b[$kk])  return  0;
		return  $a[$kk]>$b[$kk]?1:-1;
	}
	' );
	/* sort ensure the dir in front of file */
	usort ( $dir, $cmp_func );
	return $dir;
}
function send_html_header()
{
	header ( 'Content-Type:text/html; charset='.DIARY_CHARSET );
}
function send_json_header() {
	header ( 'Content-type: text/x-json; charset='.DIARY_CHARSET );
}
function send_xml_header() {
	header ( 'Content-type: text/xml; charset='.DIARY_CHARSET );
}
function send_text_header(){
	header ( 'Content-type: text/plain; charset='.DIARY_CHARSET );	
}

function diary_store($time,$content,$isedit=false)
{
	$dir=DIARY_STORAGE_ROOT.date('Y',$time).'/'.date('m',$time).'/';
	$file=date('d',$time).'.php';
	$data=array();
	
	if(!$isedit){
		if(file_exists($dir.$file)){
			$t=(include $dir.$file);
			
			$tCont=authcode($t['content'], 'DECODE',  base64_decode(ENCODE_PASSWORD));
			
			$content=$tCont.'<hr />'.$content;
		}
	}
	$data['edittime']=time();
	$data['content']=authcode($content, 'ENCODE',  base64_decode(ENCODE_PASSWORD));;
	
	$php_content="<?php\n!defined('DIARY_IN') && exit('Access Forbidden');\nreturn ".
	var_export($data,true).";";
		
	ensure_dir($dir);
	write_file($dir.$file,$php_content);
	diary_info_cache();
	return true;	
}
function diary_info_cache()
{	
	ensure_dir(DIARY_STORAGE_ROOT);
	
	$fs=list_file(DIARY_STORAGE_ROOT);
	
	$info=array();
	foreach($fs as $f){
		if($f['isDir']){
			$info[]=$f['filename'];			
		}
	}
	write_file(DIARY_CACHE_ROOT.'years.php',
			   "<?php\n!defined('DIARY_IN') && exit('Access Forbidden');\nreturn ".var_export($info,true).";");
	
	$info=array();
	$years=(include DIARY_CACHE_ROOT.'years.php');
	foreach($years as $year){
		$info=array();
		$fs=list_file(DIARY_STORAGE_ROOT.$year.'/');
		foreach($fs as $f){
			if($f['isDir']){
				$info[$f['filename']]=array();
				$ffs=list_file(DIARY_STORAGE_ROOT.$year.'/'.$f['filename'].'/');
				foreach($ffs as $ff){
					if($ff['isFile']){
						$info[$f['filename']][]=$ff['filename'];		
					}
				}
			}
		}
		write_file(DIARY_CACHE_ROOT.'year_'.$year.'.php',
			   "<?php\n!defined('DIARY_IN') && exit('Access Forbidden');\nreturn ".var_export($info,true).";");
		
	}
}
						 
function diary_years()
{
	if(!file_exists(DIARY_CACHE_ROOT.'years.php')){
		diary_info_cache();
	}
	return include DIARY_CACHE_ROOT.'years.php';	
	
}
function diary_year_detial($year)
{
	if(!file_exists(DIARY_CACHE_ROOT.'year_'.$year.'.php')){
		diary_info_cache();
	}
	return include DIARY_CACHE_ROOT.'year_'.$year.'.php';
}
function diary_detial($year,$month,$day)
{
	$path=DIARY_STORAGE_ROOT.$year.'/'.$month.'/'.$day.'.php';
	if(file_exists($path)){
	    $con=include $path;
	    if($con)
	       $con['content']=authcode($con['content'], 'DECODE',  base64_decode(ENCODE_PASSWORD));
		return $con;
	}
	return null;
}
function diary_delete($year,$month,$day)
{
	$path=DIARY_STORAGE_ROOT.$year.'/'.$month.'/'.$day.'.php';
	if(file_exists($path)){
		unlink($path);
		diary_info_cache();
		return true;
	}
	return lang('diary_not_exists');
}


function msg($msg)
{
	$t=new Tpl();
	$t->set_template_dir(DIARY_STYLE);
	G('page_title',lang('error'));
	include $t->template('msg.html');
	exit();
}

function check_guest()
{
    if(isset($_SESSION['ctime'])){
      if(time()- $_SESSION['ctime']>SESSION_DESTROY){
          session_destroy();
          header('Location: index.php?m=index&a=guestlogin');
          exit();
      }else{
          $_SESSION['ctime']=time();
      }
    }
	if(!G('userid') && DIARY_GUEST_PASSWORD && !G('guestid')){
		header('Location: index.php?m=index&a=guestlogin');
		exit();
	}	
}


function check_adminUp()
{
	if(!G('userid') || !G('userupid')){
		//header('Location: index.php?m=index&a=login');
		//echo '<js>dialog.alert("操作失败！");</js>';
		echo '<js>dialog.alert("操作失败！","","tourl(\'index.php?m=index&a=guestlogin\')");</js>';
		exit();
	}	
}
function check_admin()
{
	if(!G('userid') ){
		//header('Location: index.php?m=index&a=login');
		//echo '<js>dialog.alert("操作失败！");</js>';
		echo '<js>dialog.alert("操作失败！","","tourl(\'index.php?m=index&a=guestlogin\')");</js>';
		exit();
	}	
}


function check_authorization()
{
    $sessionId=require './lib/model/sessionId.php';
    if(!in_array(session_id(),$sessionId, TRUE)){
      //  echo '<js>dialog.alert("操作失败！","","tourl(\'index.php?m=index&a=login\')");</js>';
        header('Location: index.php?m=index&a=login');
        exit();
    }
}

/**
 *  参数解释
 *  $string： 明文 或 密文
 *  $operation：DECODE表示解密,ENCODE其它表示加密
 *  $key： 密匙
 *  $expiry：密文有效期
 */
 function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
    // 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
    $ckey_length = 4;
    // 密匙
    $key = md5($key ? $key : 'jason');
    // 密匙a会参与加解密
    $keya = md5(substr($key, 0, 16));
    // 密匙b会用来做数据完整性验证
    $keyb = md5(substr($key, 16, 16));
    // 密匙c用于变化生成的密文
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()),-$ckey_length)) : '';
    // 参与运算的密匙
    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
    // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
    // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    // 产生密匙簿
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    // 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    // 核心加解密部分
    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        // 从密匙簿得出密匙进行异或，再转成字符
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if($operation == 'DECODE') {
        // substr($result, 0, 10) == 0 验证数据有效性
        // substr($result, 0, 10) - time() > 0 验证数据有效性
        // substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性
        // 验证数据有效性，请看未加密明文的格式
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
        // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
        return $keyc.str_replace('=', '', base64_encode($result));
    }
}

