<?php 


if($session->is_logged_in()) { redirect_to("index.php");}

//pas zapper de mettre le nom submit pour le submit du formulaire...
if(isset($_POST['submit'])){

      $username = trim($_POST['username']);
      $password = sha1(trim($_POST['password']));
	  
	  //verifications b2d
	  $found_user= User::authenticate($username, $password);
	  
	  if($found_user){ // si le user est bien réferencé dans la b2d...
	  $session->login($found_user); //...alors il devient le user de session
	  redirect_to("index.php");// et on le redirige dans l'index admin
	  }else{
	     $message =" username/ password combination incorrect.";//sinon on affiche le message
	  }

}else{

  $username = "";
  $password = "";

}




?>