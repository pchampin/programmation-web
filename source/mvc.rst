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
* Utilisée par de nombreux frameworks PHP (Symfony 2 etc...)

.. note::

  Framework : Ensemble de composants qui servent à créer les fondations, l'architecture et les grandes lignes d'un logiciel

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

La partie contrôleur
+++++++++++++++++++++

* Fait le lien entre l’utilisateur et le reste de l’application
* Se charge d’analyser et de traiter la requête de l’utilisateur.
* Il demande au modèle les données et appelle la vue qui utilisera ces données pour afficher la page

Représentation schématique (1/2)
++++++++++++++++++++++++++++++++

.. figure:: _static/mvc/mvc.png
  :alt: model-view-controller

Source : OpenClassrooms

Représentation schématique (2/2)
++++++++++++++++++++++++++++++++

.. figure:: _static/mvc/mvc_symfony.png
  :alt: model-view-controller-symfony

Source : Documentation Symfony 2

Avantages de MVC
++++++++++++++++

* Séparation des préoccupations
* Code clair, bien organisé, gage de réutilisabilité
* Découpage standard qui permet aux autres développeurs de rapidement rentrer dans votre code
* Découpage des responsabilités qui permet à des développeurs avec différents profils de travailler sur un projet

Projet v2
=========

Vers MVC Maison
+++++++++++++++

Transformer son code en une architecture MVC Maison

( `Un peu d'aide sur le sujet <http://bpesquet.developpez.com/tutoriels/php/evoluer-architecture-mvc/>`_ )

Arborescence à respecter : un répertoire "Model", un "View", un "Controller" et un répertoire "Library" pour stocker les bibliothèques additionnelles par la suite


1. Refactoriser le code concernant l’accès aux données pour votre projet en créant/reprenant les classes suivantes:

  * FilmCollection (liste de films)
  * Film (contient un film de la table film)
  * Casting (liste d'acteurs pour un film)
  * Actor (acteur)
  * DBConnectionManager

Exemple 

    +-------------------------+
    |  FilmCollection         |
    +=========================+
    | `-` bdd                 |
    +-------------------------+
    | `+` getFilms() : array  |
    +-------------------------+
    | `+` __toString()        |
    +-------------------------+


.. figure:: _static/mvc/detail.png
  :alt: detail

2. Refactoriser le reste du code concernant la vue de l’itération 1 :

  * créer un fichier layout.php (à placer dans le dossier Vue) contenant tous les éléments communs des vues Il constue donc un modèle de page (template). Il permet également d’ajouter les éléments spécifiques à chaque vue à l’aide de deux variables $title et $content (la variable $content pourra etre remplie grace à la `bufferisation de sortie <http://php.net/manual/fr/outcontrol.examples.basic.php>`_)

.. code-block:: php

  <!doctype html>
  <html lang="fr">
    <head>
      <title><?php echo $titre ?></title>
    </head>
    <body>
      <?php echo $content ?>
    </body>
  </html>

* Les elements communs de votre design (menu, boutons, formulaires) devront également etre rajoutés (ou inclus) dans cette page
* index.php est un contrôleur minimal qui crée une instance de FilmCollection et affiche cette instance (liste des films).
* Lorsque des erreurs apparaisse, la page error.php permet d’afficher cette erreur en respect avec la charte graphique.

3. On souhaite que l’utilisateur puisse accéder au détail d’un film (en particulier le casting de celui-ci). 

  * La vue détailFilm.php devra permettre d’afficher les informations relatives à film, ainsi que son casting, avec les acteurs ordonnés par rang de casting en conservant la charte graphique adoptée.
  * Pour accéder au détail d’un film, il faut appeller la page index.php (contrôleur) avec un paramètres dans l’URL (movied).
  
  * Modifier l'affichage des films pour y rajouter pour chacun un lien vers le détail de ce film
  * Inclure un lien accueil pour retourner à la liste des films

.. figure:: _static/mvc/detail2.png
  :alt: detail liste