========================================
 Les Design Patterns - Partie 2
========================================

Un design pattern est un moyen de conception répondant à un problème récurrent.


Le pattern Factory
==================

Objectif : Fournir un objet pret à l'emploi, configuré correctement, avec les classes instanciées

  * Confier à une autre classe la création des instances d'une classe
    
    * Configuration spécifiques
    * Protection des instances

  * On peut aussi utiliser une méthode statique dans la meme classe

.. code-block:: php

  class FilmFactory{
    static function create(){
      // Ajouter le film dans la base
      self::ajoutFilm($data)
      // Retourner une instance
      return new Film($data)
    }
  }

Le pattern factory a pour but de laisser des classes usine créer les instances à votre place.

Le pattern Singleton
====================

Objectif : S’assurer que une seule et m^eme instance d’une classe soit utilisée

  * Contre les problemes de duplication d'objet
  * Fonctionne très bien associé au pattern Factory

  * Méthode :
    * On va ici définir le constructeur en privé (ou protected)
    * Puis utiliser une méthode ou une classe Factory

  Exemple: Pour la connection à la base de donnée, on utilise qu'une seule instance de DBConnectionManager, que l'on peut au choix stocker dans les objets ou passer en param^etre lorsqu'il est nécessaire

Le pattern Observer
===================

  * Il est possible de suivre l'etat d'un objet grace à un observer

    Le pattern observer permet de lier certains objets à des « écouteurs » eux-mêmes chargés de notifier les objets auxquels ils sont rattachés.

  * Méthode:

    * L'objet observé doit implémenter **SplSubject**
    * Il faut redéfinir les 3 méthodes suivantes:

      + **attach(SplObserver)**  : ajouter un observateur à l'objet
      + **detach(SplObserver)** : retirer un observateur
      + **notify()** : prévenir les observeurs de quelque chose

  * Exemple d'utilisation : Surveiller les erreurs ou les comportements et envoyer un email en cas de problème

( `Pour aller plus loin <https://openclassrooms.com/courses/programmez-en-oriente-objet-en-php/les-design-patterns>`_ )

Le pattern Strategy
===================

* Séparer les algorithmes

  Le pattern strategy sert à délocaliser la partie algorithmique d'une méthode afin de le permettre réutilisable, évitant ainsi la duplication de cet algorithme.

  * Utiliser des interfaces pour partager des méthodes similaires entre des classes

( `Pour aller plus loin <https://openclassrooms.com/courses/programmez-en-oriente-objet-en-php/les-design-patterns>`_ )

L'injection de dépendance
=========================

Objectif: Rendre une classe indépendante de ses dépendance

Voici un exemple pour comprendre:

.. code-block:: php
  
  class Films{
    private $db;
    function __construct(){
      $db = MyPDO::getInstance();
    }
  }

Cette classe est dépendante de PDO, elle force l'utilisateur a utiliser PDO

.. code-block:: php
  
  class Films{
    private $db;
    function __construct( $db ){
      $this->db = $db;
    }
  }

Maintenant, je peux envoyer n'importe quel type de connection base de donnée à cette classe pour peu que cet objet implemente les méthodes "connect()", "prepare()", etc...

( `Pour aller plus loin <https://openclassrooms.com/courses/programmez-en-oriente-objet-en-php/les-design-patterns>`_ )

Le pattern Décorateur
=====================

* La puissance de ce pattern qui permet d’ajouter (ou modifier) des fonctionnalités facilement
* provient de la combinaison de l’héritage et de la composition.

  * L'idée ici est de pouvoir associer à une classe une fonctionnalité à la volée

