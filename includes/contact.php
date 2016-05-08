<?php
 require_once("initialize.php");

class Contact
{
  protected static $table_name="contact";
  public $name;
  public $email;
  public $subject;
  public $message;

  

  
  public function insertContact($name,$email,$subject,$message) {
	 global $database;
	 
	  $this->name = strip_tags($name);
      $this->email = strip_tags($email);
      $this->subject = strip_tags($subject);
      $this->message = strip_tags($message);
	 // on insert les donnees en b2d en "echappant" les donnees recuperees par l'objet
	 $sql ="INSERT INTO ".self::$table_name." (";
	 $sql .="name, email, subject, message";
	 $sql .=") VALUES ('";
	 $sql .= $this->name ."','"; //on met cette valeur en l'echappant avec la methode escape value qui est dans la classe db
	 $sql .= $this->email ."','";
	 $sql .= $this->subject ."','";
	 $sql .= $this->message ."')";
	 if($database->query($sql)){//si ok envoie cette requete
	     return true;
		
	 }else{
	     return false;
	 }
	}
	
	
	
	
	 public function sendEmail($name,$email,$subject,$message){
	 
    $this->to = 'commicsgallery@gmail.com';
     $this->name = strip_tags($name);
      $this->email = strip_tags($email);
      $this->subject = strip_tags($subject);
      $this->message = strip_tags($message);
    
    $this->headers = 'From:'.$this->email."\r\n";
    $this->headers.='MIME-version: 1.0'."\r\n";
    $this->headers.='Content-type: text/html; charset=utf-8'."\r\n";
    
    mail($this->to,$this->subject,$this->message,$this->headers);
  }
 
}

?>