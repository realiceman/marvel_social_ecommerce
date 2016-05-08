<?php

//traitement du formulaire de creation de dossier
  $message="";
  // le process
  if(isset($_POST['submitfolder'])){
    $dir = new Directories();
	$dir->guest = $session2->guest_id;
	$dir->dirname = $_POST['caption'];
	$dir->isPrivate = $_POST['foldstatus'];
	 
    if($dir->create()){ // on fait passer le nouvel objet dans le process de save_file() de la classe Photograph
	     //ok
		 $message= "folder created  :)";
		 redirect_to('mygallery.php');
	}else{
	     //pas ok
		 $message = "issue to create the folder :(";
	}
  }


  // affichage des dossiers
  $ses = $session2->guest_id; //je mets dans une variable la session du guest

 $dirs = Directories::getDirsByGuestId($ses);

?>