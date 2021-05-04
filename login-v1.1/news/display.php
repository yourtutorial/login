<?php 
include("../include/dbh.inc.php");
// like state
function like_state($article_id,$from_user_id,$conn){
	$sql = "SELECT * FROM likes WHERE article_id=$article_id AND from_user_id=$from_user_id ;";
	$statement = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($statement);
	$color = "";
	if ($row == 0){
		return $color;
	}else{
		$color = " color";
		return $color;
	}

}

function num_of_like($article_id,$conn){
	$sql = "SELECT * FROM likes WHERE article_id = '$article_id';";
	$statement = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($statement);
	return $row;
}
// like state

// comment section
function disply_comment($article_id,$conn){
	$output ='';
	$articleid = $article_id;
	$comment_sql ="SELECT * FROM comments WHERE article_id='$articleid';";
	$comment_query = mysqli_query($conn,$comment_sql);
	$comment_result = mysqli_num_rows($comment_query);
	
		if($comment_result>0){
			$output .= '<ul class="list-unstyled">';
			foreach ($comment_query as $comment_assoc) {
				$comment = $comment_assoc['comments'];
				$c_date = $comment_assoc['comment_date'];
						// echo '<p >'.$comment_assoc['comments'].'</p>';
						// echo '<p >'.$comment_assoc['comment_date'].'</p>';
						$output .= '<li style="list-style:none; border-bottom:1px dotted #ccc:padding-top:8px;padding-left:8px;padding-right:8px;">
				<p>'.$comment.'-'.$c_date.'</p></li>';
	}
	$output .='</ul>';
	return $output;
				
			}			
}
function load_comments($article_id,$conn){
	$articleid = $article_id;
	$comment_sql ="SELECT * FROM comments WHERE article_id='$articleid';";
	$comment_query = mysqli_query($conn,$comment_sql);
	$comment_result = mysqli_num_rows($comment_query);
	if($comment_result>0){
		foreach ($comment_query as $comment_assoc) {
			echo '<p >'.$comment_assoc['comments'].'</p>';
			echo '<p >'.$comment_assoc['comment_date'].'</p>';
				}
		}
}

// comment section


// user info section
function get_user_name($user_id,$conn){
	$query = "SELECT user_uid FROM users WHERE user_id = '$user_id';";
	$statement=mysqli_query($conn,$query);
	foreach ($statement as $row) {
		return $row['user_uid'];
	}
}

// user info section

// article section
function display_article($conn){
	$sql = "SELECT * FROM article ORDER BY article_date DESC;";
	$statement = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($statement);

	if($row > 0){
		foreach ($statement as $row) {
			echo "<div class='article".$row['article_id']."'>";
			// echo "<h3>This is ";
			// echo get_user_name($user_id,$conn);
			// echo "'s profile</h2>";
			echo '<div class="article">';
		echo '<a href="../profile/profile.php?userid='.$row['user_id'].'">'.get_user_name($row['user_id'],$conn).'</a>';
		echo '<p>'.$row['article'].'</p>';
		echo '<p>'.$row['article_date'].'</p>';
		echo '<span id="'.$row['article_id'].'">'.num_of_like($row['article_id'],$conn).'</span>';
		echo '<br>';

		// need to add some parameters
		echo "<button class='btn-like".like_state($row['article_id'],$_SESSION['u_id'],$conn)."' id='".$row['article_id']."'>Like</button>";
		// need to add some parameters
		echo "<button class='comment-btn' id='".$row['article_id']."'>Comment</button>";
		echo '</div>';
		echo '<div class="comment'.$row['article_id'].'" style="max-height:200px;overflow-y:scroll;" >';
		echo '<div class="commentdata'.$row['article_id'].'">';
		echo '</div>';
		echo '</div>';
		echo '<div class="comment-form">';
		echo '<textarea class="addcomment'.$row['article_id'].'" style="border-radius: 10px;border: none"></textarea><button type="button" class="comment_submit" id ="'.$row['article_id'].'" name="comment">Submit</button>';
		echo "</div>";
		echo '</div>';
		echo '<br>';
		}
	}else{
		echo "No post yet";
	}
}
// article section





	



				

