<?php
require_once("../includes/initialize.php");
?>

			
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
        <meta http-equiv="content-type" content="text/html; meta charset=UTF-8" />
        <meta name="description" content="Welcome to the HD comics gallery" />  
        <meta name="keywords" content="comics, pictures, marvel, dc comics, batman, superman, spiderman, thor, avengers, justice league, super heroes" /> 
        <meta name="robots" content="index.follow">
		<meta name="Revisit-After" content="1 Days">
		<meta name="author" content="comics-gallery.com">
		<meta name="noarchive" content="robots">
		<meta name="copyright" content="copyright @ comics-gallery.com">
		<meta http-equiv="content-language" content="all">
		
		<title>Marvel / DCcomics </title>
		
		
		<script type="text/javascript" src="javascript/jquery.js"></script>
		<script type="text/javascript" src="javascript/easyslider1.7.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
		    $("#slider").easySlider({
			  continuous:true,
			  auto:true,
			  speed:35000,
			  
			  
			});			
		});
		</script>
		
</head>

<body>
 
<?php 
 include("layouts/header.php");   
?>



    <?php include ('controller/slidepics.php');?> 
   


 <?php 
include("layouts/footer.php"); 
?>

</body>

</html>