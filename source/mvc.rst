:tocdepth: 2

========================================
 Les Design Patterns - Partie 1 : MVC
========================================

* Réponses à des problématiques de conception récurrentes
* Ensemble de bonne pratiques

Le Pattern MVC
==============

MVC : Model View Controller
+++++++++++++++++++++++++++

* Architecture applicative
   - façon d'organiser le code
* Consiste à découper le code en séparant:
   - Une partie modèle
   - Une partie vue
   - Une partie controlleur
* Utilisée par le framework PHP Symfony 2

.. note::

  Framework : Ensembe de composant qui sert à créer les fondations, l'architecture et les grandes lignes d'un logiciel

La partie Vue
+++++++++++++

* Affichage
* Contient le code HTML
* Un peu de PHP (boucles, conditions, affichage des variables)
* C'est la problématique présentation
* C'est le designer qui travaille la vue

La partie Modèle
++++++++++++++++

* Logique métier
* C'est la problématique traitement/calcul
* Elle contient aussi tout ce qui concerne l’accès aux données
* C’est là qu’on trouvera les requêtes SQL

La partie controlleur
+++++++++++++++++++++

* Fait le lien entre l’utilisateur et le reste de l’application
* Il est la couche qui se charge d’analyser et de traiter la requête de l’utilisateur.
* Il demande au modèle les données, les traite et appelle la vue qui utilisera ces données pour afficher la page

Représentation schématique (1/2)
++++++++++++++++++++++++++++++++

.. figure:: _static/mvc/mvc.png
	:alt: model-view-controller

Source : OpenClassrooms

Représentation schématique (2/2)
++++++++++++++++++++++++++++++++

.. figure:: _static/mvc/mvc-symfony.png
	:alt: model-view-controller-symfony

Source : Documentation Symfony 2

Avantages de MVC
++++++++++++++++

* Séparation des préoccupations
* Code clair, bien organisé, gage de réutilisable
* Découpage standard qui permet aux autres développeurs de rapidement rentrer dans votre code
* Découpage des responsabilités qui permet à des développeurs avec différents profils de travailler sur un projet

MVC Maison
==========

MVVM : Model-View-View-Model
============================