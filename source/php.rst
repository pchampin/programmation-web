:tocdepth: 2

============================
 PHP : Les bases
============================

Le PHP, c'est quoi ?
====================

PHP: Hypertext Preprocessor
+++++++++++++++++++++++++++

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
- Le client (navigateur) est incapable de lire du code PHP, mais il sait afficher du code HTML et/ou CSS.

- PHP est interprété côté serveur :

  .. figure:: _static/php/client-serveur_PHP2.png
    :alt: client-serveur-php2
  
- On va donc demander à PHP de générer du HTML.

  - On peut aussi utiliser PHP pour générer autre chose : du CSS, du JSON... !
  
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

Pour des raisons :

* Fonctionnelles : les données sont centralisées sur le serveur (ex. forum)
* De sécurité : Certaines données doivent rester inaccessibles au client (mot de passe)
* De personnalisation : chaque utilisateur peut avoir une page différente (horloge)
 
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
* Instructions entre les balises ``<?php`` et ``?>``

  - Syntaxe courte pour l'affichage : ``<?=`` et ``?>``

* Commentaires:
  
  - Multilignes ``/*`` ... ``*/``
  - Monoligne ``//`` ou ``#``
  
* Instructions terminées par ``;``
* Insensible à la casse pour les noms de fonction MAIS pas pour les noms de variables.

Exemple : générer du HTML
+++++++++++++++++++++++++

.. code-block:: html+php

  <!DOCTYPE html>
  <html>
    <head>
    <meta charset="utf-8"/>
    <title>Ma première page en PHP !</title>
    </head>
    <body>
      <?php echo '<strong>Ce texte est écrit 
                  par du script PHP !</strong>'; ?>
    </body>
  </html>


L'instruction ``echo`` est un mot-clé PHP. Il permet d'écrire la chaîne de caractères qui suit dans la sortie (comparable à ``printf()`` en C).

.. nextslide::

L'équivalent avec la syntaxe courte :

.. code-block:: html+php

  <!DOCTYPE html>
  <html>
    <head>
    <meta charset="utf-8"/>
    <title>Ma première page en PHP !</title>
    </head>
    <body>
      <?= '<strong>Ce texte est écrit par du script PHP !</strong>' ?>
    </body>
  </html> 

Autres types de sortie
++++++++++++++++++++++

Cet exemple est aussi un script PHP valide :

.. code-block:: php

    <?= 'Ce texte est écrit par du script PHP !' ?>

Mais la sortie n'est plus du HTML (pas de DOCTYPE, aucune balise).
C'est du texte brut (type MIME : ``text/plain``).

Enfin, voyons comment générer du CSS (type MIME : ``text/css``) :

.. code-block:: php

    body {
      background-color: <?= 'red' ?>;
    }

.. nextslide::

Un tel exemple ne représente que peu d'intérêt, mais lorsque nous verrons comment dynamiser nos scripts cela deviendra intéressant !

.. tip::

   Nous verrons par la suite qu'il est possible d'inclure un fichier PHP dans un autre, ce qui donne tout son intérêt à concevoir des fichiers PHP réduits, mais génériques.
  
.. _exo_premierepagephp:

Exercice (10 minutes)
+++++++++++++++++++++

#. Téléchargez le modèle minimal de `page HTML <_static/php/html5_minimal.html>`__.

#. Sauvegardez le fichier sous l'extension ".php"

#. Ajoutez du code PHP entre balises ``<?php`` et ``?>`` pour afficher du texte dans la page

   - Essayez également la syntaxe courte ``<?=`` et ``?>``

#. Testez l'éxécution de votre script depuis un serveur (local ou en ligne)

#. Comparez votre fichier avec la source reçue au niveau du client

Voir le `résultat 
<_static/php/corrections/premierepagephp/>`__ attendu.

* Comment rendre le résultat valide en HTML ?


Un point sur l'UTF-8
======================

Apache et UTF-8
++++++++++++++++

Il existe différente normes pour coder les accents dans les chaînes de caractère, **utf-8** est la plus récente mais les navigateurs utilisent par défaut latin1 qui est la norme historique pour les langues occidentales.

