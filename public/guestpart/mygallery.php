<?php
require_once("../../includes/initialize.php");
?>



<?php include("controllers/controlphotosguest.php"); ?>

<?php include("controllers/controldirectory.php");  ?>




	








	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
        <meta http-equiv="content-type" content="text/html; meta charset=UTF-8" />
        <meta name="description" content="" />  
        <meta name="keywords" content="" /> 
      
		<title>Marvel / DCcomics </title>
		 <link rel="stylesheet" type="text/css" href="../javascript/tooltipster.css" />
		<style>
		body {background-image:url('../images/marveldc.jpg');no-repeat center center fixed;
				webkit-background-size: cover;
				moz-background-size: cover;
				o-background-size: cover;
				background-size: cover;
				color: white;
				margin: 0;}
		
		</style>
		
		
		<script type="text/javascript" src ="../javascript/jquery.js">  </script>
		<script type="text/javascript" src ="../javascript/move_pict.js">  </script>
		<script type="text/javascript" src="../javascript/jquery.tooltipster.min.js"></script>
		<script type="text/javascript" src="../javascript/jquery.tooltipster.js"></script>
		<SCRIPT type="text/javascript" language="Javascript">
		
	    $(document).ready(function() {
            $('.tooltip').tooltipster();
        });
        
	
	
    </script>
</head>

<body>


<?php 
 include("layouts/header.php");   

 
 
 
$dir_selection= '<select name="choose_directory">';
 foreach ($dirs as $adir){
	$dir_selection .= '<option value="'.$adir->id .'">'. $adir->dirname .'</option>'; 
 }
$dir_selection.= '</select>';
 ?> 
 
 
 <br/><br/>
<?php foreach($photos as $photo) : ?>

  <div style="float: left; margin-left: 20px;">
  <a href="photoguest.php?id=<?php echo $photo->id; ?>">
    <img src="<?php echo "../".$photo->upload_dir."/".$photo->filename; ?>" width="200" height="200"/>
  </a>
  <p><strong><?php echo $photo->caption; ?></strong>
  
 <br/><br/>

<a href="controllers/controlstatus.php?id=<?php echo $photo->id; ?>"><img src="layouts/logo/<?php echo ($photo->status=='0')? 'public.png' : 'private.png' ; ?>"  /></a> <!-- envoi vers le controleur de statut, et on affiche la bonne image selon le statut  -->
<a href="controllers/controldeletepic.php?id=<?php echo $photo->id; ?>"><img src="layouts/logo/delete.png"/> </a> <!-- on efface et on met à jour avec le controleur  -->
<img class="movepic" id="movepic-<?php echo $photo->id; ?>" src ="layouts/logo/moveto.png" /> 
<form action ="controllers/movepictofolder.php" method="POST" style="display : none;" id="form_movepic-<?php echo $photo->id; ?>"> <!-- formulaire lié au bouton avec l'id photo -->

<?php	
	echo $dir_selection;
?>

<input type ="hidden" name="photo_id" value="<?php echo $photo->id; ?>" />
<input type="submit" value ="move photo" />
</form>
 </p>
  </div>
  
  
  
  
  <?php endforeach;?>
  
  <?php foreach ($dirs as $dir) : ?>
	

  <div style="float: left; margin-left: 20px;">
  <a href="photosdir.php?id=<?php echo $dir->id; ?>">
    <img src="layouts/logo/bigFolder.png" width="200" height="200"/>
  </a>
  <p><strong><?php echo $dir->dirname; ?></strong>
  
 <br/><br/>
 <a href="controllers/controldirstatus.php?id=<?php echo $dir->id; ?>" ><img src= "layouts/logo/<?php echo ($dir->status=='0')? 'public.png' : 'private.png' ; ?>" class="tooltip" title="to change the status" /></a> <!-- envoi vers le controleur de statut, et on affiche la bonne image selon le statut  -->
<a href="controllers/controldeletedir.php?id=<?php echo $dir->id; ?>"><img src="layouts/logo/delete.png"  /> </a> <!-- on efface et on met à jour avec le controleur  -->
 

 </p>
  </div>
  <?php endforeach; ?>
  
  
<!-- simple clear both pour que les photos viennent en dessous  sans deborder dans le footer -->
  <div style="clear: both;">
  
  </div>
  
  <img src="layouts/logo/folder.png"/> 

 <form action="mygallery.php" method="POST">
	<li><label id="folderstatus">Create a folder : </label></li>
   private <input type="radio" name="foldstatus" value="1" />
   public <input type="radio" name="foldstatus" value="0" />
	<input type="text" name="caption" placeholder="caption" />
	<input type="submit" name="submitfolder" value="submit" />
	 
	 
	 </form>
  
 <?php 
include("layouts/footer.php"); 
?>

</body>

</html>