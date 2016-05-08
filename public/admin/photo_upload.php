<?php
require_once("../../includes/initialize.php"); 

if (!$session->is_logged_in()){ redirect_to("login.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection à login.php
?>
<?php include("admincontrollers/controlPhotoUpload.php"); ?>
















<?php  include("../layouts/admin_header.php");   ?>

<a href="index.php">go back</a><br/><br/>

<h2> Photo Upload </h2>

  <?php  echo output_message($message); ?> <!-- message pour dire si upload ou pas  -->
 <form action="photo_upload.php" enctype="multipart/form-data" method="POST">
	 
	 <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" /> <!-- largeur max de transfert en relation avec upload_max_filesize dans php.ini-->
	 <p><input type="file" name="file_upload" /></p>
	 <p>Caption: <input type="text" name="caption" value="" /></p>
	 <input type="submit" name="submit" value="Upload" />
	 
	 </form>
		
		
<?php  include("../layouts/admin_footer.php");   ?>