:tocdepth: 2

==============================
 Gestion des bases de données
==============================

Introduction aux bases de données
=================================

Qu'est ce qu'une base de données ?
++++++++++++++++++++++++++++++++++

Un **base de données** (BDD) permet l'enregistrement de données dans un format organisé et hiérarchisé.

La durée de vie des données stockées dans des variables PHP est limitée au temps d'éxécution du script.

Il est aussi possible de stocker des données dans des fichiers externes, mais cette solution n'est pas viable
pour une grande quantité de données. 

Pour manipuler une BDD, on utilise un **SGBD**.

Un SGBD ?
+++++++++

C'est un **Système de Gestion de Base de Données**.

Comme son nom l'indique, un SGBD permet :

- d'enregistrer des données
- d'organiser ces données
- d'accèder aux données

La plupart des SGBD utilisent le **langage SQL** (Structured Query Language).

Les données brutes sont stockées dans des fichiers sur le serveur.
Le SGBD a pour mission de permettre leur accès en optimisant les opération de lecture/écriture.


Quel SGBD utiliser ?
--------------------

Il existe plusieurs SGBD; parmi les plus utilisés on retrouve :

- MySQL
- Oracle
- Microsoft SQL Server
- PostgreSQL 

Dans ce cours, nous travaillerons avec MySQL. Il est le SGBD libre et gratuit le plus utilisé (mais pas le seul).

Comment s'interfacent PHP et MySQL ?
------------------------------------

.. figure:: _static/bdd/client-serveur_MySQL.png
		:alt: client-serveur-mysql

#. Le serveur interprète le script PHP
#. Le script PHP interroge dans une requête la base de données par MySQL
#. MySQL renvoie les données en réponse à la requête
#. PHP traite les données reçues côté serveur

.. note::

  Dans ce schéma, vous pourriez remplacer PHP par n'importe quel langage dédié à la gestion de pages web dynamiques.
  De même, MySQL pourrait très bien être remplacé par un autre SGBD, tant que le langage qui utilisé de PHP au SGBD reste le SQL.

Structure d'une base de données
+++++++++++++++++++++++++++++++

Une base de données est composée de **tables**.

Chaque table est composée de **champs**.

Chaque champ contient plusieurs **valeurs**.

Chaque **entrée** ou **enregistrement** correspond à ensemble comprenant une valeur pour chaque champ.

.. tip::

  Généralement, on crée une base de donnée spécifique à chaque site web.
  Mais il est aussi possible de partager une même base entre plusieurs sites.

.. nextslide::

On peut voir une table comme un tableau de la forme :

============ =========== =========== =========== 
Identifiant   Champ1      Champ2      ...
============ =========== =========== =========== 
  1          Valeur11     Valeur21    ...
  2          Valeur12     Valeur22    ...
  3          Valeur13     Valeur23    ...
  ...        ...          ...         ...
============ =========== =========== =========== 

.. tip::
  
  Le champ identifiant n'est pas obligatoire, mais il permet d'affecter une valeur unique à chaque enregistrement.
  L'utilisation d'identifiants permet aussi de lier les données de plusieurs tables entre-elles.

 
Créer et gérer une base de données
==================================
 
L'interface PhpMyAdmin
++++++++++++++++++++++

Pour faciliter les opérations de gestion des bases de données, il existe un outil nommé **PhpMyAdmin**,
qui propose une interface de gestion Web des BDD sous la forme de pages PHP permettant (entre autres) :

- la création/suppression de bases de données;
- la création/modification/suppresion de tables;
- la création/modification/suppresion de champs;
- la création/modification/suppresion d'enregistrements;
- la visualisation des données enregistrées;
- l'importation/exportation de bases de données (complètes ou partielles).
 
Accéder à PhpMyAdmin
--------------------

* Depuis le site Web de l'IUT  : http://iutdoua-webetu.univ-lyon1.fr/phpMyAdmin/
   - login habituel : pxxxxxxx
   - mot de passe : code initial
   
* Depuis un serveur local (type WAMP) : http://localhost/phpMyAdmin
 
.. figure:: _static/bdd/phpmyadmin.png
		:alt: phpmyadmin
 
 
.. _exo_phpmyadmin:  

Exercice
````````
L'objectif de cet exercice est de se familiariser avec l'interface PhpMyAdmin.

Instructions :

