$(document).ready(function() {

			$(".movepic").click(
					function(event){
				
				
				$("#form_"+event.target.id).show(); // le bouton cliqu�->donc l'img-> on recup�re l'id et on l'ajoute � "form_"; .show affiche
				
			}
			);
		});