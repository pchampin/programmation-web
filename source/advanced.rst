.. _php_avance:

========================== 
Utilisation Avancée de PHP
==========================

Fonctionnalités
==========================

Afficher les erreurs
++++++++++++++++++++++++++

Il est possible d'utiliser PHP en mode débogage lors de la phase de conception de vos scripts.

Pour cela, deux fonctions doivent être appelées dans le script :

.. code-block:: php

  <?php 
   ini_set('display_errors', '1') ;
   error_reporting(E_ALL) ;
   ... // instructions du script
  ?>

.. note::

   Il est aussi possible de configurer l'affichage des erreurs dans le fichier de configuration ``php.ini`` (nécessite d'être root)

Redirection
+++++++++++

Les codes de statut HTTP **301** et **302** permettent de faire une redirection, respectivement permanente ou temporaire. L'URL vers laquelle rediriger se trouve dans l'en-tête HTTP ``Location``.

.. tip::

  Essayez : ``curl -v http://www.google.com``

.. nextslide::

Nous avons vu que PHP permettait de redéfinir ou d'ajouter des en-têtes à la réponse HTTP.

.. code-block:: php

  <?php
   // Il ne doit y avoir aucune sortie avant ces lignes
   http_response_code(302); // temporaire ; ou 301 = permanente
   header('Location: urlDeRedirection.php?parametres');
   exit();
  ?>

.. note::
  
  Il est possible de rediriger vers une page via une URL relative ou une URL externe. On peut même faire une redirection vers la même page mais avec des paramètres différents !

Sécuriser des pages PHP
+++++++++++++++++++++++

Contrôle d'accès sur serveur Apache
-----------------------------------

Nécessité de séparer public/privé (admin, ...), plusieurs possibilités:

* Sessions PHP (vu plus tard dans le cours)
* Contrôle d'accès côté serveur 

  * limiter l'accès à certains fichiers aux seuls utilisateurs autorisés

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

Au moment de l'envoi du formulaire (soumission via ``submit``), le fichier est téléchargé par le serveur (on parle d'un "upload" côté client).

Le serveur peut ensuite manipuler le fichier puis l'enregistrer.

Formulaire d'envoi de fichier
-----------------------------

Il est possible, dans les formulaires HTML, de définir un champ de type fichier (``<input type="file" />``) permettant de transmettre des fichiers au serveur.

Le formulaire devra simplement comporter l'attribut d'encodage indiquant l'envoi de fichier(s).

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

================================= ==================================================
Variable                          Signification
================================= ==================================================
 $_FILES['fichier']['name']        Nom du fichier envoyé
 $_FILES['fichier']['type']        Type du fichier (ex: image/png)
 $_FILES['fichier']['size']        Taille du fichier en octets
 $_FILES['fichier']['tmp_name']    Emplacement temporaire du fichier sur le serveur
 $_FILES['fichier']['error']       Code d'erreur (0 si pas d'erreur)
================================= ==================================================

Vérifier le fichier reçu
------------------------

Généralement, côté serveur, le type de fichier attendu ainsi que sa taille limite sont connus à priori.
Exemple de script PHP permettant d'effectuer toutes ces vérifications :

.. code-block:: php
  
  <?php
   if (isset($_FILES['fichier']) &&
       $_FILES['fichier']['error'] == 0 &&
       $_FILES['fichier']['size'] <= 1 * 1024 * 1024)
   {
     $infosfichier = pathinfo($_FILES['fichier']['name']);
     $ext_upload = $infosfichier['extension'];
     if (in_array($ext_upload, array('jpg', 'gif', 'png')))
     {
       move_uploaded_file(
         $_FILES['fichier']['tmp_name'],
         'uploads/'.basename($_FILES['fichier']['name'])
       );
     }
   }
  ?>

.. nextslide::

