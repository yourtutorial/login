<?php
session_start();
include("../include/dbh.inc.php");
include ("user_states.php");

date_default_timezone_set('Asia/Rangoon');
if(isset($_POST['to_user_id'])){
	$datetime = date("Y-m-d H:i:sa");
	$sql = "SELECT * FROM is_friend WHERE from_user_id='".$_SESSION['u_id']."' AND to_user_id='".$_POST['to_user_id']."';";
	$statement = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($statement);
	if ($row < 1 ){
		$sql = "INSERT INTO is_friend (from_user_id,to_user_id,statue,date_time) 
 			VALUES ('".$_SESSION['u_id']."','".$_POST['to_user_id']."',1,'$datetime');";
 			mysqli_query($conn,$sql);
			echo is_follow($_SESSION['u_id'],$_POST['to_user_id'],$conn);
}else{
	$sql = "DELETE FROM is_friend 
 		WHERE  from_user_id='".$_SESSION['u_id']."'
 		AND to_user_id='".$_POST['to_user_id']."';";

 	mysqli_query($conn,$sql);
 	echo is_follow($_SESSION['u_id'],$_POST['to_user_id'],$conn);
 		
 	}
 }else{
 	echo "error";
 }
