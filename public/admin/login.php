<?php
require_once("../../includes/initialize.php");
include("admincontrollers/controlLogin.php");

	  
?>









<?php  include("../layouts/admin_header.php");   ?> 

			<h2>Staff Login</h2>
			<?php echo output_message($message); ?> <!-- fonction dans functions.php  -->
			
			<form action="login.php" method="post">
					<table>
					 <tr>
					   <td> username:</td>
					   <td>
						 <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>"  /> 
																			<!-- on enleve les donnees inutiles ou douteuses avant de soumettre  -->
					   </td>
					  </tr>
					  
					  <tr>
					   <td> password:</td>
					   <td>
						 <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>"  />
					
					   </td>
					  </tr>
					  
					  <tr>
						 <td colspan="2">
						   <input type="submit" name="submit" value="login" />
						  </td>
					  </tr>
					</table>
			</form>
			
		<?php  include("../layouts/admin_footer.php");   ?>

