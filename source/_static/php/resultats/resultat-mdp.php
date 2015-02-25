 <?php 
	$longeur_mdp = 6;
	if ($longeur_mdp >= 8) { // SI
		$save_mdp = true;
	} elseif ($longeur_mdp >= 6){ //SINON SI
		$save_mdp = true;
		echo "Ce mot de passe n'est pas très sûr !";
	} else { // SINON
		echo "Ce mot de passe est trop court !";
		$save_mdp = false;
	}
	if($save_mdp){ echo "Mot de passe sauvegardé !"; }
  ?>