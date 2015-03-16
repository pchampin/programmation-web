:tocdepth: 2

=============================
 Utilisation avancée de PHP
=============================

Sécuriser des pages PHP
=======================

Contrôle d'accès sur serveur Apache
+++++++++++++++++++++++++++++++++++

Certaines pages ou certaines sections de votre site web peuvent être privées ou limitées à certains utilisateurs (pages d'administration ...).

Pour cela, il est possible d'utiliser les `sessions PHP<sessions>`:ref:, mais leur mise en place impose de créer une interface et une table dans la BDD pour gérer les accès.

Une autre possibilité est d'utiliser le contrôle d'accès côté serveur. Cela garantit de limiter l'accès à certains fichiers aux seuls utilisateurs autorisés.

Pour mettre en place un contrôle d'accès, il faut créer deux fichiers :

#. Un fichier ``.htaccess``  qui contient l'adresse du ``.htpasswd`` et définit les options du contrôle d'accès.
#. Un fichier ``.htpasswd``  qui contient une liste de logins/mots de passe des utilisateurs autorisés à accèder aux pages contenues dans le dossier du fichier ``.htaccess``.


.. note::

  Chaque fichier ``.htaccess`` protège les pages du répertoire dans lequel il se trouve.
  Pour protéger plusieurs pages, il est donc nécessaire de dupliquer ce fichier, mais il est préférable de le faire pointer sur un fichier ``.htpasswd`` unique.

Le fichier ``.htaccess``
------------------------

Exemple :

.. code-block:: none

  AuthName "Message de l'invité"
  AuthType Basic
  AuthUserFile "/home/univ-lyon1/pxxxxxxx/
                public_html/admin/.htpasswd"
  Require valid-user

Le champ ``AuthName`` correspond au message affiché lors de la tentative d'accès à une ressource sous contrôle d'accès.

Le champ ``AuthUserFile`` est le chemin absolu vers le fichier ``.htpasswd``.

.. note::

  La fonction PHP `realpath()`__ permet de récupérer le chemin absolu du fichier ``.htpasswd``.
  
__ http://php.net/manual/fr/function.realpath.php
  
Le fichier ``.htpasswd``
------------------------

Le fichier ``.htpasswd`` se compose de lignes suivant le format : ``login:mot_de_passe_crypté``.

Il est possible d'afficher les mots de passe en clair. Mais ils sont alors visibles si on a les droits de lecture sur le serveur.

Pour crypter les mots de passe du fichier ``.htpasswd``, PHP propose la fonction `crypt()`__. 

Exemple sans cryptage :

.. code-block:: none
  
  autralian32:kangourou
  kikoo69:totolitoto
  monuser:monpass
  
__ http://php.net/manual/fr/function.crypt.php
  
.. nextslide::

Exemple avec cryptage : 

.. code-block:: none
  
  autralian32:$1$nRSP5U.A$e8FqI6QTq/Bp6lNMjBUMO1
  kikoo69:$1$riMIdCaV$6GO24RT5v4iwrSzChZq720
  monuser:$apr1$MWZtd0xs$mRBeIn.alFLzJZe4.r07U1
  
.. tip::

  Comme il est possible de manipuler des fichiers en PHP, il est aussi possible d'écrire les fichiers de contrôle d'accès directement depuis PHP.
  
  Par exemple, un formulaire accessible seulement par l'administrateur pourrait permettre d'ajouter de nouveaux utilisateurs.
  
.. TODO::
  
  htaccess ...


  
  Les expressions régulières

		  
  Programmation Orientée Objet
 

  Gestion des exceptions


  Architecture MVC
  




