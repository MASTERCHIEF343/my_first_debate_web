<?php
	require_once('debate_fns.php');
	session_start();
	$old_user = $_SESSION['valid_user'];
	unset($_SESSION['valid_user']);
	$result_dest = session_destroy();
	do_html_header('Logged out!');
	if(!empty($old_user)){
		if($result_dest){
			echo "Logged out.</br>";
			url('signup.php');
			do_html_footer();
		}else{
			echo "Can't logged out.</br>";
			do_html_footer();
		}
	}
	do_html_footer();
?>