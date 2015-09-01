:tocdepth: 2

============================
 Introduction au PHP
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
* Un **langage de script interprété côté serveur**,
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

   Nous verrons par la suite qu'il est possible d'intégrer un fichier PHP dans un autre, ce qui donne tout son intérêt à concevoir des fichiers PHP réduits, mais génériques.
  
.. _exo_premierepagephp:

Exercice
++++++++

#. Téléchargez le modèle minimal de `page HTML`__.

#. Sauvegardez le fichier sous l'extension ".php".

#. Ajoutez du code PHP entre balises ``<?php`` et ``?>`` pour afficher du texte dans la page.

#. Testez l'éxécution de votre script depuis un serveur (local ou en ligne).

#. Comparez votre fichier avec la source reçue au niveau du client.

Voir le `résultat`__ attendu.

__ _static/php/html5_minimal.html

__ _static/php/corrections/premierepagephp/



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

Les chaînes de caractères :

* écrites entre ``"`` ou entre ``'``.
* concatenation avec ``.``
* peuvent integrer la valeur d'une variable

.. note::

Beaucoup de fonctions mathématiques et pour la manipulation des strings (``http://www.php.net/manual/fr/ref.strings.php``__)

__ _http://www.php.net/manual/fr/ref.strings.php

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
  
Voir le `résultat`__.
  
__ _static/php/test.php#mdp


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

.. nextslide::  

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
  
.. _exo_for:
  
Exercice
````````

#. Créez une nouvelle page PHP (ou reprenez votre `votre première page PHP <exo_premierepagephp>`:ref:).

#. Affichez grâce à un script une liste composée de 10 "Hello World !".

Voir le `résultat`__ attendu.

__ _static/php/corrections/for/


.. _boucle_foreach:
  
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

.. _exo_tableau:

Exercice
````````

#. Créez un nouveau fichier PHP vide.
#. Créez et initialisez un tableau clé-valeur dont les clés seront "prix_unitaire" et "quantite".
#. Réalisez un affichage basique en parcourant votre tableau.

Voir le `résultat`__ attendu.

__ _static/php/corrections/tableau/

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
-$a         Négation      Opposé de $a.
$a + $b     Addition      Somme de $a et $b.
$a - $b     Soustraction    Différence de $a et $b.
$a \* $b    Multiplication  Produit de $a et $b.
$a / $b     Division      Quotient de $a et $b.
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
$a=3          Affectation     $a vaut 3.
$a += 3         Addition        $a vaut $a + 3.
$a -= 3         Soustraction    $a vaut $a - 3.
$a \*= 3         Multiplication  $a vaut $a \* 3.
$a /= 3         Division        $a vaut $a /3.
$a %= 3         Modulo          $a vaut $a % 3.
$a++          Incrémentation  $a vaut $a + 1. Equivalent à $a += 1.
$a--          Décrémentation  $a vaut $a - 1. Equivalent à $a -= 1.
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


.. _exo_fonction:
   
Exercice
--------

#. Créez un fichier "calcul_prix.php" qui contient une fonction ``Prix`` permettant de calculer un prix total à partir d'un prix unitaire et d'une quantité.
#. Ajoutez une seconde fonction ``Total`` qui calcule le prix total correspondant aux données de prix et de quantités contenues dans un tableau composé d'élements correspondant à votre tableau de l'`exercice précédent<exo_tableau>`:ref:.
#. Affichez et vérifiez le résultat en modifiant les valeurs stockées dans le tableau.


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
  
.. _exo_include:
  
Exercice
````````

#. Reprenez le code de vos fonctions écrit pour l'`exercice précédent<exo_fonction>`:ref:.
#. Séparez le tableau de données dans un fichier "donnees.php" et les fonctions dans un fichier "calcul_prix.php".
#. Créez une page générale qui contient un squelette de page HTML et affiche le résultat de la fonction ``Total``. 
  
Afficher les erreurs
--------------------

Il est possible d'utiliser PHP en mode débogage lors de la phase de conception de vos scripts.

Pour cela, deux fonctions doivent être appelées dans le script :

.. code-block:: php

  <?php 
   ini_set(’display_errors’,’1’) ;
   error_reporting(E_ALL) ;
   ... // instructions du script
  ?>

.. tip::

   Il est aussi possible de configurer l'affichage des erreurs dans le fichier de configuration ``php.ini``
  

Redirection
-----------

PHP permet de rediriger l'utilisateur d'une page à une autre grâce à la fonction ``header()``. Exemple :

.. code-block:: php

  <?php
   header('Location: urlDeRedirection.php?parametres');
   exit ();
  ?>

.. tip::
  
  Il est possible de rediriger vers une page via une URL relative ou une URL externe. On peut même faire une redirection vers la même page mais avec des paramètres différents !
  
.. warning::

  La fonction ``header()`` doit être exécutée avant toute écriture de texte.
 

.. _php_avance:
 
Utilisation Avancée de PHP
==========================

Sécuriser des pages PHP
+++++++++++++++++++++++

Contrôle d'accès sur serveur Apache
-----------------------------------

Certaines pages ou certaines sections de votre site web peuvent être privées ou limitées à certains utilisateurs (pages d'administration ...).

Pour cela, il est possible d'utiliser les `sessions PHP<sessions>`:ref:, mais leur mise en place impose de créer une interface et une table dans la BDD pour gérer les accès.

Une autre possibilité est d'utiliser le contrôle d'accès côté serveur. Cela garantit de limiter l'accès à certains fichiers aux seuls utilisateurs autorisés.

Pour mettre en place un contrôle d'accès, il faut créer deux fichiers :

#. Un fichier ``.htaccess``  qui contient l'adresse du ``.htpasswd`` et définit les options du contrôle d'accès.
#. Un fichier ``.htpasswd``  qui contient une liste de logins/mots de passe des utilisateurs autorisés à accèder aux pages contenues dans le dossier du fichier ``.htaccess``.


.. note::

  Chaque fichier ``.htaccess`` protège les pages du répertoire dans lequel il se trouve.
  Pour protéger plusieurs pages, il est donc nécessaire de dupliquer ce fichier, mais il est préférable de le faire pointer sur un fichier ``.htpasswd`` unique.

Le fichier ``.htaccess``
````````````````````````

Exemple :

.. code-block:: none

  AuthName "Message de l'invité"
  AuthType Basic
  AuthUserFile "/home/univ-lyon1/pxxxxxxx/
                public_html/admin/.htpasswd"
  Require valid-user

Le champ ``AuthName`` correspond au message affiché lors de la tentative d'accès à une ressource sous contrôle d'accès.

Le champ ``AuthUserFile`` est le chemin absolu vers le fichier ``.htpasswd``.

.. note::

  La fonction PHP `realpath()`__ permet de récupérer le chemin absolu du fichier ``.htpasswd``.
  
__ http://php.net/manual/fr/function.realpath.php
  
Le fichier ``.htpasswd``
````````````````````````

Le fichier ``.htpasswd`` se compose de lignes suivant le format : ``login:mot_de_passe_crypté``.

Il est possible d'afficher les mots de passe en clair. Mais ils sont alors visibles pour qui à les droits de lecture sur le serveur.

Pour crypter les mots de passe du fichier ``.htpasswd``, PHP propose la fonction `crypt()`__. 

Exemple sans cryptage :

.. code-block:: none
  
  autralian32:kangourou
  kikoo69:totolitoto
  monuser:monpass
  
__ http://php.net/manual/fr/function.crypt.php
  
.. nextslide::

Exemple avec cryptage : 

.. code-block:: none
  
  autralian32:$1$nRSP5U.A$e8FqI6QTq/Bp6lNMjBUMO1
  kikoo69:$1$riMIdCaV$6GO24RT5v4iwrSzChZq720
  monuser:$apr1$MWZtd0xs$mRBeIn.alFLzJZe4.r07U1
  
.. tip::

  Comme il est possible de manipuler des fichiers en PHP, il est aussi possible d'écrire les fichiers de contrôle d'accès directement depuis PHP.
  
  Par exemple, un formulaire accessible seulement par l'administrateur pourrait permettre d'ajouter de nouveaux utilisateurs.
  

  
.. Les expressions régulières
.. ++++++++++++++++++++++++++

.. A venir.
      
.. Programmation Orientée Objet
.. ++++++++++++++++++++++++++++
 
.. A venir.
 
.. Gestion des exceptions
.. ----------------------

.. A venir.

.. Architecture MVC
.. ++++++++++++++++
  
.. A venir.
