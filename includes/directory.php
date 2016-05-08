<?php 
 require_once("initialize.php");

class Directories { //on ne peut pas utiliser Directory : mot reserve
	 
	     protected static $table_name="directory";
	     public $id;
		 public $dirname;
		 public $guest;
		 public $status;
	     public $isPrivate=false;
		 // tableau de photos
		 public $array_photos= array();
		 public $photograph;
		 
		 
		 
		 	public static function find_by_id($id=0){ //retrouve par l'id
	   global $database;
	   echo 'test';
	   $result_array = self::find_by_sql("SELECT * FROM directory WHERE id={$id} ");
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
		 
		
		public static function getDirsByGuestId($guestId){
			
			global $database;
			$request = "SELECT * FROM directory WHERE id_guests=".$guestId; //je fais la requete
			$result = $database->query($request);
			$objects = array();
			if(!empty($result)){ //si ok...			    
				
				while ($record =  $database->fetch_array($result)){	//je parcours les enregistrements
					$instance = self::instantiate($record);//je crée un objet pour cet enregistement
					array_push($objects, $instance);// et le tableau contiendra tout les objets ajoutés
				}
				
			}
			return $objects;// et je retourne le tableau
		}
		
	 
	 
		 public static function display_dir($directoryId){
			 global $database;
			 $request = "SELECT * FROM directory WHERE id =".$directoryId;
			 $result = $database->query($request);
			// vérifier resultat not empty;
			if(!empty($result)){
			 while ($record =  $database->fetch_array($result)){	
					 $instance =  self::instantiate($record);
			 return Photograph::getPhotosByDirectory($instance->id);
			 }
		  }
		 }
		 
	 
		 
		 private static function instantiate($record){
			
			    $object = new self; // s'instancie lui meme dans $object puis on lui passe les attributs
				$object->id            = $record['id'];
				$object->dirname       = $record['dirname'];
				$object->status        = $record['id_status'];
				$object->guest         = $record['id_guests'];
				// remplir le tableau des photos attachées au directory
			 
			return $object;
		}
		
	
	
		public function create() {
		 global $database;
		 $sql ="INSERT INTO ".self::$table_name." (";
		 $sql .="dirname, id_guests, id_status";
		 $sql .=") VALUES ('";
		 $sql .= $this->dirname ."','"; 
		 $sql .= $this->guest ."','"; 
		 $sql .= ($this->isPrivate)?  "1" : "0";
		 $sql .= "')";
		 if($database->query($sql)){
			 return true;
		 }else{
			 return false;
		 }
		}
		 
		 
		 
		 public function delete_dir(){
		 global $database;
		$sql = "DELETE FROM ".self::$table_name;
		$sql .= " WHERE id=". $this->id;
		$sql .= " LIMIT 1";
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
		}
		
		
		
		public function delete_Dir_photo($photograph){
		 global $database;
		$sql = "DELETE FROM ". Photograph::$table_name;
		$sql .= " WHERE id_directory=". $this->id;
		$sql .= " LIMIT 1";
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
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
	 
	   
	   public function add_photo($photograph){
		// Photographs.addPhotoToDir
		if($photograph->id_directory != $this->id){
			//$findDir= self::find_by_id($photograph->id_directory);
			$photograph->id_directory= $this->id;
			$photograph->status= $this->status;
			$photograph->update();
		  }
	   } // si l'id_directory de la photo n'est pas celui du dossier alors on l'ajoute, sinon elle est déja présente
	   
	   
	   
		public function Remove($photograph){
		if($photograph->id_directory == $this->id){
			unset($photograph->id_directory);// on enleve l'id_directory de la photo
			$photograph->save();//on fait un update en bdd
			unset($this->array_photos[$photograph->id]);//on enleve l'index correspondant de la photo
		  }
	    }

		  
		  
	   public function Size(){
		return count($this->array_photos);
	     }
	   
	 
	 
 }








?>