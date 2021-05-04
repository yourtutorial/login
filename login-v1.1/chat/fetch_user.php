<?php

include('database_connection.php');

session_start();

$query = "SELECT * FROM users WHERE user_id != ".$_SESSION['u_id'].";";

$statement = mysqli_query($conn, $query);


$output ='
	<table class="row mb-3">
	<tr>
		<td class="col-4 themed-grid-col">Username</td>
		<td class="col-4 themed-grid-col">Status</td>
		<td class="col-4 themed-grid-col">Action</td>
	</tr>
';

foreach ($statement as $result) {
	# code...
	date_default_timezone_set('Asia/Rangoon');
	$status = '';
	$current_time = date('Y-m-d H:i:s');
	$current_timestamp = strtotime("-60 seconds",strtotime($current_time));
	$current_timestamp = date('Y-m-d H:i:s',$current_timestamp);
	$user_last_activity =fetch_user_last_activity($result['user_id'],$conn);
	// $user_last_activity = date('Y-m-d H:i:s',$user_last_activity);
	$message = count_unseen_message($result['user_id'],$_SESSION["u_id"],$conn);
	if($user_last_activity > $current_timestamp){

		$status = '<span class="label label-success">Online</span>';
	}else{

		$status = '<span class="label label-danger">Offline</span>';
	}
	$output .='
	<tr>
		<td>'.$result['user_uid'].''.$message.''.fetch_is_type_status($result['user_id'],$conn).'</td>
		<td>'.$status.'</td>
		<td>
			<button type="button" id="start_chat" class="btn btn-info btn-xs start_chat" data-touserid="'.$result['user_id'].'" data-tousername="'.$result['user_uid'].'" >Start Chat
			</button>
		</td>
	</tr>
	';
	// $output .='
	// <tr>
	// 	<td>'.$result['username'].''.count_unseen_message($result['user_id'],$_SESSION['user_id'],$connect).''.fetch_is_typing_status($result['user_id'],$connect).'</td>
	// 	<td>'.$status.'</td>
	// 	<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$result['username'].'">Start Chat</button></td>
	// </tr>
	// ';

}
$output .='</table>';

echo $output;