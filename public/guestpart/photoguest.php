<?php
require_once("../../includes/initialize.php");
?>

<?php 
$message="";
if(empty($_GET['id'])){ //si on obtient aucun ID via l'url donc pas de photo...
$message= "no photo in here !!!! "; //..message d'erreur
redirect_to('indexguest.php');

}


$message="";
$photo=Photograph::find_by_id($_GET['id']); 
if(!$photo){// si on ne trouve pas la photo

$message=" issue to find the photo !!! "; //message d'erreur
redirect_to('indexguest.php');

}

  $message="";
// process de verification du formulaire de commentaires
if(isset($_POST['submit'])){
      $author = trim($_POST['author']); //on recupere le name author pour la variable $author
      $body   = trim($_POST['body']); //meme process
	  
	  $new_comment= Comment::make($photo->id, $author, $body);
	  if($new_comment && $new_comment->save()){
	           //si sauvegardé on redirige pour eviter que le navigateur ne redemande l'envoi du formulaire
			   redirect_to("photoguest.php?id={$photo->id}");
			   $message="thank you for the comment !!";
	      }else{
		      $message="error, your comment is not saved";
		  }
	  }else{
      //sinon on réinitialise
	  $author="";
	  $body="";
}

//après le process on retrouve les enregistrements de commentaires en bdd
   $comments = Comment::find_comments_on($photo->id);


?>
<?php include("layouts/header.php");   ?><br/>

<a href="indexguest.php">&laquo; back</a><br/>
<br/>


<div style="margin-left:20px;">
   <img src="<?php echo "../".$photo->upload_dir."/".$photo->filename; ?>" />
   <p><?php echo $photo->caption; ?></p>
 </div>
 
 
 
      <!-- affichage des commentaires -->
     <div id="comments" style="color:#4894ff;">
			 <?php foreach($comments as $comment): ?>
	   <div class="comment" style="margin-bottom:2em;">
				  <div class="author">
				  <?php echo htmlentities($comment->author); ?> wrote: <!-- pour chaque commentaire je recupere le nom  -->
				  </div>
				  <div class="body">
				  <?php echo strip_tags($comment->body, '<strong><em><p>'); ?><!-- ...et le commentaire avec des tags accordés pour formater le texte -->
				  </div>
				  <div class="meta-info" style="font-size: 0.8em;">
				  <?php echo $comment->created ; ?> <!-- ....et la date de création -->
				  </div><br/>
			 <?php endforeach; ?>
			 <?php if(empty($comments)){echo "No comments.";} ?>
	    </div>
	 </div>
	 
   
 <!-- commentaires -->
 <div id="comment-form" style="color:white;">
    <h3>new comment</h3>
	   <?php echo output_message($message); ?>
	   <form action ="photoguest.php?id=<?php echo $photo->id; ?>" method="post"> <!--on revient à la meme page et meme photo avec l'id  -->
	   <table>
	     <tr>
		     <td style="color:white;" >your name:</td>
			 <td><input type="text" name="author" value="<?php echo $author; ?>" /></td>
		 </tr>
		 <tr>
			 <td style="color:white;" >your comment:</td>
			 <td><textarea name="body" cols="40" rows="8"><?php echo $body; ?></textarea></td>
		 </tr>
		 <tr>
		     <td>&nbsp;</td>
			 <td><input type="submit" name="submit" value="submit comment"/></td>
		 </tr>
		</table>
		</form>
	</div>
 
 <?php include("layouts/footer.php"); ?>

