<?php
session_start();
$idsession = $_SESSION['idsession'];
require_once("../../includes/initialize.php");

$iditem = $_GET['id'];
$database->query('DELETE FROM cart WHERE id_item ="'.$iditem.'" AND session= "'.$idsession.'"');

header('Location:shoppingcart.php');
?>