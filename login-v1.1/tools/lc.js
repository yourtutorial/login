// follow
$(".btn-follow").click(function(){
	console.log('hello');
	var to_user_id = $('.profile-name').data("user"); 
	$.ajax({
				url:"../friend_status/follow.php",
					method:"POST",
					data:{to_user_id:to_user_id},
					success:function(data){
						console.log(data);
						$(".btn-follow").html(data);
					}
					});
});
function is_follow(to_user_id){
			$.ajax({
				url:"../friend_status/follow.php",
					method:"POST",
					data:{to_user_id:to_user_id},
					success:function(data){
						console.log(data);
						$(".btn-follow").html(data);
								}
							});
						}
// follow
// like modal
const btns = document.querySelectorAll(".btn-like");
	btns.forEach(function (btn) {
		btn.addEventListener("click", function (e) {
    	const styles = e.currentTarget.classList.toggle('color');
    	var article_id = btn.attributes.id.nodeValue;
    	$.ajax({
				url:"../news/like.php",
					method:"POST",
					data:{article_id:article_id},
					success:function(data){
						user_like(article_id);
					}
					});
    	});
	});

function user_like(article_id){
			$.ajax({
				url:"../news/fetch_states.php",
					method:"POST",
					data:{article_id:article_id},
					success:function(data){
						$("#"+article_id).html(data);
								}
							});
						}

// like

// comment modal
const com_btns = document.querySelectorAll(".comment-btn");
com_btns.forEach(function (btn) {
	btn.addEventListener("click", function (e) {
    var article_id = btn.attributes.id.nodeValue;
    var btn_id = btn.attributes.id.nodeValue;
    // comment_modal(article_id,btn_id);
   fetch_comment_history(article_id);
   e.preventDefault();
   

});
});
 $(".comment_submit").each(function(){
		$(this).click(function(){
		var article_id = $(this).attr('id');
		var comment = $(".addcomment"+article_id).val();
		if (comment.length < 1){
			alert("Comment empty!");
		}else{	
		$.ajax({
			url:"../news/comment.php",
			method:"POST",
			data:{article_id:article_id,comment:comment},
			success:function(data){	
			$(".addcomment"+article_id).val('');
			$(".commentdata"+article_id).html(data);
		}
		});
		}			
	});
	});

function comment_modal(article_id){
	var modal_content =fetch_comment_history(article_id);
			// modal_content += '<div class="form-group">';
			// modal_content += '<textarea class=addcomment required></textarea><button type="button" id="'+btn_id+'"class="comment_submit" name="comment">Submit</button>';
			// modal_content +='</div>';
			$(".commentdata"+article_id).html(modal_content);

}


function fetch_comment_history(article_id){
			$.ajax({
				url:"../news/display_comment.php",
					method:"POST",
					data:{article_id:article_id},
					success:function(data){
						$(".commentdata"+article_id).html(data);
								}
							});
						}
function update_comment_history_data(){
				var to_user_id = $('.chat_history').data("touserid");
				js_user_chat_history(to_user_id);
							};
// comment

// modal open
const modalBtn = document.querySelector(".modal-btn");
const modal = document.querySelector(".modal-overlay");
const closeBtn = document.querySelector(".close-btn");

modalBtn.addEventListener("click", function () {
  modal.classList.add("open-modal");
});
closeBtn.addEventListener("click", function () {
  modal.classList.remove("open-modal");
});
