:tocdepth: 2

========================================
 Le PHP objet
========================================

L'objet
=======

Classes et objets
+++++++++++++++++

Les objets sont des structures de données contenant des variables (appelées attributs) et des fonctions (appelées méthodes).

Les classes sont la définition, le modèle, le "moule" qui permet de fabriquer des objets.

Pourquoi le PHP objet
+++++++++++++++++++++

* Permet de bénéficier des avantages de la programmation objet en PHP

  - meilleure lisibilité
  - programmation plus naturelle
  - meilleure réutilisabilité du code
  
* Notation PEAR

  - https://pear.php.net/manual/fr/standards.php
  - à lire et à respecter
  
Syntaxe de classe basique
+++++++++++++++++++++++++

Mot clé : **class**
  
.. code:: php

  <?php
  class Personne
  {
  }
  ?>

Propriété, méthodes et constructeur
+++++++++++++++++++++++++++++++++++
  
* Portée (visibilité) : 

  - Principe d'encapsulation
  - **public**, **protected**, **private**
    
  .. code:: php

    <?php
    class Personne
    {
      private $prenom;
      private $nom;
      private $age;

      // Constructeur
      public function __construct($prenom, $nom)
      {
          $this->prenom = $prenom;
          $this->nom = $nom;
      }

      public function sePresenter()
      {
          echo 'Bonjour ! Je m\'appelle '.$this->prenom.' '.$this->nom;
      }
    }
    ?>

Instances (objets)
++++++++++++++++++

- Création d'un objet de la classe avec mot clé **new**
- Appelle méthode (et propriété) avec **->**
- Accès à l'instance avec **$this**

.. code:: php

  <?php
  class Personne
  {
      ...
  }

  $tom = new Personne('Tom', 'Doyen');
  $tom->sePresenter();
  ?>
  
Méthodes magiques
+++++++++++++++++

- Méthodes réservées (magiques) surchargeables

  * __construct() : Constructeur 
  * __toString() : Cast implicite vers chaîne de caractère (exemple : ``echo $tom;``)
  * __set() et __get() : surcharge de l'accès aux propriété privées (**à éviter**, préférer des accesseurs explicites)
  * __clone() : surcharge comportement méthode copie mémoire **$obj->clone()** (équivalent contructeur par copie du C++)
  * (`Méthodes magiques`_)

.. _Méthodes magiques: http://php.net/manual/fr/language.oop5.magic.php

Héritage
++++++++

Définit un cas particulier d'une classe. Par exemple, un Etudiant est une Personne, avec des choses en plus.

.. code:: php

  <?php
  class Personne
  {
      ...
  }
  class Etudiant extends Personne // Un Etudiant est un cas particulier de Personne
  {
      private $num_etudiant; // qui a en plus un numéro étudiant

      private function __construct($prenom, $nom, $num_etudiant)
      {
          parent::__construct($prenom, $nom); // appel du constructeur de la classe Personne
          $this->num_etudiant = $num_etudiant; // puis initialisation des attributs spécifiques
      }

      public function sePresenter() // redéfinit la méthode de la classe Personne
      {
          parent::sePresenter(); // appel de la methode de la classe Personne (sans cette ligne la redéfinition est totale)
          echo 'Et mon numéro étudiant est '.$this->num_etudiant;
      }
  }
  ?>

Contrainte de typage (Type-hinting)
+++++++++++++++++++++++++++++++++++

* Contraintes de typage des paramètres d'une fonction

  - Classe, array, callable
  - Attention: pas les types scalaires (int, string, etc...), sauf en PHP 7+
  - `Type Hinting`_
  
  .. code:: php

    <?php
    function faireParler(Personne $p)
    {
        // on sait que $p est une Personne, donc cette ligne va marcher
        $p->sePresenter();

        // $p est peut être une classe fille, un Etudiant par exemple !
        // ce n'est pas gênant, un Etudiant EST une Personne et sait donc se présenter.
    }

    $tom = new Etudiant('Tom', 'Doyen', 'p12345678');
    faireParler($tom); // À votre avis, est-ce que c'est sePresenter de Personne ou d'Etudiant qui sera appelé ?
    ?>

