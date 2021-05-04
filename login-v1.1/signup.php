<?php 
	include_once 'header.php';
 ?>
	<section class="main-container"> 
		<div class="main-wrapper">
			<h2>Signup</h2>
			<form class="signup-form" action="include\signup.inc.php" method="POST">
			<?php 
			if (isset($_GET['first'])) {
				$first = $_GET['first'];
				echo '<input type="text" name="first" placeholder="Firstname" value="'.$first.'">';
			}else{
				echo '<input type="text" name="first" placeholder="Firstname">';
			}
			if (isset($_GET['last'])) {
				$last = $_GET['last'];
				echo '<input type="text" name="last" placeholder="Lastname" value="'.$last.'">';
			}else{
				echo '<input type="text" name="last" placeholder="Lastname">';
			}
			if (isset($_GET['uid'])) {
				$uid = $_GET['uid'];
				echo '<input type="text" name="uid" placeholder="Username" value="'.$uid.'">';
			}else{
				echo '<input type="text" name="uid" placeholder="Username">';
			}if (isset($_GET['email'])) {
				$email = $_GET['email'];
				echo '<input type="text" name="email" placeholder="E-mail" value="'.$email.'">';
			}else{
				echo '<input type="text" name="email" placeholder="E-mail">';
			}

		 ?>
		<input type="password" name="pwd" placeholder="Password">
		<input type="password" name="re-pwd" placeholder="Re-enter Password">
		<input type="checkbox" name="visibility">Show Password
		<button type="submit" name="submit">Sign Up</button>
				<!-- <input type="text" name="first" placeholder="firstname">
				<input type="text" name="last" placeholder="Lastname">
				<input type="text" name="email" placeholder="E-mail">
				<input type="text" name="uid" placeholder="Username">
				<input type="text" name="pwd" placeholder="Password">
				<button type="submit" name="submit">
					Sign Up
				</button> -->

		<?php 
			if (!isset($_GET['signup'])) {
			exit();
		}
		else{
			$signupCheck = $_GET['signup'];
			if ($signupCheck=="empty") {
				echo "<p class='error'>You did not fill in all fields!</p>";
				exit();
			}elseif ($signupCheck=="invalid") {
				echo "<p class='error'>You used invalid character!</p>";
				exit();
			}elseif ($signupCheck=="invalidemail"){
				echo "<p class='error'>You used invalid e-mail!</p>";
				exit();
			}elseif ($signupCheck=="success"){
				echo "<p class='error'>You have been signed up!</p>";
				exit();
			}
		}

		 ?>
			</form>
		</div>
		
	</section>

<?php 

	include_once 'footer.php';
 ?>
