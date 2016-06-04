<?php
	include('debate_fns.php');
	if($id = store_new_post($_POST)){
		include('main_page.php');
	}else{
		$error = true;
		include('new_post.php');
	}
?>