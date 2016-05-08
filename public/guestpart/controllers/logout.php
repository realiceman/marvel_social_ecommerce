<?php
require_once("../../../includes/initialize.php");

if($session2->is_logged_in()) { 

   $session2->logout();
   redirect_to("../../index.php");


}






?>