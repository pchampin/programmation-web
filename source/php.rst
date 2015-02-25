:tocdepth: 2

============================
 Php
============================

Le Php, c'est quoi ?
====================

PHP: Hypertex Preprocessor
++++++++++++++++++++++++++

.. figure:: _static/php/logo_php.png
   :height: 6ex
   :align: right
   :alt: php
   
   Source image `Wikimedia commons`__
__ http://commons.wikimedia.org/wiki/File:PHP-logo.svg

* Un acronyme récursif !
* Un **langage de script** exécuté **côté serveur**,
* Qui permet d'écrire des pages web **dynamiques**.
* Une extension de fichier (.php).
* Un outil incontournable pour intéragir avec une base de données (MySQL).



C'est aussi un site web http://php.net/ rempli d'autres informations utiles.


Comment ça marche ?
++++++++++++++++++++

- Reprenons l'architecture client serveur ; pour une page statique (HTML) :

	.. figure:: _static/php/client-serveur_HTML.png
		:alt: client-serveur-html

.. container:: build

  .. container::
  
    - pour une page dynamique (PHP) :

		.. figure:: _static/php/client-serveur_HTML.png
            :alt: client-serveur-html
	
Sous-sous titre
---------------

.. code-block:: html

   Ceci est du texte en <em>HTML</em>!

.. tip::

   Ceci est une astuce !

Encore plus fort
----------------

Bam ! du code source numéroté !

.. code-block:: html
  :linenos:

  <!DOCTYPE html>
  <html>
    <head>
      <title>Titre du document</title>
      <meta charset="utf-8"/>
    </head>
    <body>
      ...
    </body>
  </html>


Et si on essayait en Php ?
--------------------------

.. code-block:: php
  :linenos:

  <?php
  echo '<p>Hello $php</p>';
  ?>

