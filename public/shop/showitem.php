<?php
require_once("../../includes/initialize.php");

$id = $_GET['id'];
$item = Item::find_by_id($id);

?>

	








	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
        <meta http-equiv="content-type" content="text/html; meta charset=UTF-8" />
        <meta name="description" content="" />  
        <meta name="keywords" content="" /> 
      
		<title>Marvel / DCcomics </title>
    <link rel="stylesheet" href="layoutsEshop/cssitem.css" />
		
		
</head>

<body>
    <div class="itemheader"><p> <?php echo $item->title; ?></p></div>
    <div class="page">
        <img src="../items/<?php echo $item->name; ?>" style="width:280px;margin-top:30px;margin-left:30px;margin-bottom:30px;"/>
        <div class="describe">
            <?php $category = $item->id_category; ?>
            <a href="index.php">Back to the shop</a> | Category : <a href=""><?php  Item::getCategoryName($category) ; ?></a>
            <br>
            <br>
            <b>Description :</b>  <?php echo $item->description; ?>
            <br>
            <br>
            <span style="font-size:20px;color:#0093d1;">Price : <strong> <?php echo $item->price; ?> $</strong></span>
            <br>
            <br>
            <form method="post" action="shoppingcart.php">
                Quantity : <input type="number" name="quantity" value="1" min="1" style="width:50px;text-align:center;"/>
                <br>
                <br>
                <input type="image" src="layoutsEshop/logo/addtocart.png"/>
                <input type='hidden' id='iditem' name='iditem' value= '<?php echo $item->id ?>' />
            </form>
        </div>
    </div>


</body>

</html>