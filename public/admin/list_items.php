<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()){ redirect_to("login.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection � login.php
?>

<?php 
 //trouver les photos
 $items = Item::find_all();//on retrouve tt les records avec la requete dans la classe Photograph

?>






<?php  include("../layouts/admin_header.php");   ?>

<a href="index.php">go back</a><br/>

<h2>Items</h2>


<table class="bordered">
		<tr>
		  <th>Image</th>
		  <th>name</th>
		  <th>price</th>
		  <th>description</th>
		  <th>stock</th>
		  <th>category</th>
		  
		</tr>
		<!-- pour chaque image pass�e dans $items on va faire un affichage dynamique qui s'adaptera aux nombres de lignes enregistrees en b2d  -->
	<?php foreach($items as $item): ?>
		  <tr>  <!-- on recupere le chemin grace � filename que l'on ajoute au directory  -->
			  <td><img src="../items/<?php echo $item->name; ?>" width="100" /> </td> 
			  <td><?php echo $item->name; ?></td>
			  <td><?php echo $item->price; ?></td>
			  <td><?php echo $item->description; ?></td>
			  <td><?php echo $item->stock; ?></td> 
              <td><?php echo $item->id_category; ?></td>
			
			  <td><a href="admincontrollers/ControldeleteItem.php?id=<?php echo $item->id; ?>">delete</a></td>
		  </tr>
	<?php endforeach; ?>
</table>
<br/>
<a href="item_upload.php">Upload a new item</a>


<?php  include("../layouts/admin_footer.php");   ?>
 