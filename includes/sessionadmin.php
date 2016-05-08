<?php 

class Session{
  
        private $logged_in = false; // faux par defaut au depart
		public $user_id;
		public $message;
		
		
		
		
		
       function __construct(){
	       session_start();
	        $this->check_login(); //on demarre la session et on verifie si le user est deja loggu�
	   }
	   
	   
	   public function is_logged_in(){ // fonction pour checker si le user est loggu�
	   
	        return $this->logged_in;
	   }
	   
	   
	   public function login($user){ //je verifie si ca match avec le $user de l'index qui est celui de la b2d
	         if($user){ //si cest true
			    $this->user_id = $_SESSION['user_id'] = $user->id; // si l'id du $user correspond � $_SESSION['user_id'] alors on le met dans la variable
				$this->logged_in = true;
			 }
	   
	    }
		
		
		public function logout() { // fonction pour tout retirer quand on se deloggue.
		  unset($_SESSION['user_id']);
		  unset($this->user_id);
		  $this->logged_in = false;
		}
		
		
	   
	   
	   
	   private function check_login(){ // je verifie si un user a deja ete "recens�"
	     if(isset($_SESSION['user_id'])){ //si le user_id de la session est l�.....
		 $this->user_id = $_SESSION['user_id'];//si oui le user_id session devient l'attribut user_id 
		 $this->logged_in = true; //....et mets le parametre logged_in � true
		 } else {
		   unset($this->user_id); // sinon on remet � zero l'attribut user_id
		   $this->logged_in = false;// et on laisse logged_in � false
		 
		  }
	   
	   }
	   
	   
	  
	   
}


$session = new Session();

?>