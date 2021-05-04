<?php
session_start();
include("../include/dbh.inc.php");
include ("../news/display.php");

$comment = $_POST['comment'];
$comment_date = date("Y-m-d h:i:s");
$article_id = $_POST['article_id'];
// article id , to user id , from user id
if (!empty($comment)){
	$sql = "INSERT INTO comments (comments,article_id,from_user_id,comment_date) VALUES ('$comment','$article_id',".$_SESSION['u_id'].",'$comment_date');";
	if(mysqli_query($conn,$sql)){
	echo disply_comment($article_id,$conn);
}
	// header("Location:  ../news/article.php?comment=success");
	// echo display_comment($article_id,$conn);
}else{
	header("Location:  ../news/article.php?comment=error");
}