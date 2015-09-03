
.. _php_avance:

========================== 
Utilisation Avancée de PHP
==========================

Afficher les erreurs
--------------------

Il est possible d'utiliser PHP en mode débogage lors de la phase de conception de vos scripts.

Pour cela, deux fonctions doivent être appelées dans le script :

.. code-block:: php

  <?php 
   ini_set(’display_errors’,’1’) ;
   error_reporting(E_ALL) ;
   ... // instructions du script
  ?>

.. tip::

   Il est aussi possible de configurer l'affichage des erreurs dans le fichier de configuration ``php.ini``
  

Redirection
-----------

PHP permet de rediriger l'utilisateur d'une page à une autre grâce à la fonction ``header()``. Exemple :

.. code-block:: php

  <?php
   header('Location: urlDeRedirection.php?parametres');
   exit ();
  ?>

.. tip::
  
  Il est possible de rediriger vers une page via une URL relative ou une URL externe. On peut même faire une redirection vers la même page mais avec des paramètres différents !
  
.. warning::

  La fonction ``header()`` doit être exécutée avant toute écriture de texte.


Sécuriser des pages PHP
+++++++++++++++++++++++

Contrôle d'accès sur serveur Apache
-----------------------------------

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
````````````````````````

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
````````````````````````

Le fichier ``.htpasswd`` se compose de lignes suivant le format : ``login:mot_de_passe_crypté``.

Il est possible d'afficher les mots de passe en clair. Mais ils sont alors visibles pour qui à les droits de lecture sur le serveur.

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
  

.. _envoi_fichiers:
  
Envoyer des fichiers 
++++++++++++++++++++

Grâce à PHP, il est possible pour l'utilisateur de transmettre un fichier au serveur par l'intermédiaire des formulaires.

Au moment de l'envoi du formulaire (soumission via ``submit``); le fichier est téléchargé par le serveur (on parle d'un "upload" côté client).

Le serveur peut ensuite manipuler le fichier puis l'enregistrer.

Formulaire d'envoi de fichier
-----------------------------

Il est possible, dans les formulaires HTML, de définir un champ de type fichier (``<input type="file" />``) permettant de transmettre des fichiers au serveur.

Le formulaire devra simplement comporter l'attribut d'encodage indiquant l'envoi de fichier(s).

Exemple :

.. code-block:: html

  <form action="traitement.php" method="post"
        enctype="multipart/form-data">
        ...
  <input type="hidden"
    name="MAX_FILE_SIZE" value="1048576" />
  <input type="file" name="fichier" />
  ...
  </form>

.. note::

  Du fait du format et du volume des données, l'envoi de fichiers n'est possible qu'en ``Post``.
  
  Le champ ``<input type="hidden" />`` permet de spécifier une taille maximale de fichier.


Sauvegarder un fichier sur le serveur
-------------------------------------

Les fichiers envoyés depuis un formulaires sont stockées dans une variable différente de ``$_GET`` ou ``$_POST``: il s'agit de la variable ``$_FILES``

Les fichiers sont stockés sous la forme d'un tableau à deux dimensions. L'accès fichier par fichier se fait en utilisant la valeur de l'attribut ``name`` définit dans le formulaire.

Exemple : 

================================= ==================================================
Variable Signification             Signification
================================= ==================================================
 $_FILES['fichier']['name']        Nom du fichier envoyé
 $_FILES['fichier']['type']        Type du fichier (ex: image/png)
 $_FILES['fichier']['size']        Taille du fichier en octets
 $_FILES['fichier']['tmp_name']    Emplacement temporaire du fichier sur le serveur
 $_FILES['fichier']['error']       Code d'erreur (0 si pas d'erreur)
================================= ==================================================

Vérifier le fichier reçu
------------------------

Généralement, côté serveur, le type de fichier attendu ainsi que sa taille limite sont établis à priori.
Exemple de script PHP permettant d'effectuer toutes ces vérifications :

