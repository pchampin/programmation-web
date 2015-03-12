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

- la création/suppression de bases de données
- la création/modification/suppresion de tables
- la création/modification/suppresion de champs
- la création/modification/suppresion d'enregistrements
- la visualisation des données enregistrées
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
#. Remplissez vos tables avec quelques données.


Interroger une base de données
==============================

Se connecter à une base de donnnées
+++++++++++++++++++++++++++++++++++



.. TODO::
	
	Exercice depuis le formulaire des pizzas : la page "prix.php" va désormais intérroger une BDD
	(donner un exemple minimal .sql qui contient les infos sur les pizzas.
	Les étudiants doivent construire le tableau depuis les données de la BDD.
	
	Exercice sur les jointures : faire concevoir une  base avec une table pizzas et une table ingredients
	Puis ajouter une table pizza_ingredients
	Obtenir le même résultat que pour l'exercice précédent.