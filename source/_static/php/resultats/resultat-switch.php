<?php
	$couleur = "rouge";
	switch ($couleur) {
		  case "bleu"  : $r=0;   $g=0;   $b=255; break;
		  case "vert"  : $r=0;   $g=255; $b=0;   break;
		  case "rouge" : $r=255; $g=0;   $b=0;   break;
		  default      : $r=0;   $g=0;   $b=0;   break;
	}
	echo "Valeurs RGB pour $couleur : ($r,$g,$b).";
?>