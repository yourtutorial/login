<?php
include("../include/dbh.inc.php");
include("../news/display.php");


function user_posts($user_id,$conn){
	$sql = "SELECT * FROM article WHERE user_id = '$user_id' ORDER BY article_date DESC;";
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
		echo '<div class="comment'.$row['article_id'].'" >';
		echo '<div class="commentdata'.$row['article_id'].'">';
		echo '</div>';
		echo '</div>';
		echo '<div class="comment-form">';
		echo '<textarea class="addcomment'.$row['article_id'].'""></textarea><button type="button" class="comment_submit" id ="'.$row['article_id'].'" name="comment">Submit</button>';
		echo "</div>";
		echo '</div>';
		echo '<br>';
		}
	}else{
		echo "No post yet";
	}

}