<?php
date_default_timezone_set('Europe/Madrid'); 
$dbhost="localhost";
$dbname="calendario";
$dbuser="root";
$dbpass="root";
$con = mysql_connect($dbhost,$dbuser,$dbpass) or die("<h1>Error al connectar-se a la base de dades.");

?>
