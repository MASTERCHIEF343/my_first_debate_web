<?php
	include('debate_fns.php');
	$table_width = '580';
	session_start();
	function do_html_header($title){
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width,initial-scale=1" />
				<meta name="author" content="Anonymous" />
				<meta name="theme-login" content="web-debate" />
				<title><?php echo $title; ?></title>
				<link rel="stylesheet" type="text/css" href="css/main.css">
				<link rel="stylesheet" type="text/css" href="src/tub.css">
				<script type="text/javascript" src="src/tub.js"></script>
			</head>
			<body>
		<?php
	}

	function do_html_footer(){
		?>
			</body>
			<script type="text/javascript" src="js/nav_slider.js"></script>
			</html>
		<?php
	}

	function do_html_login_form(){
		?>
			<div id="main-content">
				<div id="signup">
					<div class="form-header">
						<h1>Fuck The World!</h1>
						<h2>welcome to the wonderland! let's so fuck the reality!</h2>
					</div>
					<div class="form-nav">
						<div class="navs-slider">
							<a id="signup" class="active navs" href="javascript:;" onclick="signup()">注册</a>
							<a id="signin" href="javascript:;" class="navs" onclick="signin()">登陆</a>
						</div>
					</div>
					<form id="signup_form" class="form-actived" name="signup_form" method="post" action="log_up.php">
						<div class="form-view">
							<div class="input-type">
								<input type="text" name="username" placeholder="username"></input>
							</div>
							<div class="input-type">
								<input type="password" name="password" placeholder="passwd"></input>
							</div>
							<div class="input-type">
								<input type="text" name="email" placeholder="email"></input>
							</div>
						</div>
						<div class="form-footer">
							<div class="input-type">
								<input id="sign" class="tab-submit" type="submit" value="注册" ></input>
							</div>
						</div>
					</form>
					<form id="signin_form" name="signin_form" method="post" action="log_in.php">
						<div class="form-view">
							<div class="input-type">
								<input type="text" name="username" placeholder="username"></input>
							</div>
							<div class="input-type">
								<input type="password" name="passwd" placeholder="passwd"></input>
							</div>
							<div class="input-type">
								<input id="yanzhengma" type="text" name="validate" placeholder="验证码"></input>
								<img src="checking_password.php" style="width:100px;height:25px;" id="code"/>  
								<a href="javascript:changeCode()">看不清，换一张</a>
							</div>
						</div>
						<div class="form-footer">
							<div class="input-type">
								<input id="sign" class="tab-submit" type="submit" value="登陆" ></input>
							</div>
						</div>
					</form>
				</div>
			</div>

		<?php
	}

	function url($url){
		?>
			<div>
				<a href="<?php echo $url; ?>" ><?php echo "$url"; ?></a>
			</div>
		<?php
	}

	function do_main_page_header(){
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width,initial-scale=1" />
				<meta name="author" content="Anonymous" />
				<meta name="theme-mainpage" content="web-debate" />
				<title><?php echo $title; ?></title>
				<link rel="stylesheet" type="text/css" href="css/main_page.css">
				<link rel="stylesheet" type="text/css" href="src/tub.css">
				<script type="text/javascript" src="src/tub.js"></script>
				<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){
						$("#tag").bind("click", function () {
							$("#nav_top_bar").slideToggle(500);
				          });
				     })
					$(document).on("mousewheel DOMMouseScroll", function (e) {
					    
					    var delta = (e.originalEvent.wheelDelta && (e.originalEvent.wheelDelta > 0 ? 1 : -1)) ||  // chrome & ie
					                (e.originalEvent.detail && (e.originalEvent.detail > 0 ? -1 : 1));              // firefox
					               //originalEvent ---> jquery.event 	
					    
					    if (delta > 0) {
					        // 向上滚
					        $("#navigation").slideDown(300);
					        $("#title_bar").css("margin-top",50);
					    } else if (delta < 0) {
					        // 向下滚
					        $("#navigation").slideUp(300);
					        $("#title_bar").css("margin-top",10);
					    }
					});  
				</script>
			</head>
			<body>
				<div id="navigation">
					<div id="navigation_content">
						<div id="tag"></div>
						<h3>Fuck!</h3>
						<div id="nav_search">
							<input type="text"></input>
							<button>搜索</button>
						</div>
						<div id="nav_top_bar" >
							<ul id="nav_top_bar_ul">
								<li>
									<a href="main_page.php">首页</a>
								</li>
								<li>
									<a href="#">话题</a>
								</li>
								<li>
									<a href="new_post.php?parent=0">发帖</a>
								</li>
								<li>
									<a href="">消息</a>
								</li>
								<li>
									<a href="log_out.php">登出</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div id="title_bar">
					<img src="images/home.png">
					<span>最新动态</span>
					<span id="setiting">
						<a href="personal.php">设置</a>
						<img src="images/setting.png">
					</span>
				</div>
		<?php
	}

	function do_personal_page(){
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width,initial-scale=1" />
				<meta name="author" content="Anonymous" />
				<meta name="theme-mainpage" content="web-debate" />
				<title><?php echo $title; ?></title>
				<link rel="stylesheet" type="text/css" href="css/personal_page.css">
				<script type="text/javascript">
					window.onload = function(){
						//side_bar change
						var oDiv = document.getElementById('side_bar');
						var aLinks = oDiv.getElementsByTagName('a');
						//personal_list change
						var oPerson = document.getElementById('personal_list');
						var oSet = document.getElementById('setting_list');
						aLinks[0].onclick = function(){
							if(this.className == 'no_actived'){
								this.className = 'actived';
								aLinks[1].className = 'no_actived';
								oPerson.className = 'show_div';
								oSet.className = 'hide_div';
							}
						}
						aLinks[1].onclick = function(){
							if(this.className == 'no_actived'){
								this.className = 'actived';
								aLinks[0].className = 'no_actived';
								oPerson.className = 'hide_div';
								oSet.className = 'show_div';
							}
						}
						//scroll--nav to hide
					}
				</script>
			</head>
			<body>
				<div id="navigation">
					<div id="navigation_content">
						<a id="back_buttton" href="main_page.php"></a>
						<div id="personal">
							<div></div>
							<span><?php echo $_SESSION['valid_user']; ?></span>
						</div>
						<div id="side_bar">
							<a class="actived" href="#">个人主页</a>
							<a class="no_actived" href="#">详细信息</a>
						</div>
					</div>
				</div>
				<div id="main_content">
					<div id="personal_list" class="show_div box_border">
						<div>
							<ul>
								<li>
									<span>关注的话题</span>
									<span>3</span>
								</li>
								<li>
									<span>我关注的人</span>
									<span>3</span>
								</li>
								<li>
									<span>回复我的人</span>
									<span>
										<?php get_children($_SESSION['valid_user']) ?>
									</span>
								</li>
							</ul>
						</div>
						<div>
							<ul>
								<li>
									<img src="images/test.png">
									<span>发布的文章<i>
										<?php get_postpage($_SESSION['valid_user']) ?>
									</i></span>
								</li>
								<li>
									<img src="images/reply.png">
									<span>回答的文章<i>
										<?php reply_quest($_SESSION['valid_user']) ?>
									</i></span>
								</li>
							</ul>
						</div>
					</div>
					<div id="setting_list" class="hide_div box_border">
						<div id="setting_list_div">
							<span>
								<h4>更改密码</h4>
							</span>
							<div id="setting_list_form_div">
								<form method="post" action="change_passwd.php">
									<div class="setting_list_div">
										<input type="password" name="oldpasswd" placeholder="旧密码"></input>
									</div>
									<div class="setting_list_div">
										<input type="password" name="newpasswd" placeholder="新密码"></input>
									</div>
									<div class="setting_list_div">
										<input id="sign" class="tab-submit" type="submit" value="提交" ></input>
									</div>
								</form>
							</div>
						</div>
						<div id="setting_list_div">
							<span>
								<h4>更改用户名</h4>
							</span>
							<div id="setting_list_form_div">
								<form method="post" action="change_username.php">
									<div class="setting_list_div" id="setting_input">
										<input type="username" name="newusername" placeholder="新用户名"></input>
									</div>
									<div class="setting_list_div" id="setting_input">
										<input id="sign" class="tab-submit" type="submit" value="提交" ></input>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
		<?php
	}

	function do_change_username(){
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width,initial-scale=1" />
				<meta name="author" content="Anonymous" />
				<meta name="theme-mainpage" content="web-debate" />
				<title><?php echo $title; ?></title>
				<link rel="stylesheet" type="text/css" href="css/personal_page.css">
			</head>
			<body>
				<div id="navigation">
					<div id="navigation_content">
						<a id="back_buttton" href="personal.php"></a>
						<div id="personal">
							<div></div>
							<span><?php echo $_SESSION['valid_user']; ?></span>
						</div>
					</div>
				</div>
		<?php
	}

	function do_main_page_header_2(){
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width,initial-scale=1" />
				<meta name="author" content="Anonymous" />
				<meta name="theme-mainpage" content="web-debate" />
				<title><?php echo $title; ?></title>
				<link rel="stylesheet" type="text/css" href="css/main_page.css">
			</head>
			<body>
				<div id="navigation">
					<div id="navigation_content">
						<h3>Fuck!</h3>
						<div id="nav_search">
							<input type="text"></input>
							<button>搜索</button>
						</div>
						<div id="nav_top_bar">
							<ul>
								<li>
									<a href="main_page.php">首页</a>
								</li>
								<li>
									<a href="#">话题</a>
								</li>
								<li>
									<a href="new_post.php?parent=0">发帖</a>
								</li>
							</ul>
						</div>
						<div id="nav_personal">
							<ul>
								<li>
									<a href="personal.php">个人</a>
								</li>
								<li>
									<a href="log_out.php">登出</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
		<?php
	}


	function do_main_page_footer(){
		?>
			</body>
			</html>
		<?php
	}

	function display_tree($expanded,$row=0,$start=0){
		global $table_width;
		echo "<div id=\"main_content\">";
		echo "<table width=\"".$table_width."\"> ";
		//whether display the whole list or sublist
		if($start > 0){
			$sublist = true;
		}else{
			$sublist = false;
		}
		//construct tree to represent conversation
		$tree = new treenode($start,'','','',1,true,-1,$expanded,$sublist);
		$tree->display($row,$sublist);
		echo "</table>";
		echo "</div>";
	}

	function do_new_post_header($username){
		?>
			<!DOCTYPE html>
			<html lang="en">
			<head>
				<meta name="viewport" content="width=device-width,initial-scale=1" />
				<meta name="author" content="Anonymous" />
				<meta name="web-debate" content="theme-new-post" />
				<title><?php echo "发表问题"; ?></title>
				<link rel="stylesheet" type="text/css" href="css/new_post.css">
				<script type="text/javascript">
						function go_back(){
							history.go(-1);
						}
				</script>
			</head>
			<body>
				<header>
					<div id="nav">
						<a onclick="go_back()" id="alink"></a>
						<div id="nav-user">
							<div></div>
							<span>
								<?php echo $username; ?>
							</span>
							<h6>孤独的人不会走出房间</h6>
						</div>
					</div>
				</header>
		<?php
	}

	function display_new_post_form($parent=0,$area=1,$title='',$message='',$poster=''){
		global $table_width;
		?>
			<div id="main-content">
				<table cellpadding="0" cellspacing="0" border="0" width="<?php echo $table_width; ?>">
					<form action="store_new_post.php?expand=<?php echo $parent;?>#<?php echo $parent;?>" method="post">
						<tr class="tr-css">
							<td class="text-align">姓名</td>
							<td class="text-input">
								<input type="text" name="poster" value="<?php echo $_SESSION['valid_user']; ?>" size="20" maxlength="20"></input>
							</td>
						</tr>
						<tr class="tr-css">
							<td class="text-align">标题</td>
							<td class="text-input"><input type="text" name="title" size="20" maxlength="20" /></td>
						</tr>
						<tr class="tr-css">
							<td class="text-align">内容</td>
							<td colspan="2">
							  <textarea id="message" name="message" rows="10" cols="50"></textarea>
							</td>
						</tr>
						<tr class="tr-css">
							<td>
							  <input id="submit" type="submit"/>
							</td>
						</tr>
					</form>
				</table>
			</div>
		<?php
	}

	function do_view_post_header($username){
		?>
			<!DOCTYPE html>
			<html lang="en">
			<head>
				<meta name="viewport" content="width=device-width,initial-scale=1" />
				<meta name="author" content="Anonymous" />
				<meta name="web-debate" content="theme-new-post" />
				<title><?php echo "发表问题"; ?></title>
				<link rel="stylesheet" type="text/css" href="css/view_post.css">
				<script type="text/javascript">
						function go_back(){
							history.go(-1);
						}
					
				</script>
			</head>
			<body>
				<header>
					<div id="nav">
						<a onclick="go_back()" id="alink"></a>
						<div id="nav-user">
							<div></div>
							<span>
								<?php echo $username; ?>
							</span>
							<h6>孤独的人不会走出房间</h6>
						</div>
					</div>
				</header>
		<?php
	}

	function display_post($post){
		global $table_width;
		if(!$post){
			return false;
		}
		?>
			<div id="main-content">
			<table width="<?php echo $table_width; ?>" cellpadding="4" cellspacing="0">
				<tr>
					<td colspan="2">
						<?php echo nl2br($post['message']); ?>
						<br />
						<br />
						<span id="post-time">创建于: <?php echo $post['posted'];?></span>
					</td>
				</tr>
			</table>	
			</div>
		<?php
	}


	function display_tree2($expanded,$row=0,$start=0){
		//whether display the whole list or sublist
		if($start > 0){
			$sublist = true;
		}else{
			$sublist = false;
		}
		//construct tree to represent conversation
		$tree = new treenode($start,'','','',1,true,-1,$expanded,$sublist);
		$tree->display_replay($row,$sublist);
	}

	function display_bottom_bar(){
		?>
			<div id="bottom_bar">
				<ul>
					<li>
						<a href="new_post.php?parent=0">new</a>
					</li>
					<li>
						<a href="new_post.php?parent=<?php echo $post['postid']; ?>">reply</a>
					</li>
				</ul>
			</div>
		<?php
	}

?>