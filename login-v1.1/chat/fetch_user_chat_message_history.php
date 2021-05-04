<?php

include('database_connection.php');
include('../include/dbh.inc.php');

session_start();
if (isset($_POST['to_user_id'])){
echo fecth_user_chat_history($_SESSION['u_id'],$_POST['to_user_id'],$conn);

}

