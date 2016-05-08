<?php
require_once("../../includes/initialize.php"); 

if (!$session->is_logged_in()){ redirect_to("login.php"); } // avec ma fonction on verifie si il existe une session ...sinon redirection � login.php
?>
<?php 
$max_file_size = 1048576;  // en bytes , cest egal � 1MB


$message="";
// le process
if(isset($_POST['submit'])){
    $item = new Item();
    $item->title = $_POST['title'];
    $item->price = $_POST['price'];
    $item->description = $_POST['description'];//on place ds la variable ce qu'on recupere du formulaire
    $item->stock = $_POST['stock'];
    $item->id_category = $_POST['id_category'];
    
    $item->attach_file($_FILES['item_upload']); // on envoie l'array entier
    if($item->save_file()){ // on fait passer le nouvel objet dans le process de save_file() de la classe Photograph
        //ok
        $message= "photo uploaded :)";
        redirect_to('list_items.php');
    }else{
        //pas ok
        $message = "photo not uploaded :(";
    }
}

?>




<?php  include("../layouts/admin_header.php");   ?>

<a href="index.php">go back</a><br/><br/>

<h2> Item Upload </h2>

  <?php  echo output_message($message); ?> <!-- message pour dire si upload ou pas  -->
 <form action="item_upload.php" enctype="multipart/form-data" method="POST">
	 
	 <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" /> <!-- largeur max de transfert en relation avec upload_max_filesize dans php.ini-->
	 <p><input type="file" name="item_upload" /></p>
     <p><input type="text" name="title" placeholder="title"/> </p>
     <p><input type="text" name="price" placeholder="price"/> </p>
	 <p><input type="text" name="description" placeholder="describe" /></p>
     <p><input type="text" name="stock" placeholder="how many pieces ?"/> </p>
     <p><input type="text" name="id_category" placeholder="1:books, 2:goodies, 3:videos"/> </p>
	 <input type="submit" name="submit" value="Upload" />
	 
	 </form>
		
		
<?php  include("../layouts/admin_footer.php");   ?>