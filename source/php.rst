:tocdepth: 2

============================
 PHP : Les bases
============================

Le PHP, c'est quoi ?
====================

PHP: Hypertext Preprocessor
++++++++++++++++++++++++++

.. figure:: _static/php/logo_php.png
   :height: 6ex
   :align: right
   :alt: php
   
   Source image `Wikimedia commons`__
__ http://commons.wikimedia.org/wiki/File:PHP-logo.svg

* Un acronyme récursif
* Un **langage de script interprété côté serveur**
* Qui permet d'écrire des pages web **dynamiques**
* Indiqué par l'extension de fichier **.php**
* Un outil incontournable pour interagir avec une `base de données <bdd>`:doc: (MySQL)

Documentation: http://php.net/ rempli d'autres informations utiles


Comment ça marche ?
++++++++++++++++++++

- Reprenons l'architecture client serveur ; pour une page statique (HTML) :

  .. figure:: _static/php/client-serveur_HTML.png
    :alt: client-serveur-html

  
- pour une page dynamique (PHP) :

  .. figure:: _static/php/client-serveur_PHP.png
    :alt: client-serveur-php
  

Quel lien avec HTML/CSS ?
++++++++++++++++++++++++++
- PHP permet de générer du HTML.
- Le client (navigateur) est incapable de lire du code PHP, mais il sait afficher du code HTML et/ou CSS.

- PHP est interprété côté serveur :

  .. figure:: _static/php/client-serveur_PHP2.png
    :alt: client-serveur-php2
  
  
Quel lien avec JavaScript ?
++++++++++++++++++++++++++++

JavaScript :
 
- est un langage de script, tout comme PHP ;
- permet de modifier dynamiquement le contenu HTML/CSS ;
- **mais** s'éxécute **généralement** côté client et non côté serveur.

.. figure:: _static/php/client-serveur_JS.png
  :alt: client-serveur-JS


Pourquoi utiliser PHP alors ?
+++++++++++++++++++++++++++++

Pour des raisons de :
  * Performance: les données sont centralisées sur le serveur
  * Sécurité: Certaines opérations doivent rester inaccessibles au client (mot de passe)
  * Personnalisation: chaque utilisateur peut avoir une page différente (horloge)
 
Autres concurrents : 
  * `ASP.NET`_
  * `Ruby on Rails`_
  * `JSP (Java EE)`_
  
.. _ASP.NET: http://www.asp.net/
.. _Ruby on Rails: http://rubyonrails.org/
.. _JSP (Java EE): http://www.oracle.com/technetwork/java/javaee/jsp/index.html
  

Ma première page
================

Les fichiers PHP
++++++++++++++++

* Extension ".php"
* Instructions entre les balises ``<?php`` et ``?>``.
* Commentaires:
  
  - Multilignes ``/*`` ... ``*/``
  - Monoligne ``//`` ou ``#``
  
* Instructions terminées par ``;``
* Insensible à la casse pour les noms de fonction MAIS pas pour les noms de variables.

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
    <?php echo("Ce texte est écrit par du script PHP!"); ?>
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

   Nous verrons par la suite qu'il est possible d'intégrer un fichier PHP dans un autre, ce qui donne tout son intérêt à concevoir des fichiers PHP réduits, mais génériques.
  
.. _exo_premierepagephp:

Exercice (10 minutes)
+++++++++++++++++++++

#. Téléchargez le modèle minimal de `page HTML <_static/php/html5_minimal.html>`_.

#. Sauvegardez le fichier sous l'extension ".php"

#. Ajoutez du code PHP entre balises ``<?php`` et ``?>`` pour afficher du texte dans la page

#. Testez l'éxécution de votre script depuis un serveur (local ou en ligne)

#. Comparez votre fichier avec la source reçue au niveau du client

Voir le `résultat <_static/php/corrections/premierepagephp/>`_ attendu.

#. Comment rendre le résultat valide en HTML ?

Les variables
==============

Syntaxe
+++++++

Utilisation de la mémoire du serveur afin de stocker des informations durant l'éxécution du script PHP, dans des **variables** qui :

