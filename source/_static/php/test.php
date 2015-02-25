<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Résultat des scripts PHP</title>
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
	<div id="affvariable" class="exercice">
		<h1>Affichage d'une variable</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-affvariable.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-affvariable.php'); ?></div>
	</div>
	<div id="concatenation" class="exercice">
		<h1>Concaténation</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-concatenation.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-concatenation.php'); ?></div>
	</div>
	<div id="accestableau" class="exercice">
		<h1>Accéder à un élément d'un tableau numéroté</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-accestableau.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-accestableau.php'); ?></div>
	</div>
	<div id="accestableauassoc" class="exercice">
		<h1>Accéder à un élément d'un tableau associatif</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-accestableauassoc.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-accestableauassoc.php'); ?></div>
	</div>
	<div id="mdp" class="exercice">
		<h1>Strurcture if ... elseif ... else</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-mdp.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-mdp.php'); ?></div>
	</div>
	<div id="switch" class="exercice">
		<h1>Strurcture switch</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-switch.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-switch.php'); ?></div>
	</div>
	<div id="while" class="exercice">
		<h1>La boucle while</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-while.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-while.php'); ?></div>
	</div>
	<div id="for" class="exercice">
		<h1>La boucle for</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-for.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-for.php'); ?></div>
	</div>
	<div id="pacrourstableau" class="exercice">
		<h1>Parcours de tableau avec un for</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-pacrourstableau.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-pacrourstableau.php'); ?></div>
	</div>
	<div id="foreach" class="exercice">
		<h1>La boucle foreach pour les tableaux simples</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-foreach.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-foreach.php'); ?></div>
	</div>
	<div id="foreach2" class="exercice">
		<h1>La boucle foreach pour les tableaux clé-valeur</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-foreach2.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-foreach2.php'); ?></div>
	</div>
  </body>
</html>