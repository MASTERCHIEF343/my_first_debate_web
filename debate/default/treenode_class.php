<?php
	require_once('debate_fns.php');
	class treenode{
		//database variables
		public $m_postid;
		public $m_title;
		public $m_poster;
		public $m_posted;
		public $m_children;
		public $m_childlist;
		public $m_depth;

		public function __construct($postid, $title, $poster, $posted, $children, $expand, $depth, $expanded, $sublist){
			$this->m_postid = $postid;
			$this->m_title = $title;
			$this->m_poster = $poster;
			$this->m_posted = $posted;
			$this->m_children =$children;
			$this->m_childlist = array();
			$this->m_depth = $depth;

			//check sublist and expanded
			if( ($sublist || $expand) && $children ){
				$conn = db_connect();
				$query = "select * from header where parent='".$postid."' order by posted ";
				$result = $conn->query($query);
				for($count = 0;$row = @$result->fetch_assoc();$count++){
					if( ($sublist) || ($expanded[$row['postid']] == true)){
						$expand = true;
					}else{
						$expand = false;
					}
					$this->m_childlist[$count] = new treenode($row['postid'],$row['title'], $row['poster'],$row['posted'], $row['children'], $expand, $depth+1, $expanded, $sublist);
				}
			}
		}

		function display($row,$sublist=false){
			if($this->m_depth>-1){
				echo "<div id='message_box' ><h5>";
				echo "$this->m_poster";
				echo "</h5>";
				echo "<h3><a name=\"".$this->m_postid."\"><a href=
	               \"view_post.php?postid=".$this->m_postid."\">".$this->m_title."</a></h3>";
	               $row++;
	               echo "<span id='span_one' >";
	               echo "<img src='images/plus.png' >";
	               echo "<h6>关注</h6>";
	               echo "<h6>";
	               echo "<img src='images/comments.png'><h6>";
	               echo "回复: ";
	               echo "$this->m_children";
	               echo "</h6>";
	               echo "</span>";
	               echo "<span id='span_two'>";
	               echo "<h6>";
	               echo "$this->m_posted";
	               echo "</h6>";
	               echo "</span>";
	               echo "</div>";
				}
				$num_children = sizeof($this->m_childlist);
				for($i = 0; $i<$num_children; $i++) {
				  $row = $this->m_childlist[$i]->display($row, $sublist);
				}
				return $row;
		}

		function display_replay($row,$sublist=false){
			if($this->m_depth>-1){
				echo "<div id='rel_list'>";
				echo "<img src='images/personal.png' ><div id='rel_message'>";
				echo "<h5>";
				echo "$this->m_poster";
				echo "</h5>";
				echo "<span>回复:<a name=\"".$this->m_postid."\"><a href=
	               \"view_post.php?postid=".$this->m_postid."\">".$this->m_title."</a></span></div>";
	             echo "</div>";
	             $row++; 
				}
				$num_children = sizeof($this->m_childlist);
				for($i = 0; $i<$num_children; $i++) {
				  $row = $this->m_childlist[$i]->display_replay($row, $sublist);
				}
				return $row;
		}

	}
?>