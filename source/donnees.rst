:tocdepth: 2

==========================
 Manipulation des données
==========================

Transmettre des données via des formulaires
===========================================

Les méthodes d'envoi
++++++++++++++++++++

En HTML, la balise ``<form>`` spécifie la méthode d'envoi des données :

* **Get** : les données sont passées via l’URL (défaut)
* **Post** : les données sont passées dans la requête HTTP/HTTPS

.. tip::

  Comment choisir la méthode d'envoi ?

    La méthode **Get** doit être employée lorsque les données ne sont pas trop volumineuses, et surtout lorsque le traitement des données n’a pas d’effet de bord.
    Dans tous les autres cas, la méthode **Post** doit être préférée.

Transmettre des données par l'URL
+++++++++++++++++++++++++++++++++

La méthode d'envoi Get est celle utilisée par défaut lorqu'on utilise les formulaires sans préciser la méthode :

.. code-block:: html

  <form action="traitement.php">
     ...
  </form>

Cette écriture est exactement équivalente à :

.. code-block:: html

  <form action="traitement.php" method="get">
     ...
  </form>


Envoi des données par URL
-------------------------

Les données du formulaire qui sont passées dans l'URL s'écrivent sous la forme :


.. raw:: html

    <p><font color="green">http://www.site.com/page.php?</font><font color="red">param1</font><font color="green">=</font><font color="blue">valeur1</font><font color="green">&</font><font color="red">param2</font><font color="green">=</font><font color="blue">valeur2</font>...</p>
    </br>

.. raw:: html

    <p>Le caractère <font color="green">?</font> sépare le nom de la page des paramètres.</p>
    <p>Chacun des couples paramètre/valeur s'écrivent sous la forme : <font color="red">nom</font><font color="green">=</font><font color="blue">valeur</font> et sont séparés les uns des autres par le symbole <font color="green">&</font>.</p>
	
	
.. note::

	Le nom des paramètres correspond à la valeur de l'attribut ``@name`` définit dans chaque balise ``<input>``.
	
	La valeur des paramètres correspond à la valeur de l'attribut ``@value`` s'il est définit, ou au texte saisi par l'utilisateur (dans un champ texte par exemple).
	
	
Traitement des données reçues dans une URL
------------------------------------------

Côté serveur (en PHP, donc), les valeurs passées dans l'URL sont stockées dans un tableau associatif ``$_GET`` : 

