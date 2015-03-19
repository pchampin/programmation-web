<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Exercice fonction</title>
  </head>
  <body>
<?php
include('calcul_prix.php');

$commande1 = array (
'prix_unitaire' => 12,
'quantite' => 5
);

$commande2 = array (
'prix_unitaire' => 10,
'quantite' => 1
);


$commande3 = array (
'prix_unitaire' => 15,
'quantite' => 3
);


$commandes = array($commande1, $commande2, $commande3);

$total = Total($commandes);

$i = 0;
foreach ( $commandes as $commande){
	++$i;
	$prix = Prix($commande['prix_unitaire'], $commande['quantite']);
	echo "<p>La commande ".$i." contient ".$commande['quantite']." unités à ".$commande['prix_unitaire']."€ pièce; Soit un sous-total de ".$prix."€.</p>";
}

echo "<p><strong>Le prix total de ces ".$i." commandes est ".$total."€</strong></p>";


?>
  </body>
</html>
