<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Commande pizza</title>
	</head>
	<body>
		<section id="commande">
			<h1>Commande de pizza en ligne</h1>
		
			<form action="#">
				
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
							<tr>
								<td>
									Margherita
								</td>
								<td>
									Tomate, Jambon, Mozzarella
								</td>
								<td>
									8€
								</td>
								<td class="qte"><input type="text" name="mar_qte" value="0" /></td>
							</tr>
							<tr>
								<td>
									Reine
								</td>
								<td>
									Tomate, Jambon, Champignons, Mozzarella
								</td>
								<td>
									9€
								</td>
								<td class="qte"><input type="text" name="rei_qte" value="0" /></td>
							</tr>
							<tr>
								<td>
									3 Fromages
								</td>
								<td>
									Crème, Oignons, Emmental, Chèvre, Mozzarella
								</td>
								<td>
									12€
								</td>
								<td class="qte"><input type="text" name="from_qte" value="0" /></td>
							</tr>
						</tbody>
					</table>
				</div>	
				<div>
					<button type="submit">Commander</button>
				</div>
			</form>
		</section>
	</body>
</html>