* s'écrivent avec un identifiant précédé d'un ``$``, par exemple ``$ma_variable``,
* ne se déclarent pas, c'est l'affectation qui détermine leur type :
 
   - booléen (``true``/``false``)
   - nombre entier
   - flottants (nombre à virgule)
   - chaîne de caractères (entre ``"``)
   - tableau
   - ou même un objet (programmation orientée objet)
   
Exemple
-------

.. code-block:: php

  <?php 
   $age=21;
   echo("Vous avez $age ans !"); 
  ?>
  
`Résultat <_static/php/test.php#affvariable>`_ HTML :
  
.. code-block:: html
    
    Vous avez 21 ans !
  
Les chaînes de caractères
+++++++++++++++++++++++++

Les chaînes de caractères :

* écrites entre ``"`` ou entre ``'``
* concatenation avec ``.``
* peuvent integrer la valeur d'une variable

.. note:: Beaucoup de fonctions mathématiques et pour la manipulation des strings (`PHP Manual for Strings`_)

.. _PHP Manual for Strings: http://www.php.net/manual/fr/ref.strings.php

Affichage de chaines
--------------------

La syntaxe de PHP permet de simplifier l'affichage de chaînes de caractères entre elles ou avec des variables.

La syntaxe est différente suivant les délimiteurs utilisés :

.. code-block:: php

  <?php 
   $mot1="phrase";
   $mot2=8;
   echo("Voici une $mot1 composée de $mot2 mots.\n");
   echo('Voici une $mot1 composée de $mot2 mots.'."\n");
   echo('Voici une '.$mot1.' composée de '.$mot2.' mots.'."\n");
  ?>
  
.. note::

  Le caractère ``\n`` correspond à un retour à la ligne. A ne pas confondre avec la balise ``<br />`` !
  
.. nextslide::

.. code-block:: html

  Voici une phrase composée de 8 mots.
  Voici une $mot1 composée de $mot2 mots.
  Voici une phrase composée de 8 mots.
  
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
   $prenoms = array ('François', 'Michel', 'Nicole', 'Véronique', 'Benoît');
  ?>

* Depuis les indices :

.. code-block:: php

  <?php
   $prenoms[0] = 'François';
   $prenoms[1] = 'Michel';
   $prenoms[2] = 'Nicole';
   ...
  ?>

.. nextslide::

* Avec des indices implicites :

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


Voir le `résultat <_static/php/test.php#accestableau>`_ .

Les tableaux associatifs
------------------------

Ils permettent de donner des noms aux clés

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
      'nom' => 'Dupont'
    );
  ?>

* En définissant les indices :

.. code-block:: php

  <?php
    $patronyme = array();
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

Voir le `résultat <_static/php/test.php#accestableauassoc>`_ .
  
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
  
Voir le `résultat <_static/php/test.php#cast>`_ .
  
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

Exemple : ``if ... else``
-------------------------

.. code-block:: php
  :linenos:
  
  <?php 
  $longueur_mdp = 6;
  if ($longueur_mdp >= 8) { // SI
    $save_mdp = true;
  } elseif ($longueur_mdp >= 6){ //SINON SI
    $save_mdp = true;
    echo "Ce mot de passe n'est pas très sûr !\n";
  } else { // SINON
    echo "Ce mot de passe est trop court !\n";
    $save_mdp = false;
  }
  if($save_mdp){ echo "Mot de passe sauvegardé !"; }
  ?>
  
Voir le `résultat <_static/php/test.php#mdp>`_ .

.. nextslide::

.. tip::

   PHP tolère aussi l'écriture condensée (nommée opérateur ternaire) : ``$variable = $condition ? valeurSiVrai : valeurSiFaux``.
   Comparée au ``if``, cette écriture permet de réduire le nombre de lignes de code, au détriment de sa lisibilité.
   

Exemple : ``switch``
--------------------

