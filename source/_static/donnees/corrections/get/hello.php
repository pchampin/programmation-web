<?php
function liste_hello($nb_hello) {
    if (isset($nb_hello) and $nb_hello != 0) {
        if ($nb_hello > 100) {
            $nb_hello = 100;
        }

        echo("<ol>");
        for ($i = 1; $i <= $nb_hello; $i++) {
            echo("<li>");
            echo("Hello world!");
            echo("</li>");
        }
        echo("</ol>");
    } else {
        echo("<p>Le paramètre 'nb_hello' n'est pas correct.</p>");
    }
}

?>