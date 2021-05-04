<?php 
include ('database_connection.php');
session_start();
date_default_timezone_set('Asia/Rangoon');
$current_time = date('Y-m-d H:i:s');
//$uid = $_SESSION['u_id'];
$sql="SELECT * FROM login_details WHERE user_id= '".$_SESSION['u_id']."' ORDER BY last_activity DESC LIMIT 1;";

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if($_SESSION['login_detail_id']=$row['login_detail_id']){
  			$query = "UPDATE login_details SET last_activity ='$current_time'  WHERE login_detail_id = '".$_SESSION['login_detail_id']."';";
  			mysqli_query($conn,$query);
  		}