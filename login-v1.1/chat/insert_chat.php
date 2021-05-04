<?php  
require 'database_connection.php';
session_start();
$to_user_id = $_POST['to_user_id'];
$from_user_id = $_SESSION['u_id'];
$chat_message = $_POST['chat_message'];
$status ='1';
$date = date("Y-m-d H:i:s");
$query =
"INSERT INTO chat_message (to_user_id,from_user_id,chat_message,timestamp,status)
		VALUES ('$to_user_id','$from_user_id','$chat_message','$date','$status');";
if(mysqli_query($conn,$query)){
	echo fecth_user_chat_history($_SESSION['u_id'],$_POST['to_user_id'],$conn);
}