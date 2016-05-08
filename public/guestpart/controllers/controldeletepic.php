<?php
require_once("../../../includes/initialize.php");

if (!$session2->is_logged_in()){ redirect_to("../../loginform.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection à login.php
?>


<?php 
    $message="";
   if(empty($_GET['id'])){
      $message= "no photo ID was provided ";
      redirect_to('../indexguest.php');
   }

   $photo = Photograph::find_by_id($_GET['id']);//je retrouve la photo avec son id récupéré dans le get
   
   $message="";
   if($photo && $photo->destroy()){ //si la photo avec id est retrouvee et si on a reussi à la detruire avec la methode
        $message= "the photo {$photo->filename} was deleted ";  //demander au prof comment afficher le message
      redirect_to('../mygallery.php');
	  
   }else{                           //sinon....
      $message= "the photo could not be deleted "; 
      redirect_to('../indexguest.php');
   }
   
?>

<?php if(isset($database)) { $database->close_connection(); } ?>