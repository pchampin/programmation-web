<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Ma première page en PHP !</title>
  </head>
  <body>
<?php
	echo "<ul>\n";
	for ($nb_hello = 0; $nb_hello < 10; $nb_hello++)
	{
		echo "	<li>Hello World !</li>\n";
	}
	echo "</ul>\n";
?>
  </body>
</html>
