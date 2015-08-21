:tocdepth: 2

============================
 PHP et le Web
============================

C'est quoi le Web ?
===================

En quelques mots
++++++++++++++++

* Son vrai nom : World Wide Web
* Une des application d'Internet
* Ensemble hyperdocumentaire (réseau de documents) public
* Basé sur un système hypertexte (protocole HTTP)
* Assemblage de technologies diverses (standards)

Architecture Client Serveur
+++++++++++++++++++++++++++

- **Ressource** : document, image, video publié sur le Web
- **Serveur** : ordinateur connecté à internet sur lequel se trouve des resources
- **Client** : appareil (ordinateur, tablette,...) utilisé pour acceder à ces ressources

.. figure:: _static/client-server-model.svg
   :height: 200ex

   Source image http://commons.wikimedia.org/wiki/File:Client-server-model.svg

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

  NB: les URLs sont parfois appelés URIs → même chose

HTML
++++

* HyperText Markup Language (`HTML`_)
* Standard de description des documents sur le Web
* Langage statique décrivant la structure des pages
* Peut ^etre combiné avec CSS pour la gestion des styles

.. _HTML: http://www.w3.org/TR/html5/

Principes de HTTP
================

HTTP
++++

* HyperText Transfer Protocol (`RFC 2616`_)
* Protocole d'échange de données entre machines
* Utilisé par les clients pour communiquer avec les serveurs

.. _RFC 2616: http://datatracker.ietf.org/doc/rfc2616/

Les Requetes HTTP
+++++++++++++++++

Une requete HTTP contient :
* Le type d'échange (écriture, lecture, ...) => VERBE HTTP
* Spécifie l'adresse => URL
* Transmet des informations à propos du client => HEADER
* Transmet éventuellement des données => BODY

Construction d'une requete
++++++++++++++++++++++++++

Une requete est construite comme suit:

.. code-block:: http
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

* Définissent le type d'échange
* Ont une sémantique propre

.. note:: Une application qui respecte cette sémantique est appellée RESTful

Les Verbes HTTP (2/2)
+++++++++++++++++++++

* GET : Lecture de la ressource
* HEAD : Requête de l'en-tête de la ressource
* POST : Mise à jour de la resource située à l'URL spécifiée
* PUT : Creation de la resource à l'URL spécifiée
* DELETE : Suppression de la ressource

Exemple d'une requete
++++++++++++++++++++++++++

.. code-block:: http
  :linenos:

  GET http://www.univ-lyon1.fr HTTP/1.1
  User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64) 
  			Gecko/20100101 Firefox/40.0
  Accept: text/html
  Accept-Language: en-US
  Connection: keep-alive

.. note:: Ces en-têtes contiennent de précieuses informations pour le serveur

Réponse HTTP
++++++++++++

La réponse du serveur à une requete est similaire:

* Statut de réponse
* En-tetes de réponses
* Corps de la réponse

Statut de réponse HTTP
++++++++++++++++++++++

Le statut de réponse HTTP informe du statut de la requete (`Liste des codes`_:

3 types usuels:
* 2xx : Succes
* 3xx : Redirection
* 4xx : Acces refusé
* 5xx : Erreur serveur

.. note:: Les codes les plus vus sont : 200 OK, 404 NOT FOUND, et 500 INTERNAL SERVER ERROR

.. _Liste des codes: https://fr.wikipedia.org/wiki/Liste_des_codes_HTTP

Construction de réponse
+++++++++++++++++++++++

.. code-block:: http
  [PROTOCOLE] [CODE] [SIGNIFICATIOn] 
  /* En-tetes */
  [TYPE1]:[VALEUR1]
  [TYPE2]:[VALEUR2]
  ...
  /*Ligne vide*/

  /* Corps de la requete */
  [BODY]


.. code-block:: http
  :linenos:

  HTTP/1.1 200 OK 
  Content-Type:text/html
  Content-Length:1245 
  Last-Modified:Tue, 04 Aug 2015 10:25:13 GMT

  <html><body> Corps du document ...

- La première ligne contient le code de réponse à la requ^ete
- Les plus connus sont:

  * **200 OK** pour une requ^ete avec succès
  * **404 Not found** lorsque l'URL pointe vers une resource inexistante
  * **501 Internal error** pour une erreur interne du serveur
