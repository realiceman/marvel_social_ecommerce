<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()){ redirect_to("login.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection à login.php
?>

<?php 
 //trouver les photos
 $photos = Photograph::find_all();//on retrouve tt les records avec la requete dans la classe Photograph

?>






<?php  include("../layouts/admin_header.php");   ?>

<a href="index.php">go back</a><br/>

<h2>Photographs</h2>


<table class="bordered">
		<tr>
		  <th>Image</th>
		  <th>Filename</th>
		  <th>Caption</th>
		  <th>Size</th>
		  <th>Type</th>
		  <th>Comments</th>
		  <th>&nbsp;</th>
		</tr>
		<!-- pour chaque image passée dans $photos on va faire un affichage dynamique qui s'adaptera aux nombres de lignes enregistrees en b2d  -->
	<?php foreach($photos as $photo): ?>
		  <tr>  <!-- on recupere le chemin grace à filename que l'on ajoute au directory  -->
			  <td><img src="../images/<?php echo $photo->filename; ?>" width="100" /> </td> 
			  <td><?php echo $photo->filename; ?></td>
			  <td><?php echo $photo->caption; ?></td>
			  <td><?php echo $photo->size; ?></td>
			  <td><?php echo $photo->type; ?></td> 
			  <td>
			-count: <a href="comments.php?id=<?php echo $photo->id; ?>">
				  <?php $comments = Comment::find_comments_on($photo->id); 
				        echo count($comments); ?>
				 </a>
			  </td>
			  <td><a href="admincontrollers/ControldeletePhoto.php?id=<?php echo $photo->id; ?>">delete</a></td>
		  </tr>
	<?php endforeach; ?>
</table>
<br/>
<a href="photo_upload.php">Upload a new pic</a>


<?php  include("../layouts/admin_footer.php");   ?>
 