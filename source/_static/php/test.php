<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Résultat des scripts PHP</title>
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
	<div id="mdp" class="exercice">
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-mdp.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-mdp.php'); ?></div>
	</div>
	<div id="switch" class="exercice">
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-switch.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-switch.php'); ?></div>
	</div>
  </body>
</html>