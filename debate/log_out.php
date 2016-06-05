<?php
	require_once('debate_fns.php');
	session_start();
	$old_user = $_SESSION['valid_user'];
	unset($_SESSION['valid_user']);
	$result_dest = session_destroy();
	do_html_header('Logged out!');
	if(!empty($old_user)){
		if($result_dest){
			header("location:signup.php");
		}else{
			echo "无法登出!</br>";
			do_html_footer();
		}
	}
	do_html_footer();
?>