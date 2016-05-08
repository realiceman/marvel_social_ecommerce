<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()){ redirect_to("login.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection � login.php
?><!-- on recupere la valeur true or false de check-login() --> 


<?php  include("../layouts/admin_header.php");   ?>

		   <h2>Menu</h2>
		
		
		<ul>
		
	       <li> <a href="list_photos.php">view the list of pics</a></li>
		    <li> <a href="photo_upload.php">upload some pics</a></li>
		    <li> <a href="list_guests.php">view the list of the guests</a></li>
            <li> <a href="item_upload.php">upload an item inside the store</a></li>
            <li> <a href="list_items.php">view the list of the items</a></li>
			  <li> <a href="admincontrollers/logout.php">logout</a></li>
		
<?php  include("../layouts/admin_footer.php");   ?>