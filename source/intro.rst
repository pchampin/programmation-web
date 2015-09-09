:tocdepth: 2

============================
 Le Web : Introduction
============================

Organisation du cours
======================

Plan des séances
++++++++++++++++

.. rst-class:: small

  * Séance 1 et 2 : 4H

    * Le Web : Rappel / Bases de PHP
  * Séance 3 et 4 : 4h

    * Les bases de données / PHP Object / Projet v1: Site web de films
  * Séance 5 et 6: 4h

    * Design pattern 1 (MVC, MVVM, etc...)

  * Séance 7 et 8 : 4h

    * Design patterns 2 (Autres designs patterns)

  * Séance 9 et 10 : 4h
    
    * PHP Avancé (Sessions, ...) / Protection et sécurité (injection SQL, XSS)

  * Séance 11 et 12 : 4h

    * Étude comparative des frameworks PHP
    
Participation, support et évaluation
+++++++++++++++++++++++++++++++++++++++++++

  * Ce cours est vivant => tous retours bienvenus

  * Contribuer à améliorer le cours est bénéfique pour tous

  * Interrogation sur les savoirs théoriques (tout ce qui est dans le support de cours) et pratiques (exercices)
  
    * Interrogation surprise possible


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

- **Ressource** : document, image, vidéo... publiés sur le Web
- **Serveur** : ordinateur connecté à internet sur lequel se trouvent des ressources
- **Client** : appareil (ordinateur, tablette,...) utilisé pour accéder à ces ressources

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

Les Requêtes HTTP
-----------------

Une requete HTTP contient :

* Le type d'échange => VERBE HTTP (GET, POST, ...)
* Spécifie l'adresse => URL
* Transmet des informations à propos du client => HEADER
* Transmet éventuellement des données => BODY

Construction d'une requête
++++++++++++++++++++++++++

Une requête est construite comme suit:

.. code-block:: none

  [VERBE] [URL] [PROTOCOLE]
  /* En-tetes */
  [TYPE1]:[VALEUR1]
  [TYPE2]:[VALEUR2]
  ...
  /*Ligne vide*/

  /* Corps de la requête */
  [BODY]

Les Verbes HTTP
+++++++++++++++

.. index:: GET
.. index:: POST

* Sémantique définissant le type d'échange

  * GET : Récupère une représentation de la ressource
  * HEAD : Récupère seulement l'en-tête de la ressource
  * POST : Création d'une sous-ressource de l'URL spécifiée
  * PUT : Modification de la ressource à l'URL (warning: création si elle n'existe pas)
  * DELETE : Suppression de la ressource


.. rst-class:: small
  
  NB: Une application qui respecte cette sémantique est appellée RESTful 

  * http://mbaron.developpez.com/soa/rest/
  * http://ruben.verborgh.org/blog/2012/09/27/the-object-resource-impedance-mismatch/

Exemple d'une requête
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

Le statut de réponse HTTP informe du statut de la requête (`Liste des codes`_):

* 1xx : En attente
* 2xx : Succès
* 3xx : Redirection
* 4xx : Accès refusé
* 5xx : Erreur serveur

Quelques codes usuels : 

**200** OK, **301** Moved Permanently, **404** Not found, **418** `I’m a teapot`_, **501** Internal error

.. _Liste des codes: https://fr.wikipedia.org/wiki/Liste_des_codes_HTTP
.. _I’m a teapot: https://tools.ietf.org/html/rfc2324

Construction de réponse
+++++++++++++++++++++++

.. code-block:: none

  [PROTOCOLE] [CODE] [SIGNIFICATION] 
  /* En-tetes */
  [TYPE1]:[VALEUR1]
  [TYPE2]:[VALEUR2]
  ...
  /*Ligne vide*/

  /* Corps de la requête */
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

Il est possible de voir le détail des requêtes dans le navigateur

#. Ouvrez une page web
#. Ouvrez l'interface développeur "Network" de votre navigateur
  
  * Firefox : Ctrl + Maj + Q
  * Chrome : Ctrl + Maj + I
  * IE: Outils > Outils de développement
  * Safari : Ctrl + Alt + I

#. Actualisez la page (F5) et observez les différentes requêtes effectuées par le navigateur
