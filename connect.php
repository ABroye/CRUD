<?php
try{
  // Informations de connexion à la base de données
  $db= new PDO('mysql:host=localhost;dbname=crud', 'root', 'root');
  $db->exec('SET NAME "UTF8"');
} catch (PDOException $e){
  echo 'Erreur : '. $e->getMessage();
  die();
}