.. warning::

  La taille du fichier est à vérifier côté serveur, puisque le ``<input type="hidden" />`` est modifiable par le client 
  (il ne sert qu'à la pré-validation par le navigateur)

.. note::

  N'hésitez pas à consulter la documentation PHP pour les fonctions `pathinfo()`__ et `move_uploaded_file()`__.
  
__ http://php.net/manual/fr/function.pathinfo.php
__ http://php.net/manual/fr/function.move-uploaded-file.php

.. _cookies:

Les cookies
+++++++++++

Les cookies sont des données enregistrées côté client.

L'utilité des cookies est de sauvegarder des données relatives au client, comme la langue qu'il a choisi.

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
     setcookie(
        'NomDuCookie',
        'valeurDuCookie',
        time() + 3600,
        null,
        null,
        false,
        true
     );
  ?>
 
.. note::
  
  Pour modifier un cookie existant, il suffit de faire appel à la même fonction, avec un nom de cookie existant. La date d'expiration est mise à jour.

.. note::

  En vous aidant des outils pour développeur (ou de curl), regardez à quoi ressemble la réponse HTTP.
  
  
Affichage d'un cookie
---------------------

Les données stockées dans un cookie sont accessibles dans la variable superglobale ``$_COOKIE`` qui est un tableau associatif dont les clés correspondent aux noms des cookies enregistrés.

Exemple :

.. code-block:: php

  <?php
   ...
   echo $_COOKIE['NomDuCookie'];
  ?>

.. note::

  En vous aidant des outils pour développeur, regardez à quoi ressemble la requête HTTP. Avec curl, on peut utiliser l'option ``--cookie NomDuCookie=valeur`` pour simuler un cookie.

.. warning::

  Les données des cookies proviennent de l'utilisateur (cf. curl), il faut donc les contrôler.

.. _sessions:
  
Les sessions
++++++++++++

L'intérêt des sessions est de pouvoir manipuler dans une variable de page en page.
Les variables de type session sont conçues pour garder en mémoire des informations relatives au client.

Une session est une sorte de "boite" spécifique à un visiteur donné et contenant des variables.

Contrairement aux cookies, les variables de session sont stockées côté serveur et ne sont donc pas directement accessibles au client. HTTP étant un protocole state-less, un unique cookie contient l'identifiant de l'utilisateur, et permet à PHP de retrouver sa "boite" de page en page.

.. note::
    L'identifiant est stocké en cookie, il est donc accessible à l'utilisateur. Cependant, il est aléatoire et suffisemment grand pour être considéré indevinable par un éventuel imposteur. Attention cependant à ne pas se le faire voler (ordinateur non verrouillé, réseau Wi-Fi non crypté comme McDo ou Eduspot)...

.. nextslide::

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
    $_SESSION['champ1'] = 'chaine';
    $_SESSION['champ2'] = 42;
  ?>
  
.. warning::

  ``session_start()``  doit être appellée avant toute sortie.
  
Utilisation des variables de session
------------------------------------

Toutes les variables de session qui ont prélablement été intitialisées dans des pages consultées par le client sont accessibles sur les autres pages.
Il suffit de faire appel à la fonction de démarrage de la session.

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

Dans certains cas, il est nécessaire de fermer la session depuis le code (c'est le cas par exemple d'un bouton "Déconnexion" pour des pages à accès restreint).

La fermeture de la session s'effectue comme suit :

.. code-block:: php

  <?php
    ...
    session_destroy();
  ?>

.. _variables_superglobales:

Récapitulatif : Les variables superglobales
+++++++++++++++++++++++++++++++++++++++++++

Liste des variables superglobales
---------------------------------

Les variables superglobales sont des variables créées et instantiées par PHP.

Parmi les variables superglobales, on retrouve :

* ``$_GET`` : données envoyées en paramètres dans l'URL
* ``$_POST`` : données envoyées dans la requête HTTP
* ``$_FILES`` : fichiers envoyés par un formulaire
* ``$_SERVER`` : variables d'exécution du serveur
* ``$_ENV`` : variables d'environnement du serveur
* ``$_SESSION`` : variables de session
* ``$_COOKIE`` : valeurs des cookies enregistrés sur le client

.. nextslide::

.. note::

  Un exemple utile de variable serveur : ``$_SERVER['REMOTE_ADDR']`` contient l'adresse IP du client qui cherche à consulter la page.

.. warning::

  ``$_GET``, ``$_POST``, ``$_COOKIE`` et certaines variables de ``$_SERVER`` comme ``$_SERVER['HTTP_REFERER']`` proviennent de l'utilisateur, il faut donc **absolument** les contrôler.

.. _manipulation_fichiers:
  
Lire et écrire dans un fichier
++++++++++++++++++++++++++++++

Ouvrir et lire un fichier
-------------------------

PHP embarque des fonctions très utiles pour ouvrir `fopen()`__, lire `fgetc()`__/`fgets()`__ et fermer `fclose()`__ un fichier.

Le protocole de lecture est en trois étapes :

#. Ouverture du fichier
#. Lecture
#. Fermeture

.. warning:: 

  Lors de l'ouverture avec ``fopen()``, PHP bloque l'accès au fichier aux autres tant qu'il n'est pas libéré par ``fclose()``.

__ http://php.net/manual/fr/function.fopen.php
__ http://php.net/manual/fr/function.fgetc.php
__ http://php.net/manual/fr/function.fgets.php
__ http://php.net/manual/fr/function.fclose.php

.. nextslide::

Exemple de lecture ligne par ligne :

.. code-block:: php

  <?php
   $fichier = fopen('fichier.txt', 'r'); // en lecture seule
   if ($fichier != NULL)
   {
     $ligne = fgets($fichier);
     while($ligne)
     {
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
----------------------

Pour écrire dans un fichier, il est utile de savoir modifier le curseur. Il indique la position courante de la lecture/écriture dans le fichier.

Le curseur se déplace avec la fonction `fseek()`__ et l'écriture est réalisée par `fputs()`__.

La fonction ``fseek()`` ne fonctionne qu'avec le mode d'écriture 'r+' ou 'w'. Dans le cas du mode 'a+' (lecture seule + pas d'écrasement), les nouvelles données seront toujours écrites à la fin.

__ http://php.net/manual/fr/function.fseek.php
__ http://php.net/manual/fr/function.fputs.php

.. nextslide::

Exemple d'écriture au début du fichier :

.. code-block:: php

  <?php
   $fichier = fopen('fichier.txt', 'r+');
   if ($fichier != NULL)
   {
     fseek($fichier, 0);
     fputs($fichier, 'nouvelles données');
     fclose($fichier);
   }
  ?>

Bonnes pratiques
================

Guard Clauses
+++++++++++++

.. code-block:: php

  <?php
    // Peu lisible...
    function check($input)
    {
      if (condition1($input))
      {
        if (condition2($input))
          return calcul($input);
        else
          return 2;
      }
      else
        return 1;
    }
  ?>

.. nextslide::

.. code-block:: php

  <?php
    // Plus lisible !
    function check($input)
    {
      if (!condition1($input))
        return 1;
      if (!condition2($input))
        return 2;
      return calcul($input);
    }
  ?>

`En savoir plus`__

... (`et si la valeur de retour est la même`__) ...

__ https://refactoring.com/catalog/replaceNestedConditionalWithGuardClauses.html
__ https://refactoring.com/catalog/consolidateConditionalExpression.html

Projet
======

v2.0
++++
   
On veut permettre aux utilisateurs loggés de voter pour un film.
   
1. Ajoutez une table User à la base de données:
  
   * user (id, login, pwd, email).

   * Implémentez un système de connexion (une page Inscription, une page Connexion)

   * Vous utiliserez les sessions pour stocker les informations de connexion

2. Ajouter une table Vote (table d'association : movie_id, user_id).

   * Ajouter une page permettant à un utilisateur loggé de voter pour un film

   * Ajouter le nombre de votes dans le détail d'un film

#. Bonus : hash du mot de passe, vérif syntaxe e-mail...
