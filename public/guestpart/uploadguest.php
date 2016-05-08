<?php
require_once("../../includes/initialize.php");
 $max_file_size = 1048576;  // en bytes , cest egal à 1MB
?>

  
<?php include("controllers/controlUploadGuest.php"); ?>  
 
  


	








	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
        <meta http-equiv="content-type" content="text/html; meta charset=UTF-8" />
        <meta name="description" content="" />  
        <meta name="keywords" content="" /> 
      
		<title>Marvel / DCcomics </title>
		<style>
		body {background-image:url('../images/marveldc.jpg');no-repeat center center fixed;
				webkit-background-size: cover;
				moz-background-size: cover;
				o-background-size: cover;
				background-size: cover;
				color: white;
				margin: 0;}
		form { background-color:black;
		       width:200px;
			  }
		
		</style>
		
</head>

<body>


<?php 
 include("layouts/header.php");   

 ?> <br/>

   <h3>Upload form for public display on the gallery :</h3>
   <form action="uploadguest.php" enctype="multipart/form-data" method="POST" >
	 
	 <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" /> <!-- largeur max de transfert en relation avec upload_max_filesize dans php.ini-->
	 <p><input type="file" name="file_upload" /></p>
	 <p>Caption: <input type="text" name="caption" value="" /></p>
	 <input type="submit" name="submitpublic" value="Public upload" />
	 
	 </form><br/><br/>
  
     <h3>Upload form for private display on "MyGallery" :</h3>
   <form action="uploadguest.php" enctype="multipart/form-data" method="POST" >
	 
	 <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" /> <!-- largeur max de transfert en relation avec upload_max_filesize dans php.ini-->
	 <p><input type="file" name="file_upload" /></p>
	 <p>Caption: <input type="text" name="caption" value="" /></p>
	 <input type="submit" name="submitprivate" value="Private upload" />
	 
	 </form>
  
  
 <?php 
include("layouts/footer.php"); 
?>

</body>

</html>