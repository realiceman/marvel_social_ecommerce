<?php



// fonction de redirection
function redirect_to($location = null){
    if($location!=NULL){
	    header("Location: {$location}");
		exit;
	
	}

}

function output_message($message=""){
       if(!empty($message)){
	       return "<p class=\"message\">{$message}</p>";
	   
	   }else{
	     return"";
	   }


}



?>