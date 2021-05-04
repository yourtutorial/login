<?php  

include('database_connection.php');

session_start();
if(isset($_POST['is_type'])){
	$query = "
	UPDATE login_details
	SET is_type = '".$_POST["is_type"]."'
	WHERE login_details_id = '".$_SESSION["login_details_id"]."'
	";

mysqli_connect($query,$conn);
}

