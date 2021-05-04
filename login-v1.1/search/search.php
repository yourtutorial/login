<?php
	include"header.php";
?>
<h1>Search page</h1>
	<?php 
		if (isset($_POST['submit-search'])) {
			$search = mysqli_real_escape_string($conn,$_POST['search']);
			$sql = "SELECT * FROM article WHERE article LIKE '%$search%' OR user_id LIKE '%$search%' ";
			$result = mysqli_query($conn,$sql);
			$queryResult = mysqli_num_rows($result);
			echo "There are ".$queryResult."results!";
			if ($queryResult > 0){
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<a href='article.php?title=".$row['article_id']."&date=".$row['article_date']."'><div class='article-box'>
						<h3>".$row['article']."</h3>
						<p>".$row['article_date']."</p>
					</div></a>";
					
				}
			}else{
				echo "There are no result matching your search";
			}
		}
	 ?>
