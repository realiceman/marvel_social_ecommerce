<?php 
  $ses = $session2->guest_id; //je mets dans une variable la session du guest
 
  $photos = Photograph::getPhotosByGuest($ses); // et grace � cette session je recupere les photos enregistr�es par le guest


?>