<?php
session_start();
include("../include/dbh.inc.php");
require 'display.php';

if (isset($_POST['article_id'])) {
	$sql = "SELECT * FROM likes WHERE article_id=".$_POST['article_id'];
	$statement = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($statement);
	echo $row;

}

