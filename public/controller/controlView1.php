<?php 

 //pagination
//je récupère dans un variable la page surlaquelle je suis grace à GET donc à l'url
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1; 

//je donne le nombre d'entrées par page
$per_page = 14;

//j'utilise la fonction count_all() pour me retourner le nombre d'entrées
$total_count = Photograph::count_all();


//j'instancie l'objet Pagination
$pagination = new Pagination($page, $per_page, $total_count);


//et donc je fais une requete qui va retourner que les enregistrements demandés sur chaque page correspondante

$sql = "SELECT * FROM photographs ";
$sql .= "WHERE id_status = 0 ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$photos = Photograph::find_by_sql($sql);





?>