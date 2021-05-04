<?php 
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login-v-1.1</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="jquery-ui/external/jquery/jquery.js"></script>
	<!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> -->
</head>
<body>
	<header>
		<nav>
			<div class="main-wrapper">
				<ul>
					<li><a href="index.php">Home</a></li>
					<?php 
				if (isset($_SESSION['u_id'])) {
					echo "<li>";
					echo '<a href="../login-v1.1/chat/chat.php">Chat message</a>';
					echo "</li>";
					echo "<li>";
					echo '<a href="../login-v1.1/news/article.php">Articles</a>';
					echo "</li>";
					echo "<li>";
					echo '<a href="../login-v1.1/profile/profile.php?userid='.$_SESSION["u_id"].'">Profile</a>';
					echo "</li>";
					echo "<li>";
					echo '<form action="../login-v1.1/search/search.php" method="POST">
						<input type="text" name="search" placeholder="search">
						<button type="submit" name="submit-search">Search</button>
					</form>';
					echo"</li>";
				}
			 ?>
				</ul>
				<div class="nav-login">
					<?php 
					if (isset($_SESSION['u_id'])) {
							 	echo'
					 <form action="include/logout.inc.php" method="POST"> 
					 	<button type="submit" name="submit">Logout</button>
					 </form>';
					}else{ 
						echo'<form action="include/login.inc.php" method="POST">';
						if (isset($_GET['username'])) {
							$first = $_GET['username'];
							echo '<input type="text" name="uid" placeholder="Firstname" value="'.$first.'">';

						}else{
							echo '<input type="text" name="uid" placeholder="Username/Email" required>';
						}
						// <input type="text" name="uid" placeholder="Username/Email">
						echo '<input type="text" name="pwd" placeholder="Password" required>
						<button type="submit" name="submit">Login</button>
					</form>
					<a href="signup.php">Signup</a>';
				}
					 ?>

				
					
				</div>
			</div>
		</nav>
	</header>