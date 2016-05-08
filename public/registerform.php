<?php
require_once("../includes/initialize.php");

include("controller/registercontroller.php");

?>





	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script> 
        <meta http-equiv="content-type" content="text/html; meta charset=UTF-8" />
        <meta name="description" content="" />  
        <meta name="keywords" content="" /> 
      
		<title>Marvel / DCcomics </title>
		
		
		<style>
		body {background-image:url('images/marveldc.jpg');no-repeat center center fixed;
				webkit-background-size: cover;
				moz-background-size: cover;
				o-background-size: cover;
				background-size: cover;
				color: white;
				margin: 0;}
				
				
				#contain {width:275px; margin:0 auto;}
                .line label {display:inline-block; width:140px;}
				form input[type="text"],
                form input[type="password"],
                form input[type="email"] {width:160px;}
				form .line {clear:both;}
                form .line.submit {text-align:right;}
			    p {color:black;}
		
		</style>
		
</head>

<body>

<?php 
 include("layouts/header.php");   
?><br/>



        <div id="contain">
		  
          <fieldset style='color:#6B0E0E;background-color:white;'> 
		       <form action="registerform.php" method="post">
			   <?php echo output_message($messagealert); ?><br/>
						<h1>NEW ACCOUNT </h1>
						 <div class="line"><label for="Fname">First name  : </label><input type="text" id="Fname" name="Fname"/></div>
						<div class="line"><label for="Lname">Last name : </label><input type="text" id="Lname" name="Lname"/></div>
						 <div class="line"><label for="guestname">Guestname : </label><input type="text" id="username" name="guestname"/></div>
						<div class="line"><label for="pwd">Password : </label><input type="password" id="pwd" name="pwd" /></div>               
						<div class="line"><label for="email">Email : </label><input type="email" id="email" name="email" /></div>
						<div class="line submit" ><input type="submit" name="submit" value="send" id="send" style='background-color:black;color:white;'/></div>
		 
						<p>Note: Please make sure your details are correct before submitting form and that all fields are well completed.</p>
                </form>
			</fieldset>
			
        </div>



	
		




  
  
 <?php 
include("layouts/footer.php"); 
?>

</body>

</html>