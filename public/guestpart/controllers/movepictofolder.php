<?php
require_once("../../../includes/initialize.php");
?>

<?php 

	$chosenDir = isset($_POST['choose_directory']) ? $_POST['choose_directory'] : 'no dir id received';
	$photoId = isset($_POST['photo_id']) ? $_POST['photo_id'] : 'no photo is received';
    $photo = Photograph::find_by_id($photoId);
	$findDir= Directories::find_by_id($chosenDir);
	$findDir->add_photo($photo);
	redirect_to('../mygallery.php');

?>