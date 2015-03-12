<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Commande pizza</title>
	</head>
	<body>
	
		<?php
			ini_set(’display_errors’,’1’) ;
		
			include("prix.php");
		?>
	
		<?php
		
			if(isset($_POST) AND count($_POST)>0){
				include("recap_commande.php");
			} else {
				
		?>
	
		<section id="commande">
			<h1>Commande de pizza en ligne</h1>
		
			<form action="#" method="post">
				
				<div><label for="nom">Nom</label><input type="text" id="nom" name="nom" /></div>
				<div><label for="tel">N. Telephone</label><input type="text" id="tel" name="tel" /></div>
				
				<div><label for="adresse">Adresse</label><textarea id="adresse" name="adresse" placeholder="Entrez votre adresse" /></textarea></div>
				
				<div>
					<label for="list">Ma Commande</label>
					<table>
						<thead>
							<tr>
								<th>Pizza</th><th>Ingrédients</th><th>Prix</th><th>Quantité</th>
							</tr>
						</thead>
						<tbody>
							<?php
							
								$number=0;
								foreach($pizzas as $pizza){
									echo "<tr>";
										echo "<td>".$pizza['pizza']."</td>";
										echo "<td>".$pizza['ingredients']."</td>";
										echo "<td>".$pizza['prix']."€</td>";
										$number++;
										echo "<td class=\"qte\"><input type=\"text\" name=\"pizza".$number."\" value=\"0\" /></td>";
									echo "</tr>";
								}
								
							?>
						</tbody>
					</table>
				</div>	
				<div>
					<button type="submit">Commander</button>
				</div>
			</form>
		</section>
		
		<?php 
			} // else
		?>
	</body>
</html>