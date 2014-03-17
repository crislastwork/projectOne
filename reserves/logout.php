<?php

session_start(); 
session_destroy(); 
  
// al header hi havia el referer pero no funca
header('Location: index_admin.php');

?>

