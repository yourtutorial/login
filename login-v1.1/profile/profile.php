<!-- points
like = 50
comment = 2 * like
share = if like and comment ( share * 3)
activity = [ like , comment ,share](message)
data_points = [ like comment share activity ]
mute = [enable] - datapoints by time [mute off] * activity
wanna be friend = [user info(year/class/age/group)] [interested object] [location] 
member = [ number of article posted, total like,comment,to_share]
news =[ activity, relative datapoints, member,]

notify parent class [ always ]
notify headquartar [ always ]
main events [always]

primary relative  points[10000]
notify [last activity with the user form now]

catagory [ article photo share ]

CLASS Modal{
	PROFILE,
	LIKE,
	COMMENT,
	SHARE,
	RETWEET
} -->
<?php 
session_start();
include("../include/dbh.inc.php");
include('profile_modal.php'); 
include("../friend_status/user_states.php");
include("../head.php");
 ?>

 <body>
 	<?php 
 	if (isset($_SESSION['u_id'])){
 		echo '<h1 class="profile-name" data-user="'.$_GET['userid'].'">this is profile '.get_user_name($_GET['userid'],$conn).'</h1>';
 		if($_GET['userid']!=$_SESSION['u_id']){
 			echo '<button type="button" class="btn btn-primary btn-sm btn-follow">'.is_follow($_SESSION['u_id'],$_GET['userid'],$conn).'</button>';
 		}else{
 			echo '<button type="button" class="modal-btn btn-update-profile">Update profile</button>';
      echo '<button type="button" class="modal-btn btn-profile-option">Option</button>';
 		}
 		user_posts($_GET['userid'],$conn);
 		}
 		else{
 			echo "error";
 			 		}
 	 ?>
 	 <div class="modal-overlay">
      <div class="modal-container">
        <form>
        	<input type="text" name="username" placeholder="Username">
        	<input type="text" name="school" placeholder="High School">
        	<input type="text" name="address" placeholder="Address">
        </form>
        <button class="close-btn">close</button>
      </div>
    </div>
 </body>
 <script type="text/javascript" src="../tools/lc.js">
</script>
 </html>