<?php
	include"header.php";
?>
	<div class="article-container">
		<?php
			$title = mysqli_real_escape_string($conn,$_GET['title']);
			

			$sql = "SELECT * FROM article WHERE article_id='$title'";
			$result = mysqli_query($conn,$sql);
			$queryResults = mysqli_num_rows($result);

			if($queryResults > 0){
				while ($row = mysqli_fetch_assoc($result)){
					echo "<div class='article-box'>
						<h3>".$row['article']."</h3>
						<p>".$row['article_date']."</p>
					</div>";
			}
		}

		?>
	</div>
</body>
</html>