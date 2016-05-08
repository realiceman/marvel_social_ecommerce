<?php
require_once("../../includes/initialize.php");
?>

<?php 
$message="";
if(empty($_GET['id'])){ //si on obtient aucun ID via l'url donc pas de photo...
$message= "no photos in here !!!! "; //..message d'erreur
redirect_to('mygallery.php');

}



$message="";
$photos =Directories::display_dir($_GET['id']); 


?>

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
		
		</style>
		
		<script type="text/javascript" src ="../javascript/jquery.js" >  </script>
		
</head>

<body>


<?php 
 include("layouts/header.php");  
 ?>
 
 <?php foreach($photos as $photo) : ?>

  <div style="float: left; margin-left: 20px;">
  <a href="photoguest.php?id=<?php echo $photo->id; ?>">
    <img src="<?php echo "../".$photo->upload_dir."/".$photo->filename; ?>" width="200" height="200"/>
  </a>
  <p><strong><?php echo $photo->caption; ?></strong>
  
    
 <br/><br/>


<a href="controllers/controldeletepic.php?id=<?php echo $photo->id; ?>"><img src="layouts/logo/delete.png"/> </a>
  
 </div>
 <?php endforeach;?>
   
 <?php 
include("layouts/footer.php"); 
?>

</body>

</html>