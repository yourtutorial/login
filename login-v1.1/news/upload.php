<?php
session_start();
include("../include/dbh.inc.php");
date_default_timezone_set('Asia/Rangoon');

$article = mysqli_real_escape_string($conn, $_POST['article']);
$date = date("Y-m-d H:i:sa");
//  user id 
if(!empty($article)){
	$sql = "INSERT INTO article (article,user_id,article_date) VALUES ('$article',".$_SESSION['u_id'].",'$date') ;";

	mysqli_query($conn,$sql);

	header("Location:  ../news/article.php?upload=success");
	exit();
}else{
	header("Location:  ../news/article.php.php?upload=error");
}