#. Créez une base de données nommée "bdd_pizzas".
#. Créez une table nommée "pizzas" avec les champs "id_pizza" (entier, clé primaire), "nom_pizza" (chaîne de caractères), "ingredients_pizza" (chaîne de caractères) et "prix_pizza" (nombre flottant).
#. Remplissez vos tables avec quelques données (5-10 pizzas).


Interroger une base de données
==============================

Se connecter à une base de donnnées
+++++++++++++++++++++++++++++++++++

Avant de pouvoir lire ou écrire dans une base de données, il est nécessaire de s'y connecter.

La connexion à une base de données est un processus d'authentification qui permet de s'assurer que seuls les utilisateurs autorisés peuvent accéder aux données et/ou les modifier.

Les SGBD utilisent un vocabulaire spécifique relatif au processus de connexion :

* **l'hôte** est l'adresse du serveur qui héberge la base de données;
* **la base** est le nom de la base de donnée à laquelle on souhaite se connecter
* **user** est l'identifiant de l'utilisateur
* **password** est le mot de passe de cet utilisateur (connexion sécurisée).

Type de connexion
-----------------

PHP propose plusieurs fonctionnalités intégrées pour se connecter à une base de données via un SGBD.
Les évolutions successives de PHP explique l'existance de 3 exentions :

* ``mysql_`` : les fonctions dont le nom commence par cette extension permettent d'accéder à une BDD gérée par MySQL;
* ``mysqli_`` : propose des fonctionalités améliorées pour MySQL;
* ``PDO`` : constitue la concrétisation d'un effort d'unification entre les différents SGBD.

En conclusion, ``PDO`` est une solution générique qui permettra d'utiliser le même code pour dialoguer avec les différents SGBD.
C'est aussi une version optimisée qui utilise les fonctionnalités avancées des dernières versions de PHP (nottament la programmation orientée objet).


Se connecter en PHP
-------------------

Fonction de connexion :

.. code-block:: php

  <?php
   function Connect_db(){
	$host="localhost"; // ou sql.hebergeur.com
	$user="root";      // ou login
	$password="";      // ou xxxxxx
	$dbname="nom_bdd";
    try {
	 $bdd=new PDO('mysql:host='.$host.';dbname='.$dbname.
	              ';charset=utf8',$user,$password);
    } catch (Exception $e) {
	 die('Erreur : '.$e->getMessage());
    }
   }
  ?>
  
Faire une requête sur une base de données
+++++++++++++++++++++++++++++++++++++++++
  
Après s'être connecté à une base de données, il est possible d'accéder à son contenu, en suivant le protocole suivant :

#. On **interroge** une base de données grâce à une **requête**. Une requête constitue une instruction qui spécifie quelle(s) donnée(s) de quelle(s) tables on souhaite récupérer.
#. Le SGBD se charge de **filtrer** et **trier** les données correspondantes à la requête et les **collecte** dans une structure de données exploitable en PHP (c'est à dire, un tableau).

Ecrire une requête
------------------

Les requêtes sont interprétées par le SGBD, elles sont dont formulées dans le langage qu'il manipule, c'est à dire le SQL.

Le langage SQL est dédié à l'écriture de requêtes. Sa syntaxe, sous forme de chaîne de caractères, permet de créer des requêtes complexes à partir de quelques mots clés.

Les instructions SQL
````````````````````

Le langage SQL est articulé autour de mots-clés facilement interprétables, exemple :

* ``SELECT`` : sélection des champs
* ``FROM`` : choix de la table
* ``WHERE`` : condition (peut être composée avec ``AND``/``OR``)
* ``ORDER BY`` : règle de tri (par champ)
* ``LIMIT`` : limite du nombre d'enregistrements
* ``INSERT INTO`` : insertion d'un enregistrement
* ``VALUES`` : précise les valeurs à enregistrer
* ``UPDATE`` : mise à jour d'un enregistrement
* ``DELETE`` : suppression d'un enregistrement
  
.. note:

	Cette liste n'est pas exhaustive : il est possible de tout faire avec des requêtes SQL (y compris création/suppresion de table et même de BDD).
 
Requête de lecture
``````````````````

L'ordre des mots-clés est figé, mais il n'est pas obligatoire de tous les utiliser.

Un exemple d'une requête de lecture complète pourrait être :

.. code-block:: sql

  SELECT champ1, champ2, champ3
  FROM table 
  WHERE champ1='valeur'
  AND champ2 < 20
  OR champ 3 > 0
  ORDER BY champ2 DESC, champ3 ASC
  LIMIT 0,5

