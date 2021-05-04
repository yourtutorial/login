<?php 
include('database_connection.php');
include('../include/dbh.inc.php');
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>chat application</title>
	<script type="text/javascript" src="../jquery-ui/external/jquery/jquery.js"></script>
	<link rel="stylesheet"  href="../jquery-ui/jquery-ui.css">
	<!-- <link rel="stylesheet" type="text/css" href="../style/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="../style.css">
	
</head>
<body>
	<div>
		<h4>Online User</h4>
		<p>
			<?php 
				if (isset($_SESSION['u_id'])) {
					echo "Hi ";
					echo $_SESSION['u_uid'];
					echo '<br>';
					echo '<a href="../index.php">Home</a>';
				}
			 ?>	 
			 </p>
</div>

	</div>
		<div id="user_details"></div>
		<div id="user_modal_details"></div>
		<script type="text/javascript" src="../chat/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="../jquery-ui/jquery-ui.js"></script>
	
</body>
</html>
<script type="text/javascript">

	fetch_user();
	setInterval(function(){
	update_last_activity(),
	fetch_user(),
	update_chat_history_data()
	 },5000);
	function fetch_user(){
		$(document).ready(function(){
				$.ajax({
				url:"fetch_user.php",
				method:"POST",
				success:function(data){
					$('#user_details').html(data);
				} 
			});
		});
	}
		

		function update_last_activity(){
			$.ajax({
				url:"update_last_activity.php",
				type: 'POST',
				success:function(data){
					$('#test').html(data);
				},
			});
		}
		
		
		function make_chat_dialog_box(to_user_id,to_user_name){
			var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with'+to_user_name+'">';
			modal_content += '<div style="height:300px;border:1px solid #ccc; overflow-y:scroll; margin-bottom:24px;padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
			modal_content += js_user_chat_history(to_user_id);
			modal_content +='</div>';
			modal_content += '<div class="form-group">';
			modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
			modal_content +='</div><div class"form-group" align="right">';
			modal_content += '<button tyle="float:right;" type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat" >Send</button></div></div>';
			$('#user_modal_details').html(modal_content);

		}
		function js_user_chat_history(to_user_id){
			$.ajax({
				url:"fetch_user_chat_message_history.php",
					method:"POST",
					data:{to_user_id:to_user_id},
					success:function(data){
						$("#chat_history_"+to_user_id).html(data);
								}
							});
						}
		function update_chat_history_data(){
				var to_user_id = $('.chat_history').data("touserid");
				js_user_chat_history(to_user_id);
							};
						
		$(document).on("click",".start_chat",function(event){
			var to_user_id = $(this).data('touserid');
			var to_user_name = $(this).data('tousername');
			make_chat_dialog_box(to_user_id,to_user_name);
			$('#user_dialog_'+to_user_id).dialog({
					autoOpen: false,
					width:300,
					height: 490
				});
			$('#user_dialog_'+to_user_id).dialog('open');
				event.preventDefault();
			});
		$(document).on('click','.send_chat',function(){
			var to_user_id = $(this).attr('id');
			var chat_message = $('#chat_message_'+to_user_id).val();
			$.ajax({
				url:"insert_chat.php",
					method:"POST",
					data:{to_user_id:to_user_id,chat_message:chat_message},
					success:function(data){
						console.log(data);
						$("#chat_message_"+to_user_id).val('');
						$('#chat_history_'+to_user_id).html(data);
								}
							});
						}		
		);
		$(document).on('click','.remove_chat',function(){
			var chat_message_id = $(this).attr('id');
			if(confirm("Are you sure you want to remove this chat"))
			$.ajax({
				url:"delete_chat_message.php",
					method:"POST",
					data:{chat_message_id:chat_message_id},
					success:function(data){
						update_chat_history_data();
					}
					});
			});
					
		$(document).on('click','ui-button-icon',function(){
			$('.user_dialog').dialog('destroy').remove();
						});
			
		$(document).on('focus','.chat_message',function(){
			var is_type = "yes";
			$.ajax({
				url:"update_is_type_status.php",
				method:"POST",
				data:{is_type:is_type},
				success:function(){
						}
				});
		});
				
		$(document).on('blur','.chat_message',function(){
			var is_type = 'no';
			$.ajax({
				url:"update_is_type_status.php",
				method:"POST",
				data:{is_type:is_type},
				success:function(){
								}
							});
						});

</script>


