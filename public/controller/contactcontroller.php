<?php 
if($session2->is_logged_in()) { redirect_to("guestpart/indexguest.php");}
  
 $messagealert="";
if(isset($_POST['submit'])){
      $name    = strip_tags($_POST['name']); //on recupere le name author pour la variable $author
      $email   = strip_tags($_POST['email']); //meme process
	  $subject = strip_tags($_POST['subject']);
	  $message = strip_tags($_POST['message']);
	  
	 
			  if((!empty($name)) && (!empty($email)) && (!empty($subject)) && (!empty($message))){
			  
					   $contact=new Contact();
						$contact->insertContact($name,$email,$subject,$message);
					   //si sauvegardé on redirige pour eviter que le navigateur ne redemande l'envoi du formulaire
						$messagealert="thank you for the message !!";
					 //   redirect_to("contactform.php");
						unset($name);
						unset($subject);
						unset($message);
						unset($email);
						unset($contact);
			
				  }else{
					  $messagealert="error,sorry";
				  }
	  }else{
      //sinon on réinitialise
	  $name="";
	  $email="";
	  $subject="";
	  $message="";
}



?>