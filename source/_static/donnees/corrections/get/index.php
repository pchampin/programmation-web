<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Exercice Get</title>
	</head>
	<body>
		<?php
		
			include('liste_hello.php');
		
			if(isset($_GET['nb_hello'])){
				listeHello((int) $_GET['nb_hello']);
			}
		?>
	</body>
</html>