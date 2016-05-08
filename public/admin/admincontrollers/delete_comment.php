<?php
require_once("../../../includes/initialize.php");

if (!$session->is_logged_in()){ redirect_to("../login.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection à login.php
?>


<?php 
    $message="";
   if(empty($_GET['id'])){
      $message= "no comment ID was provided ";
      redirect_to('../index.php');
   }

   $comment = Comment::find_by_id($_GET['id']);//je retrouve le commentaire avec son id récupéré dans le get
   
   $message="";
   if($comment && $comment->delete()){ //si le commentaire avec id est retrouve et si on a reussi à le detruire avec la methode
        $message= "the comment was deleted ";  //demander au prof comment afficher le message
      redirect_to("../comments.php?id={$comment->photograph_id}"); // on redirige vers les commentaires de la photo grace à l'id photo
	  
   }else{                           //sinon....
      $message= "the comment could not be deleted "; 
      redirect_to('../list_photos.php');
   }
   
?>

<?php if(isset($database)) { $database->close_connection(); } ?>