.. code-block:: php
  
  <?php
   if (isset($_FILES['fichier'])
    AND $_FILES['fichier']['error'] == 0
    AND $_FILES['fichier']['size'] <= 1048576) {  // 1Mo 
     $infosfichier = pathinfo($_FILES['fichier']['name']);
     $ext_upload = $infosfichier['extension'];
     $ext_autorisees = array('jpg', 'jpeg', 'gif', 'png');
     if (in_array($ext_upload, $ext_autorisees)) {
      move_uploaded_file($_FILES['fichier']['tmp_name'],
       'destination/' . basename($_FILES['fichier']['name']));
     }
    }
   ?>

.. note::

  N'hésitez pas à consulter la documentation PHP pour les fonctions `pathinfo()`__ et `move_uploaded_file()`__.
  
__ http://php.net/manual/fr/function.pathinfo.php
__ http://php.net/manual/fr/function.move-uploaded-file.php

.. _exo_fichierform:

Exercice
--------

#. Reprenez les pages de l'`exercice précédent<exo_ecriture>`:ref: sur le formulaire d'ajout de pizza.
#. Ajoutez un champ permettant d'ajouter une image (spécifiez que cela constitue une action optionnelle).
#. Limitez la taille de l'envoi à 2 Mo, et aux formats .png et .jpg.
#. Enregistrez l'image (si envoyée) dans un dossier "./images/pizzas/" avec pour nom, le nom de la pizza en minuscules (indice : fonction `strtolower()`__).
#. Pour aller plus loin : reprendre la page de commande de pizza et ajouter une colonne dans le tableau où sera affichée l'image de chaque pizza (si diponible).

__ http://php.net/manual/en/function.strtolower.php


.. _variables_superglobales:

Les variables superglobales
===========================

Liste des variables superglobales
+++++++++++++++++++++++++++++++++

Les variables superglobales sont des variables créées et instantiées par PHP.

Parmi les variables superglobales, on retrouve :

* ``$_GET`` : données envoyées en paramètres dans l'URL
* ``$_POST`` : données envoyées dans la requête HTTP
* ``$_FILES`` : fichiers envoyés par un formulaire
* ``$_SERVER`` : variables d'exécution du serveur
* ``$_ENV`` : variables d'environnement du serveur
* ``$_SESSION`` : variables de session
* ``$_COOKIE`` : valeurs des cookies enregistrés sur le client

.. note::

  Un exemple utile de variable serveur : ``$SERVER['REMOTE_ADDR']`` contient l'adresse IP du client qui cherche à consulter la page.

.. _sessions:
  
Les sessions
++++++++++++

L'intérêt des sessions est de pouvoir manipuler dans une variable de page en page.

Les variables de type session sont conçues pour garder en mémoire des informations relatives au client.

Fonctionnement des sessions :

#. Création d'une session.
#. Création des variables session.
#. Manipulation des variables.
#. Fermeture de la session.

.. note::

  La fermeture de la session peut être explicitement demandée où s'exécute automatiquement à la fermeture du navigateur, ou après un **délai d'expiration** ("timeout").


Création d'une session
----------------------

La variable session ``$_SESSION`` est accessible n'importe où dans le code à condition qu'on aie préalablement fait appel à la fonction ``session_start()``.
Les variables de session s'instancient comme des champs du tableau associatif ``$_SESSION``. Exemple :

.. code-block:: php

  <?php
    session_start();
    ...
    $_SESSION['champ1'] = 'Valeur1';
    $_SESSION['champ2'] = valeur2;
  ?>
  
.. warning::

  La fonction ``session_start()`` doit être appellée sur chacune des pages avant toute écriture de code HTML.
  
Utilisation des variables de session
------------------------------------

Toutes les variables de session qui ont prélablement été intitialisées dans des pages consultées par le client sont accessibles sur les autres pages.
Il suffit de faire appel à la fonction de démarrage de la session.

