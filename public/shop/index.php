<?php
session_start();
require_once("../../includes/initialize.php");

if(!isset($_SESSION['idsession']))
{
    $_SESSION['idsession'] = time()*rand(1,2000);
}
?>

<?php 
include("../controller/controlItemsView.php");


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
		   #thecategories{
               font-size:25px;  
               margin-bottom:50px; 
               color:#790d19;
               font-weight:bolder;
           } 
          #thecategories a{
              text-decoration:none;
              color:white;
              font-weight:bolder; 
              font-family:Devil Breeze;
          }
          
         
		 
		</style>
		
		
</head>

<body>

 <!--   je reutilise :  $target_path = "../".$this->upload_dir."/".$this->filename;  pour le chemin du fichier -->
<?php 
 include("layoutsEshop/header.php");   
?><br/><br/>
    <div id="thecategories">
    <?php
  echo Item::getAllCategories();
    ?>  
	<br/><br/>
        <a href="shoppingcart.php" onMouseOver="document.Img_1.src='layoutsEshop/logo/mycart_hover.jpg';" onMouseOut="document.Img_1.src='layoutsEshop/logo/mycart.jpg';"> <img name="Img_1" src="layoutsEshop/logo/mycart.jpg"> </a>
    </div>
    
   <br/><br/> 
    
    <?php 
$idReceived= $_GET['id'];
if(empty($idReceived)) { 
    ?>
 <?php foreach($items as $item) : ?>
     <div style="float: left; margin-left: 40px; padding:15px;">   
      <a href="showitem.php?id=<?php echo $item->id; ?>"> 
     <img src="<?php echo "../".$item->upload_dir."/".$item->name; ?>" width="280" height="350"/>
      </a>  
      </div>
 <?php endforeach; ?>
  
               <?php } else{
    
    ?>
    <div style="float: left; margin-left: 40px; color:black;"> 
    <?php
        Item::getItemsByCategory($idReceived);
  
       }
           
  ?>           
     </div> <br/> <br/>     
           
  <div id="pagination" style="clear: both;">
  <?php 
    if($pagination->total_pages() > 1){
	
	
	    if($pagination->has_previous_page()){
		 echo " <a href=\"index.php?page=";
		  echo $pagination->previous_page();
		  echo "\"  style=\"text-decoration:none; color:white;font-family:gratis;\">&laquo; Previous</a>";
		}
		
		for($i=1; $i <= $pagination->total_pages(); $i++){
			
				echo " <a href=\"index.php?page={$i}\" style=\"text-decoration:none; color:white;font-family:gratis;\"> {$i}</a>" ;
			}	
        		
	  
	    if($pagination->has_next_page()){
		  echo " <a href=\"index.php?page=";
		  echo $pagination->next_page();
		  echo "\" style=\"text-decoration:none; color:white;font-family:gratis;\">Next &raquo; </a>";
		}
	
	}
  
  ?>
  </div><br/> <br/>
  
  
 <?php 
include("layoutsEshop/footer.php"); 
?>

</body>

</html>