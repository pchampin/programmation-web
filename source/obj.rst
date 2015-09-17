:tocdepth: 2

========================================
 Le PHP objet
========================================

L'objet
=======

Les objets
++++++++++

  - Les objets sont des instances de classes
  - Contiennent des propriétés et fonctions

Pourquoi le PHP objet
+++++++++++++++++++++

* Permet de bénéficier des avantages de la programmation objet en PHP

  - meilleure lisibilité
  - programmation plus naturelle
  - meilleure réutilisabilité du code
  
* Notation PEAR

  - https://pear.php.net/manual/fr/standards.php
  - à lire et à respecter
  
Syntaxe de classe
+++++++++++++++++

  - mot clé : **class**
  - abstraction : classe abstraite (non instanciable) mot clé **abstract**
  - héritage de classe : mot clé **extends**
  
  .. code:: php

    <?php
      abstract class a 
      { 
      } 

      class b extends a
      { 
        ...
      }     
    ?>

Propriété et méthodes
+++++++++++++++++++++
  
  * Portée (visibilité) : 

    - **public**, **protected**, **private**
    - Un proprieté private commence par un **_**
    
  * Propriété ou fonction finale : 

    - surcharge interdite, mot clé **final**
  
  .. code:: php

      class a 
      {
        private $_params;
        public function hello()
        { 
        }
      }

Instances et accès
++++++++++++++++++

  - Création avec mot clé **new**
  - Appelle méthode (et propriété) avec **->**
  - Accès à l'instance avec **$this**

  .. code:: php

      class a {
        private $text = "Hello World";
        public function parler() {
          echo $this->text;
        }
      }

      $obj = new a();
      $obj->parler();
  
Méthodes magiques
+++++++++++++++++

  - Méthodes réservées (magiques) surchargeables

    * __construct() : Constructeur 
    * __toString() : affichage objet
    * __set() et __get() : surcharge de l'accès aux propriétée **private**
    * __clone() : surcharge comportement méthode copie mémoire **$obj->clone()**
    * (`Méthodes magiques`_)

Contrainte de typage
++++++++++++++++++++

  - contraintes de typage de méthode possibles

    * Attention: pas les types scalaires (int, string, etc...)
    * Class perso, array, callable
    
    .. code:: php

      public function parler(array $tableau) { ... }
    
    `Type Hinting`_

.. _Méthodes magiques: http://php.net/manual/fr/language.oop5.magic.php
.. _Type Hinting: http://php.net/manual/fr/language.oop5.typehinting.php


Méthode statiques
+++++++++++++++++

  * Méthode de la classe indépendante de l'instance
  * Mot clé **static**
  * Peut etre appellée par l'operateur de résolution de portée **::**

  .. code:: php

    class a
    {
      public static function parler() 
      {
        echo "Hello World";
      }
    }

    a::parler();

Attributs statiques
+++++++++++++++++++

  * Mot clé **static**
  * Acces depuis extérieur avec **::**
  * Acces depuis méthode statique avec **self**

    - ATTENTION AUX CONFUSIONS

    .. code:: php

    class a
    {
      private static $_compteur = 0;
      public static function parler() 
      {
        echo self::$_compteur;
      }
    }

Interfaces
++++++++++

  - mot clé **interface** pour définir des fonctions à implémenter pour une classe (méthodes publiques seulement)
  - **implements** pour lier une classe à une interface

  .. code:: php

    interface a
    {
      public function parler();
    }

    class b implements a
    {
      public function parler(){
        echo "Hello World";
      }
    }

Exercice:
+++++++++

* Réorganisez votre code en orienté objet

  - une classe "connection" pour gérer la connexion avec la BD
  - une classe "film" (dont les instances pourront être stockées dans un tableau par exemple)
  - une classe "acteur" (dont les instances pourront être stockées dans un tableau par exemple)
  etc...
