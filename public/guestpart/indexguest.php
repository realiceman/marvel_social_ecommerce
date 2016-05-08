<?php
require_once("../../includes/initialize.php");
?>
<?php 
include("../controller/controlView1.php");


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
		
</head>

<body>

 <!--   je reutilise :  $target_path = "../".$this->upload_dir."/".$this->filename;  pour le chemin du fichier -->
<?php 
 include("layouts/header.php");   

 ?> <br/>
<?php foreach($photos as $photo) : ?>
  <div style="float: left; margin-left: 20px;">
  <a href="photoguest.php?id=<?php echo $photo->id; ?>">
    <img src="<?php echo "../".$photo->upload_dir."/".$photo->filename; ?>" width="200" height="200"/>
  </a>
  <p><strong><?php echo $photo->caption; ?></strong></p>
  </div>
  <?php endforeach; ?>
  
  
  <div id="pagination" style="clear: both;">
  <?php 
    if($pagination->total_pages() > 1){
	
	
	    if($pagination->has_previous_page()){
		 echo " <a href=\"indexguest.php?page=";
		  echo $pagination->previous_page();
		  echo "\"  style=\"text-decoration:none; color:white;font-family:gratis;\">&laquo; Previous</a>";
		}
		
		for($i=1; $i <= $pagination->total_pages(); $i++){
			
				echo " <a href=\"indexguest.php?page={$i}\" style=\"text-decoration:none; color:white;font-family:gratis;\"> {$i}</a>" ;
			}	
        		
	  
	    if($pagination->has_next_page()){
		  echo " <a href=\"indexguest.php?page=";
		  echo $pagination->next_page();
		  echo "\" style=\"text-decoration:none; color:white;font-family:gratis;\">Next &raquo; </a>";
		}
	
	}
  
  ?>
  </div>
  
  
 <?php 
include("layouts/footer.php"); 
?>

</body>

</html>