.. _Type Hinting: http://php.net/manual/fr/language.oop5.typehinting.php

Méthode statiques
+++++++++++++++++

* Méthode de la classe indépendante de l'instance
* Mot clé **static**
* Peut etre appellée par l'operateur de résolution de portée **::**
* **À éviter**. S'il y en a besoin, c'est un problème de design.

.. code:: php

  <?php
  class a
  {
    public static function parler() 
    {
      echo 'Hello World';
    }
  }

  a::parler();
  ?>

Attributs statiques
+++++++++++++++++++

* Mot clé **static**
* Acces depuis extérieur avec **::**
* Acces depuis méthode statique avec **self**
* **À éviter**. Ce ne sont autres que des variables globales déguisées. S'il y en a besoin, c'est un problème de design.

.. code:: php

  <?php
  class a
  {
    private static $compteur = 0;
    private $mon_numero;

    public function __construct()
    {
        self::$compteur++;
        $this->mon_numero = self::$compteur;
    }

    public static function parler()
    {
      echo 'Je suis le '.$this->mon_numero.'eme (sur '.self::$compteur.' au total)';
    }
  }
  ?>

Classes et méthodes abstraites
++++++++++++++++++++++++++++++

* Regroupent des comportements communs
* Mais représentent un objet abstrait
* N'ont donc pas d'existence propre

.. code:: php

  <?php
  abstract class Vehicule
  {
      private $numeroDeSerie;
      public function getNumeroDeSerie() { return $this->numeroDeSerie; }
      public abstract function seDeplacer();
  }
  class Voiture extends Vehicule
  {
      private ...
      public function seDeplacer()
      {
          $this->pedaleAccelerateur->appuyer();
      }
  }
  class Moto extends Vehicule
  {
      private ...
      public function seDeplacer()
      {
          $this->poignee->tourner();
      }
  }
  ?>

À quoi ça sert ?

* Regroupe des informations communes (numéro de série) dans la classe mère, évite le copier/coller de code
* Déclare un comportement (seDeplacer) qui est garanti être appelable sur tous les véhicules

  - encapsulation + polymorphisme : quelqu'un qui a un Vehicule sait qu'il peut se déplacer, sans forcément savoir comment

Interfaces
++++++++++

* Peut se voir comme une classe 100% abstraite
* Ne définit que des comportements
* Mot clé **interface** pour définir des fonctions à implémenter pour une classe (méthodes publiques seulement)
* **implements** pour lier une classe à une interface

.. code:: php

  <?php
  interface SaitParler
  {
    public function parler();
  }

  class Personne implements SaitParler
  {
    public function parler()
    {
      echo 'Hello World';
    }
  }

  class Robot implements SaitParler
  {
    public function parler()
    {
      echo '10100110100';
    }
  }
  ?>

À quoi ça sert ?

* Déclare un comportement (saitParler) qui est garanti être appelable par tous ceux qui implémentent SaitParler

  - Mais on peut implémenter plusieurs interfaces en même temps (``implements Int1, Int2, Int3``), alors qu'on ne peut étendre que d'une classe
  - Il est également possible pour une fonction de Type-hinter sur une interface :

  .. code:: php
    
    <?php
    function faireParler(SaitParler $sp)
    {
        echo 'Tu vas parler, ordure ?';
        $sp->parler();
    }
    ?>

  - Exemples "real-world" :

    - **Serializable** ("représentable comme du texte", pour sauvegarder dans un fichier
    - **Cloneable**
    - **ArrayAccess** (pour avoir le droit d'utiliser les crochet [] sur nos propres classes, hé oui on peut créer nos propres tableaux et les utiliser de façon transparente)
    - **Iterator** (pour avoir le droit d'utiliser la structure ``foreach`` sur nos propres classes)

Exercice
========

* Réorganisez votre code en orienté objet

  - une classe "Connection" pour gérer la connexion avec la BD
  - une classe "Film" (dont les instances pourront être stockées dans un tableau par exemple)
  - une classe "Acteur" (dont les instances pourront être stockées dans un tableau par exemple)
  - etc...

