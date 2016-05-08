<?php 
require_once('database.php');

class Photograph {
    
	public static $table_name="photographs";
    public $id;
	public $id_guests;
	public $filename;
	public $type;
	public $size;
	public $caption;
	public $status;
	public $privatePic=1;
	public $isPrivate=false; //boolean 
	public $publicPic=0;
	public $id_directory;
	
	public $temp_path;
	public $upload_dir="images";
	public $errors = array();
	
	
	
	//references upload errors : wwww.php.net
	protected $upload_errors = array(  //j'attribue aux differentes variables de upload , un message
   UPLOAD_ERR_OK     => "No errors.",
   UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize;",
   UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE.",
   UPLOAD_ERR_PARTIAL   => "partial upload.",
   UPLOAD_ERR_NO_FILE   => "no file.",
   UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
   UPLOAD_ERR_CANT_WRITE => "Cant write to disk.",
   UPLOAD_ERR_EXTENSION  => "File upload stopped by extension."
   );
   
   
  public function attach_file($file){
  
     if(!$file || empty($file) || !is_array($file)){ //si aucun fichier n'est envoyé
	   $this->errors[]="no file was uploaded.";//et on le met dans le tab errors
	    return false;
		}elseif($file['error'] !=0){//on recupere l'erreur presente dans l'array de $_FILES
		  $this->errors[]= $this->upload_errors[$file['error']];//et on le met dans le tab errors
		  return false;
		  }else{
      $this->temp_path = $file['tmp_name']; //on recupere le chemin du fichier grace a tmp_name de $_FILES
	  $this->filename  = basename($file['name']);//basename va recuperer que le nom du fichier sans l'adresse
	  $this->type      = $file['type'];
	  $this->size      = $file['size'];
	  
	  return true;
             }
         }
   
  
  public function save_file(){
      if(isset($this->id)){//si l'id existe deja on update....
	      $this->update();
	  }else{ //....sinon on le cree
	    if(!empty($this->errors)){return false;} // si le tableau d'erreur n'est pas vide : retourne faux
	    
        if(strlen($this->caption) > 255) { //on verifie la longueur
         $this->errors[]="the caption can only be 255 characters long.";
		 return false;
       }	
     
         if(empty($this->filename) || empty($this->temp_path)){ //il nous faut le filename et l'endroit du fichier
         $this->errors[]= "the file location was not available.";
		 return false;
       }	
       //on determine le chemin cible
       $target_path = "../".$this->upload_dir."/".$this->filename;  
       //et on verifie dans le dossier que le fichier n'existe pas deja
       if(file_exists($target_path)){
        $this->errors[]="the file {$this->filename} already exists.";
		return false;
       }
    
        //et si apres toutes ces verifs c'est ok alors on transfere le fichier
        if(move_uploaded_file($this->temp_path, $target_path)){
            // ok et on cree l'entree dans la b2d
			if($this->save()){
			  unset($this->temp_path);//a ce stade on l'enleve car le fichier n'y est plus
			   return true;
			}
       } else {
           // pas ok
		   $this->errors[] = "the file upload did not succeed.";
		   return false;
       }	   
	  }
  
  }
  
  
  
  
  
  
	 // methodes communes qui seront reutilisées ailleurs

	public static function find_all(){
	 return self::find_by_sql("SELECT * FROM photographs");
	}
	
	
	
	
	public static function find_by_id($id=0){ //retrouve par l'id
	   global $database;
	   $result_array = self::find_by_sql("SELECT * FROM photographs WHERE id={$id} LIMIT 1");
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
	      return $object_array; // et on retourne le tableau d'objet
	}
	
	
	  
