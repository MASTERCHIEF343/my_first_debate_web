<?php
	include('debate_fns.php');
	session_start();
	$title = $_POST['title'];
	$poster = $_POST['poster'];
	$message = $_POST['message'];
	//if has parent id
	$parent = $_GET['parent'];
	//area
	if(!$area){
		$area = 1;
	}
	//title
	if(!$error){
		//if don't have parentid
		if(!$parent){
			$parent = 0;
		}else{
		// get post name
		$title = get_post_title($parent);
		//append Re
		$message = add_quoting(get_post_message($parent));
		}
	}
	do_new_post_header($_SESSION['valid_user']);
	display_new_post_form($parent, $area, $title, $message, $poster);
	if($error) {
	   echo "<p style='width:30%;margin:20px auto;'>你的文章不能发表!</p>";
	}
	do_main_page_footer();
?>