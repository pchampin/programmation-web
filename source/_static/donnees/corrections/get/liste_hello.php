<?php

function listeHello($nb){
	echo "\n		<ul>\n";
	
	if(is_int($nb) AND $nb > 0) {
		$limite = min($nb, 100);
		for($i = 1; $i <= $limite; ++$i){
			if($i%10){
				if($i%2){
					echo "			<li class=\"even\"><span></span>Hello World</li>\n";
				} else {
					echo "			<li class=\"odd\"><span></span>Hello World</li>\n";
				}
			} else {
				if($i%2){
					echo "			<li class=\"even\"><span>".$i."</span>Hello World</li>\n";
				} else {
					echo "			<li class=\"odd\"><span>".$i."</span>Hello World</li>\n";
				}
			}
		}
	}
	
	echo "		</ul>\n";
}

?>