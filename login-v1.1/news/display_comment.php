<?php 
session_start();
include("../include/dbh.inc.php");
require 'display.php';
// function disply_comment($article_id,$conn){
// 	$output ='';
// 	$articleid = $article_id;
// 	$comment_sql ="SELECT * FROM comments WHERE article_id='$articleid';";
// 	$comment_query = mysqli_query($conn,$comment_sql);
// 	$comment_result = mysqli_num_rows($comment_query);
	
// 		if($comment_result>0){
// 			$output .= '<ul class="list-unstyled">';
// 			foreach ($comment_query as $comment_assoc) {
// 				$comment = $comment_assoc['comments'];
// 				$c_date = $comment_assoc['comment_date'];
// 						// echo '<p >'.$comment_assoc['comments'].'</p>';
// 						// echo '<p >'.$comment_assoc['comment_date'].'</p>';
// 						$output .= '<li style="list-style:none; border-bottom:1px dotted #ccc:padding-top:8px;padding-left:8px;padding-right:8px;">
// 				<p>'.$comment.'-'.$c_date.'</p></li>';
// 	}
// 	$output .='</ul>';
// 	return $output;
				
// 			}			
// }

if (isset($_POST['article_id'])){

echo disply_comment($_POST['article_id'],$conn);

}