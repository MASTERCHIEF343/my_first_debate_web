<?php
	session_start();
	require_once('debate_fns.php');
	//short variables
	$username = $_POST['username'];
	$password = $_POST['passwd'];
	$yanzheng = $_POST['validate'];
	try{
		//forms filled in
		if(!filled_out($_POST)){
			throw new Exception("请填写完整的信息");
		}
		if($yanzheng !== $_SESSION["validcode"]){
			throw new Exception("验证码错误");
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
		$error = $e->getMessage();
		echo "<script type='text/javascript'>
			window.onload = function(){
				tub.alert('$error');
			}
		</script>";
		echo "<meta http-equiv='refresh' content='0.8; url=signup.php'' />";
		do_main_page_footer();
		exit;
	}
?>