.. tip::
  Si votre éditeur de texte sauvegarde vos fichiers en utf-8 mais que le navigateur de votre visiteur interprète cela comme du latin1, les accents seront mal affichés (Ã© à la place de é...).

Plusieurs solutions pour spécifier l'encodage au navigateur, dans l'ordre de préférence :

.. nextslide::

* Configurer le serveur Web pour ajouter un en-tête HTTP. Pour apache, c'est dans /etc/apache2/apache2.conf

  - Configuration globale : c'est dans /etc/apache2/apache2.conf

    * On n'y a pas toujours accès (il faut être root)

  - Configuration locale (juste votre site) : fichiers .htaccess (voir chapitre suivant)

* Utiliser la fonction PHP ``header('Content-Type: text/html; charset=utf-8)``

  - Cette fonction doit être appelée avant d'avoir fait la moindre sortie, sinon c'est trop tard (on ne peut pas ajouter un en-tête HTTP lorsque le transfert du contenu a déjà commencé).

.. nextslide::

* Utiliser la balise HTML ``<meta http-equiv="Content-Type" content="text/html; charset=utf=8" />`` dans la section ``<head></head>``

  - pour en `savoir plus`__

.. __: https://www.alsacreations.com/article/lire/628-balises-meta.html#httpequiv

Les fichiers .htaccess
++++++++++++++++++++++

Fichier ``.htaccess`` :

* fichiers de configuration apache
* portée limitée au dossier
* pas de reboot apache necessaire

Permettent:

* Sécurité (Public/Privé, ...)
* Réécriture d'URL
* Redirection
* Gestion erreurs (404, 403, ...)

  - afficher une page personnalisée

Structure .htaccess
+++++++++++++++++++

Ensemble de directives, similaire au fichier de config apache 

.. code-block:: apache

  RewriteEngine on
  ErrorDocument 404 /erreur.html

Dans notre cas, pour modifier l'encodage dans les en-tetes HTTP

.. code-block:: apache

  AddDefaultCharset UTF-8 

.. tip::

  Pour créer un fichier .htaccess sous windows, il faut (entre autre) que les extensions de fichier soient visibles dans le navigateur

Les variables
==============

Syntaxe
+++++++

Utilisation de la mémoire du serveur afin de stocker des informations durant l'éxécution du script PHP, dans des **variables** qui :

* s'écrivent avec un identifiant précédé d'un ``$``, par exemple ``$ma_variable``,
* ne se déclarent pas, c'est l'affectation qui détermine leur type :

.. slide::
 
  - booléen (``true``/``false``)
  - nombre entier
  - flottants (nombre à virgule)
  - chaîne de caractères (entre quotes, ``'``)
  - tableau
  - ressource (handler de fichier, comme en C avec ``fopen()``)
  - ou même un objet (programmation orientée objet)
   
Exemple
-------

.. code-block:: php

  <?php 
   $agei = 21;
   echo "Vous avez $age ans !";
  ?>
  
`Résultat
<_static/php/test.php#affvariable>`__ HTML :
  
.. code-block:: html
    
  Vous avez 21 ans !
  
Les chaînes de caractères
+++++++++++++++++++++++++

Les chaînes de caractères :

* écrites entre ``'`` ou entre ``"``
* concatenation avec ``.`` (attention ``+`` fait la somme)
* peuvent interpreter la valeur d'une variable (si ``"`` est utilisé)

NB: Beaucoup de fonctions existent pour la manipulation des strings (`PHP Manual for Strings`_)

.. _PHP Manual for Strings: http://www.php.net/manual/fr/ref.strings.php

Affichage de chaines
--------------------

La syntaxe de PHP permet de simplifier l'affichage de chaînes de caractères entre elles ou avec des variables.

La syntaxe est différente suivant les délimiteurs utilisés :

.. code-block:: php

  <?php 
   $mot1 = 'phrase';
   $mot2 = 8;
   echo "Voici une $mot1 composée de $mot2 mots.\n";
   echo 'Voici une $mot1 composée de $mot2 mots.'."\n";
   echo 'Voici une '.$mot1.' composée de '.$mot2.' mots.'."\n";
  ?>
  
.. nextslide::

.. code-block:: html

  Voici une phrase composée de 8 mots.
  Voici une $mot1 composée de $mot2 mots.
  Voici une phrase composée de 8 mots.

NB : Le caractère ``\n`` correspond à un retour à la ligne en texte brut. A ne pas confondre avec la balise ``<br />`` qui est un retour à la ligne HTML !

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

====== ===========
Clé     Valeur
====== ===========
  0     François
  1     Michel
  2     Nicole
  3     Véronique
  4     Benoît
  ...   ...
====== ===========

Affectation
```````````

* Avec la fonction ``array`` :

.. code-block:: php

  <?php
   $prenoms = array('François', 'Michel', 'Nicole', 'Véronique', 'Benoît');
   // ou sa syntaxe courte (PHP 5.4+) :
   $prenoms2 = ['François', 'Michel', 'Nicole', 'Véronique', 'Benoît'];
  ?>

* Depuis les indices :

.. code-block:: php

  <?php
   $prenoms = array(); // ou []
   $prenoms[0] = 'François';
   $prenoms[1] = 'Michel';
   $prenoms[2] = 'Nicole';
  ?>

.. nextslide::

* Avec des indices implicites (ajouter à la fin) :

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

   echo $prenom[1]."\n";
   echo $prenom[0]."\n";
  ?>


Voir le `résultat 
<_static/php/test.php#accestableau>`__ .

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

.. nextslide::

* En définissant les indices :

.. code-block:: php

  <?php
    $patronyme = array(); // ou []
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

Voir le `résultat 
<_static/php/test.php#accestableauassoc>`__ .
  
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
  
Voir le `résultat 
<_static/php/test.php#cast>`__ .

.. tip::
    Il est recommandé de privilégier aux casts les fonctions spécialisées comme `intval`__.
.. __: http://php.net/manual/fr/function.intval.php
  
Les structures de contrôle
==========================

Les conditions
+++++++++++++++++

Elles permettent de définir des **conditions** lors de l'éxécution de votre script PHP :

======= =========================================
Symbole Signification
======= =========================================
  ==    Est équivalent à
  ===   Est strictement égal (type et valeur) à
  !=    N'est pas équivalent à
  !==   N'est pas strictement égal à
  >     Est supérieur à
  <     Est inférieur à
  >=    Est supérieur ou égal à
  <=    Est inférieur ou égal à
======= =========================================

.. nextslide::

.. warning::
    ``0 == false`` est vrai mais ``0 === false`` est faux. Privilégier **===** et **!==**, sauf cas particuliers. Voir la fonction `strpos`__ pour comprendre...

__ http://php.net/manual/fr/function.strpos.php

Exemple : ``if ... else``
-------------------------

.. code-block:: php
  :linenos:
  
  <?php 
  $longueur_mdp = 6;
  if ($longueur_mdp >= 8) // SI
    $save_mdp = true;
  elseif ($longueur_mdp >= 6) // SINON SI
  {
    $save_mdp = true;
    echo "Ce mot de passe n'est pas très sûr !\n";
  }
  else // SINON
  {
    echo "Ce mot de passe est trop court !\n";
    $save_mdp = false;
  }

  if ($save_mdp)
    echo "Mot de passe sauvegardé !";
  ?>
  
Voir le `résultat 
<_static/php/test.php#mdp>`__ .

.. nextslide::

PHP tolère aussi l'écriture condensée (nommée opérateur ternaire) : 

.. code-block:: php

  <?php 
    $variable = $condition ? valeurSiVrai : valeurSiFaux;
  ?>

Comparée au ``if``, cette écriture permet de réduire le nombre de lignes de code, au détriment de sa lisibilité.

Elle est cependant pratique pour lutilisation des balises courtes :

.. code-block:: php

   <?= ($age >= 18) ? 'Accès autorisé' : 'Accès refusé' ?>

Exemple : ``switch``
--------------------

.. code-block:: php
  :linenos:
  
  <?php couleur
    $couleur = "rouge";
    switch ($couleur)
    {
      case "bleu"  : $r=0;   $g=0;   $b=255; break;
      case "vert"  : $r=0;   $g=255; $b=0;   break;
      case "rouge" : $r=255; $g=0;   $b=0;   break;
      default      : $r=0;   $g=0;   $b=0;   break;
    }
    echo "Valeurs RGB pour $couleur : ($r,$g,$b).";
  ?>

Voir le `résultat 
<_static/php/test.php#switch>`__ .
  
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
    if($condition1 && (!$condition2 || $condition3))
    {
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

   while ($nombre_de_lignes <= 10)
   {
     echo 'Ceci est la ligne n°' . $nombre_de_lignes . "\n";
     $nombre_de_lignes++;
   }
  ?>
  
Voir le `résultat 
<_static/php/test.php#while>`__ .

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
     echo 'Ceci est la ligne n°' . $nb_lignes . "\n";
  ?>

Voir le `résultat 
<_static/php/test.php#for>`__ .

.. _boucle_foreach:
  
La boucle ``foreach``
---------------------

Les tableaux ne **DOIVENT PAS** être parcourus à l'aide d'une boucle for indicée comme en C, pour la bonne raison que les éléments intermédiaires peuvent être supprimés et donc la contiguité des éléments n'est pas assurée.

La bonne pratique est d'utiliser foreach.

Pour les tableaux simples
`````````````````````````

.. code-block:: php

  <?php
    $prenoms = array('François', 'Michel', 'Nicole', 
                     'Véronique', 'Benoît');
    foreach ($prenoms as $element)
    {
      echo $element . "\n";
    }
  ?>

Voir le `résultat 
<_static/php/test.php#foreach>`__ .
  
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

Voir le `résultat 
<_static/php/test.php#foreach2>`__ .

.. _exo_tableau:

Exercice
````````

#. Créez un nouveau fichier PHP vide.
#. Créez et initialisez un tableau clé-valeur dont les clés seront "prix_unitaire" et "quantite".
#. Réalisez un affichage basique en parcourant votre tableau.

Voir le `résultat 
<_static/php/corrections/tableau/>`__ attendu.

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

On peut modifier une variable "à la volée" :

=============== =============== =======================  
Exemple         Nom             Résultat
=============== =============== =======================  
$a = 3          Affectation     $a vaut 3.
$a += 3         Addition        $a vaut $a + 3.
$a -= 3         Soustraction    $a vaut $a - 3.
$a \*= 3        Multiplication  $a vaut $a \* 3.
$a /= 3         Division        $a vaut $a /3.
$a %= 3         Modulo          $a vaut $a % 3.
$a++            Incrémentation  Equivalent à $a += 1.
$a--            Décrémentation  Equivalent à $a -= 1.
$b .= 'chaine'  Concaténation   $b vaut $b.'chaine'.
=============== =============== =======================  

Opérateurs de `comparaison`__
-----------------------------

============== ================== =======================================================
Exemple        Nom                Résultat
============== ================== =======================================================
$a == $b       Équivalent         TRUE si $a est égal à $b
$a===$b        Identique          TRUE si $a == $b, + même type.
$a != $b       Non-équiv.         TRUE si $a est différent de $b
$a <> $b       Non-équiv.         TRUE si $a est différent de $b
$a !== $b      Différent          TRUE si $a != $b ou types différents.
$a < $b        Inférieur          TRUE si $a est inférieur strict à $b.
$a > $b        Supérieur          TRUE si $a est supérieur strict à $b.
$a <= $b       Inférieur ou égal  TRUE si $a est inférieur ou égal à $b.
$a >= $b       Supérieur ou égal  TRUE si $a est supérieur ou égal à $b.
============== ================== =======================================================
  
__ http://php.net/manual/fr/language.operators.comparison.php

Les fonctions
=============

Définir une fonction
++++++++++++++++++++

La syntaxe PHP impose l'utilisation du mot-clé ``function`` :

.. code-block:: php

  <?php
    function MaFonction ($parametre1, $parametre2)
    {
      //corps de la fonction
      return $valeurRetournee;
    }
  ?>

Les fonctions peuvent ne rien retourner (pas d'instruction ``return``, ou instruction explicite ``return;``). En fait, c'est la valeur ``NULL`` qui est retournée.
  
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
 
  - ``include('page.php');`` qui permet d'intégrer le contenu de 'page.php'. Un message warning s'affiche si la ressource est manquante.
  - ``require('page.php');`` qui fait la même chose mais une erreur fatale est retournée si la ressource est manquante (arrêt du script).
  - ``include_once('page.php');`` et ``require_once('page.php');`` intègrent en plus un test pour empêcher une intégration multiple.

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

GET : Envoi par l'URL
+++++++++++++++++++++

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


GET : Envoi par l'URL
+++++++++++++++++++++

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
    $valeur = $_GET['param1']; // contient valeur1
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
  
  Même si les paramètres et leurs valeurs sont transmises "en caché", il est tout de même possible d'envoyer des valeurs inattendues (par exemple, en modifiant une copie du code HTML du formulaire, ou en faisant une requête HTTP manuellement via ``curl``). Il est donc tout aussi important de contrôler les données reçues.

Contrôler la valeur des paramètres
++++++++++++++++++++++++++++++++++

Lorsque des données transitent par l'URL, il faut s'assurer que les **valeurs correspondent au type attendu**.
Dans le cas contraire, il faut soit essayer de les convertir soit retourner une erreur.

De plus, il est possible que certains paramètres attendus dans le code PHP soient absents de l'URL, dans ce cas
il est possible de **tester leur présence** avec la fonction ``isset``.

.. nextslide::

Exemple :

.. code-block:: php

  <?php
  // Traitement qui s'attend à recevoir deux paramètres entiers

  if (isset($_GET['param1']) AND isset($_GET['param2']))
  {
    $valeur1 = intval($_GET['param1']);
    $valeur2 = intval($_GET['param2']);

    ... // code à exécuter si tous les paramètres sont présents
  }
  else
  {
    ...
    // code à exécuter par défaut
  }
  ?>

Aller plus loin dans le contrôle des paramètres
+++++++++++++++++++++++++++++++++++++++++++++++

En plus de vérifier le type et la présence des paramètres, le traitement des chaînes de caractères doit comprendre une conversion pour **éviter que le texte puisse être interprété comme du code** HTML (ou JavaScript). Voir `Faille XSS`__.

Il existe des fonctions PHP conçues à cet effet : ``htmlspecialchars`` (`documentation`__) et ``htmlentities`` (`documentation`__). Elles permettent de convertir les caractères spéciaux en entités HTML. Exemple : 

__ https://fr.wikipedia.org/wiki/Cross-site_scripting
__ http://php.net/manual/fr/function.htmlspecialchars.php
__ http://php.net/manual/fr/function.htmlentities.php

.. nextslide::

.. code-block:: php
  
  <?php
  $value = isset($_POST['variable']) ?
             htmlspecialchars($_POST['variable']) :
             '';

  if ((strlen($value) > 0) && (strlen($value) < 50))
  {
    ... //
  }
  else
      echo 'Erreur...';
  ?>

.. _exo_impots:
  
Exercice : Les impots
+++++++++++++++++++++

* On souhaite faire une page simple permettant à un utilisateur de calculer le montant de son impôt

  * On calcule le nombre de parts du salarié (nbEnfants est son nombre d'enfants)

    .. code:: 

      parts = nbEnfants/2+1 (pas marié)

      parts = nbEnfants/2+2 (marié)


  * On calcule son revenu imposable (S est le salaire)

    .. code:: 

      R = 0.72 * S

Exercice : Les impots
+++++++++++++++++++++

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

Exercice : Les impots
+++++++++++++++++++++

#. Créer un formulaire permettant à l’utilisateur de rentrer ses informations
#. Calculer le montant prévisionnel de son impôt
#. Afficher le résultat

  .. figure:: _static/php/form.png
