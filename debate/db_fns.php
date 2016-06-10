<?php
	require('debate_fns.php');
	//register new member
	function register($username,$password,$email){
		$conn = db_connect();
		$results = "select * from user where username='".$username."' ";
		$results = $conn->query("select * from user where username='".$username."' ");
		if(!$results){
			throw new Exception("无法验证用户");
		}
		if($results->nuw_rows>1){
			throw new Exception("用户名已经被注册");
		}
		//success
		$result = $conn->query("insert into user values ('".$username."',sha1('".$password."'),'".$email."') ");
		if(!$result){
			throw new Exception("现在还不能注册");
		}
		return true;
	}

	//connect to db
	function db_connect(){
		$result = new mysqli('localhost','debate','debate','debate');
		if(!$result){
			throw new Exception("无法连接数据库");
		}else{
			return $result;
		}
	}

	//login fnc
	function login($username,$passwd){
		$conn = db_connect();
		$query = "select * from user where username='".$username."' and passwd=sha1('".$passwd."') ";
		$results = $conn->query($query);
		if(!$results){
			throw new Exception("无法验证用户");
		}
		if($results->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}

	function change_password($username,$old,$new){
		login($username,$old);
		$conn = db_connect();
		$result = $conn->query("update user set passwd=sha1('".$new."') where username='".$username."' ");
		if(!$result){
			return false;
		}else{
			return true;
		}
	}

	function expand_all(&$expanded){
		$conn = db_connect();
		$query = "select postid from header where children=1 ";
		$result = $conn->query($query);
		if(!$result){
			throw new Exception("无法连接数据库");
		}
		$num = $results->num_rows;
		for($i = 0;$i < $num;$i++){
			$this_row = $result->fetch_row();
			$expanded[$this_row[0]] = true;
		}
	}

	function get_post($postid){
		if(!$postid){
			return false;
		}
		$conn = db_connect();
		//get all header
		$query = "select * from header where postid='".$postid."' ";
		$result = $conn->query($query);
		if($result->num_rows!=1){
			return false;
		}
		$post = $result->fetch_assoc();
		//get all message
		$query = "select * from body where postid='".$postid."' ";
		$result2 = $conn->query($query);
		if($result2->num_rows>0){
			$body = $result2->fetch_assoc();
			if($body){
				$post['message'] = $body['message'];
			}
		}
		return $post;
	}

	function get_post_title($postid){
		if(!$postid){
			return '';
		}
		$conn = db_connect();
		$query = "select title from header where postid = '".$postid."'";
		$result = $conn->query($query);
		if($result->num_rows != 1){
			return '';
		}
		$this_row = $result->fetch_array();
		return $this_row[0];
	}

	function get_post_message($postid){
		if(!$postid){
			return '';
		}
		$conn = db_connect();
		$query = "select message from body where postid = '".$postid."'";
		$result = $conn->query($query);
		if($result->num_rows > 0){
			$this_row = $result->fetch_array();
			return $this_row[0];
		}
	}

	function add_quoting($string,$pattern = '>'){
		return $pattern.str_replace("\n", "\n$pattern", $string);
	}

	function store_new_post($post){
		$conn = db_connect();
		// check no fields are blank
		if(!filled_out($post))  {
		  return false;
		}
		$post = clean_all($post);

		//check parent exists
		if($post['parent']!=0)   {
		  $query = "select postid from header where postid = '".$post['parent']."'";
		  $result = $conn->query($query);
		  if($result->num_rows!=1)  {
		    return false;
		  }
		}


		//check not a duplicat(fu ben)
		$query = "select header.postid from header, body where header.postid = body.postid and header.parent = '".$post['parent']."' and header.poster = '".$post['poster']."' and header.title = '".$post['title']."' and header.area = '".$post['area']."' and body.message = '".$post['message']."' ";
		$result2 = $conn->query($query);
		if(!$result2){
			return false;
		}
		if($result2->num_rows>0){
			$this_row = $result2->fetch_assoc();
			return $this_row[0];
		}

		$query = "insert into header values ('".$post['parent']."',
             '".$post['poster']."','".$post['title']."',0,'".$post['area']."',now(),NULL)";
          $result = $conn->query($query);
          if(!$result){
          	return false;
          }
          //note that our parent now has a child
          $query = "update header set children=1  where postid='".$post['parent']."'";
          $result = $conn->query($query);
          if(!$result){
          	return false;
          }
          // find our post id, note that there could be multiple headers
          // that are the same except for id and probably posted time
		$query = "select header.postid from header left join body on header.postid = body.postid
		                 where parent = '".$post['parent']."'
		                 and poster = '".$post['poster']."'
		                 and title = '".$post['title']."'
		                 and body.postid is NULL";
		$result = $conn->query($query);
		if (!$result)  {
		   return false;
		}

		if($result->num_rows>0) {
		  $this_row = $result->fetch_array();
		  $id = $this_row[0];
		}
		if($id) {
		   $query = "insert into body values ($id, '".$post['message']."')";
		   $result = $conn->query($query);
		   if (!$result) {
		     return false;
		   }

		  return $id;
		}
	}

	//get children from db
	function get_postpage($post_name){
		$conn = db_connect();
		$query = "select parent from header where poster='".$post_name."' and parent=0 ";
		$result = $conn->query($query);
		$result = $result->num_rows;
		echo $result;
	}

	//get reply_quest
	function reply_quest($post_name){
		$conn = db_connect();
		$query = "select parent from header where poster='".$post_name."'";
		$result = $conn->query($query);
		$result = $result->num_rows;
		echo $result;
	}

	//get reply to me
	function get_children($post_name){
		$conn = db_connect();
		$query = "select children from header where poster='".$post_name."' and children!=0 ";
		$result = $conn->query($query);
		$result = $result->num_rows;
		echo $result;
	}
?>