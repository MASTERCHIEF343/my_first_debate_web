<?php
	require_once('debate_fns.php');
	session_start();
	
	//create session variable
	if(!isset($_SESSION['expanded'])){
		$_SESSION['expanded'] = array();
	}
	//check if an expand button was pressed
	if(isset($_GET['expand'])){
		if($_GET['expand'] == 'all'){
			expand_all($_SESSION['expanded']);
		}else{
			$_SESSION['expanded'][$_GET['expand']] = true;
		}
	}
	//check if an collapse button was pressed
	if(isset($_GET['collapse'])){
		if($_GET['collapse'] == 'all'){
			$_SESSION['expanded'] = array();
		}else{
			unset($_SESSION['expanded'][$_GET['collapse']]);
		}
	}

	do_main_page_header();
	display_tree($_SESSION['expanded']);
	do_main_page_footer();
?>