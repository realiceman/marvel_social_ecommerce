<?php 
  $max_file_size = 1048576;  // en bytes , cest egal à 1MB
  
  
  $message="";
  // le process
  if(isset($_POST['submit'])){
    $photo = new Photograph();
	$photo->id_guests= $session->user_id;
	$photo->caption = $_POST['caption'];//on place ds la variable ce qu'on recupere du formulaire
	$photo->attach_file($_FILES['file_upload']); // on envoie l'array entier
    if($photo->save_file()){ // on fait passer le nouvel objet dans le process de save_file() de la classe Photograph
	     //ok
		 $message= "photo uploaded :)";
		 redirect_to('list_photos.php');
	}else{
	     //pas ok
		 $message = "photo not uploaded :(";
	}
  }

?>