.. tip::

  Le sélecteur ``*`` permet de sélectionner tous les champs d'une table : ``SELECT *``.
  
.. nextslide::

* Il est possible de ne sélectionner qu'une partie des champs d'une table.
* Il est possible de sélectionner les champs de plusieurs tables. Dans ce cas, il faut écrire ``table.champ`` après le ``SELECT`` (pas obligatoire si les noms des champs diffèrent).
* ``WHERE`` indique le début des conditions qu'il est possible de combiner avec les opérateurs ``AND`` et ``OR`` en plus des parenthèses.
* Le tri peut se faire sur plusieurs champs, par ordre d'apparition après ``ORDER BY``. C'est l'ordre alphabétique qui s'applique sur un champs texte. 
* La limite du nombre d'enregistrement s'écrit : ``LIMIT indice_debut, indice_fin`` ; il y aura donc ``indice_fin - indice_debut`` enregistrements sélectionnés. Si un seul indice est précisé, la requête renverra ce nombre d'enregistrements à partir du premier (**dans l'ordre définie par le tri**). 

Requête d'écriture
``````````````````

D'autres mots-clés permettent d'ajouter/modifier/supprimer un enregistrement dans une table.

Exemple d'**insertion** :

.. code-block:: sql

  INSERT INTO table(champ1,champ2, champ3)
  VALUES (valeur1, valeur2, valeur3)
 
.. warning::

  Les SGBD sont très sécurisés au niveau des requêtes d'insertion. Aussi, la requête se traduira systématiquement par
  un échec dans le cas d'oubli d'un des champs ou de types de paramètres incompatibles.
  
  Toutes les vérifications devront êtres faites côté PHP avant génération de la requête SQL.
 
.. note::

  Si un champ de la table à été déclaré comme une clé primaire (identifiant) avec la propriété ``auto_increment``,
  il n'est pas nécessaire de faire apparaître ce champ ni sa valeur dans une requête d'insertion.
 
 
.. nextslide::

Exemple de **modification** :

.. code-block:: sql

  UPDATE table SET champ2 = valeur2, champ3 = valeur3 
  WHERE champ1 = valeur1
  
.. warning:: 

  Les requêtes de modifications utilisent aussi une partie sélection.
  
  La requête n'aboutiera pas si la condition du ``WHERE`` n'est pas satisfaisable.
  
.. note::
  
  Il est possible de modifier plusieurs enregistrements en une seule requête : c'est la condition de sélection qui fait la différence.
 
.. nextslide::

Exemple de **suppression** :

.. code-block:: sql

  DELETE FROM table WHERE champ1=valeur1

.. warning::

  Les suppressions ne sont **pas annulables**.
  
  Attention : sans la condition ``WHERE`` tous les enregistrements de la table seront supprimés !
 
.. _exo_sql:
 
Exercice
````````

Depuis PhpMyAdmin, il est possible de taper directement des requêtes SQL et d'afficher le résultat retourné.

#. Accédez à votre base de données de l'`exercice précédent<exo_phpmyadmin>`:ref:.
#. Depuis le formulaire de requêtes de PhpMyAdmin, écrire une requête pour récupérer le nom de toutes les pizzas.
#. Ecrire une requête permettant de récupérer au plus 5 pizzas parmi les moins chères (<=10€).
#. Récupérez le nom et le prix de toutes les pizzas et triez le résultat par prix (croissant).
#. Ajouter une nouvelle pizza nommée "Cannibale", qui coûte 20€, et contient du Fromage, de la Tomate, de la Viande Hachée, du Poulet, du Chorizo, du Canard, et du Jambon.

 
Lire les données d'une base de donnnées
---------------------------------------

La lecture de données depuis une BDD s'exécute suivant ce protocole :

#. Connexion à la BDD,
#. Préparation de la requête,
#. Interrogation de la BDD via une requête SQL,
#. Récupération de la réponse complète,
#. Lecture enregistrement par enregistrement,
#. Fin de la lecture et libération de la ressource.


