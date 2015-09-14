:tocdepth: 2

========================================
 Le PHP objet
========================================

Caractéristiques générales
+++++++++++++++++++++++++++++

* Permet de bénéficier des avantages de la programmation objet en PHP

  - meilleure lisibilité
  - programmation plus naturelle
  - meilleure réutilisabilité du code
  
* Notation PEAR

  - https://pear.php.net/manual/fr/standards.php
  - à respecter
  
Les objets
+++++++++++++

* Caractéristiques générales

  - Les objets sont des instances de classes
  - Contiennent des propriétés et fonctions 

* Classes

  - mot clé : class
  - abstraction : classe abstraite (non instanciable) mot clé 'abstract'
  - héritage de classe : mot clé 'extends'
  - propriété ou fonction finale : surcharge interdite, mot clé 'final'

* Instances

  - mot clé 'new' (ex: $instance = new Classname();)
  - clonage d'objet (copie mémoire) avec clone()

* Interfaces

  - mot clé 'interface' pour définir des fonctions à implémenter pour une classe (méthodes publiques seulement)
  - implements pour lier une classe à une interface

* Méthodes

  - quelques méthodes réservées (méthodes magiques, cf : http://php.net/manual/fr/language.oop5.magic.php)
  - contraintes de typage possibles : http://php.net/manual/fr/language.oop5.typehinting.php

* Portée (visibilité)

  * private (le nom commence par un soulignement)
  * protected
  * public

Exercice
+++++++++++

* Réorganisez votre code en orienté objet

  - une classe "connection" pour gérer la connexion avec la BD
  - une classe "film" (dont les instances pourront être stockées dans un tableau par exemple)
  - une classe "acteur" (dont les instances pourront être stockées dans un tableau par exemple)
  etc...
