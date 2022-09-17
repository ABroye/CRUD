<?php
  // Démarage de la session
  session_start();

  // Vérification de l'existance de l'ID dans l'URL
  if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    // Nettoyage de l'ID
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `liste` WHERE `id` = :id;';

    // Préparation de la requête
    $query = $db->prepare($sql);

    // Accrochage des paramètres de l'ID
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // Execution de la requête
    $query->execute();

    // Récupération du produit
    $produit = $query->fetch();

    // Vérification de la présence du produit
    if(!$produit){
      $_SESSION['erreur'] = "Ce produit n'existe pas !";
      header('Location: index.php');
      die();
    }

    $sql = 'DELETE FROM `liste` WHERE `id` = :id;';

    // Préparation de la requête
    $query = $db->prepare($sql);

    // Accrochage des paramètres de l'ID
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // Execution de la requête
    $query->execute();
    $_SESSION['message'] = "Produit supprimé avec succès !";
    header('Location: index.php');

  }else{
    $_SESSION['erreur'] = "URL invalide !";
    header('Location: index.php');
  }
?>