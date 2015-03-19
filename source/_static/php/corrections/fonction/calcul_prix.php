<?php

function Prix($prix_unitaire, $quantite){
	
	$prix_total=0;
	
	if(is_integer($prix_unitaire) AND is_integer($quantite)){
		$prix_total = $prix_unitaire * $quantite;
	}
	
	return $prix_total;
}

function Total($tableau){
	
	$total = 0;
	
	foreach($tableau as $commande){
		
		$total += $commande['prix_unitaire'] * $commande['quantite'];
		
	}
	
	return $total;
}

?>