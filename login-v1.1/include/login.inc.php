<?php 
session_start();
if (isset($_POST['submit'])){
	include 'dbh.inc.php';

	$uid = mysqli_real_escape_string($conn,$_POST['uid']);
	$pwd= mysqli_real_escape_string($conn,$_POST['pwd']);

	if(empty($uid) || empty($pwd)){
		header("location: ../index.php?login=empty");
			exit();
	}
	else{
		$sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1){
			header("location: ../index.php?login=error&username=$uid");
			exit();
		}else{
			if ($row = mysqli_fetch_assoc($result)) {
				//dehashing the password
				$hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
				if ($hashedPwdCheck==false) {
					header("location: ../index.php?login=error&username=$uid");
					exit();
				}elseif ($hashedPwdCheck==true){
					//login the user here
					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_first'] = $row['user_first'];
					$_SESSION['u_last'] = $row['user_last'];
					$_SESSION['u_email'] = $row['user_email'];
					$_SESSION['u_uid'] = $row['user_uid'];
					if (isset($_SESSION['u_id'])) {
					date_default_timezone_set('Asia/Rangoon');
					$date = date("Y-m-d H:i:sa");
					$type = 1;
					$id = $_SESSION['u_id'];
					$sql = "INSERT INTO login_details (user_id,last_activity,is_type) VALUES ('".$_SESSION['u_id']."','$date','$type');";
					mysqli_query($conn,$sql);
						}
					header("Location: ../index.php?login=success");
					exit();
				}
			}
		}
	}

}else{
	header("Location: ../index.php?login=error");
	exit();

}

 ?>