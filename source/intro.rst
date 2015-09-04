:tocdepth: 2

============================
 Le Web : Introduction
============================

Plan du cours
=============

Plan des séances
++++++++++++++++

  * Séance 1 et 2 : 4H

    * Le Web : Rappel / Bases de PHP
  * Séance 3 + 4 : 4h

    * Les bases de données / PHP Object / Projet v1: Site web de films
  * Séance 5 + 6: 4h

    * Design pattern 1 (MVC, MVVM, etc...)

  * Séance 7 et 8 : 4h

    * Design patterns 2 (Autres designs patterns)

  * Séance 9 et 10 : 4h
    
    * PHP Avancé (Sessions, ...) / Protection et sécurité (injection SQL, XSS)

  * Séance 11 et 12 : 4h

    * Etude comparative des frameworks PHP

C'est quoi le Web ?
===================

En quelques mots
++++++++++++++++

* Son vrai nom : World Wide Web
* Assemblage de technologies diverses (standards)
* Une des applications d'Internet (citez en 4 autres)
* Ensemble hyperdocumentaire (réseau de documents) public
* Basé sur HTTP (HyperText Transport Protocol)
* Accès aux documents par leurs adresses (URL)
* Représentation des données pour l'humain (HTML) ou les machines (XML/JSON)

Architecture Client Serveur
+++++++++++++++++++++++++++

- **Ressource** : document, image, video publié sur le Web
- **Serveur** : ordinateur connecté à internet sur lequel se trouve des resources
- **Client** : appareil (ordinateur, tablette,...) utilisé pour acceder à ces ressources

.. figure:: _static/client-server-model.svg
   :height: 200ex

   Source image http://commons.wikimedia.org/wiki/File:Client-server-model.svg

.. note:: Différents rôles : le client initie l'exécution d'une opération fournie par le serveur (!= pair à pair)

Les Technologies
================

.. index:: URL

URLs
++++

* Uniform Resource Locator (`STD 66`_)
* Structure:

.. figure:: _static/url-structure.*
   :width: 80%

   ..

.. _STD 66: http://datatracker.ietf.org/doc/rfc3986/

.. rst-class:: small

  NB: les URLs sont parfois appelés URIs -> Plus générique, URL = URI particulière

.. index:: HTML

HTML
++++

* HyperText Markup Language (`HTML`_)
* Standard de description des documents sur le Web
* Langage statique décrivant la structure des pages
* Peut être combiné avec CSS pour la gestion des styles

.. _HTML: http://www.w3.org/TR/html5/

.. index:: HTTP

HTTP
++++

* HyperText Transfer Protocol (`RFC 2616`_)
* Protocole d'échange de données entre machines
* Utilisé par les clients pour communiquer avec les serveurs

.. _RFC 2616: http://datatracker.ietf.org/doc/rfc2616/

Les Requetes HTTP
-----------------

Une requete HTTP contient :

* Le type d'échange => VERBE HTTP (GET, POST, ...)
* Spécifie l'adresse => URL
* Transmet des informations à propos du client => HEADER
* Transmet éventuellement des données => BODY

Construction d'une requete
++++++++++++++++++++++++++

Une requete est construite comme suit:

.. code-block:: none

  [VERBE] [URL] [PROTOCOLE]
  /* En-tetes */
  [TYPE1]:[VALEUR1]
  [TYPE2]:[VALEUR2]
  ...
  /*Ligne vide*/

  /* Corps de la requete */
  [BODY]

Les Verbes HTTP (1/2)
+++++++++++++++++++++

.. index:: GET
.. index:: POST

* Définissent le type d'échange
* Ont une sémantique propre

  * GET : Récupère une représentation de la ressource
  * HEAD : Récupère seulement l'en-tête de la ressource
  * POST : Création d'une sous-ressource de l'URL spécifiée
  * PUT : Modification de la resource à l'URL spécifiée (warning: si la ressource n'existe pas, elle est crée) (todo)
  * DELETE : Suppression de la ressource


.. rst-class:: small
  
  NB: Une application qui respecte cette sémantique est appellée RESTful (complément : lien todo : pédagogique)

Exemple d'une requete
++++++++++++++++++++++++++

.. code-block:: http

  GET http://www.univ-lyon1.fr HTTP/1.1
  User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64) 
  			Gecko/20100101 Firefox/40.0
  Accept: text/html
  Accept-Language: en-US
  Connection: keep-alive

.. rst-class:: small

  NB:Ces en-têtes contiennent de précieuses informations pour le serveur

Réponse du serveur
++++++++++++++++++

La réponse du serveur à une requête est similaire:

* Statut de réponse
* En-têtes de réponses
* Corps de la réponse

Statut de réponse HTTP
++++++++++++++++++++++

.. index:: Response status

Le statut de réponse HTTP informe du statut de la requete (`Liste des codes`_):

* 1xx : En attente
* 2xx : Succes
* 3xx : Redirection
* 4xx : Acces refusé
* 5xx : Erreur serveur

.. note:: 
  Quelques codes usuels :

  **200** OK, **301** Moved Permanently, **404** Not found, **418** `I’m a teapot`_, **501** Internal error

.. _Liste des codes: https://fr.wikipedia.org/wiki/Liste_des_codes_HTTP
.. _I’m a teapot: https://tools.ietf.org/html/rfc2324

Construction de réponse
+++++++++++++++++++++++

.. code-block:: none

  [PROTOCOLE] [CODE] [SIGNIFICATIOn] 
  /* En-tetes */
  [TYPE1]:[VALEUR1]
  [TYPE2]:[VALEUR2]
  ...
  /*Ligne vide*/

  /* Corps de la requete */
  [BODY]

Exemple de réponse
++++++++++++++++++

.. code-block:: http

  HTTP/1.1 200 OK 
  Content-Type:text/html
  Content-Length:1245 
  Last-Modified:Tue, 04 Aug 2015 10:25:13 GMT

  <html><body> Corps du document ...

Exercice
++++++++++++++++++

Il est possible de voir le détail des requètes dans le navigateur

#. Ouvrez une page web
#. Ouvrez l'interface développeur "Network" de votre navigateur
  
  * Firefox : Ctrl + Maj + Q
  * Chrome : Ctrl + Maj + I
  * IE: Outils > Outils de développement
  * Safari : Ctrl + Alt + I

#. Actualisez la page (F5) et observez les différentes requètes effectuées par le navigateur
