========================================
 Les Design Patterns - Partie 2
========================================

Un design pattern est un moyen de conception répondant à un problème récurrent.

Le pattern Factory
==================

* Confier à une classe la création des objets

Le pattern factory a pour but de laisser des classes usine créer les instances à votre place.

Le pattern Observer
===================

* Il est possible de suivre l'etat d'un objet grace à un observer


    Le pattern observer permet de lier certains objets à des « écouteurs » eux-mêmes chargés de notifier les objets auxquels ils sont rattachés.


Le pattern Strategy
===================

* Séparer les algorithmes

    Le pattern strategy sert à délocaliser la partie algorithmique d'une méthode afin de le permettre réutilisable, évitant ainsi la duplication de cet algorithme.

Le pattern Singleton
====================

* Une classe, une instance
* contre les problemes de duplication d'objet

    Le pattern singleton permet de pouvoir instancier une classe une seule et unique fois, ce qui présente quelques soucis au niveau des dépendances entre classes.



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

Mise en application pour : gestion des sessions, mots de passe, protection sécurité (injection SQL & XSS, cf mon cours ici : http://liris.cnrs.fr/~mmrissa/doku.php?id=lpdasi)