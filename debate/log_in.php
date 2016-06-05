<?php
	require_once('debate_fns.php');
	session_start();
	//short variables
	$username = $_POST['username'];
	$password = $_POST['passwd'];
	$yanzheng = $_POST['yanzhengma'];
	session_start();
	try{
		//forms filled in
		if(!filled_out($_POST)){
			throw new Exception("请填写完整的信息");
		}
		if(login($username,$password)){
			$_SESSION['valid_user'] = $username;
			//$_SESSION['passwd'] = $passwd;
			$_SESSION['num'] += 1;
			header("location:main_page.php");
		}else{
			throw new Exception("用户名或密码错误");
		}
	}
	catch(Exception $e){
		do_html_header('Problem:');
		echo $e->getMessage();
		do_html_footer();
		exit;
	}
?>