</div>
		  
		
		
		<div id="admin_footer"> Copyright <?php echo date("Y",time()); ?> , Youssef Harkati </div>
                          <!--  petite astuce php pour avoir l'année en cours -->           
   </body>                          
</html>   
<?php if(isset($database)) {$database->close_connection();}  ?> 
   <!-- si la connection à la b2d est bien là donc on peut la fermer  -->