<?php 
require_once("config.php");

//utilisation d'une classe MySQLDatabase pour la modularite au meme titre que des methodes modulables ici

class MySQLDatabase {

    private $connection; //attribut permettra de réutiliser connection sinon on y aura pas acces en dehors d'ici
    public $last_query;
    

   function __construct() { // chaque objet aura un constructeur qui disposera de la fonction open_connection .
	  $this->open_connection();
	}


     public function open_connection() {
     //creer une connexion a la b2d
	 $this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	       if(!$this->connection) {
		        die("Database connection failed : ". mysql_error());
		   
		   } else {
		      $db_select = mysql_select_db(DB_NAME, $this->connection);
			  if(!$db_select){ //si pas de bdd...
			    die("Database connection failed : ". mysql_error());
			  }
		   }
  
  }

  
     public function close_connection(){
	     if(isset($this->connection)){
		     mysql_close($this->connection);
		     unset($this->connection);
		 }
	 
	 }
	 
	 
	 public function query($sql){
	     $this->last_query = $sql;
	    $result = mysql_query($sql, $this->connection);
	    $this->confirm_query($result);//j'utilise la fonction pour verifier
		return $result;
	 
	 }
	 
	
	 
	 
	 public function fetch_array($result_set){//fonction qui va me permettre de changer la b2d ici plutot que partout dans le code(si jms oracle etc..
	   return mysql_fetch_array($result_set);
	 }
	 
	 
	  private function confirm_query($result){ //on la met en private car on ne l'appellera pas d'en dehors
	     if(!$result){ 
		$output ="database query failed: " . mysql_error(). "<br/><br/>";
		//$output .= "Last SQL query: " . $this->last_query;
		die($output);
		}
	 }
	 
	 
	  public function num_rows($result_set){
	    return mysql_num_rows($result_set);
	  
	  }
	  
	  public function insert_id(){//permet d'obtenir le dernier id inséré pdt la connection
	      return mysql_insert_id($this->connection);
	  }
	  
	  
	  public function affected_rows(){ //retoune le nombre de lignes affectées par la derniere manip
	     return mysql_affected_rows($this->connection);
	  }
	 
}



$database = new MySQLDatabase(); //on pourra utiliser cet objet dans nos pages
$db =& $database; // on pourra utiliser les deux comme ca...


?>