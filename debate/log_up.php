<?php
	require_once('debate_fns.php');
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
		do_html_header("注册成功");
		url("main_page.php");
		dp_html_footer();
	}
	catch(Exception $e){
		do_html_header('Problem:');
		echo $e->getMessage();
		do_html_footer();
		exit;
	}
?>
