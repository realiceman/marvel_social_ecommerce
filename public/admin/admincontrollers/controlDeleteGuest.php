<?php
require_once("../../../includes/initialize.php");

if (!$session->is_logged_in()){ redirect_to("login.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection à login.php
?>


<?php 
    $message="";
   if(empty($_GET['id'])){
      $message= "no guest ID was provided ";
      redirect_to('../index.php');
   }

   $guest = Guest::find_by_id($_GET['id']);
   
   $message="";
   if($guest && $guest->delete()){ //si la photo avec id est retrouvee et si on a reussi à la detruire avec la methode
        $message= "the guest {$guest->guestname} was deleted ";  //demander au prof comment afficher le message
      redirect_to('../list_guests.php');
	  
   }else{                           //sinon....
      $message= "the guest could not be deleted "; 
      redirect_to('../index.php');
   }
   
?>

<?php if(isset($database)) { $database->close_connection(); } ?>