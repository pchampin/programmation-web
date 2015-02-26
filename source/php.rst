:tocdepth: 2

============================
 Le langage PHP
============================

Le PHP, c'est quoi ?
====================

PHP: Hypertex Preprocessor
++++++++++++++++++++++++++

.. figure:: _static/php/logo_php.png
   :height: 6ex
   :align: right
   :alt: php
   
   Source image `Wikimedia commons`__
__ http://commons.wikimedia.org/wiki/File:PHP-logo.svg

* Un acronyme récursif !
* Un **langage de script** exécuté **côté serveur**,
* Qui permet d'écrire des pages web **dynamiques**.
* Une extension de fichier (.php).
* Un outil incontournable pour intéragir avec une `base de données <bdd>`:doc: (MySQL).

C'est aussi un site web http://php.net/ rempli d'autres informations utiles.


Comment ça marche ?
++++++++++++++++++++

- Reprenons l'architecture client serveur ; pour une page statique (HTML) :

	.. figure:: _static/php/client-serveur_HTML.png
		:alt: client-serveur-html

.. container:: build

  .. container::
  
    - pour une page dynamique (PHP) :

	.. figure:: _static/php/client-serveur_PHP.png
		:alt: client-serveur-php
	

Quel lien avec HTML/CSS ?
++++++++++++++++++++++++++
- PHP permet de générer du HTML.
- Le client (navigateur) est incapable de lire du code PHP, mais il sait afficher du code HTML et/ou CSS.

.. container:: build

  .. container::
  
   - PHP est interprété côté serveur :

	.. figure:: _static/php/client-serveur_PHP2.png
		:alt: client-serveur-php2
	
	
Quel lien avec JavaScript ?
++++++++++++++++++++++++++++

JavaScript :
 
- est un langage de script, tout comme PHP ;
- permet de modifier dynamiquement le contenu HTML/CSS ;
- **mais** s'éxécute côté client et non côté serveur.

.. figure:: _static/php/client-serveur_JS.png
	:alt: client-serveur-JS


Pourquoi utiliser PHP alors ?
+++++++++++++++++++++++++++++
 
 - Parce que les données sont centralisées sur le serveur.
 - Parce que le résultat de l'éxécution sera identique pour tous les clients.
 - Parce que ces données brutes manipulées par le serveur sont inacessibles par les clients.
 
Mais il existe bien sûr d'autres concurrents : `ASP.NET`__, `Ruby on Rails`__, `JSP (Java EE)`__, ...
	
__ http://www.asp.net/
__ http://rubyonrails.org/
__ http://www.oracle.com/technetwork/java/javaee/jsp/index.html
	

Ma première page en PHP !
=========================

Les fichiers PHP
++++++++++++++++

