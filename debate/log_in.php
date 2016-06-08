<?php
	require_once('debate_fns.php');
	session_start();
	//short variables
	$username = $_POST['name'];
	$password = $_POST['passwd'];
	$yanzheng = $_POST['yzm'];
	//forms filled in
	if(!filled_out($_POST)){	
		echo "请填写完整的信息";
		throw new Exception("请填写完整的信息");
	}else{
		if($yanzheng !== $_SESSION["validcode"]){
			echo "验证码错误";
			throw new Exception("验证码错误");
		}else{
			if(login($username,$password)){
				$_SESSION['valid_user'] = $username;
				//$_SESSION['passwd'] = $passwd;
				$_SESSION['num'] += 1;
			}else{
				echo "用户名或密码错误";
				throw new Exception("用户名或密码错误");
			}
		}
	}
?>