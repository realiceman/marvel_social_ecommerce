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

   $dir = Directories::find_by_id($_GET['id']);//je retrouve la photo avec son id récupéré dans le get
   
   $message="";
   if($dir && $dir->delete_dir()){ //si la photo avec id est retrouvee et si on a reussi à la detruire avec la methode
        $message= "the directory {$dir->dirname} was deleted ";  //demander au prof comment afficher le message
      redirect_to('../mygallery.php');
	  
   }else{                           //sinon....
      $message= "the directory could not be deleted "; 
      redirect_to('../indexguest.php');
   }
   
?>

<?php if(isset($database)) { $database->close_connection(); } ?>