<?php
/*
*  Blog  : http://www.verytalk.cn
*  Email : i@verytalk.cn
*  Time  : 2012-1-1 20:24:54
*/

!defined('DIARY_IN') && exit('Access Forbidden');

class Model_diary
{	
	private $tpl;
	function Model_diary()
	{
	   $model_action=isset($_GET['a'])?$_GET['a']:'';
	   if($model_action != 'submitadd' && $model_action != 'submitedit'){
	       check_guest();
	    }
	    check_admin();
		$this->tpl=new Tpl();
		$this->tpl->set_template_dir(DIARY_STYLE);
	}
	
	function onDefault()
	{
		G('page_title',lang('home'));
		send_html_header();
		$years=diary_years();
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		include $this->tpl->template('index.html');
	}
	function onBrowser()
	{
		G('page_title',lang('browser'));
		send_html_header();
		$year=get('year');
		$month=get('month');
		$day=get('day');
		$years=diary_years();
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		if(in_array($year,$years)){				
			$yeardetial=diary_year_detial($year);			
			$diary_view=null;
			if($day && $month && isset($yeardetial[$month]) && in_array($day.'.php',$yeardetial[$month])){
				$diary_view=diary_detial($year,$month,$day);
				if(!$diary_view){
					msg(lang('load').lang('data').lang('error'));
				}
			}
			include $this->tpl->template('diary_browser.html');				
		}else{
			msg(lang('load').lang('data').lang('error'));
		}
	}
	function onAdd()
	{		
		G('page_title',lang('add'));
		check_admin();
		send_html_header();
		$today=date("Y-m-d"); 
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		include $this->tpl->template('diary_add.html');
	}
	function onSubmitadd()
	{
		check_admin();
		send_html_header();
		$datetime=post('datetime');
		$content=post('content');
		$time=strtotime($datetime);
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		if($time){
			if($content){
			    $tArray=require 'biaoqing.php';
			    $ti=array_rand($tArray,1);
			    $ti=$tArray[$ti];
			    unset($tArray);
			    $user_IP =$_SERVER["REMOTE_ADDR"];
			    $content="$ti---".date("Y-m-d H:i:s")." && IP:$user_IP---$ti<br/>".$content;
				$status=diary_store($time,$content);
				if(true===$status){
				    
					if(isset($_SESSION['ctime'])){
					    if(time()- $_SESSION['ctime']>SESSION_DESTROY){
					        session_destroy();
					        echo '<js>dialog.alert("'.lang('add').lang('success').'","","tourl(\'index.php\')");</js>';
					        exit();
					    }else{
					        echo '<js>dialog.alert("'.lang('add').lang('success').'","","tourl(\'index.php?m=diary&a=browser&year='.date('Y',$time).'&month='.date('m',$time).'&day='.date('d',$time).'\')");</js>';
					        check_guest();
					    }
					}else{
					    echo '<js>dialog.alert("'.lang('add').lang('success').'","","tourl(\'index.php?m=diary&a=browser&year='.date('Y',$time).'&month='.date('m',$time).'&day='.date('d',$time).'\')");</js>';
					}
					
					
				}else{
					echo '<js>dialog.alert("'.$status.'");</js>';		
				}
			}else{
				echo '<js>dialog.alert("'.lang('content_is_null').'");</js>';		
			}
		}else{
			echo '<js>dialog.alert("'.lang('datetime_is_null').'");</js>';	
		}
	}
	function onEdit()
	{
		check_admin();
		G('page_title',lang('edit'));
		send_html_header();
		$year=get('year');
		$month=get('month');
		$day=get('day');
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		$diary_view=diary_detial($year,$month,$day);
		if(!$diary_view){
			msg(lang('load').lang('data').lang('error'));
		}
		$diary_view['time']=$year.'-'.$month.'-'.$day;
		include $this->tpl->template('diary_edit.html');
		
	}
	function onSubmitedit()
	{
		check_admin();
		send_html_header();
		$datetime=post('datetime');
		$content=post('content');
		$time=strtotime($datetime);
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		if($time){
			if($content){
				$status=diary_store($time,$content,true);
				if(true===$status){
				    
					if(isset($_SESSION['ctime'])){
					    if(time()- $_SESSION['ctime']>SESSION_DESTROY){
					        session_destroy();
					        echo '<js>dialog.alert("'.lang('edit').lang('success').'","","tourl(\'index.php\')");</js>';
					        exit();
					    }else{
					        echo '<js>dialog.alert("'.lang('edit').lang('success').'","","tourl(\'index.php?m=diary&a=browser&year='.date('Y',$time).'&month='.date('m',$time).'&day='.date('d',$time).'\')");</js>';
					        check_guest();
					    }
					}else{
					    echo '<js>dialog.alert("'.lang('edit').lang('success').'","","tourl(\'index.php?m=diary&a=browser&year='.date('Y',$time).'&month='.date('m',$time).'&day='.date('d',$time).'\')");</js>';
					}
					
				}else{
					echo '<js>dialog.alert("'.$status.'");</js>';		
				}
			}else{
				echo '<js>dialog.alert("'.lang('content_is_null').'");</js>';		
			}
		}else{
			echo '<js>dialog.alert("'.lang('datetime_is_null').'");</js>';	
		}
	}
	function onDelete()
	{
		check_admin();
		send_html_header();
		$year=get('year');
		$month=get('month');
		$day=get('day');
		$y=date("Y");
		$m=date("m");
		$d=date("d");
		if(true===diary_delete($year,$month,$day)){
			echo 'ok';
		}else{
			echo lang('delete').lang('failed');	
		}
	}
	
