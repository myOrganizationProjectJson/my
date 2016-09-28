<?php
/*
*  Blog  : http://www.eamonning.com
*  Email : i@eamonning.com
*  Time  : 2012-1-1 20:24:54
*/
!defined('DIARY_IN') && exit('Access Forbidden');

class Model_index
{	
	private $tpl;
	function Model_index()
	{
	    
	}
	function onDefault()
	{
		include DIARY_ROOT.'lib/model/diary.php';
		$d=new Model_diary();
		$d->onDefault();
	}
	function onLogin()
	{
		G('page_title',lang('login'));
		$this->tpl=new Tpl();
		$this->tpl->set_template_dir(DIARY_STYLE);
		include $this->tpl->template('login.html');
	}
	function onSubmitlogin()
	{
		if(post('username')==DIARY_ADMIN_USER && md5(post('password').ENCODE_PASSWORD)==DIARY_ADMIN_PASSWORD){
			$_SESSION['userid']=1;
			$_SESSION['ctime']=time();
			$_SESSION['userupid']=1;
			echo '<js>dialog.alert("'.lang('login_success').'","","tourl(\'index.php\')");</js>';	
		}else{
			echo '<js>dialog.alert("'.lang('login_failed').'");</js>';	
		}
	}
	function onLogout()
	{
// 		if(isset($_SESSION['userid'])){
// 			unset($_SESSION['userid']);
// 		}
// 	    if(isset($_SESSION['guestid'])){
// 			unset($_SESSION['guestid']);
// 		}
		session_destroy();
		header('Location: index.php');
	}	
	function onGuestlogin()
	{
	    if(AU_GUEST==0){
	        check_authorization();
	    }
		G('page_title',lang('guest').lang('login'));
		$this->tpl=new Tpl();
		$this->tpl->set_template_dir(DIARY_STYLE);
		include $this->tpl->template('guest_login.html');
		
	}
	function onLogoff()
	{
// 		if(isset($_SESSION['guestid'])){
// 			unset($_SESSION['guestid']);
// 		}
// 		if(isset($_SESSION['userid'])){
// 		    unset($_SESSION['userid']);
// 		}
		session_destroy();
		header('Location: index.php');
	}
	function onSubmitguestlogin()
	{
	    if(AU_GUEST==0){
	        check_authorization();
	    }
		if(md5(post('password').ENCODE_PASSWORD) ==DIARY_GUEST_PASSWORD || md5(post('password').ENCODE_PASSWORD)==DIARY_GUEST_SMPWORD){
			$_SESSION['guestid']=1;
			$_SESSION['userid']=1;
			$_SESSION['ctime']=time();
			echo '<js>dialog.alert("'.lang('login_success').'","","tourl(\'index.php\')");</js>';	
		}else{
			echo '<js>dialog.alert("'.lang('login_failed').'");</js>';	
		}			
	}
	function onCache()
	{
		remove_dir(DIARY_ROOT.'_t/',false);
		
		$fs=list_file(DIARY_STORAGE_ROOT);
		
		foreach($fs as $f){
			if($f['isDir']){
				$ffs=list_file(DIARY_STORAGE_ROOT.$f['filename'].'/');
				foreach($ffs as $ff){
					if($ff['isDir']){
						$fffs=list_file(DIARY_STORAGE_ROOT.$f['filename'].'/'.$ff['filename'].'/');
						if(!count($fffs)){
							rmdir(DIARY_STORAGE_ROOT.$f['filename'].'/'.$ff['filename'].'/');
						}
					}
				}
			}
		}
		
		foreach($fs as $f){
			if($f['isDir']){
				$ffs=list_file(DIARY_STORAGE_ROOT.$f['filename'].'/');	
				if(!count($ffs)){
					rmdir(DIARY_STORAGE_ROOT.$f['filename'].'/');
				}
			}
		}
	}
}