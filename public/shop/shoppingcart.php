<?php
session_start();
require_once("../../includes/initialize.php");

$idsession = $_SESSION['idsession'];

if(isset($_POST['iditem'])){
    $id = $_POST['iditem'];
    $count=0;
    while($count<$_POST['quantity']){
        
        $rec = $database->query("INSERT INTO cart (session, id_item) VALUES ('$idsession','$id')");
        $count+=1;
    }
}

if(!empty($_POST)){
    extract($_POST);
    if(isset($voucher)){
        if(($voucher == "promo40")&&($due >= 250)){
            
            $voucher2 = 40;
        }
        elseif(($voucher == "promo20")&&($due >= 150)){

            $voucher2 = 20;
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Shopping cart</title>
        <link rel="stylesheet" href="layoutsEshop/cartcss.css" />
    </head>
    <body>
        <div class="text_cart" style="color:#0093d1;">Your shopping cart :</div>
        <form method="post" action="shoppingcart.php">
            <div id="header_cart"></div>
            <table>
                <?php 
       $result = $database->query('SELECT DISTINCT name 
                                   FROM item, cart
                                   WHERE item.id = cart.id_item 
                                   and session="'.$idsession.'"'); //afin de recuperer le nom de l'item

   $cart_records = $database->query("SELECT id FROM cart WHERE session=".$idsession); //pr savoir s'il y a des enregist. par rapport au mess.
   

$counter=1;
$total=0; //var pr le prix total
$all_qu=0;


if($database->num_rows($cart_records) > 0)
{
       while($result_datas =$database->fetch_array($result)){
           $name= $result_datas['name'];
           $sessionItem = $database->query('SELECT * FROM item WHERE name="'.$name.'"');
          $sessionItem_datas = $database->fetch_array($sessionItem); 
           
           if($counter%2==0)
           { 
    
     
            ?>
       
                <tr style="height:60px;">
                    <td style="width:403px;color:#333;" class="grey_part"><?php echo $sessionItem_datas['title']; ?></td>
                    <td style="width:103px;color:#0093d1;" class="grey_part"><?php echo Item::getCategoryName($sessionItem_datas['id_category']); ?></td>
                    <td style="width:103px;color:#0093d1;" class="grey_part"><?php echo $sessionItem_datas['price']; ?> $</td>
                    <td style="width:103px;color:#333;" class="grey_part">
                        <?php //recuperation id de l'item puis on en comptabilise le nombre dans le panier
               $idItemSession = $sessionItem_datas['id'];
               $quantity = $database->query('SELECT * FROM cart WHERE session ="'.$idsession.'" AND id_item="'.$idItemSession.'"');
               $qu = $database->num_rows( $quantity);
               $all_qu+=$qu;
               echo $qu;
                        ?>
                    </td>
                    <td style="width:103px;color:#333;" class="grey_part"><a href="delete.php?id=<?php echo $sessionItem_datas['id']; ?>"><img src="layoutsEshop/logo/del.png" style="padding-top:8px;"/></a></td>
                    <td style="width:105px;color:#333;border-right:none;" class="grey_part"><?php $finalPriceItem = $sessionItem_datas['price']*$qu; $total+=$finalPriceItem; echo $finalPriceItem ?> $</td>
                </tr>
                <?php
               $counter+=1;
           }
           else
           {
                ?>
                <tr style="height:60px;">
                    <td style="width:403px;color:#333;" class="white_part"><?php echo $sessionItem_datas['title']; ?></td>
                    <td style="width:103px;color:#0093d1;" class="white_part"><?php echo Item::getCategoryName($sessionItem_datas['id_category']); ?></td>
                    <td style="width:103px;color:#0093d1;" class="white_part"><?php echo $sessionItem_datas['price']; ?> $</td>
                    <td style="width:103px;color:#333;" class="white_part">
                       <?php //recuperation id de l'item puis on en comptabilise le nombre dans le panier
                       $idItemSession = $sessionItem_datas['id'];
                       $quantity = $database->query('SELECT * FROM cart WHERE session ="'.$idsession.'" AND id_item="'.$idItemSession.'"');
                       $qu = $database->num_rows( $quantity);
                       $all_qu+=$qu;
                       echo $qu;
                        ?>
                    </td>
                    <td style="width:103px;color:#333;" class="white_part"><a href="delete.php?id=<?php echo $sessionItem_datas['id']; ?>"><img src="layoutsEshop/logo/del.png" style="padding-top:8px;"/></a></td>
                    <td style="width:105px;color:#333;border-right:none;" class="white_part"><?php $finalPriceItem = $sessionItem_datas['price']*$qu; $total+=$finalPriceItem; echo $finalPriceItem ?> $</td>
                </tr>
       
                <?php 
           $counter+=1;
       
           }
       }
}  
 else
{
                ?>
                <tr style="height:60px;">
                    <td style="width:930px;background:#fff;text-align:center;color:#333;font:14px Arial;font-weight:bold;border-radius:0 0 10px 10px;text-decoration:underline;">your cart is empty.</td>
                </tr>
                
                <?php 
                
                    } 
                 ?>
                
            </table>
            <br>
            <div class="text_cart">
                <strong>
                    <input type="text" name="voucher" placeholder="Voucher code" value="<?php if(isset($voucher2)) echo $voucher; ?>" style="font:13px Arial;color:#0093d1;font-weight:bold;"/>
                    <span style="color:#0093d1;"><?php if(isset($voucher2)){ ?> the discount is <?php echo $voucher2; }?> $</span>
                    <br>
                    <br>
                    <?php
                if($total>=300)
                {
                    echo'DELIVERY COST : FREE !! ';
                }
                else
                {
                                    ?>
                                    DELIVERY COST : <?php $delCost=2.5*$all_qu; echo number_format($delCost,2); ?>$ (It misses : <?php if(isset($voucher2))  {
									$missing=300-$total+$voucher2;
									}else{
									$missing=300-$total;
									} 
									echo number_format($missing,2); ?>$ to have free delivery.)
                                    <?php
                }
                    ?>
                    <br>
                    <br>
                    <span style="color:#0093d1;">Total of your order </span>
                    <br>
                    <span style="font-size:25px;color:#0093d1;"><?php
                         if(isset($delCost)){
                             $due=$total+$delCost; 
                                 if(isset($voucher2)){
                                     $due=$due-$voucher2;
                                  } 
                             echo number_format($due,2); 
                         }else{ 
                             $due=$total; 
                                 if(isset($voucher2)){
                                     $due=$due-$voucher2;
                                 } 
                                 echo number_format($due,2); 
                              } ?> $  
                    </span>
                    <br>
                    <br>
                    <a href="verif.php"><img src="layoutsEshop/logo/finalizeorder.png" style="margin-right:25px;"/></a>
                    <input type="hidden" value="<?php echo $due; ?>" name="due"/>
                    <input type="image" src="layoutsEshop/logo/update.png"/>
                    <a href="index.php"><img src="layoutsEshop/logo/followshopping.png" style="margin-left:25px;"/></a>
                </strong>
            </div>
        </form>
    </body>
</html>