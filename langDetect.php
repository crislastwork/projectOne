<?php

//Detectem idoma user o si ja ha fet tria

function getUserLanguage() {
    $lang = isset($_REQUEST["lang"]);
    if (empty($lang)) {
        $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
        return $idioma;
    } else {
        $idioma = $_REQUEST["lang"];
        return $idioma;
    }
}

$user_language = getUserLanguage();
// Carreguem l'idioma, per defecte catala.
if ($user_language =="ca" | "en" | "fr"){
    include_once "lang/{$user_language}_lang.php";
} else {
   include_once "lang/ca_lang.php";
}
?>