Exemple :


.. code-block:: php

  <?php
    session_start();
    ...
    echo $_SESSION['champ1'];
  ?>
  
.. tip::

  Les variables de session sont utiles en complément d'un système d'authentification, afin de stocker des informations de connexion de l'utilisateur.
  
Fermeture d'une session
-----------------------

La variable ``$_SESSION`` est automatiquement détruite après un délai d'expiration, ou à la fermeture du client.

Dans certains cas, il est nécessaire de fermer la session depuis le code (c'est le cas par exemple d'un bouton "Déconnexion" pour des pages à accès restreints).

La fermeture de la session s'effectue comme suit :

.. code-block:: php

  <?php
    ...
    session_destroy();
  ?>


.. _exo_sessions:
  
Exercice
--------

#. Reprenez les pages de l'`exercice précédent<exo_fichierform>`:ref: sur le formulaire d'ajout de pizza.
#. Créez une page d'authentification "authentification.php" qui affiche un formulaire avec un champ "login" et un champ "mot de passe" dont la cible est le formulaire d'ajout de pizza.
#. Grâce aux sessions, réalisez un mini-contrôle d'accès à la page d'ajout aux seuls utilisateurs connectés (indiquez le login et mot de passe attendu en dur dans la page "authentification.php").
#. Pour aller plus loin: grâce aux fonctions d'inclusion, s'assurer que l'on demande systématiquement les informations d'authentification lorsque l'on souhaite accèder à la page d'ajout, sauf si elles ont déjà été renseignées (et donc stockées dans des variables de session).


Les cookies
+++++++++++

Contrairement aux sessions où les données sont stockées côté serveur, les cookies sont des fichiers qui contiennent des donénes et sont enregistrés côté client.

L'utilité des cookies est de sauvegarder des données relatives au client et dont la portée dépasse celle des sessions.

L'utilisation des cookies se fait en deux temps :

#. Création et enregistrement du cookie
#. Consultation des données contenues dans le cookie

Création d'un cookie
--------------------

Pour créer un cookie, il suffit d'utiliser la fonction

``setcookie($name, $value, $expire, $path, $domain, $secure, $httponly)`` (voir la `documentation`__) dont les paramètres sont :

* ``$name`` : le nom du cookie
* ``$value`` : sa valeur
* ``$expire`` : le délai d'expiration (timestamp Unix)
* ``$path`` : la portée du cookie (par défaut, toutes les pages)
* ``$domain`` : le domaine où le cookie est accessible
* ``$secure`` : indique si le protocole HTTPS est obligatoire
* ``$httponly`` : limite l'accès au protocole HTTP

__ http://php.net/manual/fr/function.setcookie.php

