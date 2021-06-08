<?php

// Tableau (id, prenom, nom, age)
// afficher l'âge dans 50 ans
//Bonjour, nom prenom dans 50 asn vous aurez x ans.
  $identitePersonneA= array (
         'id'=>15,
         'prenom'=>'Nicolas',
         'nom'=>'Dupont',
         'age'=>'34'
  );


  $age_supplementaire = $identitePersonneA['age'] + 50;

echo 'Bonjour '.$identitePersonneA['nom'].'   '.$identitePersonneA['prenom'].' dans 50 ans vous aurez  '.$age_supplementaire.' ans.';

//Super j'ai trouvé ça seul c'est un miracle

?>



