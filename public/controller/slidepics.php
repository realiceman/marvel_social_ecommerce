 <div id="slider">
   <ul>
   <?php
	//  recupérer la liste des photos a afficher pour ma thematique passée en parametres pour le slider
	
	
	$req= mysql_query("SELECT * FROM slidepictures");
	$record = mysql_num_rows($req);
	if($record<=0)
	{
		echo "Sorry for the bug , no worry it 'll be fixed asap...";
	}else{
		
		   while($data = mysql_fetch_array($req))
		  {									
			$path = htmlentities($data['address']);
			echo "<li><img src='photopage/".$path."' style='height:600px;'/>'   '</li>";	
            		
		  }
	     }
?>
  </ul>
   </div>