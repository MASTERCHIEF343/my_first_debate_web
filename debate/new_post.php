<?php
	include('debate_fns.php');
	session_start();
	$title = $_POST['title'];
	$poster = $_POST['poster'];
	$message = $_POST['message'];
	//if has parent id
	if(isset($_GET['parent'])){
		$parent = $_GET['parent'];
	}else{
		$parent = $_POST['parent'];
	}
	//area
	if(!$area){
		$area = 1;
	}
	//title
	if(!$error){
		//if don't have parentid
		if(!$parent){
			$parent = 0;
			if(!$title){
				$title = 'New Post';
			}
		}else{
		// get post name
		$title = get_post_title($parent);
		//append Re
		if(strstr($title, 'Re: ') == false){
			$title = 'Re: '.$title;
		}
		$title = substr($title, 0,20);
		$message = add_quoting(get_post_message($parent));
		}
	}
	do_new_post_header($_SESSION['valid_user']);
	display_new_post_form($parent, $area, $title, $message, $poster);
	if($error) {
	   echo "<p>Your message was not stored.</p>
	         <p>Make sure you have filled in all fields and try again.</p>";
	}
	do_main_page_footer();
?>