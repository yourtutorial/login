<?php 
session_start();
include("../include/dbh.inc.php");
include ('display.php');
include("../head.php");
 ?>
<body>
	<div class="wrapper" style="margin:0 30%;">
		<?php 
		if(isset($_SESSION['u_id'])){
			echo '<div class="upload-form" style="padding-top: 1em;">
		<form action="upload.php" class="upload" method="POST" style="padding:0 3px;height:37px;width:300px;">
			<!-- <label for="article" name="article">Article</label> -->
			<input type="text" name="article" required placeholder="upload Article" style="border-radius: 10px;border: none;">
			<button type="submit" name="submit" style="border-radius: 3px;border: none;padding:0px;width: 100px;height: 24px;">Submit</button>
		</form>
	</div>';
		}
		
		 ?>
	<!-- <div class="upload-form" style="padding-top: 1em;">
		<form action="upload.php" class="upload" method="POST" style="padding:0 3px;height:37px;width:300px;">
			<label for="article" name="article">Article</label> -->
			<!-- <input type="text" name="article" required placeholder="upload Article" style="border-radius: 10px;border: none;">
			<button type="submit" name="submit" style="border-radius: 3px;border: none;padding:0px;width: 100px;height: 24px;">Submit</button>
		</form>
	</div> -->
	<br>
	<section >
		<?php 
		if(!isset($_SESSION['u_id'])){
			header("Location:../index.php");
		}else{
			display_article($conn);
		}
		
		 ?>
	</section>
	<footer>
	</footer>
	</div>
</body>
<script type="text/javascript" src="../tools/lc.js">	
</script>
</html>