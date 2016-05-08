<?php
require_once("../../../includes/initialize.php");

if (!$session->is_logged_in()){ redirect_to("login.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection � login.php
?>


<?php 
    $message="";
   if(empty($_GET['id'])){
      $message= "no photo ID was provided ";
      redirect_to('../index.php');
   }

   $photo = Photograph::find_by_id($_GET['id']);//je retrouve la photo avec son id r�cup�r� dans le get
   
   $message="";
   if($photo && $photo->destroy()){ //si la photo avec id est retrouvee et si on a reussi � la detruire avec la methode
        $message= "the photo {$photo->filename} was deleted ";  //demander au prof comment afficher le message
      redirect_to('../list_photos.php');
	  
   }else{                           //sinon....
      $message= "the photo could not be deleted "; 
      redirect_to('../index.php');
   }
   
?>

<?php if(isset($database)) { $database->close_connection(); } ?>