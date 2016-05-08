<?php 
 if(empty($_GET['id'])){
 $session->message("no photograph ID was provided.");
redirect_to("login.php");
 }
 
 $photo = Photograph::find_by_id($_GET['id']);
 if(!$photo){
   $session->message("the photo could not be located.");
redirect_to("login.php");
 }

 
 $comments=Comment::find_comments_on($photo->id);
?>