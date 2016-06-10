<?php
	//check the form filled in
	function filled_out($forms){
		foreach ($forms as $key => $value) {
			if( (!isset($key)) || ($value == '') ){
				return false;
			}
		}
		return true;
	}
	//check email form
	function email_valid($email){
		if(preg_match('/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ',$email)){
			return true;
		}else{
			return false;
		}
	}
	//foreach post as a array
	function clean_all($form){
		foreach ($form as $key => $value) {
			$form[$key] = clean($value);
		}
		return $form;
	}
	//delete whit-spacing > trim
	//sql or others turn to html > htmlentities
	//delete "html" tags > strip_tags
	function clean($string){
		$string = trim($string); //remove white-spacing
		$string = htmlentities($string);  //change to html
		$string = strip_tags($string);  //delete html tags
		return $string;
	}
?>