Exemple (avec l'URL précédente) :

.. code-block:: php

  <?php
    $valeur = $_GET[’param1’]; // contient valeur1
  ?>

.. warning::
	
  Comme les paramètres et leurs valeurs sont intégrés dans l'URL, ils sont directement modifiables.
  
  Il est donc très important de tester si les données reçues sont celles attendues (mauvais type, données manquantes ...).

  
Contrôler la valeur des paramètres
`````````````````````````````````` 

Lorsque des données transitent par l'URL, il faut s'assurer que les **valeurs correspondent au type attentdu**.
Dans le cas contraire, PHP permet de convertir les valeurs d'un type à un autre.

De plus, il est possible que certains paramètres attendus dans le code PHP soient absents de l'URL, dans ce cas
il est possible de **tester leur présence** avec la fonction ``isset``.

.. nextslide::

Exemple :

.. code-block:: php

  <?php
  if (isset($_GET['param1']) AND isset($_GET['param2'])) {
	$valeur1 = (int) $_GET['param1'];
	$valeur2 = (int) $_GET['param2'];
	... // code à exécuter si tous les paramètres sont présents
  } else {
	...
	// code à exécuter par défaut
  }
  ?>

.. _exo_get: 
 
Exercice
````````
  
#. Reprenez votre script `de l'exercice sur les boucles <exo_for>`:ref:.
#. Permettre d'adapter le nombre de "Hello World!" affichés en fonction de la valeur de la variable ``nb_hello`` passée en paramètre de l'URL.
#. Améliorez votre script vous assurant que l'affichage des "Hello World !" soit limité à 100 occurences, et qu'une valeur négative ou nulle de ``nb_hello`` n'aie pas d'incidence sur le script.
#. Ajoutez un numéro de ligne toutes les 10 lignes et alternez les couleurs une ligne sur deux (utiliser une feuille de style CSS !).
#. Assurez vous que la valeur transmise soit bien de type entier (soit par conversion, ou mieux, avec la ``is_int`` (`documentation`__). 


__ http://php.net/manual/fr/function.is-int.php
  
Transmettre des données dans une requête
++++++++++++++++++++++++++++++++++++++++

La méthode d'envoi Post doit être spécifiée dans le formulaire si l'on souhaite transmettre des données dans une requête :

.. code-block:: html

  <form action="traitement.php" method="post">
     ...
  </form>

Dans ce cas, les paramètres et leurs valeurs envoyés ne seront plus visibles dans l'URL.


Traitement des données reçues en Post
-------------------------------------

Les valeurs transmises par la méthode Post sont stockées dans la variable ``$_POST``. Les données sont stockées de la même manière que dans la variable ``$_GET``.

.. warning::
	
  Même si les paramètres et leurs valeurs sont transmises sans apparaître dans l'URL, il est tout de même possible d'envoyer des valeurs inattendues (par exemple, en modifiant une copie du code HTML du formulaire).
  Il est d'autant plus important de contrôler les données reçues que les données envoyées en Post peuvent contenir des chaînes de caractères conséquentes (et pourquoi pas, du code HTML ou JavaScript !).


Aller plus loin dans le contrôle des paramètres
```````````````````````````````````````````````

En plus de vérifier le type et la présence des paramètres, le traitement des chaînes de caractères doit comprendre une conversion pour **éviter que le texte puisse être interprété comme du code** HTML (ou JavaScript).

Il existe des fonctions PHP conçues à cet effet : ``htmlspecialchars`` (`documentation`__) et ``htmlentities`` (`documentation`__). Elles permettent de convertir les caractères spéciaux en entités HTML. Exemple : 

__ http://php.net/manual/fr/function.htmlspecialchars.php
__ http://php.net/manual/fr/function.htmlentities.php

.. code-block:: php
  
  <?php
	$value = ( isset($_POST['variable']) ) ?
             htmlspecialchars($_POST['variable']) : "";
	if((strlen($value) > 0) && (strlen($value) < 50)){
	 ... //
	}
  ?>

.. _exo_post:
  
Exercice
````````

#. Téléchargez `l'archive`__ contenant des pages permettant de commander des pizzas en ligne.
#. Créez une page nommée "prix.php" contenant un tableau simple dont chaque élément est un tableau clé-valeur comprenant les clés "pizza", "ingredients" et "prix". 
#. Modifiez la page PHP du formulaire pour inclure le tableau et mettre à jour la liste des pizzas depuis les valeurs du tableau.
#. Modifiez la page "recap_commande.php" qui sera la cible du formulaire et affichera un récapitulatif de la commande sous la forme d'un tableau, avec calcul du total (aidez-vous des fonctions définies dans un `précédent exercice<exo_include>`:ref:).
#. En utilisant les fonction d'inclusion, faire en sorte que l'utilisateur reste en permanence sur la page principale et adaptez son contenu en fonction des données transmises (ou l'absence de données transmises).

Voir le `résultat`__.

__ _static/donnees/exercices/pizza.zip
__ _static/donnees/corrections/pizza/
  


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

Généralement, côté serveur, le type de fichier attendu est établi à priori et on préfère limiter la taille des fichiers.
Exemple de script PHP permettant d'effectuer toutes ces vérifications :

.. code-block:: php
  
  <?php
   if (isset($_FILES['fichier'])
    AND $_FILES['fichier']['error'] == 0)
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
Les variables de session s'instantient comme des champs du tableau associatif ``$_SESSION``. Exemple :

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

#. Reprenez les pages de l'`exercice précédent<exo_ecriture>`:ref: sur le formulaire d'ajout de pizza.
#. Créez une page d'authentification "authentification.php" qui affiche un formulaire avec un champ "login" et un champ "mot de passe" dont la cible est le formulaire d'ajout de pizza.
#. Grâce aux sessions, réalisez un mini-contrôle d'accès à la page d'ajout aux seuls utilisateurs connectés (indiquez le login et mot de passe attendu en dur dans la page "authentification.php").
#. Pour aller plus loin, grâce aux fonctions d'inclusion, s'assurer que l'on demande systématiquement les informations d'authentification lorsque l'on souhaite accèder à la page d'ajout, sauf si elles ont déjà été renseignées (et donc stockées dans des variables de session).


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

  
Lire et écrire dans un fichier
==============================

.. TODO::
	
	Exercice depuis le formulaire des pizzas amélioré avec BDD : donner un fichier texte très complet avec plein de pizzas.
	L'étudiant doit lire le fichier, récupérer les données et les enregistrer dans une base de données
