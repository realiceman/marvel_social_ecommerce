<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()){ redirect_to("login.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection à login.php
?>

<?php 
 //trouver les photos
 $guests = Guest::find_all();//on retrouve tt les records avec la requete dans la classe

?>






<?php  include("../layouts/admin_header.php");   ?>

<h2>Guests list</h2>


<table class="bordered">
		<tr>
		  <th>guestname</th>
		  <th>email</th>
		  <th>first name</th>
		  <th>last name</th>
		  <th>&nbsp;</th>
		</tr>
		<!-- pour chaque image passée dans $photos on va faire un affichage dynamique qui s'adaptera aux nombres de lignes enregistrees en b2d  -->
	<?php foreach($guests as $guest): ?>
		  <tr>  
			  <td><?php echo $guest->guestname; ?></td>
			  <td><?php echo $guest->email; ?></td>
			  <td><?php echo $guest->first_name; ?></td>
			  <td><?php echo $guest->last_name; ?></td>
			  <td><a href="admincontrollers/ControlDeleteGuest.php?id=<?php echo $guest->id; ?>">delete</a></td>
		  </tr>
	<?php endforeach; ?>
</table>
<br/>
<a href="index.php">go back</a>


<?php  include("../layouts/admin_footer.php");   ?>
 