.. code-block:: php
  :linenos:
  
  <?php couleur
    $couleur = "rouge";
    switch ($couleur) {
      case "bleu"  : $r=0;   $g=0;   $b=255; break;
      case "vert"  : $r=0;   $g=255; $b=0;   break;
      case "rouge" : $r=255; $g=0;   $b=0;   break;
      default      : $r=0;   $g=0;   $b=0;   break;
    }
    echo "Valeurs RGB pour $couleur : ($r,$g,$b).";
  ?>

Voir le `résultat <_static/php/test.php#switch>`_ .
  
Les conditions multiples
++++++++++++++++++++++++

Il est possible de combiner les conditions dans une même instruction :

======= ============ ==========================
Symbole Mot-clé      Signification
======= ============ ==========================
``&&``  AND          Et
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
  
Voir le `résultat <_static/php/test.php#while>`_.

.. nextslide::  

.. tip::

   La bouche ``do-while`` existe aussi. Pratique pour s'assurer qu'on rentre au moins une fois dans la boucle.

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

Voir le `résultat <_static/php/test.php#for>`_ .

.. _boucle_foreach:
  
La boucle ``foreach``
---------------------

Elle permet de simplifier le parcours des tableaux, en permetant une écriture plus lisible et surtout plus générique que :

.. code-block:: php

  <?php
    $prenoms = array ('François', 'Michel', 'Nicole', 'Véronique', 'Benoît');
    for ($numero = 0; $numero < 5; $numero++)
      echo $prenoms[$numero] . "\n";
    }
  ?>

Voir le `résultat <_static/php/test.php#pacrourstableau>`_ .
  
Pour les tableaux simples
`````````````````````````

.. code-block:: php

  <?php
    $prenoms = array ('François', 'Michel', 'Nicole', 'Véronique', 'Benoît');
    foreach($prenoms as $element) {
      echo $element . "\n";
    }
  ?>

Voir le `résultat <_static/php/test.php#foreach>`_ .
  
Pour les tableaux clé-valeur
````````````````````````````
  
.. code-block:: php

  <?php
    $coordonnees = array (
      'prenom' => 'François',
      'nom' => 'Dupont',
      'adresse' => '3 Rue du Paradis',
      'ville' => 'Marseille');

    foreach($coordonnees as $champ => $element){
      echo $champ . ' : ' .$element . "\n";
    }
  ?>

Voir le `résultat <_static/php/test.php#foreach2>`_.

.. _exo_tableau:

Exercice
````````

#. Créez un nouveau fichier PHP vide.
#. Créez et initialisez un tableau clé-valeur dont les clés seront "prix_unitaire" et "quantite".
#. Réalisez un affichage basique en parcourant votre tableau.

Voir le `résultat <_static/php/corrections/tableau/>`_ attendu.

Les opérateurs
++++++++++++++

L'utilisation de variables implique la présence d'opérateurs pour pouvoir les manipuler.

PHP comprend une multitude d'opérateurs pour manipuler les variables numériques, booléennes, ou les chaînes de caractères.

Opérateurs arithmétiques
------------------------

PHP reconnait tous les `opérateurs arithmétiques`__ classiques :

=========== =============== =======================================================================
Exemple     Nom             Résultat
=========== =============== =======================================================================
-$a         Négation        Opposé de $a.
$a + $b     Addition        Somme de $a et $b.
$a - $b     Soustraction    Différence de $a et $b.
$a \* $b    Multiplication  Produit de $a et $b.
$a / $b     Division        Quotient de $a et $b.
$a % $b     Modulo          Reste de $a divisé par $b.
$a \*\* $b  Exponentielle   Résultat de l'élévation de $a à la puissance $b. Introduit en PHP 5.6.
=========== =============== =======================================================================
  
__ http://php.net/manual/fr/language.operators.arithmetic.php
  
Opérateurs d'affectation
------------------------

Il est possible de modifier une variable lors de son affectation :

