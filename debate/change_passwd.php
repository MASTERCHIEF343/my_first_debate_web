<?php
	require_once('debate_fns.php');
	session_start();
	$old_passwd = $_POST['oldpasswd'];
	$new_passwd = $_POST['newpasswd'];
	try{
		if(!filled_out($_POST)){
			throw new Exception("请填写完整的注册信息");
		}
		if($new_passwd == $old_passwd){
			throw new Exception("密码不能重复使用");
		}
		if((strlen($new_passwd) < 6) || (strlen($new_passwd > 16)) ){
			throw new Exception("密码必须在6-16之间");
		}
		if(change_password($_SESSION['valid_user'],$old_passwd,$new_passwd)){
			do_change_username();
			echo "<div id='main_content'>";
			echo "password changed.";
			echo "</div>";
			do_main_page_footer();
		}else{
			throw new Exception("无法更改密码");
		}
	}
	catch(Exception $e){
		do_change_username();
		echo $e->getMessage();
		do_main_page_footer();
		exit;
	}
?>