<?php 

class Sessionguest{
  
        private $logged_in = false; // faux par defaut au depart
		public $guest_id;
		public $message;
		
		
		
		
		
       function __construct(){
	       session_start();
	        $this->check_login(); //on demarre la session et on verifie si le guest est deja loggué
	   }
	   
	   
	   public function is_logged_in(){ // fonction pour checker si le guest est loggué
	   
	        return $this->logged_in;
	   }
	   
	   
	   public function login($guest){ //je verifie si ca match avec le $guest de l'index qui est celui de la b2d
	         if($guest){ //si cest true
			    $this->guest_id = $_SESSION['guest_id'] = $guest->id; // si l'id du $guest correspond à $_SESSION['guest_id'] alors on le met dans la variable
				$this->logged_in = true;
			 }
	   
	    }
		
		
		public function logout() { // fonction pour tout retirer quand on se deloggue
		  unset($_SESSION['guest_id']);
		  unset($this->guest_id);
		  $this->logged_in = false;
		}
		
		
	   
	   
	   
	   private function check_login(){ // je verifie si un user a deja ete "recensé"
	     if(isset($_SESSION['guest_id'])){ //si le guest_id de la session est là.....
		 $this->guest_id = $_SESSION['guest_id'];//si oui le guest_id session devient l'attribut user_id 
		 $this->logged_in = true; //....et mets le parametre logged_in à true
		 } else {
		   unset($this->guest_id); // sinon on remet à zero l'attribut guest_id
		   $this->logged_in = false;// et on laisse logged_in à false
		 
		  }
	   
	   }
	   
	   
	  
	   
}

$session2 = new Sessionguest();


?>