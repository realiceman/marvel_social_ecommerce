 <div id="slider">
   <ul>
   <?php
	//  recup�rer la liste des photos a afficher pour ma thematique pass�e en parametres pour le slider
	
	
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