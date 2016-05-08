<?php 

if($session2->is_logged_in()) { redirect_to("guestpart/indexguest.php");}

 $messagealert="";
if(isset($_POST['submit'])){
      $guestname    = strip_tags($_POST['guestname']); //on recupere le name author pour la variable $author
      $password     = strip_tags($_POST['pwd']); //meme process
	  $email        = strip_tags($_POST['email']);
	  $first_name   = strip_tags($_POST['Fname']);
	  $last_name    = strip_tags($_POST['Lname']);
	  
	  $guest=new Guest();
	  $guest->guestname =$guestname;
	  $guest->password = $password;
	  $guest->email = $email;
	  $guest->first_name=$first_name;
	  $guest->last_name=$last_name;
		if((!empty($first_name)) && (!empty($last_name)) && (!empty($guestname)) && (!empty($password)) && (!empty($email))){
				 //2: verifier que login et mail existe pas deja.
				 $myreq = "SELECT email FROM guests WHERE email ='".$email."'";
				 $req = $database->query($myreq);
				// si je trouve au moins un mail, je ne permet pas l'inscription, il doit utiliser un autre mail.
				 $present = $database->num_rows($req);
				 if($present==1){
					 $messagealert = 'you are already registered !';
				 }else {
				 // sinon il peut s'inscrire,  et j'insere en bdd les datas du user.
				 $guest->create();
				 $messagealert = 'You are registered.Thank you.'; 
				
		               }
		     
		}else{
		  $messagealert= 'please fill all the required details';
		 
		}
}


?>