<?php
require_once('initialize.php');

class Comment {

     protected static $table_name="comments";
    protected static $db_fields = array('id', 'photograph_id', 'created', 'author', 'body');
	
	public $id;
	public $photograph_id;
	public $created;
	public $author;
	public $body;
	
	
	
	public static function make($photo_id, $author="anonymous", $body=""){
	   if(!empty($photo_id) && !empty($author) && !empty($body)){
		$comment = new Comment();
		$comment->photograph_id = (int)$photo_id;
		$comment->created = strftime("%d-%m-%Y %H:%M:%S" , time());
		$comment->author = $author;
		$comment->body = $body;
		return $comment;
		
       }else{
	     return false;
	   
	   }
	}
	
	
	public static function find_comments_on($photo_id=0){
	global $database;
	$sql = "SELECT * FROM ".self::$table_name;
	$sql .= " WHERE photograph_id=" . $photo_id;
	$sql .= " ORDER BY created ASC";
	return self::find_by_sql($sql);
	}



	public static function find_all(){
	 return self::find_by_sql("SELECT * FROM comments");
	}
	
	
	
	public static function find_by_id($id=0){ //retrouve par l'id
	   global $database;
	   $result_array = self::find_by_sql("SELECT * FROM comments WHERE id={$id} LIMIT 1");
	   return !empty($result_array) ? array_shift($result_array) : false; //si le tableau n'est pas vide  on met les elements ds result array
	}  //si vide on retourne faux
	
	
	
	
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
			$object->id                = $record['id'];
			$object->photograph_id     = $record['photograph_id'];
			$object->created           = $record['created'];
			$object->author            = $record['author'];
			$object->body              = $record['body'];
			
	    return $object;
	}
	

	
	// CRUD (create read update delete) pour les users
	public function save(){
	   return isset($this->id) ? $this->update() : $this->create(); 
	  //si l'id existe deja on sait que c'est deja en b2d et donc faut l'updater sinon on créé l'enregistrement
	}
	
	
	
	
	public function create() {
	 global $database;
	 
	 $sql ="INSERT INTO ".self::$table_name." (";
	 $sql .= "photograph_id, created, author, body"; //ttes les attributs de la table seront mis à la suite avec la virgule
	 $sql .=") VALUES ('";
	 $sql .= Stripslashes($this->photograph_id) ."', '";
	 $sql .= Stripslashes($this->created) ."', '";
	 $sql .= Stripslashes($this->author) ."', '";
	 $sql .= Stripslashes($this->body) ."')";
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
	$sql .= "photograph_id='". Stripslashes($this->photograph_id) ."', ";
    $sql .= "created='". Stripslashes($this->created) ."', ";
	$sql .= "author='". Stripslashes($this->author) ."', ";
	$sql .= "body='". Stripslashes($this->body) ."' ";
	$sql .= " WHERE id=". Stripslashes($this->id);
	$database->query($sql);
	return ($database->affected_rows() == 1) ? true : false; //si la ligne est updatée c'est ok sinon false
	}
	
	
	
	public function delete(){
	global $database;
	
	$sql = "DELETE FROM ".self::$table_name ;
	$sql .= " WHERE id=". $this->id;
	$sql .= " LIMIT 1";
	$database->query($sql);
	return ($database->affected_rows() == 1) ? true : false;
	}



}
?>