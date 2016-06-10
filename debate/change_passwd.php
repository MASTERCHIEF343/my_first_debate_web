<?php
	header("Content-type: text/html; charset=utf-8");
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
		if(strlen($new_passwd) < 6 || strlen($new_passwd) > 16){
			throw new Exception("密码长度必须在6之16之间");
		}
		if(!change_password($_SESSION['valid_user'],$old_passwd,$new_passwd)){
			throw new Exception("无法更改密码");
		}
		do_change_username();
		echo "<div id='main_content'>";
		echo "密码 changed!";
		echo "</div>";
		do_main_page_footer();
	}
	catch(Exception $e){
		do_change_username();
		echo "<div id='err_content'>";
		echo $e->getMessage();
		echo "</div>";
		do_main_page_footer();
		exit;
	}
?>