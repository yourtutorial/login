<?php
include("../include/dbh.inc.php");
date_default_timezone_set('Asia/Rangoon');

function fetch_user_last_activity($user_id,$conn){
	$query = "SELECT * FROM login_details WHERE user_id= '$user_id' ORDER BY last_activity DESC LIMIT 1;";
	$statement=mysqli_query($conn,$query);
	$result = mysqli_fetch_assoc($statement);
	foreach ($statement as $row) {
		return $row['last_activity'];
	}
}

function fecth_user_chat_history($from_user_id,$to_user_id,$conn){

	$query ="
		SELECT * FROM chat_message 
		WHERE (from_user_id='".$from_user_id."' AND to_user_id = '".$to_user_id."') OR (from_user_id= '".$to_user_id."' AND to_user_id ='".$from_user_id."')
		ORDER BY timestamp DESC
	";
	$statement=mysqli_query($conn,$query);
	$output = '<ul class="list-unstyled">';
	foreach ($statement as $row) {
		$user_name = '';
		$dynamic_background = '';
		$chat_message='';
		if($row["from_user_id"] == $from_user_id){
			if ($row['status'] == '2'){
				$chat_message = '<em>This message has been remove</em>';
				$user_name = '<b align="right" class="text-success">You</b>';
			}else{
				$chat_message = $row['chat_message'];
				$user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chat_message_id'].'">x</button><b align="right" class="text-success">You</b>';
			}
			
			$dynamic_background = 'background-color:#ffe6e6';

		}else{
			if($row["status"] == '2'){
				$chat_message = '<em>This message has been remove</em>';
			}
			else{
				$chat_message = $row['chat_message'];
			}
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'],$conn).'</b>';
			$dynamic_background = 'background-color:#ffffe6';
		}
// <div align="right">-<small><em>'.$row['timestamp'].'</em></small></div>
		$output .= '<li style="list-style:none; border-bottom:1px dotted #ccc:padding-top:8px;padding-left:8px;padding-right:8px;'.$dynamic_background.'">
				<p>'.$user_name.'-'.$chat_message.'
				</p>
			</li>';
	}
	$output .='</ul>';
	$query = "
		UPDATE chat_message
		SET status = '0'
		WHERE from_user_id = '".$to_user_id."' 
		AND to_user_id = '".$from_user_id."'
		AND status = '1';";
	$statement=mysqli_query($conn,$query);
	return $output;

}
function get_user_name($user_id,$conn){
	$query = "SELECT user_uid FROM users WHERE user_id = '$user_id';";
	$statement=mysqli_query($conn,$query);
	foreach ($statement as $row) {
		return $row['user_uid'];
	}
}
function count_unseen_message($from_user_id,$to_user_id,$conn){

	$query = "
	SELECT * FROM chat_message
	WHERE from_user_id = '$from_user_id'
	AND to_user_id = '$to_user_id,'
	AND status = 1;
	";
	$statement=mysqli_query($conn,$query);
	$count = mysqli_num_rows($statement);
	$output = "<div></div>";
	if ($count > 0){
		$output .= '<span style="color:red;font-size:23px;"class="label label-success">'.$count.'</span>';
	}
	return $output;
}

function fetch_is_type_status($user_id,$conn){
	$query = "
	SELECT is_type FROM login_details
	WHERE user_id = '".$user_id."'
	ORDER BY last_activity DESC 
	LIMIT 1;";
	$statement=mysqli_query($conn,$query);
	$output = "";
	foreach ($statement as $row) {
		if($row['is_type'] == "yes"){
			$output .= '-<small><em><span class="text-muted">Typing...</span></em></small>';
		}
	}
	return $output;
}