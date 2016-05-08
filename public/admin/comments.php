<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()){ redirect_to("login.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection à login.php
?>
<?php include("admincontrollers/controlComments.php"); ?>













<?php  include("../layouts/admin_header.php");   ?>


<a href="list_photos.php">&laquo; Back</a><br/>
<br/>

<h2>Comments on <?php echo $photo->filename; ?></h2>

 <div id="comments" style="color:#4894ff;">
			 <?php foreach($comments as $comment): ?>
	   <div class="comment" style="margin-bottom:2em;">
				  <div class="author">
				  <?php echo htmlentities($comment->author); ?> wrote: <!-- pour chaque commentaire je recupere le nom  -->
				  </div>
				  <div class="body">
				  <?php echo strip_tags($comment->body, '<strong><em><p>'); ?><!-- ...et le commentaire avec des tags accordés pour formater le texte -->
				  </div>
				  <div class="meta-info" stylee="font-size: 0.8em;">
				  <?php echo $comment->created ; ?> <!-- ....et la date de création -->
				  </div>
				  <div class="actions" style="font-size:0.8em;">
				     <a href="admincontrollers/delete_comment.php?id=<?php echo $comment->id; ?>">Delete comment</a>
				  </div><br/>
				  
			 <?php endforeach; ?>
			 <?php if(empty($comments)){echo "No comments.";} ?>
	    </div>
	 </div>





<?php  include("../layouts/admin_footer.php");   ?>