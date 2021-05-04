<?php
include("../include/dbh.inc.php");
function is_follow($from_user,$to_user,$conn){
	$sql = "SELECT * FROM is_friend WHERE from_user_id='$from_user' AND to_user_id='$to_user';";
	$statement = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($statement);
	if ($row > 0 ){
		return "followed";
	}
	else{
		return "follow";
	}
}

function is_block($from_user,$to_user,$conn){
	$sql = "SELECT from_user_id='$from_user' AND to_user_id='$to_user' OR from_user_id='$to_user' AND to_user_id='$from_user' FROM is_friend WHERE status='2';";
	$statement = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($statement);
	if ($row > 0 ){
		echo "blocked";
	}
}

function be_friend($from_user,$to_user,$conn){
	$sql = "SELECT from_user_id='$from_user' AND to_user_id='$to_user' OR from_user_id='$to_user' AND to_user_id='$from_user' FROM is_friend WHERE status='0';";
	$statement = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($statement);
	if ($row > 0 ){
		echo "be_friend";
	}
}

function follow($from_user,$to_user,$conn){
	$sql = "SELECT from_user_id='$from_user' AND to_user_id='$to_user' OR from_user_id='$to_user' AND to_user_id='$from_user' FROM is_friend WHERE status='3';";
	$statement = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($statement);
	if ($row > 0 ){
		echo "follow";
	}else{
		echo "not followed yet";
	}

}

function mute ($from_user,$to_user,$conn){
	$sql = "SELECT from_user_id='$from_user' AND to_user_id='$to_user' OR from_user_id='$to_user' AND to_user_id='$from_user' FROM is_friend WHERE status='3';";
	$statement = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($statement);
	if ($row > 0 ){
		echo "mute";
	}

}