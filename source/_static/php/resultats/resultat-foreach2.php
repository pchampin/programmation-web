<?php
	$coordonnees = array (
		'prenom' => 'François',
		'nom' => 'Dupont',
		'adresse' => '3 Rue du Paradis',
		'ville' => 'Marseille');

	foreach($coordonnees as $champ => $element)
	{
		echo $champ . ' : ' .$element . "\n";
	}
?>