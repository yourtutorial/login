<?php 
session_start();
include("../include/dbh.inc.php");
function find_method($user,$conn){
	$def = array();
// rel $ activity
	$chat_sql = "SELECT to_user_id FROM chat_message WHERE from_user_id='$user';";
	$rel_sql="SELECT "
}

 ?>