Exemple générique
````````````````` 

.. code-block:: php
  :linenos:
  
  <?php
   Connect_db(); //connexion à la BDD
   $query = $bdd->prepare('...'); // requête SQL
   $query->execute(...); // paramètres et exécution
   while($data = $query->fetch()) { // lecture par ligne
      ... // traitement de l'enregistrement
   } // fin des données
   
   $query->closeCursor();
  ?>

.. nextslide::
  
Quelques remarques :
  
* Dans la requête, si on veut injecter des paramètres, il faut le spécifier par le caractère anonyme ``?`` ou un identifiant précédé par ``:``.
* La fonction ``execute()`` exécute la requête avec les paramètres fournis sous la forme d'un tableau simple (paramètres anonymes) ou associatif (paramètres identifés). Il n'est pas nécessaire de préciser de paramètres si la requête SQL n'en comporte pas.
* La fonction ``fetch()`` retourne un tableau associatif dont les clés correspondent aux champs sélectionnés par la requête.
* La lecture s'arrête lorsque l'affectation de l'enregistrement échoue : il n'y a plus de données à lire.
* La fonction ``closeCursor()`` permet de libérer la ressource lorqu'on a fini les traitements sur les données retournées par le SGBD.


Requête sans paramètres
```````````````````````

.. code-block:: php
  :linenos:
  
  <?php
   ...
   $query=$bdd->prepare('SELECT * from table');
   $query->execute();
   ...
  ?>
  
.. note::

  Pour gagner du temps, il est aussi possible d'utiliser la fonction ``exec()`` qui prend en paramètre une requête, et s'applique sur l'objet BDD :
  
  ``$query=$bdd->exec('...');``.

Requête avec paramètres anonymes
````````````````````````````````

.. code-block:: php
  :linenos:
  
  <?php
   ...
   $query=$bdd->prepare('SELECT champ1, champ2 
                         FROM table
	                 WHERE champ1 = ?  
	                 AND champ3 <= ? 
	                 ORDER BY champ2');
   $query->execute(array($valeur1, $valeur2));
   ...
  ?>


Requête avec paramètres identifiés
``````````````````````````````````
  
.. code-block:: php
  :linenos:
  
  <?php
   ...
   $query=$bdd->prepare('SELECT champ1, champ2 
                         FROM table
	                 WHERE champ1 = :valeur1  
	                 AND champ3 <= :valeur2 
	                 ORDER BY champ2');
   $query->execute(array('valeur1' => $valeur1,
                         'valeur2' => $valeur2));
   ...
  ?>
  
.. _exo_requete:
  
Exercice
````````

#. Reprenez votre formulaire de commande de pizzas de l'`exercice précédent<exo_post>`:ref:.
#. Créez une page contenant la fonction de connexion à la BDD pizzas.
#. Modifiez la page "prix.php" pour que la construction du tableau soit faite depuis les données de la BDD.	

Ecrire des données dans une base de donnnées
--------------------------------------------

L'écriture de données dans une BDD se fait en suivant les étapes suivantes :

#. Connexion à la BDD,
#. Préparation de la requête,
#. Exécution de la requête.

Trois actions sont possibles pour l'écriture : insertion, modification ou suppression d'un enregistrement.

Exemple générique
`````````````````
Avec paramètres :

.. code-block:: php
  :linenos:
  
  <?php
   Connect_db(); //connexion à la BDD
   $query = $bdd->prepare('...'); // requête SQL
   $query->execute(...); // paramètres et exécution
  ?>

Sans paramètres :

.. code-block:: php
  :linenos:
  
  <?php
   Connect_db(); //connexion à la BDD
   $query = $bdd->exec('...'); // requête SQL
  ?>
  
.. note::

  Pour effectuer chacune des opérations (ajout, modification, suppression), il suffit de choisir la bonne requête (``INSERT INTO, UPDATE SET, DELETE FROM``);

  
.. _exo_ecriture:
  
Exercice
````````

#. Récupérez `la page "ajout_pizza.php"`__ qui permet d'afficher un formulaire.
#. Modifiez la pour que, lorsque des données sont envoyées, elles soient insérées dans la table pizzas de votre BDD.
#. Ajoutez tous les tests nécessaires au traitement des données entrées.
#. Si l'utilisateur entre un nom de pizza déja existant dans la table, appliquer une requête de modification avec les nouvelles données (empêchez la création de doublons).

__ _static/bdd/exercices/ajout_pizza.zip

Les requêtes de jointure
------------------------



Exercice
````````

.. TODO::

	Exercice sur les jointures : faire concevoir une  base avec une table pizzas et une table ingredients
	Puis ajouter une table pizza_ingredients
	Obtenir le même résultat que pour l'exercice précédent.