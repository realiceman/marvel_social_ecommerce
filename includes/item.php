<?php 
require_once('database.php');

class Item {
    
	public static $table_name="item";
    public $id;
    public $title;
	public $name;
    public $price;
	public $description;
	public $stock;
	public $id_category;
	
	public $temp_path;
	public $upload_dir="items";
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
  
     if(!$file || empty($file) || !is_array($file)){ //si aucun fichier n'est envoy�
	   $this->errors[]="no file was uploaded.";//et on le met dans le tab errors
	    return false;
		}elseif($file['error'] !=0){//on recupere l'erreur presente dans l'array de $_FILES
		  $this->errors[]= $this->upload_errors[$file['error']];//et on le met dans le tab errors
		  return false;
		  }else{
      $this->temp_path = $file['tmp_name']; //on recupere le chemin du fichier grace a tmp_name de $_FILES
	  $this->name  = basename($file['name']);//basename va recuperer que le nom du fichier sans l'adresse
	 
	  return true;
             }
         }
   
  
  public function save_file(){
      if(isset($this->id)){//si l'id existe deja on update....
	      $this->update();
	  }else{ //....sinon on le cree
	    if(!empty($this->errors)){return false;} // si le tableau d'erreur n'est pas vide : retourne faux
	    
        if(strlen($this->description) > 400) { //on verifie la longueur
         $this->errors[]="the caption can only be 255 characters long.";
		 return false;
       }	
     
         if(empty($this->name) || empty($this->temp_path)){ //il nous faut le filename et l'endroit du fichier
         $this->errors[]= "the file location was not available.";
		 return false;
       }	
       //on determine le chemin cible
       $target_path = "../".$this->upload_dir."/".$this->name;  
       //et on verifie dans le dossier que le fichier n'existe pas deja
       if(file_exists($target_path)){
        $this->errors[]="the file {$this->name} already exists.";
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
  
  
  
  
  
  
	 // methodes communes qui seront reutilis�es ailleurs

	public static function find_all(){
	 return self::find_by_sql("SELECT * FROM item");
	}
	
	
	
	
	public static function find_by_id($id=0){ //retrouve par l'id
	   global $database;
	   $result_array = self::find_by_sql("SELECT * FROM item WHERE id={$id} LIMIT 1");
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
	   $row = $database->fetch_array($result_set); //on passe dans $row la ligne retourn�e gr�ce � fetch_array()
	   return array_shift($row); //on recupere ce qu'il y a dans cette ligne grace � la fonction native php array_shift()
	}
	
	
	
	
	
	
	private static function instantiate($record){
    	
		$object = new self; // s'instancie lui meme dans $object puis on lui passe les attributs
			$object->id           = $record['id'];
            $object->title        = $record['title'];
			$object->name         = $record['name'];
            $object->price        = $record['price'];
            $object->description  = $record['description'];
		    $object->stock        = $record['stock'];
			$object->id_category  = $record['id_category'];
			
			
	    return $object;
	}
	
	
    
    public static function getAllCategories(){
     global $database;
        $req= $database->query("SELECT * FROM category ORDER BY name ASC"); 
        echo "CATEGORIES | ";
        while($data = $database->fetch_array($req))
        {
            $id = $data['id']; 
            $name = $data['name'];
            echo "   <a href='index.php?id=".$id."' >".$name."     </a>  "; 
        }
  
  
    }
    
    
    public static function getCategoryName($id){
        global $database;
        $req= $database->query("SELECT name FROM category WHERE id=".$id);
            while($data = $database->fetch_array($req))
        {
           $catName = $data['name'];
            echo $catName; 
        }
    }
    
    
	
	public static function getItemsByCategory($CatId){
	global $database;
    
	$req= $database->query("SELECT * FROM item WHERE id_category =".$CatId);
   
    $record = $database->num_rows($req);
    if($record <= 0)
    {
        echo "<h2>no record for this category, sorry !</h2>";
    }else{
            
            while($re=$database->fetch_array($req))
            {
                $picLink= $re['name'];
                $idLink= $re['id'];
                echo " <a href='showitem.php?id=".$idLink."'> 
                    <img src='../items/".$picLink."' width='280' height='350'/>
                    </a>";
            }
         }
	
    } 
	
	
	
	
	
	public static function countAllItemsByCat($CatId){
	global $database;
        return self::find_by_sql("SELECT COUNT(*) FROM item WHERE id_category =".$CatId);
	
	
	}
	
	
	
	// CRUD pour les users
	public function save(){
	   return isset($this->id) ? $this->update() : $this->create(); 
	  //si l'id existe deja on sait que c'est deja en b2d et donc fuat l'updater sinon on cr�� l'enregistrement
	}
	
	
	//permet d'effacer la ligne dans la b2d et d'enlever le fichier
	public function destroy(){
	   if($this->delete()){ 
	     $target_path = "../../".$this->upload_dir."/".$this->name; //je reutlise le meme chemin cr�� plus haut dans le process de sauveagarde save_file() 
         return unlink($target_path) ? true : false;	//et j'utlise unlink pour detacher 	 
	   }else{
	      return false;
	   }
	
	}
	
	
	
	
	

	
	
	
	
	public function create() {
	 global $database;
	
	 $sql ="INSERT INTO ".self::$table_name." (";
	 $sql .="title, name, price, description, stock , id_category";
	 $sql .=") VALUES ('";
     $sql .= $this->title ."','";
	 $sql .= $this->name ."','"; 
	 $sql .= $this->price ."','";
	 $sql .= $this->description ."','";
	 $sql .= $this->stock ."','";
	 $sql .= $this->id_category;
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
    $sql .= "name='". $this->title ."', ";
	$sql .= "name='". $this->name ."', ";
	$sql .= "type='". $this->type ."', ";
	$sql .= "size='". $this->size ."', ";
	$sql .= "caption='". $this->caption ."' ,";
	$sql .= "id_status='". $this->status."' ,";
	$sql .= "id_directory='". $this->id_directory."' ";
	$sql .= " WHERE id= '". $this->id. "' " ;
	
	echo $sql;
	$database->query($sql);
	return ($database->affected_rows() == 1) ? true : false; //si la ligne est updat�e c'est ok sinon false
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