=============== =============== =======================================  
Exemple         Nom             Résultat
=============== =============== =======================================  
$a=3            Affectation     $a vaut 3.
$a += 3         Addition        $a vaut $a + 3.
$a -= 3         Soustraction    $a vaut $a - 3.
$a \*= 3        Multiplication  $a vaut $a \* 3.
$a /= 3         Division        $a vaut $a /3.
$a %= 3         Modulo          $a vaut $a % 3.
$a++            Incrémentation  $a vaut $a + 1. Equivalent à $a += 1.
$a--            Décrémentation  $a vaut $a - 1. Equivalent à $a -= 1.
$b .= "chaine"  Concaténation   $b vaut $b."chaine".
=============== =============== =======================================  

Opérateurs de comparaison
-------------------------

Les `comparaisons`__ de variables sont facilités par des opérateurs spécifiques :

============== ================== =======================================================
Exemple        Nom                Résultat
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
  return $valeurRetournee;
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

   Une bonne pratique consiste à définir vos fonctions dans des fichiers séparés, puis de les inclure dans vos pages grâce à la fonction ``require_once``.

Voir le `résultat`__ attendu.

__ _static/php/corrections/fonction/

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

Intégrer des fichiers externes
------------------------------

* PHP a été pensé pour la conception d'applications Web
* PHP permet de définir des "briques de base" réutilisables
* Il existe plusieurs fonctions d'intégration :
 
  - ``include("page.php");`` qui permet d'intégrer le contenu de "page.php". Un message warning s'affiche si la ressource est manquante.
  - ``require("page.php");`` qui fait la même chose mais une erreur fatale est retournée si la ressource est manquante (arrêt du script).
  - ``include_once("page.php");`` et ``require_once("page.php");`` intègrent en plus un test pour empêcher une intégration multiple.

Transmettre des données
=======================

Via un formulaire : Les méthodes d'envoi
++++++++++++++++++++++++++++++++++++++++

En HTML, la balise ``<form>`` spécifie la méthode HTTP utilisée par le formulaire :

* **GET** :

  * Dans le cas d'une lecture d'information (accès à un article, recherche)
  * Les données seront passées via l’URL (défaut)

* **POST** :

  * Dans le cas d'une modification (Paramètres utilisateurs)
  * Les données seront passées dans le corps de la requête HTTP

GET : Envoi par l'URL (1/2)
+++++++++++++++++++++++++++

La méthode d'envoi GET est celle utilisée par défaut lorqu'on utilise les formulaires sans préciser la méthode :

.. code-block:: html

  <form action="traitement.php">
     ...
  </form>

Cette écriture est exactement équivalente à :

.. code-block:: html

  <form action="traitement.php" method="get">
     ...
  </form>


GET : Envoi par l'URL (1/2)
+++++++++++++++++++++++++++

Les données du formulaire qui sont passées dans l'URL s'écrivent sous la forme :

.. raw:: html

    <p><font color="green">http://www.site.com/page.php?</font><font color="red">param1</font><font color="green">=</font><font color="blue">valeur1</font><font color="green">&</font><font color="red">param2</font><font color="green">=</font><font color="blue">valeur2</font>...</p>
    </br>

.. raw:: html

    <p>Le caractère <font color="green">?</font> sépare le nom de la page des paramètres.</p>
    <p>Chaque couple paramètre/valeur s'écrit sous la forme : <font color="red">nom</font><font color="green">=</font><font color="blue">valeur</font>; ils sont séparés les uns des autres par le symbole <font color="green">&</font>.</p>
  
  
.. note::

  Le nom des paramètres correspond à la valeur de l'attribut ``@name`` définit dans chaque balise ``<input>``.
  
  La valeur des paramètres correspond à la valeur de l'attribut ``@value`` s'il est définit, ou au texte saisi par l'utilisateur (dans un champ texte par exemple).
  
  
Reception des données
+++++++++++++++++++++

Côté serveur (en PHP, donc), les valeurs passées dans l'URL sont stockées dans un tableau associatif ``$_GET`` : 

