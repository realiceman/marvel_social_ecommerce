<?php 


class Pagination{

  public $current_page;
  public $per_page;
  public $total_count;
  
  
  
  public function __construct($page=1, $per_page=20, $total_count=0){
         $this->current_page = (int)$page;
		 $this->per_page = (int)$per_page;
		 $this->total_count = (int)$total_count;
  
  }

  
  
  public function offset(){
   //si 20 items par page : la page 1 a un offset de 0 -> (1-1) * 20
   //                       la page 2 a un offset de 20-> (2-1) * 20 ; donc démarre à 21 (zappe les 20 elements)
   return ($this->current_page -1) * $this->per_page;
  
  
  }

  
  public function total_pages(){
  
         return ceil($this->total_count/$this->per_page); //on retourne le nbres de pages nécessaires et on 
  }                                                       //utilise ceil pour arrondir au dessus

  
  
  public function previous_page(){
  
         return $this->current_page - 1;
  }
  
  
  public function next_page(){
  
         return $this->current_page + 1;
  
  }
  
  
  public function has_previous_page(){ //on verifie si il y a une page précedente
     
	    return $this->previous_page() >= 1 ? true : false;
  
  }
  
  
   public function has_next_page(){ //on verifie si il y a une page suivante
     
	    return $this->next_page() <= $this->total_pages() ? true : false;
  
  }

}



?>