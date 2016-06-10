window.onload = function(){
	var Nav_signup = document.getElementById('#signup');
	var Nav_signin = document.getElementById('#signin');
	var Signup_form = document.getElementById('#signup_form');
	var Signin_form = document.getElementById('#signin_form');
	function signup(){
		signup_form.style.display = 'block';
		signin_form.style.display = 'none';
	}
	function signin(){
		signup_form.style.display = 'none';
		signin_form.style.display = 'block';
	}
}
	function signup(){
		signup_form.style.display = 'block';
		signin_form.style.display = 'none';
	}
	function signin(){
		signup_form.style.display = 'none';
		signin_form.style.display = 'block';
	}

	function changeCode(){
		document.getElementById('code').src = "checking_password.php?id="+Math.random();
	}