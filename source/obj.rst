:tocdepth: 2

========================================
 Le PHP objet
========================================

* Permet de bénéficier des avantages de la programmation objet en PHP
  - meilleure lisibilité
  - programmation plus naturelle
  - meilleure réutilisabilité du code
  ...
  
* Notation PEAR
  - https://pear.php.net/manual/fr/standards.php
  - à respecter
  
Les objets
==============

* Propriétés générales
  - Les objets sont des instances de classes
  - Contiennent des propriétés et fonctions 

* Classe
  - abstraite (non instanciable) avec 'abstract'
  - héritage avec 'extends'
  - surcharge interdite avec 'final'

* Interface
  - interface pour définir des fonctions à implémenter pour une classe (méthodes public seulement)
  - implements pour lier une classe à une interface

  
* Méthodes
  - quelques méthodes réservées (méthodes magiques, cf : http://php.net/manual/fr/language.oop5.magic.php)
  - clonage d'objet (copie mémoire) avec clone()

* Portée (visibilité)
  * private (le nom commence par un soulignement)
  * protected
  * public
* 
