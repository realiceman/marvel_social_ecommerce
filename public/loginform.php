<?php
require_once("../includes/initialize.php");


include("controller/logincontroller.php");

?>













	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script> 
        <meta http-equiv="content-type" content="text/html; meta charset=UTF-8" />
        <meta name="description" content="" />  
        <meta name="keywords" content="" /> 
      
		<title>Marvel / DCcomics </title>
		
		<link rel="stylesheet" type="text/css" href="stylesheet/csslogin.css" />
		<style>
		body {background-image:url('images/marveldc.jpg');no-repeat center center fixed;
				webkit-background-size: cover;
				moz-background-size: cover;
				o-background-size: cover;
				background-size: cover;
				color: white;
				margin: 0;}
		
		</style>
		
</head>

<body>

<?php 
 include("layouts/header.php");   
?><br/>



<form action="loginform.php" method="post">

<div class="login">
<?php echo output_message($messagealert); ?>
    <input type="text" placeholder="guestname" name="guestname" value="<?php echo htmlentities($guestname); ?>"   >  
  <input type="password" placeholder="password" name="password" value="<?php echo htmlentities($password); ?>"  >  
  <input type="submit" value="Login" id='login' name='login'><br/>
                     <a href="register.php" style="text-decoration:none;color:black; margin-left:55px;"> Need to create an account ?</a>
</div>

</form> <br/>




  
  
 <?php 
include("layouts/footer.php"); 
?>

</body>

</html>