
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Exercice tableau</title>
  </head>
  <body>
<?php
$commande = array (
'prix_unitaire' => 12,
'quantite' => 5
);

$total = $commande['quantite'] * $commande['prix_unitaire'];
echo "<p>Vous avez commandé ".$commande['quantite']." unités à ".$commande['prix_unitaire']."€ pièce; Soit un total de ".$total."€</p>";
?>
  </body>
</html>
