<div>
	<table>
		<thead>
			<tr>
				<th>Pizza</th><th>Prix Unitaire</th><th>Quantité</th><th>Prix</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$total = 0;
			
				for($i = 0; $i < count($_POST); ++$i){
					
					$quantite = (int) $_POST["pizza".($i+1)];
					
					if($quantite > 0) {
					
						echo "<tr>";
							echo "<td>".$pizzas[$i]['pizza']."</td>";
							echo "<td>".$pizzas[$i]['prix']."€</td>";
							echo "<td>".$quantite."</td>";
							$prix = $pizzas[$i]['prix'] * $quantite;
							echo "<td>".$prix."€</td>";
						echo "</tr>";
					
						
						$total += $prix;
					}
				}
			?>
		</tbody>
		<thead>
			<tr>
				<th colspan="3">Total commande :</th><th><?php echo $total;?>€</th>
			</tr>
		</thead>
	</table>
</div>