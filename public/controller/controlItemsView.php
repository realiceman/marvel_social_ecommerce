<?php 

 //pagination
//je r�cup�re dans un variable la page surlaquelle je suis grace � GET donc � l'url
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1; 

//je donne le nombre d'entr�es par page
$per_page = 14;

//j'utilise la fonction count_all() pour me retourner le nombre d'entr�es
$total_count = Item::count_all();


//j'instancie l'objet Pagination
$pagination = new Pagination($page, $per_page, $total_count);


//et donc je fais une requete qui va retourner que les enregistrements demand�s sur chaque page correspondante

$sql = "SELECT * FROM item ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$items = Item::find_by_sql($sql);





?>