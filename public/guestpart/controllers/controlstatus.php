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

	   $photo = Photograph::find_by_id($_GET['id']);
	   $status= $photo->status;
	   $privatestatus="1";
	   $publicstatus="0";
	   $newlink="";
		   if($status=="0"){ 
			  $photo->switch_status($privatestatus);
			  
			  redirect_to('../mygallery.php');
			  
		   }
		    else{                          
			  $photo->switch_status($publicstatus);
			
			  redirect_to('../mygallery.php');
		   }
		   
		   
		   
   
?>

<?php if(isset($database)) { $database->close_connection(); } ?>