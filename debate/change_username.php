<?php
	header("Content-type: text/html; charset=utf-8");
	require_once('debate_fns.php');
	session_start();
	$new_username = $_POST['newusername'];
	$old_username = $_SESSION['valid_user'];
	try{
		if(!filled_out($_POST)){
			throw new Exception("请填写完整的注册信息");
		}
		if($new_username == $old_username){
			throw new Exception("用户名不能重复");
		}
		if(!change_username($new_username,$old_username)){
			throw new Exception("无法更改用户名");
		}
		do_change_username();
		echo "<div id='main_content'>";
		echo "用户名 changed!";
		echo "</div>";
		do_main_page_footer();
	}catch(Exception $e){
		do_change_username();
		echo "<div id='err_content'>";
		echo $e->getMessage();
		echo "</div>";
		do_main_page_footer();
		exit;
	}
?>