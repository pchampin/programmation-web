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
  
Transmettre des données dans une requète
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
  

.. TODO::
  
  Envoyer des fichiers (http://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql/transmettre-des-donnees-avec-les-formulaires#2481477)
  

  

  
Créer et manipuler les sessions
================================

.. TODO::
  
  Gestion des sessions : http://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql/variables-superglobales-sessions-et-cookies

Lire et écrire dans un fichier
==============================

.. TODO::
	
	Exercice depuis le formulaire des pizzas amélioré avec BDD : donner un fichier texte très complet avec plein de pizzas.
	L'étudiant doit lire le fichier, récupérer les données et les enregistrer dans une base de données
