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

..code: php

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

  * On va ici définir le constructeur en privé (ou protected)
  * Puis utiliser une méthode ou une classe Factory

Le pattern Observer
===================

* Il est possible de suivre l'etat d'un objet grace à un observer

    Le pattern observer permet de lier certains objets à des « écouteurs » eux-mêmes chargés de notifier les objets auxquels ils sont rattachés.

( `Pour aller plus loin <http://bpesquet.developpez.com/tutoriels/php/evoluer-architecture-mvc/>`_ )

Le pattern Strategy
===================

* Séparer les algorithmes

    Le pattern strategy sert à délocaliser la partie algorithmique d'une méthode afin de le permettre réutilisable, évitant ainsi la duplication de cet algorithme.


L'injection de dépendance
=========================

* Envoyer à un objet les objet dont il va avoir besoin

Le pattern injection de dépendances a pour but de rendre le plus indépendantes possible les classes.


Le pattern Décorateur
=====================

* La puissance de ce pattern qui permet d’ajouter (ou modifier) des fonctionnalités facilement
* provient de la combinaison de l’héritage et de la composition.

Autres design patterns ?
========================

Mise en application pour : gestion des sessions, mots de passe, protection sécurité (injection SQL & XSS, cf: http://liris.cnrs.fr/~mmrissa/doku.php?id=lpdasi)