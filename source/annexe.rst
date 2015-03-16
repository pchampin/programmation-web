:tocdepth: 2

==============================
 Annexe technique : IUT Lyon1
==============================


Héberger des pages Web sur le serveur de l'IUT
==============================================

Votre répertoire personnel
++++++++++++++++++++++++++

Vous disposez d'un répertoire spécial dans votre répertoire personnel nommé "public_html".

Toutes les pages Web qui s'y trouvent sont visibles à l'adresse :

http://iutdoua-webetu.univ-lyon1.fr/~votrelogin

où ``votrelogin`` correspond à votre identifiant étudiant (pxxxxxxx).


Accéder à votre répertoire en FTP
---------------------------------

Si vous souhaitez modifier les fichiers présents dans votre espace personnel depuis l'extérieur, il est possible de se connecter au serveur de l'IUT en suivant le protocole FTP.

Les paramètres de connexion sont les suivants :

* Hôte : iutdoua-samba.univ-lyon1.fr
* Port : 990
* Protocole : FTP - Protocole de Transfert de Fichiers
* Chiffrement : Connexion FTP explicite sur TLS

Vous pouvez utiliser un outil comme `FileZilla`__ pour envoyer des fichiers en FTP.

__ https://filezilla-project.org/


PhpMyAdmin
++++++++++++++++++++++

Pour accéder à l'interface PhpMyAdmin qui vous permet de gérer votre base de données MySQL sur le serveur de l'IUT, il vous suffit de vous connecter à l'adresse :

http://iutdoua-webetu.univ-lyon1.fr/phpMyAdmin/

Les paramètres de connexion sont les suivants :

* Login : pxxxxxxx
* Mot de passe : habituel, celui de votre messagerie

.. note::

  Pensez à bien paramétrer un mot de passe différent pour vous connecter à vos BDD et à PhpMyAdmin.

  
Utiliser un serveur local pour tester vos pages
===============================================

Environnement de développement pour Apache, MySQL, PHP
++++++++++++++++++++++++++++++++++++++++++++++++++++++

Il existe des logiciels permettant d'émuler le fonctionnement d'un serveur en local (i.e., sur votre machine).

Suivant votre système d'exploitation : 

* `WAMP`__ (Windows) 
* `XAMPP`__ (Linux) 
* `MAMP`__ (Mac OS)

__ http://sourceforge.net/projects/wampserver/
__ http://sourceforge.net/projects/xampp/
__ http://sourceforge.net/projects/mamp/

Utilisation
-----------

Vous pouvez ensuite accéder aux pages HTML et PHP que vous déposez directement dans le répertoire nommé `www` via l'URL : 

http://localhost/

.. note::

  Le port Apache par défaut est le port 80. Si vous le modifiez, l'URL deviendra : 

  http://localhost:port/

PhpMyAdmin est accessible à l'adresse :

http://localhost/phpmyadmin/




