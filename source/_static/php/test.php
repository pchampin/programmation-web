<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Résultat des scripts PHP</title>
	<script src="run_prettify.js"></script>
	<script src="section_selector.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body onload="displaySelectedSection();"> 
	<section id="affvariable" class="exercice">
		<h1>Affichage d'une variable</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-affvariable.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-affvariable.php'); ?></div>
	</section>
	<section id="concatenation" class="exercice">
		<h1>Concaténation</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-concatenation.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-concatenation.php'); ?></div>
	</section>
	<section id="accestableau" class="exercice">
		<h1>Accéder à un élément d'un tableau numéroté</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-accestableau.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-accestableau.php'); ?></div>
	</section>
	<section id="accestableauassoc" class="exercice">
		<h1>Accéder à un élément d'un tableau associatif</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-accestableauassoc.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-accestableauassoc.php'); ?></div>
	</section>
	<section id="cast" class="exercice">
		<h1>Conversion de type</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-cast.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-cast.php'); ?></div>
	</section>
	<section id="mdp" class="exercice">
		<h1>Structure if ... elseif ... else</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-mdp.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-mdp.php'); ?></div>
	</section>
	<section id="switch" class="exercice">
		<h1>Structure switch</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-switch.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-switch.php'); ?></div>
	</section>
	<section id="while" class="exercice">
		<h1>La boucle while</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-while.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-while.php'); ?></div>
	</section>
	<section id="for" class="exercice">
		<h1>La boucle for</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-for.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-for.php'); ?></div>
	</section>
	<section id="pacrourstableau" class="exercice">
		<h1>Parcours de tableau avec un for</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-pacrourstableau.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-pacrourstableau.php'); ?></div>
	</section>
	<section id="foreach" class="exercice">
		<h1>La boucle foreach pour les tableaux simples</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-foreach.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-foreach.php'); ?></div>
	</section>
	<section id="foreach2" class="exercice">
		<h1>La boucle foreach pour les tableaux clé-valeur</h1>
		<pre class="prettyprint linenums lang-html"><?php echo(htmlentities(file_get_contents('./resultats/resultat-foreach2.php'))); ?></pre>
		<div class="result"><?php include('./resultats/resultat-foreach2.php'); ?></div>
	</section>
	<!-- <nav id="navigation">
		<h1>Exemples de scripts PHP et leurs résultats :</h1>
		<ul>
			<li><a href="#affvariable">Affichage d'une variable</a></li>
			<li><a href="#concatenation">Concaténation</a></li>
			<li><a href="#accestableau">Accéder à un élément d'un tableau numéroté</a></li>
			<li><a href="#mdp">Structure if ... elseif ... else</a></li>
			<li><a href="#switch">Structure switch</a></li>
			<li><a href="#while">La boucle while</a></li>
			<li><a href="#for">La boucle for</a></li>
			<li><a href="#pacrourstableau">Parcours de tableau avec un for</a></li>
			<li><a href="#foreach">La boucle foreach pour les tableaux simples</a></li>
			<li><a href="#foreach2">La boucle foreach pour les tableaux clé-valeur</a></li>
		</ul>
	</nav> -->
	<div id="retour">
		<a href="#" onClick="history.go(-1);return true;">Retour</div>
	</div>
  </body>
</html>