Exemple
```````

Création d'un cookie (qui expire au bout d'une heure): 

.. code-block:: php

  <?php
     setcookie("NomDuCookie",
               'valeurDuCookie',
               time()+3600,
               null,
         null,
         false,
         true );
  ?>

.. warning::

  Le mode "httponly" permet de s'assurer qu'aucun script (JavaScript) ne modifie le cookie.
  
.. note::
  
  Pour modifier un cookie existant, il suffit de faire appel à la même fonction, avec un nom de cookie existant.
  
  
Affichage d'un cookie
---------------------

Les données stockées dans un cookie sont accessibles dans la variable superglobale ``$_COOKIE`` qui est un tableau associatif dont les clés correspondent aux noms des cookies enregistrés.

Exemple :

.. code-block:: php

  <?php
   ...
   echo $_COOKIE['NomDuCookie'];
  ?>

.. warning::

  Contrairement aux variables de session, les données des variables des cookies peuvent avoir été modifiées par l'utilisateur.
  Il faut donc leur appliquer un contrôle très strict.


.. _exo_cookies:
  
Exercice
--------

#. Reprenez votre `exercice sur les sessions<exo_sessions>`:ref:.
#. Créez un cookie pour sauvegarder la date de la dernière connexion de l'utilisateur sous la forme d'un timestamp (indice : fonction `time()`__).
#. Afficher cette date au format "Dernière connexion le JJ/MM/AAAA à HH:mm" sur la page d'ajout de pizza (indice : fonction `date()`__).

__ http://php.net/manual/fr/function.time.php
__ http://php.net/manual/fr/function.date.php


.. _manipulation_fichiers:
  
Lire et écrire dans un fichier
==============================

Ouvrir et lire un fichier
+++++++++++++++++++++++++

PHP embarque des fonctions très utiles pour ouvrir `fopen()`__, lire `fgetc()`__/`fgets()`__ et fermer `fclose()`__ un fichier.

Le protocole de lecture est en trois étapes :

#. Ouverture du fichier
#. Lecture
#. Fermeture

.. warning:: 

  Lors de l'ouverture avec ``fopen()``, PHP bloque l'accès au fichier tant que la fonction ``fclose()`` n'est pas appellée.

__ http://php.net/manual/fr/function.fopen.php
__ http://php.net/manual/fr/function.fgetc.php
__ http://php.net/manual/fr/function.fgets.php
__ http://php.net/manual/fr/function.fclose.php

.. nextslide::

Exemple de lecture ligne par ligne :

.. code-block:: php

  <?php
   $fichier = fopen('fichier.txt', 'r');
   if($fichier != NULL){
    $ligne = fgets($fichier);
    while($ligne){
   ... // traitement de la ligne
   $ligne = fgets($fichier);
    }
    fclose($fichier);
   }
  ?>

.. note:: 

  Le 'r' signifie que le fichier est ouvert en lecture. Voir la `documentation`__ pour les autres modes.
  
__ http://php.net/manual/fr/function.fopen.php
  
Ecrire dans un fichier
++++++++++++++++++++++

Pour écrire dans un fichier, il est utile de savoir modifier le curseur. Il indique la position courante de la lecture/écriture dans le fichier.

Le curseur se déplace avec la fonction `fseek()`__ et l'écriture est réalisée par `fputs()`__.

La fonction ``fseek()`` ne fonctionne qu'avec le mode d'écriture 'r+' ou 'w'. Dans le cas du mode 'a+' (lecture seule + pas d'écrasement), les nouvelles données seront toujours écrites à la fin.

__ http://php.net/manual/fr/function.fseek.php
__ http://php.net/manual/fr/function.fputs.php

Exemple d'écriture au début du fichier :

.. code-block:: php

  <?php
   $fichier = fopen('fichier.txt', 'r+');
   if($fichier != NULL){
    fseek($fichier, 0);
  fputs($fichier, 'nouvelles données');
    fclose($fichier);
   }
  ?>

  
.. _exo_donnees_fichiers:   

Exercice
++++++++

#. Reprenez votre `exercice ultérieur<exo_jointure>`:ref: avec la BDD incluant la table de jointure.
#. Téléchargez le fichier `pizzas.txt`__ et enregistrez le dans un dossier du serveur.
#. Créez une page protégée "maj_bdd.php" permettant de mettre à jour les données de la base depuis le fichier externe fourni (indice : utilisez les expressions régulières pour découper le fichier).
#. Pour aller plus loin : créez une page "générer_menu.php" qui permet d'extraire toutes les pizzas de la BDD et de les enregistrer dans un fichier téléchargé au chargement de la page sous le format "Pizza (prix €) : Ingrédients, ...".

__ _static/donnees/exercices/pizzas.txt



Les expressions régulières
++++++++++++++++++++++++++

A venir.
      
Programmation Orientée Objet
++++++++++++++++++++++++++++
 
A venir.
 
Gestion des exceptions
----------------------

A venir.

Architecture MVC
++++++++++++++++
  
A venir.
