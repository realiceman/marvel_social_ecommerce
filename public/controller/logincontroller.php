<?php 


if($session2->is_logged_in()) { redirect_to("guestpart/indexguest.php");}

$messagealert="";
if(isset($_POST['login'])){

      $guestname = trim($_POST['guestname']);
      $password = sha1(trim($_POST['password']));
	  
	  //verifications b2d
	  $found_user= Guest::authenticate($guestname, $password);
	  
	  if($found_user){ // si le guest est bien réferencé dans la b2d...
	  $session2->login($found_user); //...alors il devient le guest de session
	  redirect_to("guestpart/indexguest.php");// et on le redirige dans l'index admin
	  }else{
	     $messagealert ="name/ password : combination incorrect.";//sinon on affiche le message
	  }

}else{

  $username = "";
  $password = "";

}




?>