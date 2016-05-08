</div>
		<div id="white">
        </div>		
		
		
		<div id="footer"> 
			<span><a href="../rights.php">PRIVACY POLICY</a></span>
			<span id="admin"><a href="../admin/index.php">admin</a></span>
			<span id="copy">Copyright <?php echo date("Y",time()); ?> , Youssef Harkati </span>
			
			
		
		</div>
         
        
		<div id="white">
        </div>	
                    
   </body>                          
</html>   
<?php if(isset($database)) {$database->close_connection();}  ?> 
   <!-- si la connection � la b2d est bien l� donc on peut la fermer  -->