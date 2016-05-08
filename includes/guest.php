<?php 
require_once('initialize.php');

class Guest extends User{

    protected static $table_name="guests";
   //les autres attributs ont ete importés avec "extends"
	
	
	
	public static function authenticate($guestname="", $password=""){
	    global $database; //permet d'avoir un scope global de database
		$guestname = Stripslashes($guestname);
	    $password = Stripslashes($password);
		// en fait on fait un traitement pour voir si username et password existent en b2d
		$sql  = "SELECT * FROM guests ";
		$sql .= "WHERE guestname = '{$guestname}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1"; //et dit qu'on limite tt ca à une personne (une ligne)
		
		$result_array = self::find_by_sql($sql); // on fait le traitement sql
	   return !empty($result_array) ? array_shift($result_array) : false; //si y a 1pers : ok  on met dans result_array sinon faux
	}
	
	public function full_name(){
	
	    if(isset($this->first_name) && isset($this->last_name)){
		 return $this->first_name . " " . $this->last_name;
		}else{
		   return "";
		}
	
	}
	
	
  // methodes communes qui seront reutilisées ailleurs

	public static function find_all(){
	 return self::find_by_sql("SELECT * FROM guests");
	}
	
	
	public static function find_by_id($id=0){ //retrouve par l'id
	   global $database;
	   $result_array = self::find_by_sql("SELECT * FROM guests WHERE id={$id} LIMIT 1");
	   return !empty($result_array) ? array_shift($result_array) : false; //si le tableau n'est pas vide  on met les elements ds result array
	}  //si vide on retourne faux (array_shift permet de transferer chaque resultat dans le tableau
	
	
	
	public static function find_by_sql($sql=""){ //on passe en argument une requete...
	    global $database;
		$result_set = $database->query($sql); //...que l'on met dans result_set
		$object_array = array();// ..on cree un tableau
		while($row = $database->fetch_array($result_set)){//on passe tt les resultats ds row
		   $object_array[]= self::instantiate($row);//et tt les resultats disposeront des attributs
		 // et sont mis dans le tableau
		}
	
	      return $object_array; // et on retourne un tableau d'objet
	}
	
	
	
	
	public static function count_all(){
	   global $database;
	   $sql = "SELECT COUNT(*) FROM ".self::$table_name;
	   $result_set = $database->query($sql); //j'execute la requete
	   $row = $database->fetch_array($result_set); //on passe dans $row la ligne retournée grâce à fetch_array()
	   return array_shift($row); //on recupere ce qu'il y a dans cette ligne grace à la fonction native php array_shift()
	}
	
	
	
	
	private static function instantiate($record){
			//process 
			$object = new self;
			$object->id           = $record['id'];
			$object->guestname    = $record['guestname'];
			$object->password     = $record['password'];
			$object->email        = $record['email'];
			$object->first_name   = $record['first_name'];
			$object->last_name    = $record['last_name'];
			return $object;
		}
		
		
	

	
	
	// CRUD pour les users
	public function save(){
	   return isset($this->id) ? $this->update() : $this->create(); 
	  //si l'id existe deja on sait que c'est deja en b2d et donc fuat l'updater sinon on créé l'enregistrement
	}
	
	
	
	
	public function create() {
		 global $database;
		
		//on insert les donnees en b2d en "echappant" les donnees recuperees par l'objet
		 $sql ="INSERT INTO ".self::$table_name." (";
		 $sql .= "guestname, password,email, first_name, last_name"; //ttes les attributs de la table seront mis à la suite avec la virgule
		 $sql .=") VALUES ('";
		 $sql .= Stripslashes($this->guestname) ."', '";
		 $sql .= sha1(Stripslashes($this->password)) ."', '";
		 $sql .= Stripslashes($this->email) ."', '";
		 $sql .= Stripslashes($this->first_name) ."', '";
		 $sql .= Stripslashes($this->last_name) ."')";
		 if($database->query($sql)){//si ok envoie cette requete
			 return true;
			 $this->id = $database->insert_id(); //on recupere l'id du client en b2d pour l'objet car l'id est attribue en auto-increment en b2d
		 }else{
			 return false;
		 }
	}
	
	
	
	public function update(){
	global $database;
	
	$sql ="UPDATE ".self::$table_name." SET ";
	$sql .= "guestname='". Stripslashes($this->guestname) ."', ";
    $sql .= "password='". Stripslashes($this->password) ."', ";
	$sql .= "email='". Stripslashes($this->email) ."', ";
	$sql .= "first_name='". Stripslashes($this->first_name) ."', ";
	$sql .= "last_name='". Stripslashes($this->last_name) ."' ";
	$sql .= " WHERE id=". Stripslashes($this->id);
	$database->query($sql);
	return ($database->affected_rows() == 1) ? true : false; //si la ligne est updatée c'est ok sinon false
	}
	
	
	
	public function delete(){
	global $database;
	
	$sql = "DELETE FROM ".self::$table_name ;
	$sql .= " WHERE id=". Stripslashes($this->id);
	$sql .= " LIMIT 1";
	$database->query($sql);
	return ($database->affected_rows() == 1) ? true : false;
	}
	
	}



?>