Exemple (avec l'URL précédente) :

.. code-block:: php

  <?php
    $valeur = $_GET[’param1’]; // contient valeur1
  ?>

.. warning::
  
  Comme les paramètres et leurs valeurs sont intégrés dans l'URL, ils sont directement modifiables.
  
  Il est donc très important de tester si les données reçues sont celles attendues (mauvais type, données manquantes ...).
  
Transmettre des données dans une requête
++++++++++++++++++++++++++++++++++++++++

La méthode POST doit être spécifiée dans le formulaire si l'on souhaite transmettre des données dans une requête :

.. code-block:: html

  <form action="traitement.php" method="post">
     ...
  </form>

Dans ce cas, les paramètres et leurs valeurs envoyés ne seront plus visibles dans l'URL.


Traitement des données reçues en Post
+++++++++++++++++++++++++++++++++++++

Les valeurs transmises par la méthode Post sont stockées dans la variable ``$_POST``. Les données sont stockées de la même manière que dans la variable ``$_GET``.

.. warning::
  
  Même si les paramètres et leurs valeurs sont transmises sans apparaître dans l'URL, il est tout de même possible d'envoyer des valeurs inattendues (par exemple, en modifiant une copie du code HTML du formulaire).
  Il est d'autant plus important de contrôler les données reçues que les données envoyées en Post peuvent contenir des chaînes de caractères conséquentes (et pourquoi pas, du code HTML ou JavaScript !).

Contrôler la valeur des paramètres
++++++++++++++++++++++++++++++++++

Lorsque des données transitent par l'URL, il faut s'assurer que les **valeurs correspondent au type attendu**.
Dans le cas contraire, PHP permet de convertir les valeurs d'un type à un autre.

De plus, il est possible que certains paramètres attendus dans le code PHP soient absents de l'URL, dans ce cas
il est possible de **tester leur présence** avec la fonction ``isset``.

.. nextslide::

Exemple :

.. code-block:: php

  <?php
  if (isset($_GET['param1']) AND isset($_GET['param2'])) {
  $valeur1 = (int) $_GET['param1'];
  $valeur2 = (int) $_GET['param2'];
  ... // code à exécuter si tous les paramètres sont présents
  } else {
  ...
  // code à exécuter par défaut
  }
  ?>

Aller plus loin dans le contrôle des paramètres
+++++++++++++++++++++++++++++++++++++++++++++++

En plus de vérifier le type et la présence des paramètres, le traitement des chaînes de caractères doit comprendre une conversion pour **éviter que le texte puisse être interprété comme du code** HTML (ou JavaScript).

Il existe des fonctions PHP conçues à cet effet : ``htmlspecialchars`` (`documentation`__) et ``htmlentities`` (`documentation`__). Elles permettent de convertir les caractères spéciaux en entités HTML. Exemple : 

__ http://php.net/manual/fr/function.htmlspecialchars.php
__ http://php.net/manual/fr/function.htmlentities.php

.. code-block:: php
  
  <?php
  $value = ( isset($_POST['variable']) ) ?
             htmlspecialchars($_POST['variable']) : "";
  if((strlen($value) > 0) && (strlen($value) < 50)){
   ... //
  }
  ?>

.. _exo_impots:
  
Exercice : Les impots
=====================

* On souhaite faire une page simple permettant à un utilisateur de calculer le montant de son impôt

  * On calcule le nombre de parts du salarié (nbEnfants est son nombre d'enfants)

    .. code:: 

      parts = nbEnfants/2+1 (pas marié)

      parts = nbEnfants/2+2 (marié)


  * On calcule son revenu imposable (S est le salaire)

    .. code:: 

      R = 0.72 * S

  * On calcule son quotient familial

    .. code:: 

      Q = R / parts


* Les tranches du barème sont les suivantes, appliquée au montant du quotient familial Q :

  ======== ============ ============= ============= =============
  0 à 5614 5615 à 11198 11199 à 24872 24873 à 66679 66680 et plus
  ======== ============ ============= ============= =============
  0%       5.5%         14%           30%           40%
  ======== ============ ============= ============= =============


* Le montant de l’impot est alors remultiplié par le nombre de parts nbParts.

#. Créer un formulaire permettant à l’utilisateur de rentrer ses informations
#. Calculer le montant prévisionnel de son impôt
#. Afficher le résultat

  .. figure:: _static/php/form.png
