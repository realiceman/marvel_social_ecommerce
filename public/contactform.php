<?php
require_once("../includes/initialize.php");
?>

<?php 
include("controller/contactcontroller.php");
?>









	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
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
		
		</style>
		
</head>

<body>

<?php 
 include("layouts/header.php");   
?><br/>





 <div id="content">
    
    <?php echo output_message($messagealert); ?>
	
    <form action="contactform.php" method="post">
       
      <label for="name" style="color:black;">Name :</label>
      <input type="text" name="name" value="<?php if(isset($name)) echo $name;?>" />
      
      <label for="email" style="color:black;">Email :</label>
      <input type="text" name="email" value="<?php if(isset($email)) echo $email;?>" />
      
      <label for="subject" style="color:black;">Subject :</label>
      <input type="text" name="subject" value="<?php if(isset($subject)) echo $subject;?>" />
      
      <label for="message" style="color:black;">Your message :</label>
      <textarea name="message"><?php if(isset($message)) echo $message;?></textarea>
      
      <input type="submit" name="submit" class="submit" value="SUBMIT" />
      
      
    </form>
    
  </div>


  
  
 <?php 
include("layouts/footer.php"); 
?>

</body>

</html>