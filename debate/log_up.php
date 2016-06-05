<?php
	require_once('debate_fns.php');
	session_start();
	//short variables
	$username = $_POST['username'];
	$passwd = $_POST['password'];
	$email = $_POST['email'];
	$yanzheng = $_POST['yanzhengma'];
	//session
	session_start();
	try{
		//check forms filled in
		if(!filled_out($_POST)){
			throw new Exception("请填写完整的注册信息");
		}
		//check email
		if(!email_valid($email)){
			throw new Exception("邮箱格式不对");
		}
		//check password
		if((strlen($passwd) < 6) || (strlen($passwd) > 16)){
			throw new Exception("密码长度必须在6之16之间");
		}
		//register
		register($username,$passwd,$email);
		//register session variable
		$_SESSION['valid_user'] = $username;
		//$_SESSION['passwd'] = $passwd;
		//provide links to main pages
		$_SESSION['num'] = 0;
		header("location:main_page.php");
	}
	catch(Exception $e){
		do_html_header('Problem:');
		echo $e->getMessage();
		do_html_footer();
		exit;
	}
?>
