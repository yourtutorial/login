<?php
include('database_connection.php');
session_start();
if(isset($_POST["chat_message_id"])){
	$sql = "UPDATE chat_message
	SET status = '2' 
	WHERE chat_message_id ='".$_POST["chat_message_id"]."';";
	mysqli_query($conn,$sql);
}