	function onUpconfig()
	{
	    check_adminUp();
	    $username=DIARY_ADMIN_USER;
	    $time=SESSION_DESTROY;
	    $GUEST=AU_GUEST;
	    include $this->tpl->template('upconfig.html');
	}
	
	/**
	 * 修改配置文件
	 */
	function onDoupconfig(){
	  check_adminUp();
      if(md5($_REQUEST['rpassword'].ENCODE_PASSWORD) != DIARY_ADMIN_PASSWORD){
          echo '<js>dialog.alert("原密码输入错误","","tourl(\'index.php?m=diary&a=upconfig\')");</js>';
          exit();
      }else{
          $Uname=$_REQUEST['username'];
         (!empty($Uname))?$username=$Uname:$username=DIARY_ADMIN_USER;
         $Pword=$_REQUEST['password'];
         ($Pword!='')?$password=md5($_REQUEST['password'].ENCODE_PASSWORD):$password=DIARY_ADMIN_PASSWORD;
         
         $Pword1=$_REQUEST['password1'];
         ($Pword1!='')?$password1=md5($_REQUEST['password1'].ENCODE_PASSWORD):$password1=DIARY_GUEST_PASSWORD;
         
         $Pword2=$_REQUEST['password2'];
         ($Pword2 !='')?$password2=md5($_REQUEST['password2'].ENCODE_PASSWORD):$password2=DIARY_GUEST_SMPWORD;
         
          $Ttime=$_REQUEST['time'];
         ($Ttime != '')?$time=$Ttime:$time=SESSION_DESTROY;
         
          $Tguest=$_REQUEST['guest'];
         ($Tguest != '')?$guest=$Tguest:$guest=AU_GUEST;
         
          $upconfig=require 'upconfig.php';
          
          if( write_file('config.php',$upconfig)){
              echo '<js>dialog.alert("资料修改成功","","tourl(\'index.php?m=index\')");</js>';
              exit();
          }
      }
	}
	
	/**
	 * 修改快速登陆权限
	 */
	function onUpauthorization()
	{
	    check_adminUp();
	    $sessionId=require 'sessionId.php';
	    $dis='0';
	    $sessionNow=session_id();
	    if(in_array(session_id(),$sessionId, TRUE)){
           $dis='1';
        }
	    include $this->tpl->template('upauthorization.html');
	}
	
	/**
	 * 提交修改快速登陆权限
	 */
	function onDoupauthorization()
	{
	    check_adminUp();
	    $sessionId=$_REQUEST['sessionId'];
	    $sessionId=array_filter ($sessionId);
	    $php_content="<?php\n!defined('DIARY_IN') && exit('Access Forbidden');\nreturn ".
	        var_export($sessionId,true).";";
	   
	   if( write_file('./lib/model/sessionId.php',$php_content)){
              echo '<js>dialog.alert("资料修改成功","","tourl(\'index.php?m=diary&a=Upauthorization\')");</js>';
              exit();
          }
	    
	}
}