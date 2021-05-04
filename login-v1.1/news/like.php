<?php
session_start();
include("../include/dbh.inc.php");
require 'display.php';
date_default_timezone_set('Asia/Rangoon');

$datetime = date("Y-m-d H:i:sa");
$article_id = $_POST['article_id'];
$from_user_id = $_SESSION['u_id'];

$sql = "SELECT * FROM likes WHERE article_id='$article_id' AND from_user_id='$from_user_id';";

$statement = mysqli_query($conn,$sql);
$row = mysqli_num_rows($statement);
if ($row < 1 ){
$sql = "INSERT INTO likes (article_id,from_user_id,date_time) 
 			VALUES ('$article_id','$from_user_id','$datetime');";

mysqli_query($conn,$sql);
}else{
$sql = "DELETE FROM likes 
 		WHERE  article_id='$article_id'
 		AND from_user_id='$from_user_id';";

 		mysqli_query($conn,$sql);
 		
 	}
 echo display_article($conn);
