<?php 


 $message="";
  // le process
  if(isset($_POST['submitpublic'])){
    $photo = new Photograph();
	$photo->id_guests= $session2->guest_id;
	$photo->caption = $_POST['caption'];//on place ds la variable ce qu'on recupere du formulaire
	$photo->attach_file($_FILES['file_upload']); // on envoie l'array entier
    if($photo->save_file()){ // on fait passer le nouvel objet dans le process de save_file() de la classe Photograph
	     //ok
		 $message= "photo uploaded as public on the public page  :)";
		 redirect_to('mygallery.php');
	}else{
	     //pas ok
		 $message = "photo not uploaded :(";
	}
  }
  
  
  $message="";
  // le process
  if(isset($_POST['submitprivate'])){
    $photo = new Photograph();
	$photo->id_guests= $session2->guest_id;
	$photo->isPrivate = true;
	$photo->caption = $_POST['caption'];//on place ds la variable ce qu'on recupere du formulaire
	$photo->attach_file($_FILES['file_upload']); // on envoie l'array entier
    if($photo->save_file()){ // on fait passer le nouvel objet dans le process de save_file() de la classe Photograph
	     //ok
		 $message= "photo uploaded as private only viewable you by :)";
		 redirect_to('mygallery.php');
	}else{
	     //pas ok
		 $message = "photo not uploaded :(";
	}
  }




?>