$(document).ready(function() {

			$(".movepic").click(
					function(event){
				
				
				$("#form_"+event.target.id).show(); // le bouton cliqué->donc l'img-> on recupère l'id et on l'ajoute à "form_"; .show affiche
				
			}
			);
		});