	public static function count_all(){
	   global $database;
	   $sql = "SELECT COUNT(*) FROM ".self::$table_name;
	   $result_set = $database->query($sql); //j'execute la requete
	   $row = $database->fetch_array($result_set); //on passe dans $row la ligne retournée grâce à fetch_array()
	   return array_shift($row); //on recupere ce qu'il y a dans cette ligne grace à la fonction native php array_shift()
	}
	
	
	
	
	
	
	private static function instantiate($record){
    	
		$object = new self; // s'instancie lui meme dans $object puis on lui passe les attributs
			$object->id           = $record['id'];
			$object->filename     = $record['filename'];
			$object->type         = $record['type'];
			$object->size         = $record['size'];
			$object->caption      = $record['caption'];
		    $object->status       = $record['id_status'];
			$object->id_directory = $record['id_directory'];
			$object->id_guests    = $record['id_guests'];
			
	    return $object;
	}
	
	
	
	public static function getPhotosByDirectory($dirId){
	global $database;
	return self::find_by_sql("SELECT * FROM photographs WHERE id_directory ='".$dirId."' ");
	
	
	} 
	
	
	
	public static function getPhotosByGuest($id_guests){
	global $database;
	return self::find_by_sql("SELECT * FROM photographs WHERE id_guests =".$id_guests. " AND id_directory IS NULL");
	
	
	}
	
	
	public static function countAllGuest($id_guests){
	global $database;
	return self::find_by_sql("SELECT COUNT(*) FROM photographs WHERE id_guests =".$id_guests);
	
	
	}
	
	
	
	// CRUD pour les users
	public function save(){
	   return isset($this->id) ? $this->update() : $this->create(); 
	  //si l'id existe deja on sait que c'est deja en b2d et donc fuat l'updater sinon on créé l'enregistrement
	}
	
	
	//permet d'effacer la ligne dans la b2d et d'enlever le fichier
	public function destroy(){
	   if($this->delete()){ 
	     $target_path = "../../".$this->upload_dir."/".$this->filename; //je reutlise le meme chemin créé plus haut dans le process de sauveagarde save_file() 
         return unlink($target_path) ? true : false;	//et j'utlise unlink pour detacher 	 
	   }else{
	      return false;
	   }
	
	}
	
	
	public function switch_status($newStatus){
		global $database;

		    $sql ="UPDATE ".self::$table_name." SET ";
	        $sql .= "id_status= ". $newStatus;
			$sql .= " WHERE id=". $this->id;
	        $database->query($sql);
			$result = ($database->affected_rows() == 1) ? true : false;
			if($result){
				$this->status= $newStatus;
			}
			return $result;	
		}
	
	

	
	
	
	
	public function create() {
	 global $database;
	
	 $sql ="INSERT INTO ".self::$table_name." (";
	 $sql .="filename, type, size, caption, id_status, id_directory, id_guests";
	 $sql .=") VALUES ('";
	 $sql .= $this->filename ."','"; 
	 $sql .= $this->type ."','";
	 $sql .= $this->size ."','";
	 $sql .= $this->caption ."','";
	 $sql .= ($this->isPrivate ==true)? "1" : "0";
	 $sql .= "',";
	 $sql .= ($this->id_directory == NULL) ? "NULL": $this->id_directory;
	 $sql .= ",'".$this->id_guests;
	 $sql .= "')";
	 echo $sql;
	 if($database->query($sql)){
	     return true;
		 $this->id = $database->insert_id();
	 }else{
	     return false;
	 }
	}
	
	
	
	
	
	
	
	public function update(){
	global $database;
	
	$sql ="UPDATE ".self::$table_name." SET ";
	$sql .= "filename='". $this->filename ."', ";
	$sql .= "type='". $this->type ."', ";
	$sql .= "size='". $this->size ."', ";
	$sql .= "caption='". $this->caption ."' ,";
	$sql .= "id_status='". $this->status."' ,";
	$sql .= "id_directory='". $this->id_directory."' ";
	$sql .= " WHERE id= '". $this->id. "' " ;
	
	echo $sql;
	$database->query($sql);
	return ($database->affected_rows() == 1) ? true : false; //si la ligne est updatée c'est ok sinon false
	}
	
	
	public function delete(){
	global $database;
	
	$sql = "DELETE FROM ".self::$table_name;
	$sql .= " WHERE id=". $this->id;
	$sql .= " LIMIT 1";
	$database->query($sql);
	return ($database->affected_rows() == 1) ? true : false;
	}
}

?>