* Les fichiers contenant du PHP doivent porter l'extension ".php".
* Le script PHP doit toujours être situé entre les balises ``<?php`` et ``?>``.
* Les commentaires peuvent être :
  
  - Multilignes (``/*`` ... ``*/``)
  - Monoligne (``//``, ``#``)
  
* Toutes les instructions se terminent par ``;``
* PHP est insensible à la casse pour les noms de fonction mais pas pour les noms de variables.

.. note::

  Il est aussi possible d'utiliser les balises courtes  ``<?`` et ``?>`` pour signaler du code PHP.
  On préférera toutefois les balises longues qui assurent une portabilité totale sur tous les serveurs et avec toutes les versions de PHP.


Exemple
+++++++

.. code-block:: html
  :linenos:

  <!DOCTYPE html>
  <html>
    <head>
	  <meta charset="utf-8"/>
	  <title>Ma première page en PHP !</title>
    </head>
    <body>
	  <?php echo("Ce texte est écrit 
	  par du script PHP!"); ?>
    </body>
  </html>

.. note::

  L'instruction ``echo`` est une fonction PHP. Elle permet d'écrire la chaîne de caractères passée en paramètre dans le fichier HTML généré.
  
Exemple minimal 
+++++++++++++++

Cet exemple est aussi un script PHP valide :

.. code-block:: php

	  <?php echo("Ce texte est écrit par du script PHP!"); ?>

Mais ce fichier ne générera en revanche pas un fichier HTML valide.

.. tip::

   On verra par la suite qu'il est possible d'intégrer un fichier PHP dans un autre, ce qui donne tout son intérêt à concevoir des fichiers PHP réduits, mais génériques.
  
Exercice
++++++++

#. Téléchargez le modèle minimal de `page HTML`__.

#. Sauvegardez le fichier sous l'extension ".php".

#. Ajoutez du code PHP entre balises ``<?php`` et ``?>`` pour afficher du texte dans la page.

#. Testez l'éxécution de votre script depuis un serveur (local ou en ligne).

#. Comparez votre fichier avec la source reçue au niveau du client.

__ _static/php/html5_minimal.html


Intégrer des fichiers externes
++++++++++++++++++++++++++++++

* PHP a été pensé pour la conception d'applications Web
* PHP permet de définir des "briques de base" réutilisables
* Il existe plusieurs fonctions d'intégration :
 
  - ``include("page.php");`` qui permet d'intégrer le contenu de "page.php". Un message warning s'affiche si la ressource est manquante.
  - ``require("page.php");`` qui fait la même chose mais une erreur fatale est retournée si la ressource est manquante (arrêt du script).
  - ``include_once("page.php");`` et ``require_once("page.php");`` intègrent en plus un test pour empêcher une intégration multiple.
  

Les variables
==============

Syntaxe
+++++++

En PHP, il est possible d'utiliser la mémoire du serveur afin d'y stocker des informations durant l'éxécution du script PHP, dans des **variables** qui :

* s'écrivent avec un identifiant précédé d'un ``$``, par exemple ``$ma_variable``,
* ne se déclarent pas, c'est l'affectation qui détermine leur type :
 
   - booléen (``true``/``false``) ;
   - nombre entier ;
   - flottants (nombre à virgule) ;
   - chaîne de caractères (entre ``"``) ;
   - tableau ;
   - ou même un objet (programmation orientée objet).  
   
Exemple
-------

.. code-block:: php

  <?php 
   $age=21;
   echo("Vous avez $age ans !"); 
  ?>

.. container:: build

  .. container::
  
    `Résultat`__ HTML :
  
    .. code-block:: html
    
	  Vous avez 21 ans !
 
__ _static/php/test.php#affvariable
  
Les chaînes de caractères
+++++++++++++++++++++++++

Les chaînes de caractères affectées à une variable sont écrites entre ``"`` ou entre ``'``.

Exemple :

.. code-block:: php

  <?php 
   $phrase1="Ma chaîne de caractères";
   $phrase2='Ma chaîne de caractères';
  ?>

Il est possible d'intégrer la valeur d'une variable à une chaîne de caractères.
Cela se nomme la **concaténation**

La concaténation
----------------

La syntaxe de PHP permet de simplifier la concaténation de chaînes de caractères entre elles ou avec des variables.

La syntaxe est différente suivant les délimiteurs utilisés :

.. code-block:: php

  <?php 
   $mot1="phrase";
   $mot2=8;
   echo("Voici une $mot1 composée de $mot2 mots.\n");
   echo('Voici une $mot1 composée de $mot2 mots.'."\n");
   echo('Voici une '.$mot1.' composée de '.$mot2.' mots.');
  ?>
  
.. note::

  Le caractère ``\n`` correspond à un retour à la ligne. A ne pas confondre avec la balise ``<br />`` !
  
Résultat
````````

.. code-block:: html

  Voici une phrase composée de 8 mots.
  Voici une $mot1 composée de $mot2 mots.
  Voici une phrase composée de 8 mots.
  
Voir le `résultat généré`__.
  
__ _static/php/test.php#concatenation
  
Les tableaux
+++++++++++++

Les tableaux sont un type spécial de variable capable de stocker plus d'une valeur.

Il existe deux types de tableaux en PHP : 

* Les tableaux **numérotés** (tableaux simples)
* Les tableaux **associatifs** (tableaux clé-valeur)

Les tableaux numérotés
----------------------

Ils contiennent des éléments accessibles via leur indice. Les indices démarrent à 0 en PHP. 

Par exemple, votre tableau pourrait contenir : 

======= ==========================
Clé     Valeur
======= ==========================
  0     François
  1     Michel
  2     Nicole
  3     Véronique
  4     Benoît
  ...   ...
======= ==========================

Affectation
```````````

* Avec la fonction ``array`` :

.. code-block:: php

  <?php
   $prenoms = array ('François', 'Michel', 
   'Nicole', 'Véronique', 'Benoît');
  ?>

* Depuis les indices :

.. code-block:: php

  <?php
   $prenoms[0] = 'François';
   $prenoms[1] = 'Michel';
   $prenoms[2] = 'Nicole';
   ...
  ?>

Affectation implicite
`````````````````````

* Avec des indices implicite :

.. code-block:: php

  <?php
   $prenoms[] = 'François';
   $prenoms[] = 'Michel';
   $prenoms[] = 'Nicole';
   ...
  ?>

Ce code est équivalent au précédent, mais sera moins lisible pour l'accès futur aux éléments du tableau.

Accès aux éléments
``````````````````
.. code-block:: php

  <?php
   $prenoms[0] = 'François';
   $prenoms[1] = 'Michel';

   echo($prenom[1]."\n");
   echo($prenom[0]."\n");
  ?>


Voir le `résultat`__.
  
__ _static/php/test.php#accestableau
  

Les tableaux associatifs
------------------------

Ils permettent une représentation plus complexe et détaillée.

Par exemple, votre tableau pourrait contenir : 

========== ==========================
Clé        Valeur
========== ==========================
  prenom   François
  nom      Dupont
  adresse  3 rue du Paradis
  ville    Marseille
========== ==========================

Cette fois, les notion de "clé" et de "valeur" prennent tout leur sens.
  
  
Affectation
```````````

* Avec la fonction ``array`` :

.. code-block:: php

  <?php
   $patronyme = array (
    'prenom' => 'François',
    'nom' => 'Dupont');
  ?>

* En définissant les indices :

.. code-block:: php

  <?php
   $patronyme['prenom'] = 'François';
   $patronyme['nom'] = 'Dupont';
  ?>

Accès aux éléments
``````````````````
.. code-block:: php

  <?php
   $coordonnees['prenom'] = 'François';
   $coordonnees['nom'] = 'Dupont';
   $coordonnees['adresse'] = '3 Rue du Paradis';
   $coordonnees['ville'] = 'Marseille';
   echo $coordonnees['ville'];
  ?>

Voir le `résultat`__.
  
__ _static/php/test.php#accestableauassoc
  
  
Conversion de type
++++++++++++++++++

Le "cast" existe en PHP : il est possible de convertir une variable d'un type à un autre type.
Il suffit de préciser le type après conversion entre parenthèses.
  
Par exemple : 

.. code-block:: php

  <?php
   $a = '5';
   $b = ((int) $a) + 2;
   echo $b;
  ?>  
  
Voir le `résultat`__.
  
__ _static/php/test.php#cast
  
Les structures de contrôle
==========================

Les conditions
++++++++++++++

Elles permettent de définir des **conditions** lors de l'éxécution de votre script PHP :

* la structure ``if`` ... ``else`` ;
* la structure ``switch``.

======= ==========================
Symbole Signification
======= ==========================
  ==    Est égal à
  >     Est supérieur à
  <     Est inférieur à
  >=    Est supérieur ou égal à
  <=    Est inférieur ou égal à
  !=    Est différent de
======= ==========================

.. note::

  Le ``==`` de la comparaison est à distinguer du symbole d'affectation ``=``.

Exemple
-------
.. code-block:: php
  :linenos:
  
  <?php 
  $longeur_mdp = 6;
  if ($longeur_mdp >= 8) { // SI
   $save_mdp = true;
  } elseif ($longeur_mdp >= 6){ //SINON SI
   $save_mdp = true;
   echo "Ce mot de passe n'est pas très sûr !\n";
  } else { // SINON
   echo "Ce mot de passe est trop court !\n";
   $save_mdp = false;
  }
  if($save_mdp){ echo "Mot de passe sauvegardé !"; }
  ?>

Voir le `résultat`__.
  
__ _static/php/test.php#mdp

Exemple 2
---------

.. code-block:: php
  :linenos:
  
  <?php couleur
  $couleur = "rouge";
  switch ($longeur_mdp) {
	case "bleu"  : $r=0;   $g=0;   $b=255; break;
	case "vert"  : $r=0;   $g=255; $b=0;   break;
	case "rouge" : $r=255; $g=0;   $b=0;   break;
	default      : $r=0;   $g=0;   $b=0;   break;
  }
  echo "Valeurs RGB pour $couleur : ($r,$g,$b).";
  ?>

Voir le `résultat`__.
  
__ _static/php/test.php#switch
  
Les conditions multiples
++++++++++++++++++++++++

Il est possible de combiner les conditions dans une même instruction :

======= ============ ==========================
Symbole Mot-clé      Signification
======= ============ ==========================
``&&``    AND          Et
  ||    OR           Ou   
  !     NOT          Négation de la condition
======= ============ ==========================
  
Exemple : 
  
.. code-block:: php

  <?php 
   if($condition1 && (!$condition2 || $condition3)){
	...
   }
  ?>

  
Les boucles et opérateurs
=========================

Les boucles
+++++++++++

Il existe trois boucles en PHP :

* la boucle ``while`` ;
* la boucle ``for`` ;
* la boucle ``foreach``. 

La boucle ``while``
-------------------

Elle permet d'éxécuter la même série d'instructions tant que la **condition d'arrêt** n'est pas vérifiée.

Exemple : 
  
.. code-block:: php

  <?php
   $nombre_de_lignes = 1;

   while ($nombre_de_lignes <= 10) {
    echo 'Ceci est la ligne n°' . $nombre_de_lignes . "\n";
    $nombre_de_lignes++;
   }
  ?>
  
Voir le `résultat`__.
  
.. tip::

   La bouche ``do-while`` existe aussi. Pratique pour s'assurer qu'on rentre au moins une fois dans la boucle.
  
__ _static/php/test.php#while

La boucle ``for``
-------------------

Elle est très semblable à la boucle ``while`` mais permet cette fois de regrouper les conditions initiales, d'arrêt et l'incrémentation.

Exemple : 
  
.. code-block:: php

  <?php
   for ($nb_lignes = 1; $nb_lignes <= 10; $nb_lignes++)
   {
     echo 'Ceci est la ligne n°' . $nb_lignes . "\n";
   }
  ?>

Voir le `résultat`__.
  
__ _static/php/test.php#for
  
La boucle ``foreach``
---------------------

Elle permet de simplifier le parcours des tableaux, en permetant une écriture plus lisible et surtout plus générique que :

.. code-block:: php

  <?php
   $prenoms = array ('François', 'Michel',
   'Nicole', 'Véronique', 'Benoît');
   for ($numero = 0; $numero < 5; $numero++)
    echo $prenoms[$numero] . "\n";
   }
  ?>

Voir le `résultat`__.
  
__ _static/php/test.php#pacrourstableau
  
Pour les tableaux simples
`````````````````````````

.. code-block:: php

  <?php
   $prenoms = array ('François', 'Michel',
   'Nicole', 'Véronique', 'Benoît');
   foreach($prenoms as $element) {
    echo $element . "\n";
   }
  ?>

Voir le `résultat`__.
  
__ _static/php/test.php#foreach
  
Pour les tableaux clé-valeur
````````````````````````````
  
.. code-block:: php

  <?php
   $coordonnees = array (
    'prenom' => 'François',
    'nom' => 'Dupont',
    'adresse' => '3 Rue du Paradis',
    'ville' => 'Marseille');

   foreach($coordonnees as $champ => $element)
   {
    echo $champ . ' : ' .$element . "\n";
   }
  ?>

Voir le `résultat`__.
  
__ _static/php/test.php#foreach2
  
Les opérateurs
++++++++++++++

L'utilisation de variables implique la présence d'opérateurs pour pouvoir les manipuler.

PHP comprent une multitude d'opérateurs pour manipuler les variables numériques, booléennes, ou les chaînes de caractères.

Opérateurs arithmétiques
------------------------

PHP reconnait tous les `opérateurs arithmétiques`__ classiques :

=========== =============== =======================================================================
Exemple	    Nom	            Résultat
=========== =============== =======================================================================
-$a	        Négation	    Opposé de $a.
$a + $b	    Addition	    Somme de $a et $b.
$a - $b	    Soustraction    Différence de $a et $b.
$a \* $b    Multiplication  Produit de $a et $b.
$a / $b	    Division	    Quotient de $a et $b.
$a % $b	    Modulo	        Reste de $a divisé par $b.
$a \*\* $b  Exponentielle   Résultat de l'élévation de $a à la puissance $b. Introduit en PHP 5.6.
=========== =============== =======================================================================
  
__ http://php.net/manual/fr/language.operators.arithmetic.php
  
Opérateurs d'affectation
------------------------

Il est possible de modifier une variable lors de son affectation :

=============== =============== =======================================  
Exemple	        Nom	            Résultat
=============== =============== =======================================  
$a=3	        Affectation	    $a vaut 3.
$a += 3	        Addition        $a vaut $a + 3.
$a -= 3	        Soustraction    $a vaut $a - 3.
$a \*= 3         Multiplication  $a vaut $a \* 3.
$a /= 3	        Division        $a vaut $a /3.
$a %= 3	        Modulo          $a vaut $a % 3.
$a++ 	        Incrémentation  $a vaut $a + 1. Equivalent à $a += 1.
$a--	        Décrémentation  $a vaut $a - 1. Equivalent à $a -= 1.
$b .= "chaine"  Concaténation   $b vaut $b."chaine".
=============== =============== =======================================  

Opérateurs de comparaison
-------------------------

Les `comparaisons`__ de variables sont facilités par des opérateurs spécifiques :

============== ================== =======================================================
Exemple	       Nom	              Résultat
============== ================== =======================================================
$a == $b       Egal               TRUE si $a est égal à $b
$a === $b      Identique          TRUE si $a == $b et qu'ils sont de même type.
$a != $b       Différent          TRUE si $a est différent de $b
$a <> $b       Différent          TRUE si $a est différent de $b
$a !== $b      Différent          TRUE si $a != $b ou types différents.
$a < $b        Plus petit que     TRUE si $a est strictement plus petit que $b.
$a > $b        Plus grand         TRUE si $a est strictement plus grand que $b.
$a <= $b       Inférieur ou égal  TRUE si $a est plus petit ou égal à $b.
$a >= $b       Supérieur ou égal  TRUE si $a est plus grand ou égal à $b.
============== ================== =======================================================
  
__ http://php.net/manual/fr/language.operators.comparison.php
  
Les fonctions
=============

Définir une fonction
++++++++++++++++++++

La syntaxe PHP impose l'utilisation du mot-clé ``function`` :

.. code-block:: php

  <?php
   function MaFonction ($parametre1, $parametre2) {
	//corps de la fonction
	return $valeurRetournee
   }
  ?>
	
.. note:: 
  
  Les fonctions peuvent ne rien retourner (pas d'instruction ``return``). Par défaut, c'est la valeur ``NULL`` est retournée.

  
Appeler une fonction
++++++++++++++++++++

.. code-block:: php

  <?php
   MaFonction('1234', 5678);
  ?>

.. note:: 
  
  Comme le langage PHP n'est pas typé, il est possible d'injecter des types de variables incompatibles dans les fonctions. Il faut donc penser à cette éventualité lors de l'écriture de vos fonctions.
  
.. tip::

   Une bonne pratique consiste à définir vos fonctions dans des fichiers séparés, puis de les inclure dans vos page grâce à la fonction ``require_once``.

   
Les fonctions de PHP
++++++++++++++++++++

PHP propose une multitude de fonctions "toutes prêtes", qui permettent entre autre :

* de manipuler les chaînes de caractères,
* de déplacer/envoyer des fichiers,
* de manipuler des images,
* d'envoyer des e-mail,
* de crypter les mots de passe,
* de manipuler les dates, 
* ...

Le site web de PHP référence `toutes les fonctions`__ par catégorie.

__ http://fr.php.net/manual/fr/funcref.php
   






